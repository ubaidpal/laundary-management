<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thank extends Model
{
    protected $fillable = [
        'text','day','time','created_at','updated_at'
    ];

    protected $table = 'thanks';
}
