<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAddon extends Model
{
    protected $fillable = [
        'order_detail_id','addon_id','quantity','created_at','updated_at'
    ];


    public function addondetails()
    {
        return $this->belongsTo(Addon::class,'addon_id','id');
    }

}
