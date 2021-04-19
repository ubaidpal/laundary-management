<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\User;
use Auth;
use Carbon\Carbon;
use App\Models\Cronjob;

class OrderController extends Controller
{
    public function index()
    {
       // die('ok');
        //$data = Order::with(['orderdetails','user','orderdetails.addons','orderdetails.items'])->get();
        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->get();
        //echo $data;die();
        return view('admin.orders.index',['data' => $data]);
    }

    public function laundryorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Laundry')->get();
        return view('admin.orders.index',['data' => $data]);
    }

    public function housekeepingorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Housekeeping')->get();
        return view('admin.orders.index',['data' => $data]);
    }

    public function storageorders()
    {
        $data = OrderDetail::with('order.user','addons','items')->where('service','Storage')->get();

        return view('admin.orders.index',['data' => $data]);
    }

    public function view($id)
    {
        $data= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user','user.school','preferences'])->whereId($id)->orderBy('id','desc')->first();
        if($data->subscription->cart->service == 'Laundry'){
                  $data->plan = LaundryPlan::whereId($data->subscription->cart->plan_id)->first();
        }elseif ($data->subscription->cart->service == 'Housekeeping') {
           $data->plan = HousekeepingPlan::whereId($data->subscription->cart->plan_id)->first();
           //echo "<pre>";
           //print_r($data->subscription->cart);die("fff");

        }elseif ($data->subscription->cart->service == 'Storage') {
           $data->plan = StoragePlan::whereId($data->subscription->cart->plan_id)->first();
        }
        //echo "<pre>"; print_r($data->plan); die();
          
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
                    $data->specialRequestPrice = array_sum($totalPrice1);
                    $total = (string) ( array_sum($totalPrice) + array_sum($totalPrice1) ); 
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
            $insurance =  Insurance::whereId($insurance_explode[0])->first();
           
            $price_explode = explode(',', $insurance->prices);
          
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
        $staff_members= StaffMember::with('staffOrders.order')->get();
        $chk_order= OrderAssign::where(['order_id'=>$id])->with('staff')->first();
        // echo "<pre>"; print_r($data->toArray()); die();
        return view('admin.orders.view',['data' => $data,'staff_members'=>$staff_members,'chk_order'=>$chk_order]);
    }

    public function allorders(Request $request ,$type=null)
    {
        //$data = OrderDetail::with('order.user','addons','items')->get();
       $query= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user','user.school'])->orderBy('id','desc');
        if($type){
         //   die('ok');
            $query->where('service','=',$type);
        }

         $data = $query->get();
        //echo "<pre>";    print_r($data->toArray());die();
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

        return view('admin.orders.index',['data' => $data]);
    }

    public function updateStatus(Request $request)
    {
       //dd($request->all());
       //die();
        $data = Order::find($request->input('id'));

        if($data->update(['order_status' => $request->input('accept_status')])){

            $save_notification['service'] = $data->service;
            $save_notification['user_id'] = $data->user_id;
            $save_notification['title'] = $data->service;
            $accept_status = $request->input('accept_status');

            if($request->input('accept_status') == 1){
                $this->cronJobNotifications($data,$accept_status);
                $message = 'Your order is in progress:'.'ORD'.$data->id;
            }elseif ($request->input('accept_status') == 2) {
                $this->cronJobNotifications($data,$accept_status);
                $message = 'Your order has been completed:'.'ORD'.$data->id;
            }else{
                $message = 'Your order has been cancelled:'.'ORD'.$data->id;
            }
            $save_notification['text'] = $message;
            Notification::insert($save_notification);

            $this->SendPushNotification($save_notification);
            return '1';
        }else{
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

    public function singledelete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = Order::where('id',$id)->delete();
            if($delete){
                return redirect()->route('orders.index')->with(['success' => 'Order Deleted Successfully!']);
            }
            else{
                return redirect()->route('orders.index')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function cronJobNotifications()
    {

       

        $orders = Order::where('order_date', '>=' , date("Y-m-d"))
                        /*whereId(561)*/->get();
            
        // echo "<pre>";  print_r($orders->toArray()); die();;
        // echo "<pre>";  print_r(date("Y-m-d H:i")); die();;
        foreach ($orders as $key => $data) {

            $orderDateTime = $data->order_date.' '.$data->order_time;
            $dateTime = date("Y-m-d H:i",strtotime($orderDateTime));
            $notificationDateTime = date('Y-m-d H:i', strtotime($dateTime. ' - 1 days'));

            
            $save_notification['user_id'] = $data->user_id;
             //echo $data->accept_status;die();
            if ($data->order_status == 1) {

                if ($data->service == 'Housekeeping') {

               
                    // 1 dAY before
                        
                        $order_date = $data->order_date;

                        $date = date("Y-m-d",strtotime($order_date));
                        $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                        $oneDayBefore = $date;

                        if($oneDayBefore == date("Y-m-d")){

                            $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                            if (empty($cronCheck)) { 


                                $cron = new Cronjob();
                                $cron->user_id = $data->user_id;
                                $cron->order_id = $data->id;
                                $cron->date = date("Y-m-d");
                                $cron->save();
                                $save_notification['service'] = "Housekeeping";
                                $save_notification['title'] = "Housekeeping Reminder";
                                $save_notification['text'] = 'Your housekeeper will arrive tomorrow at '.$orderDateTime; 

                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification);  
                            }else{

                                $currentTime = date("H:i");
                                $orderTime = $data->order_time;
                                $current =  strtotime($currentTime);
                                $orderTime =  strtotime($orderTime);
                                $diffTime = ($current - $orderTime) / 60;

                                //print_r($diffTime);  die();

                                if (($diffTime >58  && $diffTime <60)) {
                                   
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                                    // 1 hour before Time
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Housekeeping";
                                    $save_notification['title'] = "Housekeeping Reminder";
                                    $save_notification['text'] = 'Your housekeeper will arrive today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                            }
                            
                        }else{
                               
                                $ordersDATETime = $data->order_date.' '.$data->order_time;
                                $currentDATETime = date("Y-m-d H:i");
                                   // die(); 
                                $orderDateTimes = strtotime($ordersDATETime);
                                 $currentDateTime = strtotime($currentDATETime);

                                $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                                
                                if (($diffTime >58  && $diffTime <60)) {
                                    //die();
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);

                                    // 1 hour before Time
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Housekeeping";
                                    $save_notification['title'] = "Housekeeping Reminder";
                                    $save_notification['text'] = 'Your housekeeper will arrive today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                        }
                        //dd("df");
                }elseif ($data->service == 'Laundry') {
                    // 1 dAY before
                        $date = date("Y-m-d",strtotime($data->order_date));
                        $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                       
                        $oneDayBefore = $date;
                        if($oneDayBefore == date("Y-m-d")){

                            $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                            if (empty($cronCheck)) {


                                $cron = new Cronjob();
                                $cron->user_id = $data->user_id;
                                $cron->order_id = $data->id;
                                $cron->date = date("Y-m-d");
                                $cron->save();
                                $save_notification['service'] = "Laundry";
                                $save_notification['title'] = "Laundry Reminder";
                                $save_notification['text'] = 'Pick up your clean laundry tomorrow at '.$orderDateTime; 

                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification);  
                            }/*else{
                                $currentTime = date("H:i");
                                $orderTime = $data->order_time;
                                $current =  strtotime($currentTime);
                                $orderTime =  strtotime($orderTime);
                                $diffTime = ( $orderTime - $current ) / 60;

                               
                                if (($diffTime >58  && $diffTime <60)) {
                                   
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                                    // 1 hour before Time
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Laundry";
                                    $save_notification['title'] = "Laundry Reminder";
                                    $save_notification['text'] = 'Pick up your clean laundry today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                            }*/
                            
                        }else{
                                $ordersDATETime = $data->order_date.' '.$data->order_time;
                                $currentDATETime = date("Y-m-d H:i");
                                   // die(); 
                                $orderDateTimes = strtotime($ordersDATETime);
                                 $currentDateTime = strtotime($currentDATETime);

                                $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                               
                                if (($diffTime >58  && $diffTime <60)) {
                                   
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                                    // 1 hour before Time
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Laundry";
                                    $save_notification['title'] = "Laundry Reminder";
                                    $save_notification['text'] = 'Pick up your clean laundry today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                        }

                }elseif ($data->service == 'Storage') {
                    // 1 dAY before
                    $date = date("Y-m-d",strtotime($data->order_date));
                    $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                    $oneDayBefore = $date;
                    if($oneDayBefore == date("Y-m-d")){

                        $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                        if (empty($cronCheck)) {


                            $cron = new Cronjob();
                            $cron->user_id = $data->user_id;
                            $cron->order_id = $data->id;
                            $cron->date = date("Y-m-d");
                            $cron->save();
                            $save_notification['service'] = "Storage";
                            $save_notification['title'] = "Storage Reminder";
                            $save_notification['text'] = 'Your storage will be picked up tomorrow at '.$orderDateTime; 

                            Notification::insert($save_notification);
                            $this->SendPushNotification($save_notification);  
                        }/*else{

                            $currentTime = date("H:i");
                            $orderTime = $data->order_time;
                            $current =  strtotime($currentTime);
                            $orderTime =  strtotime($orderTime);
                           $diffTime = ( $orderTime - $current ) / 60;

                           
                            if (($diffTime >58  && $diffTime <60)) {
                                \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                            
                                // 1 hour before Time
                                $dateTime = $data->order_date.' '.$data->order_time;

                                $date = date("Y-m-d H:i",strtotime($dateTime));               
                                $date = date("Y-m-d H:i",strtotime($dateTime));
                                $time = Carbon::parse($date)->subHour();
                                $time = date("H:i",strtotime($time));
                                $save_notification['service'] = "Storage";
                                $save_notification['title'] = "Storage Reminder";
                                $save_notification['text'] = 'Your storage will be picked up today at '.$data->order_time;
                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification); 
                            }
                        }*/
                        
                    }else{

                        $ordersDATETime = $data->order_date.' '.$data->order_time;
                        $currentDATETime = date("Y-m-d H:i");
                         
                        $orderDateTimes = strtotime($ordersDATETime);
                         $currentDateTime = strtotime($currentDATETime);

                        $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                       // print_r($diffTime);die;
                        if (($diffTime >58  && $diffTime <60)) {
                           
                            \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                            // 1 hour before Time
                            $dateTime = $data->order_date.' '.$data->order_time;

                            $date = date("Y-m-d H:i",strtotime($dateTime));               
                            $date = date("Y-m-d H:i",strtotime($dateTime));
                            $time = Carbon::parse($date)->subHour();
                            $time = date("H:i",strtotime($time));
                            $save_notification['service'] = "Storage";
                            $save_notification['title'] = "Storage Reminder";
                            $save_notification['text'] = 'Your storage will be picked up today at '.$data->order_time;
                            Notification::insert($save_notification);
                            $this->SendPushNotification($save_notification); 
                        }
                    }             
                }
                 
            }elseif ($data->order_status == 2) {

                if ($data->service == 'Housekeeping') {
                    // 1 dAY before
                        $date = date("Y-m-d",strtotime($data->order_date));
                        $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                        $oneDayBefore = $date;
                        if($oneDayBefore == date("Y-m-d")){

                            $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                            if (empty($cronCheck)) {


                                $cron = new Cronjob();
                                $cron->user_id = $data->user_id;
                                $cron->order_id = $data->id;
                                $cron->date = date("Y-m-d");
                                $cron->save();
                                $save_notification['service'] = "Housekeeping";
                                $save_notification['title'] = "Housekeeping Reminder";
                                $save_notification['text'] = 'Your packing materials will arrive tomorrow at '.$orderDateTime; 

                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification);  
                            }/*else{

                                $currentTime = date("H:i");
                                $orderTime = $data->order_time;
                                $current =  strtotime($currentTime);
                                $orderTime =  strtotime($orderTime);
                                $diffTime = ( $orderTime - $current ) / 60;

                               
                                if (($diffTime >58  && $diffTime <60)) {
                                    // 1 hour before Time
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Housekeeping";
                                    $save_notification['title'] = "Housekeeping Reminder";
                                    $save_notification['text'] = 'Your packing materials will arrive today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                            }*/
                            
                        }else{
                            $ordersDATETime = $data->order_date.' '.$data->order_time;
                            $currentDATETime = date("Y-m-d H:i");
                               // die(); 
                            $orderDateTimes = strtotime($ordersDATETime);
                             $currentDateTime = strtotime($currentDATETime);

                            $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                           
                            if (($diffTime >58  && $diffTime <60)) {
                                // 1 hour before Time
                                \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);

                                $dateTime = $data->order_date.' '.$data->order_time;

                                $date = date("Y-m-d H:i",strtotime($dateTime));               
                                $date = date("Y-m-d H:i",strtotime($dateTime));
                                $time = Carbon::parse($date)->subHour();
                                $time = date("H:i",strtotime($time));
                                $save_notification['service'] = "Housekeeping";
                                $save_notification['title'] = "Housekeeping Reminder";
                                $save_notification['text'] = 'Your packing materials will arrive today at '.$data->order_time;
                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification); 
                            }
                        }
                }elseif ($data->service == 'Laundry') {
                    // 1 dAY before
                        $date = date("Y-m-d",strtotime($data->order_date));
                        $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                        $oneDayBefore = $date;
                        if($oneDayBefore == date("Y-m-d")){

                            $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                            if (empty($cronCheck)) {


                                $cron = new Cronjob();
                                $cron->user_id = $data->user_id;
                                $cron->order_id = $data->id;
                                $cron->date = date("Y-m-d");
                                $cron->save();
                                $save_notification['service'] = "Laundry";
                                $save_notification['title'] = "Laundry Reminder";
                                $save_notification['text'] = 'Drop off your dirty laundry tomorrow at '.$orderDateTime; 

                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification);  
                            }/*else{

                                $currentTime = date("H:i");
                                $orderTime = $data->order_time;
                                $current =  strtotime($currentTime);
                                $orderTime =  strtotime($orderTime);
                                $diffTime = ( $orderTime - $current ) / 60;

                               
                                if (($diffTime >58  && $diffTime <60)) {
                                   
                                    \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);

                                    // 1 hour before Time
                                    $dateTime = $data->order_date.' '.$data->order_time;

                                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                                    $date = date("Y-m-d H:i",strtotime($dateTime));
                                    $time = Carbon::parse($date)->subHour();
                                    $time = date("H:i",strtotime($time));
                                    $save_notification['service'] = "Laundry";
                                    $save_notification['title'] = "Laundry Reminder";
                                    $save_notification['text'] = 'Drop off your dirty laundry today at '.$data->order_time;
                                    Notification::insert($save_notification);
                                    $this->SendPushNotification($save_notification); 
                                }
                            }*/
                            
                        }else{
                           $ordersDATETime = $data->order_date.' '.$data->order_time;
                            $currentDATETime = date("Y-m-d H:i");
                               // die(); 
                            $orderDateTimes = strtotime($ordersDATETime);
                             $currentDateTime = strtotime($currentDATETime);

                            $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                           
                            if (($diffTime >58  && $diffTime <60)) {
                               
                                \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);

                                // 1 hour before Time
                                $dateTime = $data->order_date.' '.$data->order_time;

                                $date = date("Y-m-d H:i",strtotime($dateTime));               
                                $date = date("Y-m-d H:i",strtotime($dateTime));
                                $time = Carbon::parse($date)->subHour();
                                $time = date("H:i",strtotime($time));
                                $save_notification['service'] = "Laundry";
                                $save_notification['title'] = "Laundry Reminder";
                                $save_notification['text'] = 'Drop off your dirty laundry today at '.$data->order_time;
                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification); 
                            }
                        }
                }elseif ($data->service == 'Storage') {
                    // 1 dAY before
                    $date = date("Y-m-d",strtotime($data->order_date));
                    $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                    $oneDayBefore = $date;
                    if($oneDayBefore == date("Y-m-d")){

                        $cronCheck = Cronjob::where(['user_id' => $data->user_id,'date' =>date("Y-m-d"),'order_id' =>$data->id])->first();
                        if (empty($cronCheck)) {


                            $cron = new Cronjob();
                            $cron->user_id = $data->user_id;
                            $cron->order_id = $data->id;
                            $cron->date = date("Y-m-d");
                            $cron->save();
                            $save_notification['service'] = "Storage";
                            $save_notification['title'] = "Storage Reminder";
                            $save_notification['text'] = 'your summer storage will be returned tomorrow at '.$orderDateTime; 

                            Notification::insert($save_notification);
                            $this->SendPushNotification($save_notification);  
                        }/*else{

                            $currentTime = date("H:i");
                            $orderTime = $data->order_time;
                            $current =  strtotime($currentTime);
                            $orderTime =  strtotime($orderTime);
                             
                            $diffTime = ( $orderTime - $current ) / 60;
                           
                            if (($diffTime >58  && $diffTime <60)) {
                               
                                \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);

                                // 1 hour before Time
                                $dateTime = $data->order_date.' '.$data->order_time;

                                $date = date("Y-m-d H:i",strtotime($dateTime));               
                                $date = date("Y-m-d H:i",strtotime($dateTime));
                                $time = Carbon::parse($date)->subHour();
                                $time = date("H:i",strtotime($time));
                                $save_notification['service'] = "Storage";
                                $save_notification['title'] = "Storage Reminder";
                                $save_notification['text'] = 'Your summer storage will be returned today at '.$data->order_time;
                                Notification::insert($save_notification);
                                $this->SendPushNotification($save_notification); 
                            }
                        }*/
                        
                    }else{
                        $ordersDATETime = $data->order_date.' '.$data->order_time;
                        $currentDATETime = date("Y-m-d H:i");
                           // die(); 
                        $orderDateTimes = strtotime($ordersDATETime);
                         $currentDateTime = strtotime($currentDATETime);

                        $diffTime = ($orderDateTimes - $currentDateTime) / 60;

                       
                        if (($diffTime >58  && $diffTime <60)) {
                        
                            \DB::table('test_crone')->insert(['user_id'=>$data->user_id,'order_id'=>$data->id,'order_date'=>$data->order_date,'order_time'=>$data->order_time,'diffTime'=>$diffTime]);
                            // 1 hour before Time
                            $dateTime = $data->order_date.' '.$data->order_time;

                            $date = date("Y-m-d H:i",strtotime($dateTime));               
                            $date = date("Y-m-d H:i",strtotime($dateTime));
                            $time = Carbon::parse($date)->subHour();
                            $time = date("H:i",strtotime($time));
                            $save_notification['service'] = "Storage";
                            $save_notification['title'] = "Storage Reminder";
                            $save_notification['text'] = 'Your summer storage will be returned today at '.$data->order_time;
                            Notification::insert($save_notification);
                            $this->SendPushNotification($save_notification); 
                        }
                    }               
                }
                
            }          
        }                
        echo "Notification sent Successfully"; die();

    }   

}
