<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\HousekeepingPlan;
use App\Models\Insurance;
use App\Models\LaundryItem;
use App\Models\LaundryPlan;
use App\Models\Notification;
use App\Models\Subscription;
use App\Models\PaymentCard;
use App\Models\Preferrence;
use App\Models\StoragePlan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user_id = \Session::get('user_id');

        if($user_id == ''){
            $data = LaundryPlan::active()->get();
            return view('web.index',['laundryPlans' => $data]);
        }

        $data = LaundryPlan::active()->get();

        foreach($data as $details){
            $description = $details->description;
            preg_match_all('!\d+!', $description, $matches);
            $details['totalQauntity'] = array_sum($matches[0]);

            $date = date('Y-m-d');
            $check = Subscription::with(['laundrycart'])->where('user_id',$user_id)->has('laundrycart')->where('is_deleted','0')->where('is_canceled','0')->get();

            if(count($check) > 0){

                foreach($check as $key => $checkk){
                    if(isset($checkk->laundrycart->plan_id) && ($checkk->laundrycart->plan_id ==  $details->id) ){
                        $buy[] = '1';
                        $subscription_id[] = $checkk->id;
                    }else{
                        $buy[] = '0';
                        $subscription_id[] = '0';
                    }

                }

                // dd($buy);

                $new = array_filter($buy,function($buys){
                        return $buys == '1';
                    });

                $new1 = array_filter($subscription_id,function($subscription_ids){
                        return $subscription_ids != '0';
                    });

                if(count($new) > 0){
                    $details['is_brought'] = '1';
                }else{
                    $details['is_brought'] = '0';
                }
                if(count($new1) > 0){
                    $details['subscription_id'] =  (string) reset($new1);
                }else{
                    $details['subscription_id'] = '';
                }
                $buy = [];
                $subscription_id = [];
            }else{
                $details['is_brought'] = '0';
                $details['subscription_id'] = '';
            }

            $datas[] = $details;

        }

        return view('web.index',['laundryPlans' => $datas]);
    }

    public function register()
    {
        return view('web.register');
    }


    public function cancel($id)
    {
        return view('web.cancel');
    }

    public function setsession(Request $request)
    {
        $session = $request->input('token');
        $user_id = $request->input('id');
        \Session::put('auth_token',$session);
        \Session::put('user_id',$user_id);
        // print_r(\Session::get('user_id'));
        // die;
        if(\Session::get('auth_token') && \Session::get('user_id') ){
            return '1';
        }
        return '0';
    }

    public function setCartSession(Request $request)
    {
        $service = $request->input('service');
        $cart_id = $request->input('cart_id');
        \Session::put('service',$service);
        \Session::put('cart_id',$cart_id);

        if(\Session::get('service') && \Session::get('cart_id') ){
            return '1';
        }
        return '0';
    }

    public function destroyCartsession(Request $request)
    {
        $request->session()->forget('service');
        $request->session()->forget('cart_id');

        return '1';
    }

    public function cart(Request $request)
    {
        $data = $request->user;
        return view('web.cart',['data' => $data]);
    }

    public function completeBooking($service,$plan_id)
    {
        if($service == 'Laundry'){
            $planDetails = LaundryPlan::find($plan_id);
        }
        if($service == 'Housekeeping'){
            $planDetails = HousekeepingPlan::find($plan_id);
        }
        if($service == 'Storage'){
            $planDetails = StoragePlan::find($plan_id);
        }

        $insurance = Insurance::first();
        $insurance = explode(',',$insurance->prices);
        $insuranceName = ['Standard','Premium','Plus'];

        return view('web.complete',['service' => $service, 'planDetails' => $planDetails, 'insurance' => $insurance,'insuranceName' => $insuranceName]);
    }

    public function aboutus()
    {
        return view('web.aboutus');
    }

    public function getservice()
    {
        return view('web.getservice');
    }

    public function contactus()
    {
        return view('web.contactus');
    }

    public function policies()
    {
        return view('web.policy');
    }

    public function terms()
    {
        return view('web.terms');
    }

    public function housekeeping()
    {
        $user_id = \Session::get('user_id');
        if($user_id == ''){

            $housekeepingplans = HousekeepingPlan::all();
            return view('web.housekeeping',['housekeepingplans' => $housekeepingplans]);

        }


        $data = HousekeepingPlan::active()->get();

        foreach($data as $details){
            $date = date('Y-m-d');
            $check = Subscription::with(['housekeepingcart'])->where('user_id',$user_id)->has('housekeepingcart')->where('is_deleted','0')->where('is_canceled','0')->get();

            if(count($check) > 0){

                foreach($check as $key => $checkk){
                    if(isset($checkk->housekeepingcart->plan_id) && ($checkk->housekeepingcart->plan_id ==  $details->id) ){
                        $buy[] = '1';
                        $subscription_id[] = $checkk->id;
                    }else{
                        $buy[] = '0';
                        $subscription_id[] = '0';
                    }

                }

                // dd($buy);

                $new = array_filter($buy,function($buys){
                        return $buys == '1';
                    });

                $new1 = array_filter($subscription_id,function($subscription_ids){
                        return $subscription_ids != '0';
                    });

                if(count($new) > 0){
                    $details['is_brought'] = '1';
                }else{
                    $details['is_brought'] = '0';
                }
                if(count($new1) > 0){
                    $details['subscription_id'] =  (string) reset($new1);
                }else{
                    $details['subscription_id'] = '';
                }
                $buy = [];
                $subscription_id = [];
            }else{
                $details['is_brought'] = '0';
                $details['subscription_id'] = '';
            }

            $datas[] = $details;
        }

        return view('web.housekeeping',['housekeepingplans' => $datas]);
    }

    public function storage()
    {
        $user_id = \Session::get('user_id');

        if($user_id == ''){
            $storageplans = HousekeepingPlan::all();
            return view('web.storage',['storageplans' => $storageplans]);
        }

        $data = StoragePlan::active()->get();

        foreach($data as $details){
            $date = date('Y-m-d');
            $check = Subscription::with(['storagecart'])->where('user_id', $user_id)->has('storagecart')->where('is_deleted','0')->where('is_canceled','0')->get();
            if(count($check) > 0){

                foreach($check as $key => $checkk){
                    if(isset($checkk->storagecart->plan_id) && ($checkk->storagecart->plan_id ==  $details->id) ){
                        $buy[] = '1';
                        $subscription_id[] = $checkk->id;
                    }else{
                        $buy[] = '0';
                        $subscription_id[] = '0';
                    }

                }

                // dd($buy);

                $new = array_filter($buy,function($buys){
                        return $buys == '1';
                    });

                $new1 = array_filter($subscription_id,function($subscription_ids){
                        return $subscription_ids != '0';
                    });

                if(count($new) > 0){
                    $details['is_brought'] = '1';
                }else{
                    $details['is_brought'] = '0';
                }
                if(count($new1) > 0){
                    $details['subscription_id'] =  (string) reset($new1);
                }else{
                    $details['subscription_id'] = '';
                }
                $buy = [];
                $subscription_id = [];

            }else{
                $details['is_brought'] = '0';
                $details['subscription_id'] = '';
            }

            $datas[] = $details;
        }

        return view('web.storage',['storageplans' => $datas]);
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function profile(Request $request)
    {
        $data = $request->user;
        $paymentDetails = PaymentCard::where('user_id',$data->id)->where('status','1')->first();
        $billingaddress = BillingAddress::where('user_id',$data->id)->first();
        // dd($billingaddress);
        $laundry_items = LaundryItem::all();

        $prefferences = Preferrence::where('user_id',$data->id)->first();

        // dd($prefferences);

        $notifications = Notification::where('user_id',$data->id)->get();

        return view('web.profile',['data' => $data,'paymentDetails' => $paymentDetails, 'billingaddress' => $billingaddress, 'laundry_items' => $laundry_items ,'prefferences' => $prefferences,'notifications' => $notifications ]);
    }

    public function destroysession()
    {
        \Session::flush();
        return '1';
    }

    public function classSchedule(Request $request)
    {
        $data = $request->user;
        return view('web.schedule',['data' => $data]);
    }
}
