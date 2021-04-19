<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $table = 'insurances';

    protected $fillable = [
        'item_name','prices','status','created_at','updated_at'
    ];
}
