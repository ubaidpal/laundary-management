<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $fillable = [
        'school_name','created_at','updated_at'
    ];

    public function building()
    {
        return $this->hasMany(Building::class);
    }

   	public function buildingname()
    {
        return $this->belongsTo(Building::class,'id','school_id');
    }  

    public function availability()
    {
        return $this->belongsTo(SchoolAvailability::class,'availability_id','id');
    }

}
