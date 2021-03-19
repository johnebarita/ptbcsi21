<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 2:52 PM
 */

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Leave extends  Model
{
    protected $guarded =[];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function leave_type(){
        return $this->belongsTo(LeaveType::class);
    }
}