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
use Carbon\Carbon;

class PositionController extends BaseController
{
    public function index()
    {
        $data['view'] = 'position\index';
        $data['positions'] = Position::with('schedule')->has('schedule')->get();
        $data['schedules'] = Schedule::all();
        return $this->blade->run('employee-management.position.position', $data);
    }

    public function create()
    {
        $schedule = Schedule::create([
            'morning_in' => $_POST['morning_in'],
            'morning_out' => $_POST['morning_out'],
            'afternoon_in' => $_POST['afternoon_in'],
            'afternoon_out' => $_POST['afternoon_out'],
            'working_days' => implode(',', $_POST['working_days']),
        ]);


        $position = Position::updateOrCreate(
            [
                'position' => $_POST['position']
            ],
            [
                'position' => $_POST['position'],
                'rate' => $_POST['rate'],
                'schedule_id' => $schedule->id,
            ]
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

        $schedule = Schedule::find($_POST['schedule_id']);
        $schedule->morning_in = $_POST['morning_in'];
        $schedule->morning_out = $_POST['morning_out'];
        $schedule->afternoon_in = $_POST['afternoon_in'];
        $schedule->afternoon_out = $_POST['afternoon_out'];
        $schedule->working_days = implode(',', $_POST['working_days']);

        $now = Carbon::now()->format('d');
        if ($schedule->isDirty()) {
            if ($now != 1 || $now != 16) {
                $key = "danger";
                $message = "Schedule can only be updated at the beginning of the payroll period";
                return redirect()->route('position.index')->with('status', ['key' => $key, 'message' => $message]);
            } else {
                $schedule->save();
            }
        }

        $status = $position->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Position updated successfully!" : "Opps! There is an error while updating the position.");
        return redirect()->route('position.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete()
    {
        $position = Position::find($_POST['id']);

        $status = false;
        if (count($position->employees()->get()) == 0) {
            $schedule = $position->schedule();
            $schedule->delete();
            $status = $position->delete();

        }
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Position deleted successfully!" : "Opps! There is an error while deleting the position.<br/> Position is currently used.");
        return redirect()->route('position.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}