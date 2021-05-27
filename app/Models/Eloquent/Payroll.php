<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $guarded = [];

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }

    public function employee(){
        return  $this->belongsTo(Employee::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable')->orderBy('created_at','desc');
    }

    public function cash_advance_details(){
        return $this->hasMany(CashAdvanceDetail::class);
    }
}