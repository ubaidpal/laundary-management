<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    protected $table = 'contactus';

    protected $fillable = [
        'user_id','school_name','fullname', 'first_name','last_name','country_code','contact','email','message','created_at','updated_at'
    ];

    public function schoolname()
    {
    	return $this->belongsTo('App\Models\School','school_name','id');
    }
}
