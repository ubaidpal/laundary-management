<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancelSubscription extends Model
{

    protected $fillable = [
        'subscription_id', 'reason', 'description'
    ];

    public function subscription()
    {
        return $this->belongsTo(Subscription::class,'subscription_id','id');
    }
}
