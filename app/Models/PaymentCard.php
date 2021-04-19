<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    protected $fillable = [
        'user_id','card_type','name_on_card','card_number','expiry_month','expiry_year','status','created_at','updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
