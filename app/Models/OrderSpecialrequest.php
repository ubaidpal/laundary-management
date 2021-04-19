<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderSpecialrequest extends Model
{
    protected $table = 'order_specialrequests';

    protected $fillable = [
        'order_id','subscription_id','user_id','addon','addon_quantity','created_at','updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subcription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
