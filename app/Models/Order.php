<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
       'service', 'user_id','subscription_id','transaction_id','charge_id','total_amount','card_id','cart_id','accept_status','created_at','updated_at','gratuity','order_status','order_date','order_time'
    ];

    protected $casts = [
        'transaction_id' => 'string',
        'charge_id' => 'string',
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

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class,'subscription_id','id');
    }

    public function card()
    {
        return $this->belongsTo(PaymentCard::class,'card_id','id');
    }

    public function cart(Type $var = null)
    {
        return $this->belongsTo(AddtocartLaundry::class,'cart_id','id');
    }

    public function userdetails(Type $var = null)
    {
        return $this->belongsTo(User::class,'user_id','id')->orderBy('first_name','asc');
    }

    public function preferences()
    {
        return $this->belongsTo(Preferrence::class,'user_id','user_id');
    }

    public function laundrylogcomments()
    {
        return $this->belongsTo(LaundryLog::class,'id','orderdetails_id');
    }
}
