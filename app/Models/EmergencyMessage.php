<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyMessage extends Model
{
    public function users()
    {
    	return $this->belongsTo('App\Models\User','user_id');
    }

    public function schools()
    {
    	return $this->belongsTo('App\Models\School','school_id');
    }

    public function usersnames()
    {
    	return $this->hasOne('App\Models\User','id','user_id');
    }

    public function schoolby()
    {
        return $this->hasMany('App\Models\User','school_name','school_id');
    }
}
