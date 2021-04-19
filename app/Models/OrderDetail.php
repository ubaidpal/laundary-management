<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'order_id','service','plan_id','selected_date','time','is_drycleaning','is_insurance','large_item','insurance_plan','dropoff_date','dropoff_time','drom_name','address_same_as_signup','created_at','updated_at','status'
    ];

    public function addons()
    {
        return $this->hasMany(OrderAddon::class,'order_detail_id','id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_detail_id','id');
    }

    public function laundryplan()
    {
        return $this->belongsTo(LaundryPlan::class,'plan_id','id');
    }

    public function housekeepingplan()
    {
        return $this->belongsTo(HousekeepingPlan::class,'plan_id','id');
    }

    public function storageplan()
    {
        return $this->belongsTo(StoragePlan::class,'plan_id','id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }



}
