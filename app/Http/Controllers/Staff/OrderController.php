<?php

namespace App\Http\Controllers\Staff;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\LaundryPlan;
use App\Models\HousekeepingPlan;
use App\Models\StoragePlan;
use App\Models\LaundryItem;
use App\Models\Addon;
use App\Models\AddtocartHousekeeping;
use App\Models\OrderSpecialrequest;
use App\Models\AddtocartStorage;
use App\Models\StaffMember;
use App\Models\OrderAssign;
use App\Models\Notification;
use App\Models\Insurance;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
       // die('ok');
        //$data = Order::with(['orderdetails','user','orderdetails.addons','orderdetails.items'])->get();
       

        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->get();
       // echo $data;die();
        return view('staff.orders.index',['data' => $data]);
    }

    public function laundryorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Laundry')->get();
        return view('staff.orders.index',['data' => $data]);
    }

    public function housekeepingorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Housekeeping')->get();
        return view('staff.orders.index',['data' => $data]);
    }

    public function storageorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Storage')->get();

        return view('staff.orders.index',['data' => $data]);
    }

    public function view($id)
    {
       // $data = OrderDetail::with('order.user','addons','items')->find($id);
        $data= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->whereId($id)->orderBy('id','desc')->first();
        //echo $data;die();
        //echo "<pre>"; print_r($data->toArray()); die();
        if($data->subscription->cart->service == 'Laundry'){
                  $data->plan = LaundryPlan::whereId($data->subscription->cart->plan_id)->first();
           }elseif ($data->subscription->cart->service == 'Housekeeping') {
               $data->plan = HousekeepingPlan::whereId($data->subscription->cart->plan_id)->first();
           }elseif ($data->subscription->cart->service == 'Storage') {
               $data->plan = StoragePlan::whereId($data->subscription->cart->plan_id)->first();
           }
          //echo  $data->cart;die();
        //echo $data;die();
           if($data->subscription->cart->service == 'Laundry'){
                $laundry_items = explode(',',$data->cart->items_id);
                $laundry_items_quntity = explode(',',$data->cart->items_quantity);
                $laundryItems = array_combine($laundry_items,$laundry_items_quntity);
                foreach($laundryItems as $key => $value){
                    $itemDetais = LaundryItem::find($key);
                    $datass['item_name'] = $itemDetais->name;
                    $datass['item_id'] = $key;
                    $datass['quantity'] = $value;
                    $detailsss[] = $datass;
                }

                $data->laundryItems = $detailsss;
                if($data->cart->is_dryclean == '1'){
                    $dryclean_items = explode(',',$data->cart->dryclean_id);
                    $dryclean_items_quntity = explode(',',$data->cart->dryclean_quantity);
                    $drycleanItems = array_combine($dryclean_items,$dryclean_items_quntity);
                    foreach($drycleanItems as $key => $value){
                        $dryCleanDetails = Addon::find($key);
                        $datasss['dryclean_name'] = $dryCleanDetails->description;
                        $datasss['price'] = $dryCleanDetails->price;
                        $datasss['dryclean_id'] = $key;
                        $datasss['quantity'] = $value;
                        $detailssss[] = $datasss;
                    }
                    $data->drycleanItems = $detailssss;
                }

        }

        if($data->subscription->cart->service == 'Housekeeping'){
                $Housekeepingcart = AddtocartHousekeeping::find($data->cart_id);
                if(($Housekeepingcart->addon != '') && ($Housekeepingcart->addon != null)){
                    $addon = explode(',',$Housekeepingcart->addon);
                    $addon_quntity = explode(',',$Housekeepingcart->addon_quantity);
                    $addonss = array_combine($addon,$addon_quntity);
                    foreach($addonss as $key => $value){
                        $addonDeatils = Addon::find($key);
                        $datasss['addon_name'] = $addonDeatils->description;
                        $datasss['price'] = $addonDeatils->price;
                        $datasss['addon_id'] = (int) $key;
                        $datasss['quantity'] = $value;
                        $totalllll = $addonDeatils->price * $value;
                        $detailssss[] = $datasss;
                        $totalPrice[] = $totalllll;
                    }
                }else{
                    $detailssss = [];
                    $totalPrice = [];
                }

                     $data->addonsDetail = $detailssss;
                     $data->addonsTotalPrice = array_sum($totalPrice);
                    $specialRequests = OrderSpecialrequest::where('order_id',$id)->get();
                   //echo $specialRequests;die();
                    if(count($specialRequests) > 0){
                        foreach($specialRequests as $specialRequest){
                                $addonDeatils = Addon::find($specialRequest->addon);
                                $datasss['addon_name'] = $addonDeatils->description;
                                $datasss['price'] = $addonDeatils->price;
                                $datasss['addon_id'] = (int) $specialRequest->addon;
                                $datasss['quantity'] = $specialRequest->addon_quantity;
                                $specialRequestAddon[] = $datasss;
                                $totalPrice1[] = ($specialRequest->addon_quantity * $addonDeatils->price);
                        }
                        $specialRequestAddons = $specialRequestAddon;
                    }else{
                        $specialRequestAddons = [];
                        $totalPrice1 = [];
                    }
                    $data->specialRequestAddons = $specialRequestAddons;
                    //$data->addonsDetail = array_merge($detailssss,$specialRequestAddons);
                    $data->specialRequestPrice = array_sum($totalPrice1);
                    $total = (string) ( array_sum($totalPrice) + array_sum($totalPrice1) );
                    //$data->addonsTotalPrice = $total;
        }

        if($data->subscription->cart->service == 'Storage'){
                $storagecart = AddtocartStorage::find($data->cart_id);
                if(($storagecart->addon != '') && ($storagecart->addon != null) ){
                    $addon = explode(',',$storagecart->addon);
                    $addon_quntity = explode(',',$storagecart->addon_quantity);
                    $addonss = array_combine($addon,$addon_quntity);
                    foreach($addonss as $key => $value){
                        $addonDeatils = Addon::find($key);
                        $datasss['addon_name'] = $addonDeatils->description;
                        $datasss['price'] = $addonDeatils->price;
                        $datasss['addon_id'] = $key;
                        $datasss['quantity'] = $value;
                        $detailssss[] = $datasss;
                        $totalPrice[] = $addonDeatils->price;
                    }
                    $data->addonsDetail = $detailssss;
                    $data->addonsTotalPrice = (string) array_sum($totalPrice);
                }else{
                    $data->addonsDetail = [];
                    $data->addonsTotalPrice = '';
                }

        }

        if(!empty($data->subscription->cart->insurance)){
            $insurance_explode = explode(',', $data->subscription->cart->insurance);
          //  dd($insurance_explode[0]);
            
            $insurance =  Insurance::whereId($insurance_explode[0])->first();
           // dd($insurance);
            $price_explode = explode(',', $insurance->prices);
          //  dd($price_explode);
           if($insurance_explode[1] == 0){
              $price =  $price_explode[0];
              $plan_type = 'Standard';
            }elseif (@$insurance_explode[1] == 1) {
                $price =  $price_explode[1];
                $plan_type = 'Premium';
            }elseif (@$insurance_explode[1] == 2) {
                $price =  $price_explode[2];
                $plan_type = 'Plus';
            }
            $data->insurance_price = @$price;
            $data->plan_type = @$plan_type;

        }
        // dd($price);
         $staff_members= StaffMember::with('staffOrders.order')->get();
         $chk_order= OrderAssign::where(['order_id'=>$id])->with('staff')->first();

      // echo $data;die();
        return view('staff.orders.view',['data' => $data,'staff_members'=>$staff_members,'chk_order'=>$chk_order]);
    }

    public function allorders(Request $request ,$type=null)
    {
        //$data = OrderDetail::with('order.user','addons','items')->get();
       //dd(Auth::id());
         $assign_orders = OrderAssign::where(['staff_id'=>Auth::id()])->pluck('order_id');
        // dd($assign_orders);
       $query= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->orderBy('id','desc')->whereIn('id',$assign_orders);
        if($type){
         //   die('ok');
            $query->where('service','=',$type);    
        }
        
         $data = $query->get();
       foreach ($data as $key => $dat) {
          //echo $dat;die();
           if($dat->subscription->cart->service == 'Laundry'){
                  $dat->plan = LaundryPlan::whereId($dat->subscription->cart->plan_id)->first();
           }elseif ($dat->subscription->cart->service == 'Housekeeping') {
               $dat->plan = HousekeepingPlan::whereId($dat->subscription->cart->plan_id)->first();
           }elseif ($dat->subscription->cart->service == 'Storage') {
               $dat->plan = StoragePlan::whereId($dat->subscription->cart->plan_id)->first();
           }

       }
//echo $data;die();
        
        return view('staff.orders.index',['data' => $data]);
    }

    public function updateStatus(Request $request)
    {
       //dd($request->all());
       //die();
        $data = Order::find($request->input('id'));
       // echo $data;die();

        if($data->update(['order_status' => $request->input('accept_status')])){
            //dd($request->input('accept_status'));
            //$user = User::whereId($data->user_id)->first();
            //$save_notification = new Notification;
            $save_notification['service'] = $data->service;
            $save_notification['user_id'] = $data->user_id;
            $save_notification['title'] = $data->service;
             if($request->input('accept_status') == 1){
                $message = 'Your order is in progress:'.'ORD'.$data->id;
            }elseif ($request->input('accept_status') == 2) {
                $message = 'Your order has been completed:'.'ORD'.$data->id;
            }else{
                $message = 'Your order has been cancelled:'.'ORD'.$data->id;
            }
            $save_notification['text'] = $message;
            Notification::insert($save_notification);

            $this->SendPushNotification($save_notification);

            $response['status'] = '1';
            return response()->json($response);
            return '1';
        }else{
             $response['status'] = '0';
            return response()->json($response);
            return '0';
        }
    }

    public function assignOrder(Request $request)
    {
        $order_assign  =      new OrderAssign;
        $order_assign->order_id = $request->order_id;
        $order_assign->staff_id = $request->staff_id;
        $order_assign->save();
        return 1;
    }

}
