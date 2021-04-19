<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\StaffMember;
use App\Models\AddtocartStorage;
use App\Models\OrderSpecialrequest;
use App\Models\AddtocartHousekeeping;
use App\Models\OrderAssign;
use App\Models\StoragePlan;
use App\Models\Notification;
use App\Models\LaundryItem;
use App\Models\Insurance;
use App\Models\OverWeightCharge;
use Maatwebsite\Excel\Facades\Excel;
use DB; 
use Auth;

class LaundryLogController extends Controller
{
    public function index()
    {
        //$data = LaundryLog::with('orderdetails.order.user','orderdetails.addons.addondetails')->get();
        $data = LaundryLog::with('order.user')->get();
        //echo $data;die();
        //die();
        return view('admin.laundrylogs.index',['data' => $data ]);
    }

    public function overweightindex()
    {
        
        $data = OverWeightCharge::orderBy('id','desc')->first();
        
        return view('admin.laundrylogs.owerweightindex',['data' => $data ]);
    }

    public function inventoryindex()
    {
        
        $query= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user','user.school'])->orderBy('id','desc'); 
         $data = $query->get();
          //  echo "<pre>";    print_r($data->toArray());die();
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

        return view('admin.laundryinventory.index',['data' => $data ]);
    }

    public function inventoryview($id)
    {
        $data= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->whereId($id)->orderBy('id','desc')->first();
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
         // echo "<pre>";    print_r($data->toArray());die();
        return view('admin.laundryinventory.view',['data' => $data,'staff_members'=>$staff_members,'chk_order'=>$chk_order]);
    }

    public function printableData()
    {
        $data = LaundryLog::with('order.user')->get(); 
        return view('admin.laundrylogs.printable_index',['data' => $data ]);
    }

    public function overweightsingle()
    {
        return view('admin.laundrylogs.overweightforms');
    }

    public function single(Request $request)
    {
       //dd($request->all());
        //$orders = OrderDetail::where('service','Laundry')->whereRaw("id not IN (SELECT orderdetails_id from laundry_logs)")->get();
        $checkPayment = LaundryLog::where('orderdetails_id',$request->orderdetails_id)->orderBy('id','desc')->first();
      
// dd($checkPayment);
        if($checkPayment){
            if ($checkPayment->payment_status == '1') {

                $orderss = Order::with(['subscription.cart','subscription.billingAddress','card','cart','userdetails'])->where('service','Laundry')->groupBy('user_id')->get();
                    $orders = Order::with(['subscription.cart','subscription.billingAddress','card','cart','userdetails'])->where('service','Laundry')->orderBy('id','desc')->groupBy('user_id')->get()->sortBy(function($orderss) {
                        return $orderss->userdetails->first_name;
                    });

                      $order = Order::with(['subscription.cart','subscription.billingAddress','card','cart','userdetails'])->where('service','Laundry')->where(['id'=>$request->orderdetails_id])->orderBy('id','desc')->first();

                //  echo "<pre>";   print_r($order->toArray());die();
                    // echo $order;die();
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

                     $overweightcharge = OverWeightCharge::first(); 
                    // dd($orders);
                    return view('admin.laundrylogs.form',['orders' => $orders,'drycleans' => $drycleans , 'users' => $users,'order_details'=>$order_details,'overweightcharge'=>$overweightcharge,'order'=>$order,'laundrylogsdata' =>$checkPayment]);
            }
        }

        $orderss = Order::with(['subscription.cart','subscription.billingAddress','card','cart','userdetails'])->where('service','Laundry')->orderBy('orders.id','desc')->groupBy('user_id')->get();

        $orders = Order::with(['subscription.cart','subscription.billingAddress','card','cart','userdetails'])->where('service','Laundry')->groupBy('user_id')->orderBy('orders.id','desc')->get()->sortBy(function($orderss) {
            return $orderss->userdetails->first_name;
        });
       //echo "//<pre>";   print_r($orders->toArray());die();
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

         $overweightcharge = OverWeightCharge::first(); 
 // dd($overweightcharge);
        return view('admin.laundrylogs.form',['orders' => $orders,'drycleans' => $drycleans , 'users' => $users,'order_details'=>$order_details,'overweightcharge'=>$overweightcharge]);
    }

