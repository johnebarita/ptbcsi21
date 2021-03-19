<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16/10/2020
 * Time: 11:51 AM
 */

namespace App\Controllers;


use App\Models\Eloquent\Position;
use App\Models\Eloquent\Schedule;

class PositionController extends BaseController
{
    public function index()
    {
        $data['view'] = 'position\index';
        $data['positions'] = Position::with('schedule')->has('schedule')->get();
        $data['schedules'] = Schedule::all();
        return view('template\template', $data);
    }

    public function create()
    {
        $position = Position::updateOrCreate(
            [
                'position' => $_POST['position'],
                'schedule_id' => $_POST['schedule_id']
            ],
            $_POST
        );
        $key = ($position->wasRecentlyCreated ? "success" : "danger");
        $message = ($position->wasRecentlyCreated ? "Position created successfully!" : "Position already exist!");
        return redirect()->route('position.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $position = Position::find($_POST['id']);
        $position->position = $_POST['position'];
        $position->rate = $_POST['rate'];
        $position->schedule_id = $_POST['schedule_id'];
        $status = $position->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Position updated successfully!" : "Opps! There is an error while updating the position.");
        return redirect()->route('position.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete()
    {
        $position = Position::find($_POST['id']);
        $status = false;
        if (count($position->has('employees')->get()) == 0) {
            $status = $position->delete();
        }
        $key = ($status?"success":"danger");
        $message = ($status?"Position deleted successfully!":"Opps! There is an error while deleting the position.<br/> Position is currently used.");
        return redirect()->route('position.index')->with('status',['key'=>$key,'message'=>$message]);
    }
}