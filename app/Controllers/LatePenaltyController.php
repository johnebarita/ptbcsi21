<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Eloquent\LatePenalty;
use App\Models\Eloquent\Schedule;
use function Symfony\Component\Translation\t;

class LatePenaltyController extends BaseController
{
    public function index()
    {



        $data['late_penalties'] = LatePenalty::all();
        return $this->blade->run('deduction.late-penalty.late_penalty', $data);
    }

    public function create()
    {
        $penalty = LatePenalty::updateOrCreate(
            [
                'from' => $_POST['from_h'] . ':' . $_POST['from_m'],
                'to' => $_POST['to_h'] . ':' . $_POST['to_m'],
                'equivalent' => $_POST['equivalent_h'] . ':' . $_POST['equivalent_m'],
            ],
            [
                'from' => $_POST['from_h'] . ':' . $_POST['from_m'],
                'to' => $_POST['to_h'] . ':' . $_POST['to_m'],
                'equivalent' => $_POST['equivalent_h'] . ':' . $_POST['equivalent_m'],
            ]

        );
        if ($_POST['from_h'] == '' || $_POST['from_m'] == ''
            || $_POST['to_h'] == '' || $_POST['to_m'] == ''
            || $_POST['equivalent_h'] == '' || $_POST['equivalent_m'] == '') {
            $penalty->delete();
            return redirect()->route('late-penalty.index')->with('status', ['key' => 'danger', 'message' => 'Please add valid values.']);
        }

        $key = ($penalty->wasRecentlyCreated ? "success" : "danger");
        $message = ($penalty->wasRecentlyCreated ? "Late Penalty added successfully!" : "Late Penalty already exist!");
        return redirect()->route('late-penalty.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function update()
    {
        $penalty = LatePenalty::where([
            'from' => $_POST['from_h'] . ':' . $_POST['from_m'],
            'to' => $_POST['to_h'] . ':' . $_POST['to_m'],
            'equivalent' => $_POST['equivalent_h'] . ':' . $_POST['equivalent_m'],
        ])->get();

        if (count($penalty) == 0) {
            $from = $_POST['from_h'] . ':' . $_POST['from_m'];
            $to = $_POST['to_h'] . ':' . $_POST['to_m'];
            $equivalent = $_POST['equivalent_h'] . ':' . $_POST['equivalent_m'];

            if ($_POST['from_h'] == '' || $_POST['from_m'] == ''
                || $_POST['to_h'] == '' || $_POST['to_m'] == ''
                || $_POST['equivalent_h'] == '' || $_POST['equivalent_m'] == '') {
                return redirect()->route('late-penalty.index')->with('status', ['key' => 'danger', 'message' => 'Please add valid values.']);
            } else {
                $penalty = LatePenalty::find($_POST['id']);
                $penalty->from = $from;
                $penalty->to = $to;
                $penalty->equivalent = $equivalent;
                $status = $penalty->save();
                $key = ($status ? "success" : "danger");
                $message = ($status ? "Late Penalty updated successfully!" : "Oops! There is an error while updating late penalty");
                return redirect()->route('late-penalty.index')->with('status', ['key' => $key, 'message' => $message]);
            }
        } else {
            return redirect()->route('late-penalty.index')->with('status', ['key' => 'danger', 'message' => 'Late Penalty already exist']);
        }
    }

    public function delete()
    {
        $penalty = LatePenalty::find($_POST['id']);
        $status = $penalty->delete();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Late Penalty deleted successfully!" : "Opps! There is an error while deleting the late penalty.");
        return redirect()->route('late-penalty.index')->with('status', ['key' => $key, 'message' => $message]);
    }
}
