<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cmspage extends Model
{
     protected $fillable = [
        'url','title', 'description',
        ];
}
