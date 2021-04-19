<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
       'service', 'code','discount','upload_icon','description','expiry_date','status','total','created_at','updated_at'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }
 
    public function getUploadIconAttribute($value)
    {
        if(!empty($value)){ 

            $url = filter_var($value, FILTER_VALIDATE_URL);
            if ($url) { 
                return $url;
            }else{
                $value = \URL::to('/').'/images/users/'.$value;
                return $value; 
            }   
        }
        else{
            return '';
        }
    }

}
