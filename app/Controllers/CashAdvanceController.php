<?php


namespace App\Controllers;


use App\Models\Eloquent\CashAdvance;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\Overtime;
use App\Models\Eloquent\Schedule;

class CashAdvanceController extends BaseController
{
    public function index(){
        $data['view'] = 'cash-advance\index';
        $data['cash_advances'] = CashAdvance::with('employee','cash_advance_details')->get();
        $data['employees'] = Employee::all();
        $data['active'] = 'cash-advance';
//        return view('template\template', $data);
        return  $this->blade->run('cash-advance.cash-advance', $data);
    }

    public function create(){
        $cash_advance =  CashAdvance::updateOrCreate(
            [
                'employee_id'=>$_POST['employee_id'],
                'request_date'=>$_POST['request_date']
            ],
            [
                'employee_id'=>$_POST['employee_id'],
                'request_date'=>$_POST['request_date'],
                'amount'=>$_POST['amount'],
                'repayment'=>$_POST['repayment'],
                'balance'=>$_POST['repayment'],
                'purpose'=>$_POST['purpose']
            ]
        );
        $key = ($cash_advance->wasRecentlyCreated?"success":"danger");
        $message = ($cash_advance->wasRecentlyCreated?"Cash Advance added successfully!":"Cash advance request already exist!");
        return redirect()->route('cash-advance.index')->with('status',['key'=>$key,'message'=>$message]);
    }

    public function update(){
        $cash_advance = CashAdvance::where('id',$_POST['cash_advance_id'])->first();
        $cash_advance->request_date= $_POST['request_date'];
        $cash_advance->amount= $_POST['amount'];
        $cash_advance->repayment= $_POST['repayment'];
        $cash_advance->purpose= $_POST['purpose'];
        $status = $cash_advance->save();
        $key = ($status?"success":"danger");
        $message = ($status?"Cash Advance updated successfully!":"Opps! There is an error while updating the cash advance request.");
        return redirect()->route('cash-advance.index')->with('status',['key'=>$key,'message'=>$message]);
    }
}