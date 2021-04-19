<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryLog extends Model
{
    protected $fillable = [
        'date','orderdetails_id','username','weight_received','weight_plan','overweight','overcharged','created_at','comments','image','updated_at','drycleaning','total'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'orderdetails_id','id');
    }
    
    public function getImageAttribute($value)
    {
        if(!empty($value)){ 

            $url = filter_var($value, FILTER_VALIDATE_URL);
            if ($url) { 
                return $url;
            }else{
                $value = \URL::to('/').'/images/thanks/'.$value;
                return $value; 
            }   
        }
        else{
            return '';
        }
    }

    public function getCommentsAttribute($value)
    {
        if(!empty($value)){ 
            return $value; 
        }
        else{
            return '';
        }
    }
}
