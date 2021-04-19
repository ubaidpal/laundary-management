<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddtocartStorage extends Model
{
    protected $table = 'addtocart_storage';

    protected $fillable = [
        'user_id','subscription_id','addon','addon_quantity','created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

}
