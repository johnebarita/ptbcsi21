<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    protected $guarded = [];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function cash_advance_details(){
        return $this->hasMany(CashAdvanceDetail::class);
    }
}