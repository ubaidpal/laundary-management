<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryPlan extends Model
{
    protected $fillable = [
        'weight','description','price','status','created_at','updated_at'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }
}
