<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26/10/2020
 * Time: 5:17 PM
 */

namespace App\Controllers;

use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Holiday;
use App\Models\Eloquent\TimeSheet;
use Carbon\CarbonPeriod;
use Illuminate\Support\Carbon;

class DtrController extends BaseController
{
    public function index()
    {
        $data['view'] = 'dtr\index';

        $half = (isset($_POST['half']) ? $_POST['half'] : (Carbon::now()->format('d') < 15 ? 'A' : 'B'));
        $month = (isset($_POST['month']) ? $_POST['month'] : Carbon::now()->format('m'));
        $year = (isset($_POST['year']) ? $_POST['year'] : Carbon::now()->format('Y'));


        $start = ($half == "A" ? 1 : 16);
        $end = ($half == "A" ? 15 : Carbon::createFromFormat('m-Y', $month . '-'.$year  )->endOfMonth()->format('d'));

        $data['half'] = $half;
        $data['month'] = $month;
        $data['year'] = $year;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['employees'] = Employee::all();
        $data['time_sheets'] = [];
        $data['employee_id'] = 0;
        $data['holidays'] = Holiday::with('holiday_type')->whereBetween('start', [$year . '-' . $month . '-' . $start, $year . '-' . $month . '-' . $end])->get();

        if (isset($_POST['employee_id'])) {
            $time_sheets = TimeSheet::where('employee_id', '=', $_POST['employee_id'])->whereBetween('date', [$year . '-' . $month . '-' . $start, $year . '-' . $month . '-' . $end])->get();
            $data['time_sheets'] = $time_sheets;
            $data['employee_id'] = $_POST['employee_id'];
        }



        return $this->blade->run('dtr.index', $data);
//        return view('template\template', $data);
    }

}

