<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
class AddToCart extends Model
{

    protected $table = 'add_to_cart';
    protected $fillable = [
        'user_id','service','plan_id','pickup_date','pickup_time','image','laundry_items','is_dryclean','dryclean_id','insurance','dropoff_date','dropoff_time','same_as_signup','addons','frequency','date','time','address','latitude','longitude','created_at','updated_at','laundry_items_quantity','addons_quantity','dryclean_id_quantity','is_deleted','dorm_name','comment','is_scheduled'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function input()
    {
        '';
    }

    public function ScopeLaundry($query)
    {
        return $query->where('status','1');

    }

    protected $casts = [
        'pickup_date' => 'string',
        'pickup_time' => 'string',
        'laundry_items' => 'string',
        'laundry_items_quantity' => 'string',
        'image' => 'string',
        'addons' => 'string',
        'addons_quantity' => 'string',
        'is_dryclean' => 'string',
        'dryclean_id' => 'string',
        'dryclean_id_quantity' => 'string',
        'frequency' => 'string',
        'date' => 'string',
        'time' => 'string',
        'insurance' => 'string',
        'dropoff_date' => 'string',
        'dropoff_time' => 'string',
        'dorm_name' => 'string',
        'same_as_signup' => 'string',
        'address' => 'string',
        'latitude' => 'string',
        'longitude' => 'string',
        'is_scheduled' => 'string',
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class,'cart_id','id');
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return URL::to('/').'/images/addtocart/'.$value;
        }else{
            return '';
        }
    }


}
