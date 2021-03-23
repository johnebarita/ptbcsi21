<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/10/2020
 * Time: 4:53 PM
 */

namespace App\Controllers;


use App\Database\Migrations\Events;
use App\Models\Eloquent\Event;
use Illuminate\Support\Carbon;

class CalendarController extends BaseController
{
    public function index()
    {
        $data['view'] = 'calendar\index';
        $data['active'] = 'calendar';
        $data['events'] = Event::all();
        $month = (isset($_POST['month']) ? $_POST['month'] : Carbon::now()->format('m'));
        $year = (isset($_POST['year']) ? $_POST['year'] : Carbon::now()->format('Y'));
        $data['month'] = $month;
        $data['year'] = $year;
        $events = Event::where(function ($query) use ($month, $year) {
            $query->whereMonth('start', '=', $month)
                ->orWhereMonth('end', '=', $month);
//            $query->whereYear('start', '=', $year)
//                ->orWhereYear('end', '=', $year);
        })->get();

        $data['events'] = $events;

//        return view('template\template', $data);
        return $this->blade->run('calendar.calendar', $data);
    }

    public function create()
    {
        Event::updateOrCreate($_POST);
        return redirect()->route('calendar.index')->with('success', 'Event added successfully!');
    }

    public function update()
    {
        $event = Event::find($_POST['id']);
        $event->start = $_POST['start'];
        $event->end = $_POST['end'];
        $event->save();
        return "Success";
    }
}