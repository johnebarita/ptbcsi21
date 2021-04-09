<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 10:04 AM
 */

namespace App\Models\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Silber\Bouncer\Database\HasRolesAndAbilities;


class Employee extends Model
{

    protected $guarded = [];

    public function position(){
        return $this->belongsTo(Position::class);
    }

    public function overtimes(){
        return $this->hasMany(Position::class);
    }

    public function time_sheets(){
        return $this->hasMany(TimeSheet::class);
    }

    public function payrolls(){
        return $this->hasMany(Payroll::class);
    }

    public function cash_advances(){
        return $this->hasMany(CashAdvance::class);
    }

}