<?php

namespace App\Http\Controllers\Staff;

use App\Exports\LaundryLogs;
use App\Http\Controllers\Controller;
use App\Models\Addon;
use Illuminate\Http\Request;
use App\Models\LaundryLog;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\HousekeepingPlan;
use App\Models\LaundryPlan;
use App\Models\StoragePlan;
use App\Models\Notification;
use Maatwebsite\Excel\Facades\Excel;

class LaundryLogController extends Controller
{
    public function index()
    {
        //$data = LaundryLog::with('orderdetails.order.user','orderdetails.addons.addondetails')->get();
        $data = LaundryLog::with('order.user')->get();
        //echo $data;die();
        //die();
        return view('staff.laundrylogs.index',['data' => $data ]);
    }

    public function single(Request $request)
    {
       //dd($request->all());
        //$orders = OrderDetail::where('service','Laundry')->whereRaw("id not IN (SELECT orderdetails_id from laundry_logs)")->get();
        $orders = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->where('service','Laundry')->get();
     //  echo $orders;die();
        $drycleans = Addon::where('service','Laundry')->get();
        $users = User::user()->get();
        $order_details = array();
        if($request->orderdetails_id){
         //   die('okok');
            $order_details = Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->whereId($request->orderdetails_id)->first();
            if($order_details->subscription->cart->service == 'Laundry'){
                  $order_details->plan = LaundryPlan::whereId($order_details->subscription->cart->plan_id)->first();
           }elseif ($order_details->subscription->cart->service == 'Housekeeping') {
               $order_details->plan = HousekeepingPlan::whereId($order_details->subscription->cart->plan_id)->first();
           }elseif ($order_details->subscription->cart->service == 'Storage') {
               $order_details->plan = StoragePlan::whereId($order_details->subscription->cart->plan_id)->first();
           }
        }

        
      //echo $order_details;die();
        // dd($users);

        return view('staff.laundrylogs.form',['orders' => $orders,'drycleans' => $drycleans , 'users' => $users,'order_details'=>$order_details]);
    }

    public function create(Request $request)
    {

        //dd($request->all());
        $this->validate($request,[
            'date' => 'required',
            'orderdetails_id' => 'required',
            'weight_plan' => 'required|string',
            'weight_received' => 'required',
            'overweight' => 'required',
            'overcharged' => 'required',
            'total' => 'required',
        ]);

        $chk_order= Order::whereId($request->orderdetails_id)->first();
        $data = new LaundryLog($request->all());
        $save_notification['service'] = $chk_order->service;
        $save_notification['user_id'] = $chk_order->user_id;
        $save_notification['title'] = $chk_order->service;
        $save_notification['text'] = 'You have to pay remaining payment:$'.$request->total;
        Notification::insert($save_notification);
        $this->SendPushNotification($save_notification);

        if($data->save()){
            //die('oko');
            return redirect()->route('staff.laundrylogs.index')->with(['success' => 'Laundry Log Added Successfully!']);
        }
        else{
            return redirect()->route('staff.laundrylogs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $orders = OrderDetail::where('service','Laundry')->where('id','1')->get();
        $data = LaundryLog::find($id);

        $drycleans = Addon::where('service','Laundry')->get();
        $users = User::user()->get();
        return view('staff.laundrylogs.form',['data'=> $data,'orders' => $orders,'drycleans'=>$drycleans,'users'=>$users]);
    }

     public function update(Request $request,$id)
    {
        $this->validate($request,[
            'orderdetail_id' => 'required|integer',
            'weight_plan' => 'required|string',
            'weight_received' => 'required',
            'overweight' => 'required',
            'overcharged' => 'required',
        ]);

        $data = [
            'weight_plan' => $request->input('weight_plan'),
            'weight_received' => $request->input('weight_received'),
            'overweight' => $request->input('overweight'),
            'overcharged' => $request->input('overcharged'),
        ];

        if(LaundryLog::where('id',$id)->update($data)){
          return redirect()->route('laundrylogs.index')->with(['success' => 'Laundry Log Updated Successfully!']);
        }
        else{
            return redirect()->route('laundrylogs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete($id)
    {
        $delete = LaundryLog::where('id',$id)->delete();
        if($delete){
            return redirect()->route('laundrylogs.index')->with(['success' => 'Laundry Log Deleted Successfully!']);
        }
        else{
            return redirect()->route('laundrylogs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }


    public function getorderdetails(Request $request)
    {
        $user_id = User::where('username',$request->input('username'))->value('id');
        if(!$user_id){
            return [];
        }
        $order_id = Order::where('user_id',$user_id)->value('id');
        if(!$order_id){
            return [];
        }
        $data = OrderDetail::with('order.user','laundryplan')->where('order_id',$order_id)->first();
        $details['weight'] = $data->laundryplan->weight;
        $details['username'] = $data->order->user->first_name.' '.$data->order->user->last_name;
        $details['id'] = $data->id;

        return $details;
    }

    public function getDrycleanTotal(Request $request)
    {
        $data = explode(',',$request->input('data'));

        foreach($data as $details){
            $explodeData = explode('-',$details);
            $addonDetails = Addon::find($explodeData[0]);
            $result['description'][] = $addonDetails->description;
            $result['quantity'][] = $explodeData[1];

            $total[] = $addonDetails->price * $explodeData[1];
        }

        $result['total'] = array_sum($total);

        return $result;

    }

    public function exportExcel()
    {
        return Excel::download(new LaundryLogs, 'list.xlsx');
    }


}
