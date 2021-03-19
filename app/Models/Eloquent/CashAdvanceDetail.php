<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class CashAdvanceDetail extends Model
{
    protected $guarded = [];

    public function cash_advance(){
        return $this->belongsTo(CashAdvance::class);
    }

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }
}