<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowItWork extends Model
{
	protected $fillable = ['created_at','updated_at'];
	
    public function worksdetails()
    {
    	return $this->hasMany(WorkDetail::class,'work_id','id');
    }

    public function getCreatedAtAttribute($value)
    {
        if(empty($value)){
             return '';
        } 
        return $value;
    }

    public function getUpdatedAtAttribute($value)
    {
        if(empty($value)){
             return '';
        } 
        return $value;
    }
}
