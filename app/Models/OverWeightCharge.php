<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverWeightCharge extends Model
{
    protected $fillable = ['lbs_per_item','charge'];
}
