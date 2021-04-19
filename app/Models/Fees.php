<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $table = 'fees';

    protected $fillable = [
        'tax_fees','service_fees'
    ];

}
