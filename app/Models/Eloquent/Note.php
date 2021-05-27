<?php

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];

    public function noteable()
    {
        return $this->morphTo();
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
