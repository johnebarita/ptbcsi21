<?php


namespace App\Controllers\CLI;


use App\Controllers\BaseController;
use App\Models\Eloquent\TimeSheet;
use Carbon\Carbon;

class AttendancePusher extends BaseController
{

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

    public function get_time_diff($in, $out)
    {
        $in = Carbon::createFromTimeString($in);
        $out = Carbon::createFromTimeString($out);
        return (number_format($in->diffInMinutes($out) / 60.0, 2));
    }

}