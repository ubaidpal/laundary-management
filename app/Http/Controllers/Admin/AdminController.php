<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\HousekeepingPlan;
use App\Models\LaundryLog;
use App\Models\LaundryPlan;
use App\Models\Order;
use App\Models\OrderAddon;
use App\Models\OrderDetail;
use App\Models\Report;
use App\Models\Restaurant;
use App\Models\StaffMember;
use App\Models\StoragePlan;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Waiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
/*    public function index(){

        $currentYear  =  (int)Date('Y');
        for($i = 01 ; $i<=12;$i++ ){
            if(strlen($i) == 1){
                $i = "0".$i;
            }

            $startDate = $currentYear.'-'.$i.'-'."01";
            $endDate = $currentYear.'-'.$i.'-'."31";

            $usersCountMonthly[] = User::user()->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            $laundryCountMonthly[] = OrderDetail::where('service','Laundry')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            $housekeepingCountMonthly[] = OrderDetail::where('service','Housekeeping')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            $storageCountMonthly[] = OrderDetail::where('service','Storage')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();
        }

        $totalsatff = StaffMember::count();
        $totalusers = User::user()->count();
        $totalCoupons = Order::where('coupon_id','!=','')->count();
        $totalOrders = 0;

        $todayTotalSale = Order::whereDate('created_at',date('Y-m-d'))
                        ->sum('total_amount');

        $monthlyTotalSale = Order::whereRaw(" MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->sum('total_amount');

        $yearlyTotalSale = Order::whereRaw("YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->sum('total_amount');

        $storageids = OrderDetail::where('service','Storage')->get();

        $storageAddons = Addon::where('service','Storage')->get()->pluck('description');
        $storageAddonscount = count($storageAddons);
        $storageAddons[$storageAddonscount] = 'Bins';
        $bins = 0;
        $bikeData = 0;
        $couchData = 0;
        $tvData = 0;
        $tvstandData = 0;
        $chairData = 0;
        $deskData = 0;
        $rugData =0;

        // dd($storageAddons);

        $demo['Bins'] = 0;

        foreach($storageids as $storageid){

            $planData = StoragePlan::find($storageid->plan_id);
            $str = $planData->description;
            preg_match_all('!\d+!', $str, $matches);
            $bins += $matches[0][0];
            $demo['Bins'] += $matches[0][0];

            $datas = OrderAddon::where('order_detail_id',$storageid->id)->get();
            foreach($datas as $addons){
                // dd($addons);
                $detailss = Addon::where('id',$addons->addon_id)->value('description');
                // dd($addons->id);

                if($detailss == 'Bike'){
                    $bikeData += 1;
                }
                if($detailss == 'Couch'){
                    $couchData += 1;
                }
                if($detailss == 'TV'){
                    $tvData += 1;
                }
                if($detailss == 'TV Stand'){
                    $tvstandData += 1;
                }
                if($detailss == 'Chair'){
                    $chairData += 1;
                }
                if($detailss == 'Desk'){
                    $deskData += 1;
                }
                if($detailss == 'Rug'){
                    $rugData += 1;
                }

            }
        }


        $bargraphdata = [
                    $bins,
                    $bikeData,
                    $couchData,
                    $tvData ,
                    $tvstandData ,
                    $chairData,
                    $deskData ,
                    $rugData ,
        ];


        // dd($storageAddons);

        $totalEarning = 0;
         return view('admin.dashboard',['totalOrders' => $totalOrders,'totalstaff' => $totalsatff,'totalusers' => $totalusers, 'usersCountMonthly' => $usersCountMonthly,'totalcategories' => '','todayTotalSale' => $todayTotalSale,'monthlyTotalSale'=> $monthlyTotalSale, 'yearlyTotalSale' => $yearlyTotalSale , 'totalCoupons' => $totalCoupons,'totalEarning' => $totalEarning,'laundryCountMonthly' => $laundryCountMonthly,'housekeepingCountMonthly' => $housekeepingCountMonthly, 'storageCountMonthly' => $storageCountMonthly,'bargraphdata' => $bargraphdata,'storageAddons' => $storageAddons]);

        // return view('admin.dashboard',['totalOrders' => 0,'totalrestaurants' => 0,'totalusers' => 0, 'ordersCountMonthly' => [],'totalcategories' => 0,'totalEarning' => 0,'waiters'=>0 ]);

    }

*/




    public function index(){
        $currentYear  =  (int)Date('Y');
        for($i = 01 ; $i<=12;$i++ ){
            if(strlen($i) == 1){
                $i = "0".$i;
            }

            $startDate = $currentYear.'-'.$i.'-'."01";
            $endDate = $currentYear.'-'.$i.'-'."31";
//die('ok');
            $usersCountMonthly[] = User::user()->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

           // $laundryCountMonthly[] = OrderDetail::where('service','Laundry')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            //$housekeepingCountMonthly[] = OrderDetail::where('service','Housekeeping')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            //$storageCountMonthly[] = OrderDetail::where('service','Storage')->where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->count();

            $weightPlan[] = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('weight_plan');

            $weightRecieved = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('weight_received');

            $weightOver = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('overweight');

            $totalWeightOver[] = $weightRecieved +  $weightOver;


        }



        $totalsatff = StaffMember::count();
        $totalusers = User::user()->count();
       //// $totalCoupons = Order::where('coupon_id','!=','')->count();
        $totalOrders = 0;

        $todayTotalSale = Order::whereDate('created_at',date('Y-m-d'))
                        ->sum('total_amount');

        $monthlyTotalSale = Order::whereRaw(" MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->sum('total_amount');

        $yearlyTotalSale = Order::whereRaw("YEAR(created_at) = YEAR(CURRENT_DATE())")
                        ->sum('total_amount');

        $storageids = Order::All();


        $storageAddons = Addon::where('service','Storage')->get()->pluck('description');
        $storageAddonscount = count($storageAddons);
        $storageAddons[$storageAddonscount] = 'Bins';

        foreach($storageAddons as $addons){
            $newAddons[$addons] = 0;
        }

        foreach($storageids as $orderid){
            $planData = StoragePlan::find($orderid->plan_id);
            $str = @$planData->description;
            preg_match_all('!\d+!', $str, $matches);
            $newAddons['Bins'] += @$matches[0][0];

            //$orderAddons = OrderAddon::where('order_detail_id',$orderid->id)->get();

            /*foreach($orderAddons as $addons){
                $detailss = Addon::where('id',$addons->addon_id)->value('description');
                $newAddons[$detailss] += 1;
            }*/
        }




        foreach($newAddons as $name => $units ){
            $price = Addon::where('service','Storage')->where('description',$name)->value('price');
            if($name == 'Bins'){
                $price = 2.99;
            }
            if($price){
                $storageSales[] = $units * $price;
            }
        }


        $totalEarning = 0;


        // $laundryAddons = Addon::where('service','Laundry')->orderby('description','ASC')->get();
        $laundryAddonsNames = Addon::where('service','Laundry')->orderby('description','ASC')->get()->pluck('description');

        foreach($laundryAddonsNames as $laundryAddonsName){
            $newdetails[$laundryAddonsName] = 0;
        }


       // $laundryids = OrderDetail::where('service','Laundry')->get();

        $laundryAddons = Addon::where('service','Laundry')->get()->pluck('description');
        $laundryAddonscount = count($laundryAddons);

        /*foreach($laundryids as $orderids){

            $planData = LaundryPlan::find($orderids->plan_id);

            $orderAddons = OrderAddon::where('order_detail_id',$orderids->id)->get();
            foreach($orderAddons as $addons){
                // dd($addons);
                $detailss = Addon::where('id',$addons->addon_id)->value('description');
                    // dd($detailss);
                $newdetails[$detailss] += (isset($addons->quantity)) ? $addons->quantity : 1 ;
            }

        }*/

        foreach($newdetails as $newwdetailsname => $newwdetailsnameunits ){
            $price = Addon::where('service','Laundry')->where('description',$newwdetailsname)->value('price');
            if($price){
                $laundrySalesData[] = $newwdetailsnameunits * $price;
            }
        }




        $housekeepingAddonsNames = Addon::where('service','Housekeeping')->orderby('description','ASC')->get()->pluck('description');

        foreach($housekeepingAddonsNames as $housekeepingAddonsName){
            $newdetails1[$housekeepingAddonsName] = 0;
        }


        //$housekepingids = OrderDetail::where('service','Housekeeping')->get();

        $housekeepingAddons = Addon::where('service','Housekeeping')->get()->pluck('description');
        $housekeepingAddonscount = count($housekeepingAddons);

        /*foreach($housekepingids as $orderids){

            $planData = HousekeepingPlan::find($orderids->plan_id);

            $orderAddons = OrderAddon::where('order_detail_id',$orderids->id)->get();
            foreach($orderAddons as $addons){
                // dd($addons);
                $detailss = Addon::where('id',$addons->addon_id)->value('description');
                    // dd($detailss);
                $newdetails1[$detailss] += (isset($addons->quantity)) ? $addons->quantity : 1 ;
            }

        }*/

        foreach($newdetails1 as $newwdetailsname1 => $newwdetailsnameunits1 ){
            $price = Addon::where('service','Housekeeping')->where('description',$newwdetailsname1)->value('price');
            if($price){
                $housekeepingSalesData[] = $newwdetailsnameunits1 * $price;
            }
        }
//dd($usersCountMonthly);die();
$laundryCountMonthly=array(1,2,3);
$housekeepingCountMonthly = array(1,2,3);
$storageCountMonthly = array(1,2,3);

        return view('admin.dashboard',['totalOrders' => $totalOrders,'totalstaff' => $totalsatff,'totalusers' => $totalusers, 'usersCountMonthly' => $usersCountMonthly,'totalcategories' => '','todayTotalSale' => $todayTotalSale,'monthlyTotalSale'=> $monthlyTotalSale, 'yearlyTotalSale' => $yearlyTotalSale , 'totalCoupons' => 1,'totalEarning' => $totalEarning,'laundryCountMonthly' => $laundryCountMonthly,'housekeepingCountMonthly' => $housekeepingCountMonthly, 'storageCountMonthly' => $storageCountMonthly,'bargraphdata' => $newAddons,'storageAddons' => $storageAddons,'laundrybargraph' => $newdetails,'laundrySalesData'=>$laundrySalesData,'laundryAddonsNames' => $laundryAddonsNames,'storageSalesData'=> $storageSales,'weightCollected' => $weightPlan,'weightOver' => $totalWeightOver,'housekeepingAddonsNames' => $housekeepingAddonsNames,'housekeepingbargraph'=>$newdetails1 ]);

        // return view('admin.dashboard',['totalOrders' => 0,'totalrestaurants' => 0,'totalusers' => 0, 'ordersCountMonthly' => [],'totalcategories' => 0,'totalEarning' => 0,'waiters'=>0 ]);

    }












    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showProfile()
    {

        $data = Auth::user();
        return view('admin.profile',['data' => $data]);
    }

    public function updateProfile(Request $request)
    {

        // dd($request->all());

        $this->validate($request,[
            'first_name' => 'required',
            'email' => 'required|unique:users,email,'.Auth::id(),
        ]);

        $data = [
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
        ];

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');

            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/users');
           
            $file->move($path,$filename);
            $data['profile_image'] = $filename;
            // dd($data);die();
        }

        $update = User::where('id',Auth::user()->id)->update($data);
        if($update){
            return redirect()->route('home')->with(['success' => 'Profile Updated Successfully!']);
        }
        else{
            return redirect()->route('profile.show')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showPassword()
    {
        return view('admin.password');
    }

    public function updatePassword(Request $request)
    {

        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $check = Hash::check($request->input('old_password'), Auth::user()->password);
        if(!$check){
            return redirect()->back()->with(['error' => 'Old Password not Matched!']);
        }
        else{
            $update = User::where('id',Auth::user()->id)->update(['password' => Hash::make($request->input('password'))]);
            if($update){
                return redirect()->back()->with(['success' => 'Password Changes Successfully!']);
            }
        }
    }
}
