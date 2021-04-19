<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoragePlan extends Model
{
    protected $fillable = [
        'description','price','status','created_at','updated_at'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }
}
