<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    protected $fillable = [
        'service','description','price','status','created_at','updated_at'
    ];

    public function ScopeActive($query)
    {
        return $query->where('status','1');
    }


}
