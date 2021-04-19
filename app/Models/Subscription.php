<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'service','user_id','cart_id','card_id','billing_address_id','total','coupon','grautity','tax','subtotal','start','end','service_fee','transaction_id','charge_id','is_canceled','created_at','updated_at','is_deleted'
    ];

    protected $casts = [
        'coupon' => 'string',
        'grautity' => 'string',
        'service' => 'string',
        'service_tax' => 'string',
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function cart()
    {
        return $this->belongsTo(AddToCart::class,'cart_id','id');
    }

    public function laundrycart()
    {
        return $this->belongsTo(AddToCart::class,'cart_id','id')->where('service','Laundry');
    }

    public function housekeepingcart()
    {
        return $this->belongsTo(AddToCart::class,'cart_id','id')->where('service','Housekeeping');
    }

    public function storagecart()
    {
        return $this->belongsTo(AddToCart::class,'cart_id','id')->where('service','Storage');
    }


    public function card()
    {
        return $this->belongsTo(PaymentCard::class,'card_id','id');
    }

    // public $object = (object)[];

    public function billingAddress()
    {
        return $this->belongsTo(BillingAddress::class,'billing_address_id','id')->withDefault((object)["appartment_number" => "",
        "created_at" => "",
        "city" => "",
        "state" => "",
        "updated_at" => "",
        "id" => 0,
        "gate_code" => "",
        "user_id" => 0,
        "address" => "",
        "zipcode" => ""]);
    }

    public function billAddress()
    {
        return $this->belongsTo(BillingAddress::class,'billing_address_id','id');
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }


}
