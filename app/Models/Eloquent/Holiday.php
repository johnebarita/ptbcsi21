<?php


namespace App\Models\Eloquent;



use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $guarded =[];

    public function holiday_type(){
        return $this->belongsTo(HolidayType::class);
    }
}