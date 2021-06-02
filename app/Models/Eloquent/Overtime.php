<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2020
 * Time: 10:21 AM
 */

namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $guarded = [];


    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable')->orderBy('created_at', 'desc');
    }
}