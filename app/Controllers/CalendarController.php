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
use App\Models\Eloquent\Payroll;
use Illuminate\Support\Carbon;

class CalendarController extends BaseController
{
    public function index()
    {
        $data['active'] = 'calendar';
        $month = (isset($_POST['month']) ? $_POST['month'] : Carbon::now()->format('m'));
        $year = (isset($_POST['year']) ? $_POST['year'] : Carbon::now()->format('Y'));
        $data['month'] = $month;
        $data['year'] = $year;
        $events = Event::where(function ($query) use ($month, $year) {
            $query->whereMonth('start', '=', $month)->whereYear('start', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('end', '=', $month)->whereYear('end', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('start', '<', $month)->whereYear('start', '=', $year)->whereMonth('end', '>', $month)->whereYear('end', '=', $year);
        })->get();


        foreach ($events as $event) {
            $event->end = Carbon::parse($event->end)->addDays(1)->format('Y-m-d H:i:s');
        }
//        dd($events);


        $data['events'] = $events;

        return $this->blade->run('calendar.calendar', $data);
    }

    public function create()
    {

        $event = Event::updateOrCreate(
            [
                'title' => $_POST['title'],
                'start' => Carbon::createFromFormat('Y-m-d G:i:s', $_POST['start'] . ' 00:00:00'),
                'end' => Carbon::createFromFormat('Y-m-d G:i:s', $_POST['end'] . ' 00:00:00'),
            ],
            [
                'title' => $_POST['title'],
                'start' => Carbon::createFromFormat('Y-m-d G:i:s', $_POST['start'] . ' 00:00:00'),
                'end' => Carbon::createFromFormat('Y-m-d G:i:s', $_POST['end'] . ' 00:00:00'),
                'note' => $_POST['note'],
            ]
        );
        $key = ($event->wasRecentlyCreated ? "success" : "danger");
        $message = ($event->wasRecentlyCreated ? "Event added successfully!" : "Event already exist!");
        return redirect()->route('calendar.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {

        $event = Event::find($_POST['id']);
        $event->title = $_POST['title'];
        $event->start = Carbon::createFromFormat('Y-m-d G:i:s', $_POST['start'] . ' 00:00:00');
        $event->end = isset($_POST['drag']) ? Carbon::createFromFormat('Y-m-d G:i:s', $_POST['end'] . ' 00:00:00')->subDay(1)
            : Carbon::createFromFormat('Y-m-d G:i:s', $_POST['end'] . ' 00:00:00');
        $event->note = $_POST['note'];
        $status = $event->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Event updated successfully!" : ($flag ?? "Opps! There is an error while updating the event."));
        return redirect()->route('calendar.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function get($id)
    {
        return json_encode(Event::find($id)->toArray());
    }

    public function getEventsPerMonth($month, $year)
    {
        $events = Event::where(function ($query) use ($month, $year) {
            $query->whereMonth('start', '=', $month)->whereYear('start', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('end', '=', $month)->whereYear('end', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('start', '<', $month)->whereYear('start', '=', $year)->whereMonth('end', '>', $month)->whereYear('end', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('start', '=', $month+1)->whereYear('start', '=', $year);
        })->orWhere(function ($query) use ($month, $year) {
            $query->whereMonth('end', '=', $month-1)->whereYear('end', '=', $year);
        })->get();

        foreach ($events as $event) {
            $event->end = Carbon::parse($event->end)->addDays(1)->format('Y-m-d H:i:s');
        }
        return json_encode($events);
    }
}