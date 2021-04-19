<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class StaffMember extends Authenticatable
{
    protected $fillable = [
        'name','email','password','contact','profile_image','address','latitude','longitude','created_at','updated_at','role_assignment','school_assignment'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    public function staffOrders()
    {
         return $this->hasMany(OrderAssign::class,'staff_id','id');
    }
}
