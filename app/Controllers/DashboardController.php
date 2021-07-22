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
use App\Models\Eloquent\CiSession;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Holiday;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\TimeSheet;
use App\Models\Eloquent\User;
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

//            $session = CiSession::all();
//            dd($session);

//        dd($this->session->userData['role']);
        $employees = Employee::all();

        $time_sheets = TimeSheet::with('employee.position.schedule')->whereDate('date', Carbon::now())->get();
        $lates = 0;
        $monthly_lates = [];
        $monthly_absences = [];
        $monthly_presences = [];

//        $this->push();

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

//                $time_stamp = Carbon::createFromFormat('Y-m-d G:i:s', $attendance['timestamp']);

                $time_stamp = Carbon::createFromFormat('G:i:s', '13:00:00');
                $m_in = Carbon::createFromFormat('G:i:s', '08:00:00');
                $m_out = Carbon::createFromFormat('G:i:s', '12:00:00');
                $a_in = Carbon::createFromFormat('G:i:s', '01:00:00');
                $a_out = Carbon::createFromFormat('G:i:s', '05:00:00');

                $time_sheet = TimeSheet::firstOrCreate(
                    ['employee_id' => $attendance['id']],
                    ['date' => $time_stamp->format('Y-m-d')],
                );

                $employee = Employee::with('position.schedule')->find($attendance['id']);

                $m_in->setTimeFromTimeString($employee->position->schedule->morning_in);
                $m_out->setTimeFromTimeString($employee->position->schedule->morning_out);
                $a_in->setTimeFromTimeString($employee->position->schedule->afternoon_in);
                $a_out->setTimeFromTimeString($employee->position->schedule->afternoon_out);

                d($m_in, $m_out, $a_in, $a_out);

                if ($time_stamp->lte($m_in)) {
                    if ($time_sheet->morning_in == '') {
                        d('morning in a');
                    }
                } elseif ($time_stamp->gt($m_in) && $time_stamp->lte($m_out)) {
                    if ($time_sheet->morning_in == '') {
                        d('morning in b');
                    } elseif ($time_sheet->morning_out == '') {
                        d('morning out b');
                    } else {
                        d('afternoon in b');
                    }
                } elseif ($time_stamp->gt($m_out) && $time_stamp->lte($a_out)) {
                    if ($time_sheet->morning_in != '' && $time_sheet->morning_out == '') {
                        d('morning out c');
                    } elseif ($time_sheet->afternoon_in == '') {
                        d('afternoon in c');
                    } else {
                        d('afternoon out c');
                    }
                } elseif ($time_stamp->gt($a_out)) {
                    if ($time_sheet->afternoon_in != '' && $time_sheet->afternoon_out == '') {
                        d('afternoon out d');
                    } elseif ($time_sheet->overtime_in == '') {
                        d('overtime in d');
                    } else {
                        d('overtime out d');
                    }
                }


//                $noon = Carbon::createFromFormat('G:i:s', '11:59:00');
//
//                if ($time_sheet == null) {
//                    $time_sheet = TimeSheet::create([
//                        'employee_id' => $attendance['id'],
//                        'date' => $time_stamp->format('Y-m-d'),
//                    ]);
//                }
//
//
//                if ($time_stamp->lte($noon)) {
//                    if ($time_sheet->morning_in == '') {
//                        $time_sheet->morning_in = $time_stamp->format('G:i');
//                        d('morning in a');
//                    } else {
//                        $time_sheet->morning_out = $time_stamp->format('G:i');
//                        d('morning out a');
//                    }
//                } else {
//                    if ($time_sheet->morning_in != '' && $time_sheet->morning_out == "") {
//                        $time_sheet->morning_out = $time_stamp->format('G:i');
//                        d('morning out b');
//                    } elseif ($time_sheet->afternoon_in == '') {
//                        $time_sheet->afternoon_in = $time_stamp->format('G:i');
//                        d('afternoon in a');
//                    } elseif ($time_sheet->afternoon_out == '') {
//                        $time_sheet->afternoon_out = $time_stamp->format('G:i');
//                        d('afternoon out a');
//                    } elseif ($time_sheet->overtime_in == "") {
//                        $time_sheet->overtime_in = $time_stamp->format('G:i');
//                        d('overtime in a');
//                    } elseif ($time_sheet->overtime_out == "") {
//                        $time_sheet->overtime_out = $time_stamp->format('G:i');
//                        d('overtime out a');
//                    }
//                }

//                $time_sheet->save();
//                if ($time_sheet->morning_in == '') {
//                    if ($time_stamp->lt($noon)) {
//                        $time_sheet->morning_in = $time;
//
//                    } elseif ($time_sheet->afternoon_in == '') {
//                        $time_sheet->afternoon_in = $time;
//
//                    }
//                } elseif ($time_sheet->morning_out == '') {
//                    $time_sheet->morning_out = $time;
//                    $time_sheet->morning_time = $this->get_time_diff($time_sheet->morning_in, $time_sheet->morning_out);
//                    $time_sheet->pre = $time_sheet->morning_time;
//
//                } elseif ($time_sheet->afternoon_in == '') {
//
//                    $time_sheet->afternoon_in = $time;
//
//                } elseif ($time_sheet->afternoon_out == '') {
//
//                    $time_sheet->afternoon_out = $time;
//                    $time_sheet->afternoon_time = $this->get_time_diff($time_sheet->afternoon_in, $time_sheet->afternoon_out);
//                    $time_sheet->pre = (float)$time_sheet->morning_time + (float)$time_sheet->afternoon_time;
//
//                } elseif ($time_sheet->overtime_in == '') {
//                    $time_sheet->overtime_in = $time;
//
//                } elseif ($time_sheet->overtime_out == '') {
//
//                    $time_sheet->overtime_out = $time;
//                    $time_sheet->overtime_time = $this->get_time_diff($time_sheet->overtime_in, $time_sheet->overtime_out);
//
//                }
//                $time_sheet->save();

            }
//            $this->zk->clearAttendance();
            $this->zk->disconnect();
        }

    }

    public function pushUser()
    {
        $employees = Employee::all();
        if ($this->zk->connect()) {
//            $this->zk->clearUsers();
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