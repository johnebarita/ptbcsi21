<?php


namespace App\Controllers;


use App\Models\Eloquent\CashAdvance;
use App\Models\Eloquent\CashAdvanceDetail;
use App\Models\Eloquent\Payroll;

class CashAdvanceDetailController extends BaseController
{
    public function get($id){
        return json_encode(CashAdvance::with('employee')->with(['cash_advance_details'=>function($query){
           $query->orderBy('created_at')->get();
        }])->where('id',$id)->first());
    }
}