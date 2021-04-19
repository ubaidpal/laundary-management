<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Claim extends Model
{
    protected $fillable = [
        'claim_id','user_id','order_id','service','color','brand','category','item','size','last_worn','date_filed','status','resolution','date_resolved','created_at','updated_at','image'
    ];

    protected $casts = [
        'order_id' => 'string',
        'service' => 'string',
        'color' => 'string',
        'brand' => 'string',
        'category' => 'string',
        'item' => 'string',
        'size' => 'string',
        'last_worn' => 'string',
        'date_filed' => 'string',
        'resolution' => 'string',
        'date_resolved' => 'string',
        'status' => 'string'
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }

    public function getImageAttribute($value)
    {
        if(!empty($value)){
            return URL::to('/').'/images/claims/'.$value;
        }else{
            return '';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function order()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
