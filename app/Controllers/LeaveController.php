<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/10/2020
 * Time: 1:31 PM
 */

namespace App\Controllers;


use App\Models\Eloquent\LeaveType;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Leave;

class LeaveController extends BaseController
{

    public function index()
    {
        $data['view'] = 'leave\index';
        $data['leaves'] = Leave::with('employee')->with('leave_type')->get();
        $data['employees'] = Employee::all();
        $data['leave_types'] = LeaveType::all();
//        return view('template\template', $data);
        return $this->blade->run('request.leave.leave', $data);
    }

    public function create()
    {
        $leave = Leave::updateOrCreate(
            [
                'employee_id' => $_POST['employee_id'],
                'request_start' => $_POST['request_start'],
                'request_end' => $_POST['request_end'],
            ], $_POST
        );

        $key = ($leave->wasRecentlyCreated ? "success" : "danger");
        $message = ($leave->wasRecentlyCreated ? "Leave requested successfully!" : "Leave request already exist!");
        return redirect()->route('leave.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $leave = Leave::find($_POST['id']);
        $leave->status = $_POST['status'];
        $status = $leave->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Leave request updated successfully!" : "Opps! There is an error while updating the leave request.");
        return redirect()->route('leave.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}