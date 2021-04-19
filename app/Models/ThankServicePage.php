<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThankServicePage extends Model
{
    protected $table = 'thanks_service_pages';
    protected $fillable = ['image'];

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

}
