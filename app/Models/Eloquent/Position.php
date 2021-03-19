<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 10:20 AM
 */

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $guarded = [];

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}