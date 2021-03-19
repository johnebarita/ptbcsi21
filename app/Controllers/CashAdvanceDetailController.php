<?php


namespace App\Controllers;


use App\Models\Eloquent\CashAdvance;
use App\Models\Eloquent\CashAdvanceDetail;

class CashAdvanceDetailController extends BaseController
{
    public function get_detail(){
        $data=array(
            'cash_advance' =>CashAdvance::with('employee')->where('id',$_POST['id'])->first(),
            'cash_advance_details' => CashAdvanceDetail::with('cash_advance')->where('cash_advance_id',$_POST['id'])->orderBy('created_at')->get(),
            'csrf_hash'=> csrf_hash()
        );
        return json_encode($data);
    }
}