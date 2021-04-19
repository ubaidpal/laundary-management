<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderAssign extends Model
{
    public function staff()
    {
        return $this->belongsTo(StaffMember::class,'staff_id','id');
    }


    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    function ordersss(){
    	return $this->belongsTo(Order::class,'order_id','id')->where(['order_status'=>'0']);
    }
}
