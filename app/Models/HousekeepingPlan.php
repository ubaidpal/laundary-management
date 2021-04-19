<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HousekeepingPlan extends Model
{
    protected $fillable = [
        'bedroom','description','frequency','price','status','created_at','updated_at','cleaning_time'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }

    public function getCleaningTimeAttribute($value)
    {
        if(empty($value)){
             return '';
        } 
        return $value;
    }

}
