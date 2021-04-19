<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        //die();
        //$data = OrderDetail::whereRaw('MONTH(`selected_date`) = MONTH(CURRENT_DATE()) AND YEAR(selected_date) = YEAR(CURRENT_DATE())')->get();
        $data = Order::with('subscription.cart')->get();
        //echo $data;die();
        return view('admin.schedule.index',['data' => $data]);
    }

    public function scheduleOrderDetails(Request $request)
    {
       // $data = OrderDetail::with(['order.user','addons.addondetails','items'])->where('selected_date',$request->input('date'))->get()->toArray();
        //$request->input('date') = '2020-8-21';
        $data = Order::whereDate('order_date',$request->input('date'))->with('subscription.cart','user')->get()->toArray(); 
        return $data;
    }

    public function viewOrder(Request $request)
    {
    	$data = Order::whereDate('order_date',$request->input('date'))->with('subscription.cart')->get(); 
    	$response['data'] = $data;
    	$response['date'] = $request->input('date');
    	$response['redirect'] = "today-view-orders/".$request->input('date');
    	return response()->json($response); 
    }

    public function orderlistview(Request $request,$date)
    { 
        $data = Order::whereDate('order_date',$date)->with('subscription.cart')->get();
        return view('admin.schedule.today_schdule',['data' => $data]);
    }

}
