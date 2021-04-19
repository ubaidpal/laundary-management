<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolThank extends Model
{
	protected $fillable = [
        'text','school_id','time','created_at','updated_at','deleted_at'
    ];
    
    protected $table = 'schools_thanks';
}
