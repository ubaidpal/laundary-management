<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Preferrence extends Model
{
    protected $table = 'prefferences';

    protected $fillable = [
        'user_id','detergent','fabric_softner','oxiclean','starch','rush_delivery','leave_laundry','delivery_instructions','vaccum','mop','cleaning_product','pets','created_at','updated_at'
    ];

    protected $casts = [
        'detergent' => 'string',
        'fabric_softner' => 'string',
        'oxiclean' => 'string',
        'rush_delivery' => 'string',
        'starch' => 'string',
        'leave_laundry' => 'string',
        'delivery_instructions' => 'string',
        'vaccum' => 'string',
        'mop' => 'string',
        'cleaning_product' => 'string',
        'pets' => 'string',
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
