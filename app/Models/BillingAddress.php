<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    protected $table = 'billing_addresses';

    protected $fillable = [
        'user_id','address','city','state','zipcode','appartment_number','gate_code'
    ];
}
