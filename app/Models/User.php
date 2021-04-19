<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','dob','country_code','contact','username','profile_image','class_schedule','type','status', 'email', 'password','user_token','device_type','device_token','school_name','in_campus','apartment','hall','room_number','address','city','state','country','zipcode','doorcode','created_at','updated_at','pfirst_name','plast_name','pemail','pcountry_code','pcontact','card_type','card_number','card_month','card_year','card_cvv','gratuity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hall' => 'string',
        'room_number' => 'string',
        'address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'zipcode' => 'string',
        'country' => 'string',
        'doorcode' => 'string',
        'card_type' => 'string',
        'card_number' => 'string',
        'card_month' => 'string',
        'card_year' => 'string',
        'card_cvv' => 'string',
        'gratuity' => 'string',
        'device_type' => 'string',
        'device_token' => 'string',
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }

    public function school()
    {
        return $this->belongsTo(School::class,'school_name','id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class,'hall','id');
    }


        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getProfileImageAttribute($value)
    {
        if(!empty($value)){
            return URL::to('/').'/images/users/'.$value;
        }else{
            return '';
        }
    }

    public function getClassScheduleAttribute($value)
    {
        if(!empty($value)){
            return URL::to('/').'/images/class_schedule/'.$value;
        }else{
            return '';
        }
    }

    public function getApartmentAttribute($value)
    {
        if(!empty($value)){
           return $value;
        }else{
            return '';
        }
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function ScopeUser($query)
    {
        return $query->where('type','USER');
    }

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }
}
