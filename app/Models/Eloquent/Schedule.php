<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 10:13 AM
 */

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $guarded=[];

    public function positions(){
        return $this->hasMany(Position::class);
    }

    public function course(){
        return $this->hasOne(Course::class);
    }
}