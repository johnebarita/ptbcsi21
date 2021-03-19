<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class HolidayType extends Model
{
    protected $guarded =[];

    public function holidays(){
        return $this->belongsToMany(Holiday::class);
    }
}