    public function create(Request $request)
    {

        

        
//dd($request->all());
       // dd($request->all());
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
        $save_notification['text'] = 'Payment for :$'.$request->total.' has been auto debit for overcharged';
        Notification::insert($save_notification);
        $this->SendPushNotification($save_notification);

        $tt = $this->paymenttest($request->total);

        $data->comments = $request->comment;

        if($request->hasFile('upload_image')){

            $file = $request->file('upload_image');            
            $imgName = $file->getClientOriginalName();
            $ext = explode('?', \File::extension($imgName));
            $main_ext = $ext[0];
            $finalName = time()."_".rand(1,10000).'.'.$main_ext; 

            // $filename2 = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/thanks');
            //dd($path);
            $file->move($path,$finalName);
            $imageName = $finalName;
        }

        $data->image = $imageName;
        // echo "<pre>"; print_r( $imageName ) ; die();

        if($data->save()){

            $check = LaundryLog::where('orderdetails_id',$request->orderdetails_id)->first();
            if ($check) {
                LaundryLog::where('orderdetails_id',$request->orderdetails_id)->update(['payment_status' => '1']);
            }
            return redirect()->route('laundrylogs.index')->with(['success' => 'Laundry Log Added Successfully!']);
        }
        else{
            return redirect()->route('laundrylogs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function overweightcreate(Request $request)
    {

        //dd($request->all());
        $this->validate($request,[
            'lbs_item' => 'required',
            'overcharged' => 'required', 
        ]); 

        $data = new OverWeightCharge();
        $data->lbs_per_item = $request->lbs_item; 
        $data->charge = $request->overcharged; 
        if($data->save()){

            return redirect()->route('laundrylogs.overweightindex')->with(['success' => 'Added Successfully!']);
        }else{
            return redirect()->route('laundrylogs.overweightindex')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $orders = OrderDetail::where('service','Laundry')->where('id','1')->get();
        $data = LaundryLog::find($id);

        $drycleans = Addon::where('service','Laundry')->get();
        $users = User::user()->get();
        return view('admin.laundrylogs.form',['data'=> $data,'orders' => $orders,'drycleans'=>$drycleans,'users'=>$users]);
    }

    public function overweightshowupdate($id)
    {
        $data = OverWeightCharge::find($id); 
        
        return view('admin.laundrylogs.overweightforms',compact('data')); 
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

    public function overweightupdate(Request $request,$id)
    {
        $this->validate($request,[
            'lbs_item' => 'required',
            'overcharged' => 'required', 
        ]);

        $data = [
            'lbs_per_item' => $request->input('lbs_item'), 
            'charge' => $request->input('overcharged'),
        ];

        if(OverWeightCharge::where('id',$id)->update($data)){
          return redirect()->route('laundrylogs.overweightindex')->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->route('laundrylogs.overweightindex')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete(Request $request)
    {   
        $authId = Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = LaundryLog::where('id',$id)->delete();
            if($delete){
                return redirect()->route('laundrylogs.index')->with(['success' => 'Laundry Log Deleted Successfully!']);
            }
            else{
                return redirect()->route('laundrylogs.index')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function overweightdelete(Request $request)
    {   
        $authId = Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = OverWeightCharge::where('id',$id)->delete();
            if($delete){
                return redirect()->route('laundrylogs.overweightindex')->with(['success' => 'Deleted Successfully!']);
            }
            else{
                return redirect()->route('laundrylogs.overweightindex')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
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
         $chk_log= DB::table('laundry_logs')->get();
        //print_r($chk_log);die();
        if(count($chk_log)>0){
           return Excel::download(new  LaundryLogs, 'list.xlsx');
        }
        return redirect()->route('laundrylogs.index')->with(['error' => 'Nothing to export']);
    }


}
