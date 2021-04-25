<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 16/10/2020
 * Time: 11:48 AM
 */

namespace App\Controllers;


use App\Controllers\ZKLib\ZKController;
use App\Models\Eloquent\MaritalStatus;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Position;
use App\Models\Eloquent\Address;
use App\Models\Eloquent\Schedule;

class EmployeeController extends BaseController
{
    public function index()
    {
        $data['positions'] = Position::with('schedule')->get();
        $data['schedules'] = Schedule::where('custom', 0)->get();
        $data['employees'] = Employee::withTrashed()->with(['position' => function ($query) {
            $query->with('schedule')->get();
        }])->get();

        $data['marital_statuses'] = MaritalStatus::all();
        return $this->blade->run('employee-management.employee.employee', $data);
    }

    public function create()
    {
        $employee = Employee::where([
            ['firstname', '=', $_POST['firstname']],
            ['lastname', '=', $_POST['lastname']]
        ])->first();

        if ($employee == null) {

            $schedule = Schedule::firstOrCreate([
                'morning_in' => $_POST['morning_in'],
                'morning_out' => $_POST['morning_out'],
                'afternoon_in' => $_POST['afternoon_in'],
                'afternoon_out' => $_POST['afternoon_out'],
                'working_days' => implode(',', $_POST['working_days']),
            ])->firstOrCreate();

            if ($schedule->wasRecentlyCreated) {
                $schedule->custom = 1;
                $schedule->save();
                $schedule_id = $schedule->id;
            } else {
                $schedule_id = null;
            }

            $total_allowance = ($_POST['transportation_allowance'] == '' ? 0 : $_POST['transportation_allowance']) +
                ($_POST['meal_allowance'] == '' ? 0 : $_POST['meal_allowance']) +
                ($_POST['internet_allowance'] == '' ? 0 : $_POST['internet_allowance']) +
                ($_POST['phone_allowance'] == '' ? 0 : $_POST['phone_allowance']);

            $employee = Employee::create([
                'firstname' => $_POST['firstname'],
                'middle' => $_POST['middle'],
                'lastname' => $_POST['lastname'],
                'gender' => $_POST['sex'],
                'birth_date' => $_POST['birth_date'],
                'marital_status_id' => $_POST['marital_status_id'],
                'address' => $_POST['address'],
                'mobile_no' => $_POST['mobile_no'],
                'tel_no' => $_POST['tel_no'],
                'email' => $_POST['email'],
                'contact_person' => $_POST['contact_person'],
                'contact_person_no' => $_POST['contact_person_no'],
                'date_hired' => $_POST['date_hired'],//todo I think you can change this to date data type
                'bank_name' => $_POST['bank_name'],
                'tin_no' => $_POST['tin_no'],
                'philhealth_no' => $_POST['philhealth_no'],
                'sss_no' => $_POST['sss_no'],
                'pagibig_no' => $_POST['pagibig_no'],
                'is_active' => $_POST['is_active'],
                'position_id' => $_POST['position_id'],
                'monthly_pay' => round($_POST['monthly_pay'], 2),
                'basic_pay' => round($_POST['monthly_pay'] * 12 / 313, 2),//todo update basic pay based on his schedule
                'schedule_id' => $schedule_id,
                'is_fixed_salary' => $_POST['is_fixed_salary'],
                'can_ot' => $_POST['can_ot'],
                'transportation_allowance' => $_POST['transportation_allowance'] == '' ? 0 : $_POST['transportation_allowance'],
                'meal_allowance' => $_POST['meal_allowance'] == '' ? 0 : $_POST['meal_allowance'],
                'internet_allowance' => $_POST['internet_allowance'] == '' ? 0 : $_POST['internet_allowance'],
                'phone_allowance' => $_POST['phone_allowance'] == '' ? 0 : $_POST['phone_allowance'],
                'total_allowance' => $total_allowance,
            ]);
            $status = $employee->wasRecentlyCreated;
            //        if($this->zk->connect()){
//            $this->zk->setUser($employee->id, $employee->id, strtoupper($employee->lastname . ' ' . $employee->firstname),'');
//            $this->zk->disconnect();
//        }
        } else {
            $status = false;
        }

        $key = ($status ? "success" : "danger");
        $message = ($status ? "Employee added successfully!" : "Employee  already exist!");
        return redirect()->route('employee.index')->with('status', ['key' => $key, 'message' => $message]);

    }

