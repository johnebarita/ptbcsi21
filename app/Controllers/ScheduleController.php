<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/10/2020
 * Time: 4:41 PM
 */

namespace App\Controllers;


//use Schedule;

use App\Models\Eloquent\Position;
use App\Models\Eloquent\Schedule;

class ScheduleController extends BaseController
{
    public function index()
    {
        $data['view'] = 'schedule\index';
        $data['schedules'] = Schedule::all();
//        return view('template\template', $data);
        return $this->blade->run('schedule.schedule', $data);
    }

    public function create()
    {

        $schedule = Schedule::updateOrCreate($_POST);
        $key = ($schedule->wasRecentlyCreated ? "success" : "danger");
        $message = ($schedule->wasRecentlyCreated ? "Schedule added successfully!" : "Schedule already exist!");
        return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $schedule = Schedule::find($_POST['id']);
        $schedule->time_in = $_POST['time_in'];
        $schedule->time_out = $_POST['time_out'];
        $status = $schedule->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Schedule updated successfully!" : "Opps! There is an error while updating the schedule.");
        return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete()
    {
        $schedule = Schedule::find($_POST['id']);
        $status = false;
        if (count($schedule->positions) == 0) {
            $status = $schedule->delete();
        }
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Schedule deleted successfully!" : "Opps! There is an error while deleting the schedule.<br/> Schedule is currently used.");
        return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
    }

}