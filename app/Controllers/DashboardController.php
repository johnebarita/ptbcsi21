<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14/10/2020
 * Time: 5:36 PM
 */

namespace App\Controllers;


use App\Controllers\ZKLib\ZKController;
use App\Models\Eloquent\AttendanceSummary;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Holiday;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\TimeSheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use CodeIgniter\Database\Database;
use phpDocumentor\Reflection\Types\This;

class DashboardController extends BaseController
{
    function __construct()
    {

    }

//    public function index()
//    {
//        $employees = Employee::all();
//        dd($employees);
//    }

    public function index()
    {
        $employees = Employee::all();
        $time_sheets = TimeSheet::with('employee.position.schedule')->whereDate('date', Carbon::now())->get();
        $lates = 0;
        $monthly_lates = [];
        $monthly_absences = [];
        $monthly_presences = [];

        $this->push();

        foreach ($time_sheets as $time_sheet) {
            if (Carbon::parse($time_sheet->morning_in)->gt(Carbon::parse($time_sheet->employee->position->schedule->time_in))
                || Carbon::parse($time_sheet->afternoon_in)->gt(Carbon::parse($time_sheet->employee->position->schedule->time_out))) {
                $lates++;
            }
        }

        foreach (range(1, Carbon::now()->format('n')) as $number) {
            $late = 0;
            $absent = 0;
            $present = 0;

            $attendanceSummary = AttendanceSummary::where('date', Carbon::createFromFormat('n', $number)->startOfMonth())->get();

            if (count($attendanceSummary) != 0) {
                $monthly_lates[] = $attendanceSummary[0]->late;
                $monthly_absences[] = $attendanceSummary[0]->absent;
                $monthly_presences[] = $attendanceSummary[0]->present;

            } else {

                $monthly_time_sheets = TimeSheet::whereBetween('date', [Carbon::createFromFormat('n', $number)->startOfMonth(), Carbon::createFromFormat('n', $number)->endOfMonth()])->get();

                //TODO calculate monthly lates
                foreach ($monthly_time_sheets as $time_sheet) {
                    $holiday = Holiday::whereDate('start', '=', Carbon::parse($time_sheet->date));

                    if (Carbon::parse($time_sheet->morning_in)->gt(Carbon::parse($time_sheet->employee->position->schedule->time_in))
                        || Carbon::parse($time_sheet->afternoon_in)->gt(Carbon::parse($time_sheet->employee->position->schedule->time_out))) {
                        $late++;
                    }
                }

                //TODO calculate monthly absent and present
                foreach ($employees as $employee) {

                    $mt = TimeSheet::where('employee_id', $employee->id)->whereBetween('date', [Carbon::createFromFormat('n', $number)->startOfMonth(), Carbon::createFromFormat('n', $number)->endOfMonth()])->get();
                    $periods = CarbonPeriod::create(Carbon::createFromFormat('n', $number)->startOfMonth(), Carbon::createFromFormat('n', $number)->endOfMonth());
                    foreach ($periods as $period) {
                        if ($period->lte(Carbon::now())) {
                            $time_sheet = $mt->where('date', $period)->first();
                            if ($time_sheet == null) {
                                if ($period->format('D') != 'Sun') {
                                    $absent++;
                                }
                            } else {
                                $present++;
                            }
                        }
                    }
                }

                AttendanceSummary::updateOrCreate(
                    [
                        'date' => Carbon::createFromFormat('n', $number)->startOfMonth(),
                    ],
                    [
                        'date' => Carbon::createFromFormat('n', $number)->startOfMonth(),
                        'absent' => $absent,
                        'late' => $late,
                        'present' => $present

                    ]);
                $monthly_lates[] = $late;
                $monthly_absences[] = $absent;
                $monthly_presences[] = $present;
            }
        }


        return $this->blade->run('dashboard.dashboard', compact(['employees', 'time_sheets', 'lates', 'monthly_lates', 'monthly_absences', 'monthly_presences']), 1, 60);


//        $data['view'] = 'dashboard\index';
        //        $this->push();
//        return view('template\template', $data);
    }

    public function push()
    {

        if ($this->zk->connect()) {

            $attendances = $this->zk->getAttendance();
            foreach ($attendances as $attendance) {

                $date = Carbon::createFromFormat('Y-m-d G:i:s', $attendance['timestamp'])->format('Y-m-d');
                $time = Carbon::createFromFormat('Y-m-d G:i:s', $attendance['timestamp'])->format('h:i');
                $time_sheet = TimeSheet::where([['employee_id', '=', $attendance['id']], ['date', '=', $date]])->first();

                if ($time_sheet == null) {
                    TimeSheet::create([
                        'employee_id' => $attendance['id'],
                        'date' => $date,
                        'morning_in' => $time
                    ]);
                } else {
                    if ($time_sheet->morning_in == '') {

                        $time_sheet->morning_in = $time;

                    } elseif ($time_sheet->morning_out == '') {

                        $time_sheet->morning_out = $time;
                        $time_sheet->morning_time = $this->get_time_diff($time_sheet->morning_in, $time_sheet->morning_out);
                        $time_sheet->pre = $time_sheet->morning_time;

                    } elseif ($time_sheet->afternoon_in == '') {

                        $time_sheet->afternoon_in = $time;

                    } elseif ($time_sheet->afternoon_out == '') {

                        $time_sheet->afternoon_out = $time;
                        $time_sheet->afternoon_time = $this->get_time_diff($time_sheet->afternoon_in, $time_sheet->afternoon_out);
                        $time_sheet->pre = (float)$time_sheet->morning_time + (float)$time_sheet->afternoon_time;

                    } elseif ($time_sheet->overtime_in == '') {
                        $time_sheet->overtime_in = $time;

                    } elseif ($time_sheet->overtime_out == '') {

                        $time_sheet->overtime_out = $time;
                        $time_sheet->overtime_time = $this->get_time_diff($time_sheet->overtime_in, $time_sheet->overtime_out);

                    }
                    $time_sheet->save();
                }
            }
            $this->zk->clearAttendance();
            $this->zk->disconnect();
        }

    }

    public function pushUser()
    {
        $employees = Employee::all();
        if ($this->zk->connect()) {
            foreach ($employees as $employee) {
                $this->zk->setUser($employee->id, $employee->id, strtoupper($employee->lastname . ' ' . $employee->firstname), '');
            }
            $this->zk->disconnect();
        }
//
//
//        }
    }

    public function get_time_diff($in, $out)
    {
        $in = Carbon::createFromTimeString($in);
        $out = Carbon::createFromTimeString($out);
        return (number_format($in->diffInMinutes($out) / 60.0, 2));
    }

}