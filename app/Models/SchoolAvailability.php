<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolAvailability extends Model
{
    protected $table = 'school_availability';

    public function school()
    {
        return $this->belongsTo(School::class,'id','school_availability');
    }
}
