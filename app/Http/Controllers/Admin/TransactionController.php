<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaundryPlan;
use App\Models\HousekeepingPlan;
use App\Models\StoragePlan;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\LaundryItem;
use App\Models\Addon;
use App\Models\StaffMember;
use App\Models\OrderAssign;
use App\Models\Insurance;
use App\Models\AddtocartHousekeeping;
use App\Models\OrderSpecialrequest;
use App\Models\AddtocartStorage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Transaction;

class TransactionController extends Controller
{
	public function index(Request $request)
    {
        //dd($request->all());
        //$data = Subscription::with('user')->paginate(10);
        //$data = Subscription::with('user','cart')->orderBy('id','desc')->get();
        $query = Order::with(['subscription.cart','subscription.billingAddress','card','cart','user','user.school'])->orderBy('id','desc');
        if($request->type == 'today'){
            $query->whereDate('created_at',date('Y-m-d'));    
        }
        if($request->type == 'monthly'){
            $query->whereRaw(" MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())");
        }
        if($request->type == 'yearly'){
            $query->whereRaw(" YEAR(created_at) = YEAR(CURRENT_DATE())");
        }
        
        $data = $query->get();
        foreach ($data as $key => $dat) {
           //  echo $dat;die();  
            if($dat->subscription->cart->service == 'Laundry'){
                $dat->plan = LaundryPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif ($dat->subscription->cart->service == 'Housekeeping') {
                $dat->plan = HousekeepingPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif($dat->subscription->cart->service == 'Storage') {
                $dat->plan = StoragePlan::whereId($dat->subscription->cart->plan_id)->first();
            }
        }

       // echo "<pre>"; print_r($data->toArray());die();
   // echo $data;die();
        return view('admin.transactions.index',['data' => $data]);
    }

    public function view($id)
    {
       // $data = Order::with('orderdetails','user','orderdetails.addons','orderdetails.items','orderdetails')->where('id',$id)->first();
     // $id=186;
       $data= Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->whereId($id)->orderBy('id','desc')->first();
        //echo $data;die();
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
       
         
        //echo $data;die(); 
        return view('admin.transactions.view',['data' => $data]);
    
    }

    public function today()
    {
        //$data = Order::with('orderdetails','user','orderdetails.addons','orderdetails.items','orderdetails')->whereDate('created_at',date('Y-m-d'))->get();\
                        

                        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->orderBy('id','desc')->whereDate('created_at',date('Y-m-d'))->get();
      
        foreach ($data as $key => $dat) {
           //  echo $dat;die();  
            if($dat->subscription->cart->service == 'Laundry'){
                $dat->plan = LaundryPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif ($dat->subscription->cart->service == 'Housekeeping') {
                $dat->plan = HousekeepingPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif($dat->subscription->cart->service == 'Storage') {
                $dat->plan = StoragePlan::whereId($dat->subscription->cart->plan_id)->first();
            }
        }
        return view('admin.transactions.index', ['data' => $data]);
    }

    public function monthly()
    {
       /* $data = Order::with('orderdetails','user','orderdetails.addons','orderdetails.items','orderdetails')->whereRaw(" MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->get();*/
           $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->orderBy('id','desc')->whereRaw(" MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")->get();
      
        foreach ($data as $key => $dat) {
           //  echo $dat;die();  
            if($dat->subscription->cart->service == 'Laundry'){
                $dat->plan = LaundryPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif ($dat->subscription->cart->service == 'Housekeeping') {
                $dat->plan = HousekeepingPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif($dat->subscription->cart->service == 'Storage') {
                $dat->plan = StoragePlan::whereId($dat->subscription->cart->plan_id)->first();
            }
        }              

        return view('admin.transactions.index', ['data' => $data]);
    }

    public function yearly()
    {
       /* $data = Order::with('orderdetails','user','orderdetails.addons','orderdetails.items','orderdetails')->whereRaw(" YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->get();*/
        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart','user'])->orderBy('id','desc')->whereRaw(" YEAR(created_at) = YEAR(CURRENT_DATE())")->get();
      
        foreach ($data as $key => $dat) {
           //  echo $dat;die();  
            if($dat->subscription->cart->service == 'Laundry'){
                $dat->plan = LaundryPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif ($dat->subscription->cart->service == 'Housekeeping') {
                $dat->plan = HousekeepingPlan::whereId($dat->subscription->cart->plan_id)->first();
            }elseif($dat->subscription->cart->service == 'Storage') {
                $dat->plan = StoragePlan::whereId($dat->subscription->cart->plan_id)->first();
            }
        }

        return view('admin.transactions.index', ['data' => $data]);
    }

    public function charge($id)
    {
       //$id=186;
        /*$data = Order::with('orderdetails','user','orderdetails.addons','orderdetails.items','orderdetails')->where('id',$id)->first();
        $orderdetails = OrderDetail::where('order_id',$id)->get();
        $services = OrderDetail::where('order_id',$id)->get()->pluck('service');
        foreach($orderdetails as $orderdetail){
            $orderItems =  OrderItem::where('order_detail_id',$orderdetail->id)->get()->toArray();
            $orderAddons = OrderAddon::with('addondetails')->where('order_detail_id',$orderdetail->id)->get()->toArray();
            $items = array_merge($orderItems,$orderAddons);
            $details[] = [
                'service' => $orderdetail->service,
                'items' => $items,
            ];

        }*/

         $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->find($id);
         if($data){
        //echo $data;die();
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
            if($insurance_explode[0] == 1){
              $price =  $price_explode[0];
              $plan_type = 'Standard';
            }elseif (@$insurance_explode[1] == 2) {
                $price =  $price_explode[1];
                $plan_type = 'Premium';
            }elseif (@$insurance_explode[2] == 3) {
                $price =  $price_explode[2];
                $plan_type = 'Plus';
            }
            $data->insurance_price = @$price;
            $data->plan_type = @$plan_type;

        }
    }else{
        $data = array();
    }
//echo $data->subscription;die();
        // dd($details);
$details = array();
        return view('admin.transactions.viewCharge',['data' => $data,'details' => $details]);
    }

}
