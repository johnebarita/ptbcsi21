<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/10/2020
 * Time: 1:31 PM
 */

namespace App\Controllers;


use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Overtime;
use App\Models\Eloquent\TimeSheet;
use Carbon\Carbon;

class OvertimeController extends BaseController
{

    public function index()
    {
        $data['overtimes'] = Overtime::with('employee')->get();
        $data['employees'] = Employee::all();
        return $this->blade->run('request.overtime.overtime', $data);
    }

    public function create()
    {
        $overtime = Overtime::updateOrCreate(
            ['employee_id' => $_POST['employee_id'], 'request_date' => $_POST['request_date']],
            $_POST
        );
        $key = ($overtime->wasRecentlyCreated ? "success" : "danger");
        $message = ($overtime->wasRecentlyCreated ? "Overtime requested successfully!" : "Overtime request already exist!");
        return redirect()->route('overtime.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $overtime = Overtime::find($_POST['id']);
        $overtime->status = $_POST['status'];
        $status = $overtime->save();
        $time_sheet = TimeSheet::where('employee_id', $overtime->employee_id)->where('date', $overtime->created_at->format('Y-m-d'))->first();
        if ($time_sheet) {
            if ($overtime->status == 'accepted') {
                $time_sheet->overtime_in = Carbon::createFromFormat('G:i', $overtime->overtime_in)->format('h:i');
                $time_sheet->overtime_out = Carbon::createFromFormat('G:i', $overtime->overtime_out)->format('h:i');
                $time_sheet->overtime_time = number_format(Carbon::createFromFormat('G:i', $overtime->overtime_in)->diffInMinutes($overtime->overtime_out) / 60.0, 2);
                $time_sheet->ot += $time_sheet->overtime_time;
            } else {
                $time_sheet->ot -=$time_sheet->overtime_time;
                $time_sheet->overtime_in = null;
                $time_sheet->overtime_out = null;
                $time_sheet->overtime_time = null;

            }
            $status = $time_sheet->save();
        }

        $key = ($status ? "success" : "danger");
        $message = ($status ? "Overtime request updated successfully!" : "Opps! There is an error while updating the overtime request.");
        return redirect()->route('overtime.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}