    public function update()
    {

        $schedule = Schedule::where([
            ['morning_in', '=', $_POST['morning_in']],
            ['morning_out', '=',$_POST['morning_out']],
            ['afternoon_in', '=',$_POST['afternoon_in']],
            ['afternoon_out', '=', $_POST['afternoon_out']],
            ['working_days', '=', implode(',', $_POST['working_days'])],
        ])->first();

        if ($schedule == null) {
            $schedule = Schedule::create([
                'morning_in' => $_POST['morning_in'],
                'morning_out' => $_POST['morning_out'],
                'afternoon_in' => $_POST['afternoon_in'],
                'afternoon_out' => $_POST['afternoon_out'],
                'working_days' => implode(',', $_POST['working_days']),
                'custom' => true
            ]);
        }

        if ($schedule->wasRecentlyCreated) {
            $schedule->custom = 1;
            $schedule->save();
            $schedule_id = $schedule->id;
        } elseif ($schedule->custom == true) {
            $schedule_id = $schedule->id;
        }else{
            $schedule_id = null;
        }

        $total_allowance = ($_POST['transportation_allowance'] == '' ? 0 : $_POST['transportation_allowance']) +
            ($_POST['meal_allowance'] == '' ? 0 : $_POST['meal_allowance']) +
            ($_POST['internet_allowance'] == '' ? 0 : $_POST['internet_allowance']) +
            ($_POST['phone_allowance'] == '' ? 0 : $_POST['phone_allowance']);

        $employee = Employee::find($_POST['id']);
        $employee->firstname = $_POST['firstname'];
        $employee->middle = $_POST['middle'];
        $employee->lastname = $_POST['lastname'];
        $employee->gender = $_POST['sex'];
        $employee->birth_date = $_POST['birth_date'];
        $employee->marital_status_id = $_POST['marital_status_id'];
        $employee->address = $_POST['address'];
        $employee->mobile_no = $_POST['mobile_no'];
        $employee->tel_no = $_POST['tel_no'];
        $employee->email = $_POST['email'];
        $employee->contact_person = $_POST['contact_person'];
        $employee->contact_person_no = $_POST['contact_person_no'];
        $employee->date_hired = $_POST['date_hired'];//todo I think you can change this to date data type
        $employee->bank_name = $_POST['bank_name'];
        $employee->tin_no = $_POST['tin_no'];
        $employee->philhealth_no = $_POST['philhealth_no'];
        $employee->sss_no = $_POST['sss_no'];
        $employee->pagibig_no = $_POST['pagibig_no'];
        $employee->is_active = $_POST['is_active'];
        $employee->position_id = $_POST['position_id'];
        $employee->monthly_pay = round($_POST['monthly_pay'], 2);
        $employee->basic_pay = round($_POST['monthly_pay'] * 12 / 313, 2);//todo update basic pay based on his schedule
        $employee->schedule_id = $schedule_id;
        $employee->is_fixed_salary = $_POST['is_fixed_salary'];
        $employee->can_ot = $_POST['can_ot'];
        $employee->transportation_allowance = $_POST['transportation_allowance'] == '' ? 0 : $_POST['transportation_allowance'];
        $employee->meal_allowance = $_POST['meal_allowance'] == '' ? 0 : $_POST['meal_allowance'];
        $employee->internet_allowance = $_POST['internet_allowance'] == '' ? 0 : $_POST['internet_allowance'];
        $employee->phone_allowance = $_POST['phone_allowance'] == '' ? 0 : $_POST['phone_allowance'];
        $employee->total_allowance = $total_allowance;

        $status = $employee->save();
        $key = ($status ? "success" : "danger");
        $message = ($status ? "Employee details updated successfully!" : "Opps! There is an error while updating the details.");
        return redirect()->route('employee.index')->with('status', ['key' => $key, 'message' => $message]);
    }

    public function delete(){
        $employee = Employee::find($_POST['id']);
        $employee->delete();
        return redirect()->route('employee.index');
    }
    public function restore(){
        $employee = Employee::withTrashed()->find($_POST['id']);
        $employee->restore();
        return redirect()->route('employee.index');
    }

    public function get($id)
    {
        return json_encode(Employee::with('position.schedule', 'schedule')->find($id)->toArray());
    }
}