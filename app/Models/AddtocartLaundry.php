<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddtocartLaundry extends Model
{
    protected $table = 'addtocart_laundry';

    protected $fillable = [
       'user_id', 'subscription_id','items_id','items_quantity','is_dryclean','dryclean_id','dryclean_quantity','created_at','updated_at','is_deleted','gratuity'
    ];

    protected $casts = [
        'items_id' => 'string',
        'items_quantity' => 'string',
        'is_dryclean' => 'string',
        'dryclean_id' => 'string',
        'dryclean_quantity' => 'string',
        'gratuity' => 'string',
    ];

    protected function castAttribute($key, $value)
    {
        if (is_null($value)) {
            return '';
        }

        return parent::castAttribute($key, $value);
    }


    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
