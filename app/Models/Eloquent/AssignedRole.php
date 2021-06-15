<?php


namespace App\Models\Eloquent;


use Illuminate\Database\Eloquent\Model;

class AssignedRole extends Model
{
    protected $guarded = [];
    public $with=['role'];
    public function role(){
        return $this->belongsTo(Role::class);
    }
}