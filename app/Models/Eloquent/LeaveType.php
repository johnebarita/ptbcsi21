<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 3:10 PM
 */

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $guarded = [];

    public function leaves(){
        return $this->belongsToMany(Leave::class);
    }
}