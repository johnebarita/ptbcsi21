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
use App\Models\Eloquent\Schedule;
use App\Models\Eloquent\TimeSheet;
use Carbon\Carbon;

class OvertimeController extends BaseController
{

    public function index()
    {


        if (session()->userData['role'] == 'Employee') {
            $data['overtimes'] = Overtime::with('employee')->where('employee_id', session()->userData['id'])->get();
            $data['employees'] = Employee::where('id', session()->userData['id'])->get();
        } else {
            $data['overtimes'] = Overtime::with('employee')->get();
            $data['employees'] = Employee::all();
        }
        return $this->blade->run('request.overtime.overtime', $data);
    }

    public function create()
    {

        if (isset($_POST['type'])) {
            $employee = Employee::with('position.schedule', 'schedule')->find(session()->userData['id']);

            if ($employee->schedule != null) {
                $afternoon_out = $employee->schedule->afternoon_out;
            } else {
                $afternoon_out = $employee->position->schedule->afternoon_out;
            }

            $overtime = Overtime::updateOrCreate(
                [
                    'employee_id' => $employee->id,
                    'request_date' => Carbon::now()->format('Y-m-d'),
                ],
                [
                    'employee_id' => $employee->id,
                    'request_date' => Carbon::now()->format('Y-m-d'),
                    'overtime_in' => $afternoon_out,
                    'overtime_out' => '20:00',
                    'note' => $_POST['note'],
                ]
            );
            $message = "Overtime requested successfully!";
            return redirect()->route('dtr.index')->with('status', ['key' => 'success', 'message' => $message]);
        } else {
            $overtime = Overtime::where(['employee_id' => $_POST['employee_id'], 'request_date' => $_POST['request_date']])->first();
            if ($overtime != null) {
                return redirect()->route('overtime.index')->with('status', ['key' => 'danger', 'message' => "Overtime request already exist!"]);
            } else {
                $request_date = Carbon::createFromFormat('Y-m-d', $_POST['request_date']);
               if($request_date->gt(Carbon::now())){
                   return redirect()->route('overtime.index')->with('status', ['key' => 'danger', 'message' => 'Unable to request overtime for future days!']);
               }
                $overtime = Overtime::updateOrCreate(
                    [
                        'employee_id' => $_POST['employee_id'],
                        'request_date' => $_POST['request_date']
                    ],
                    $_POST
                );

                return redirect()->route('overtime.index')->with('status', ['key' => 'success', 'message' => 'Overtime requested successfully!']);
            }

        }

    }

    public function update()
    {

        $overtime = Overtime::find($_POST['id']);
        $overtime->status = $_POST['status'];
        $dirty =$overtime->isDirty();
        $status = $overtime->save();
        $time_sheet = TimeSheet::where('employee_id', $overtime->employee_id)->where('date', $overtime->created_at->format('Y-m-d'))->first();

        if ($time_sheet) {
            if($dirty){
                if ($overtime->status == 'accepted') {
                    $time_sheet->overtime_in = Carbon::createFromFormat('G:i', $overtime->overtime_in)->format('h:i');
                    $time_sheet->overtime_out = Carbon::createFromFormat('G:i', $overtime->overtime_out)->format('h:i');
                    $time_sheet->overtime_time = number_format(Carbon::createFromFormat('G:i', $overtime->overtime_in)->diffInMinutes($overtime->overtime_out) / 60.0, 2);
                    $time_sheet->ot += $time_sheet->overtime_time;
                } else {
                    $time_sheet->ot -= $time_sheet->overtime_time;
                    $time_sheet->overtime_in = null;
                    $time_sheet->overtime_out = null;
                    $time_sheet->overtime_time = null;
                }
            }

            $status = $time_sheet->save();

        }

        if($_POST['action']=='delete'){
            $status = $overtime->delete();
            $key = ($status ? "success" : "danger");
            $message = ($status ? "Overtime request deleted successfully!" : "Opps! There is an error while deleting the overtime request.");
            return redirect()->route('overtime.index')->with('status', ['key' => $key, 'message' => $message]);
        }

        $key = ($status ? "success" : "danger");
        $message = ($status ? "Overtime request updated successfully!" : "Opps! There is an error while updating the overtime request.");
        return redirect()->route('overtime.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}