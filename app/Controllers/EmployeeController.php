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

class EmployeeController extends BaseController
{
    public function index()
    {
        $data['view'] = 'employee\index';
        $data['positions'] = Position::with('schedule')->get();
        $data['employees'] = Employee::with(['position' => function ($query) {
            $query->with('schedule')->get();
        }
        ])->get();
        $data['marital_statuses'] = MaritalStatus::all();
//        return view('template\template', $data);
         return $this->blade->run('employee-management.employee.index',$data);
    }

    public function create()
    {
//        $employee = Employee::create($_POST);
        $daily_rate = $_POST['monthly_pay']*12/313;


        $employee = Employee::create([
            'firstname' => $_POST['firstname'],
            'middle' => $_POST['middle'],
            'lastname' => $_POST['lastname'],
            'gender' => $_POST['gender'],
            'birth_date' => $_POST['birth_date'],
            'marital_status_id' => $_POST['marital_status_id'],
            'mobile_no' => $_POST['mobile_no'],
            'tel_no' => $_POST['tel_no'],
            'email' => $_POST['email'],
            'contact_person' => $_POST['contact_person'],
            'contact_person_no' => $_POST['contact_person_no'],
            'date_hired' => $_POST['date_hired'],
            'bank_name' => $_POST['bank_name'],
            'tin_no' => $_POST['tin_no'],
            'philhealth_no' => $_POST['philhealth_no'],
            'sss_no' => $_POST['sss_no'],
            'pagibig_no' => $_POST['pagibig_no'],
            'is_active' => $_POST['is_active'],
            'position_id' => $_POST['position_id'],
            'monthly_pay' => round($_POST['monthly_pay'],2),
            'basic_pay'=>round($_POST['monthly_pay']*12/313,2),
            'is_fixed_salary' => $_POST['is_fixed_salary'],
            'transportation_allowance' => $_POST['transportation_allowance'],
            'internet_allowance' => $_POST['internet_allowance'],
            'phone_allowance' => $_POST['phone_allowance'],
        ]);
        Address::create(['employee_id' => $employee->id, 'city' => $_POST['address'], 'postal_code' => '123456']);
        if($this->zk->connect()){
            $this->zk->setUser($employee->id, $employee->id, strtoupper($employee->lastname . ' ' . $employee->firstname),'');
            $this->zk->disconnect();
        }
        return redirect()->route('employee.index');
    }
}