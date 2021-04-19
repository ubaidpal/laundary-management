<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryItem extends Model
{
    protected $table = 'laundry_items';

    protected $fillable = [
        'name','status','created_at','updated_at'
    ];
}
