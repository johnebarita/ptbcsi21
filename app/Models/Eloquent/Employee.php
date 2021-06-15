<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 10:04 AM
 */

namespace App\Models\Eloquent;
use App\Database\Migrations\AssignedRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Silber\Bouncer\Database\HasRolesAndAbilities;


class Employee extends Model
{
    use SoftDeletes;
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

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function role(){
        return $this->hasOne(AssignedRole::class,'employee_id')->first();
    }
}