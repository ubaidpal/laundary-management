<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_detail_id','cloths','quantity','created_at','updated_at'
    ];
}
