<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }

    public function cash_advance_details(){
        return $this->hasMany(CashAdvanceDetail::class);
    }
}