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
use Carbon\Carbon;
use http\Client\Request;
use Symfony\Contracts\EventDispatcher\Event;

class ScheduleController extends BaseController
{
    public function index()
    {
        $data['schedules'] = Schedule::with('positions')->where('custom',0)->get();

        return $this->blade->run('schedule.schedule', $data);
    }

    public function create()
    {

        $schedule = Schedule::updateOrCreate(
            [
                'morning_in' => $_POST['morning_in'],
                'morning_out' => $_POST['morning_out'],
                'afternoon_in' => $_POST['afternoon_in'],
                'afternoon_out' => $_POST['afternoon_out'],
                'working_days' => implode(',', $_POST['working_days'])
            ],
            [
                'morning_in' => $_POST['morning_in'],
                'morning_out' => $_POST['morning_out'],
                'afternoon_in' => $_POST['afternoon_in'],
                'afternoon_out' => $_POST['afternoon_out'],
                'working_days' => implode(',', $_POST['working_days'])
            ]
        );

        $key = ($schedule->wasRecentlyCreated ? "success" : "danger");
        $message = ($schedule->wasRecentlyCreated ? "Schedule added successfully!" : "Schedule already exist!");
        return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {

        $schedule = Schedule::find($_POST['id']);
        $schedule->morning_in = $_POST['morning_in'];
        $schedule->morning_out = $_POST['morning_out'];
        $schedule->afternoon_in = $_POST['afternoon_in'];
        $schedule->afternoon_out = $_POST['afternoon_out'];
        $schedule->working_days = implode(',', $_POST['working_days']);

        $existed = Schedule::where([
            ['morning_in', '=', $schedule->morning_in],
            ['morning_out', '=', $schedule->morning_out],
            ['afternoon_in', '=', $schedule->afternoon_in],
            ['afternoon_out', '=', $schedule->afternoon_out],
            ['working_days', '=', $schedule->working_days],
        ])->get();

        if (count($existed) != 0) {
            $flag = "Schedule already exist!";
            $status = false;
        } else {
            $now =  Carbon::now()->format('d');
            if(count($schedule->positions) !=0 && $now!=1 || $now!=16 ){
                $key = "danger";
                $message = "Schedule can only be updated at the beginning of the payroll period";
                return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
            }else{
                $status = $schedule->save();
            }
        }
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Schedule updated successfully!" : ($flag ?? "Opps! There is an error while updating the schedule."));
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
        $message = ($status ? "Schedule deleted successfully!" : "Opps! There is an error while deleting the schedule.<br>Schedule is currently used.");
        return redirect()->route('schedule.index')->with('status', ['key' => $key, 'message' => $message]);
    }

}