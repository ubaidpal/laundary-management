<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'service','user_id','title','text','created_at','updated_at'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
