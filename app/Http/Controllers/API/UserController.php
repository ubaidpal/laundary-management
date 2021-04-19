<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\AddToCart;
use App\Models\AddtocartHousekeeping;
use App\Models\BillingAddress;
use App\Models\Contactus;
use App\Models\Coupon;
use App\Models\HousekeepingPlan;
use App\Models\LaundryItem;
use App\Models\LaundryPlan;
use App\Models\Order;
use App\Models\Insurance;
use App\Models\Fees;
use App\Models\Transaction;
use App\Models\AddtocartLaundry;
use App\Models\AddtocartStorage;
use App\Models\Building;
use App\Models\CancelSubscription;
use App\Models\PrefferenceText;
use App\Models\Claim;
use App\Models\Cmspage;
use App\Models\LaundryLog;
use App\Models\TaxFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Models\Notification;
use App\Models\OrderSpecialrequest;
use App\Models\OrderStatus;
use App\Models\PaymentCard;
use App\Models\Preferrence;
use App\Models\Restaurant;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;
use App\Models\School;
use App\Models\StoragePlan;
use App\Models\Subscription;
use App\Models\Thank;
use DateTime;
use Illuminate\Support\Facades\Mail;
use Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\ThankServicePage;
use App\Models\ReferFriend;
use DateInterval;

use Carbon\Carbon;

class UserController extends Controller
{

     
    public function getProfile()
    {
        $data = User::with('school','building')->find(Auth::id());
        $response = [
            'message' => 'Details found',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function updateProfile(Request $request){

        $userId = Auth::user()->id;

        $v = Validator::make($request->all(),[
            'school_name' => 'required',
            'in_campus' => 'required|in:0,1',
            'hall' => 'required_if:in_campus,==,1',
            'room_number' => 'required_if:in_campus,==,1',
            'address' => 'required_if:in_campus,==,0',
            'city' => 'required_if:in_campus,==,0',
            'state' => 'required_if:in_campus,==,0',
            'zipcode' => 'required_if:in_campus,==,0',
            'country' => 'required_if:in_campus,==,0',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'country_code' => 'required',
            'contact' => 'required',
            'image' => 'sometimes',
            'schedule' => 'sometimes',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename1 = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/users');
            $file->move($path,$filename1);

        }

        if($request->hasFile('schedule')){
            $file = $request->file('schedule');
            $filename2 = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/class_schedule');
            $file->move($path,$filename2);
        }

        if (!empty($request->apartment)) {
            $apartment = $request->apartment;
        }else{
            $apartment = "";
        }

        $data = [
        
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country_code' => $request->input('country_code'),
            'contact' => $request->input('contact'),
            'dob' => $request->input('dob'),
            'school_name' => $request->input('school_name'),
            'in_campus' => $request->input('in_campus'),
            'hall' => $request->input('hall'),
            'room_number' => $request->input('room_number'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'zipcode' => $request->input('zipcode'),
            'country' => $request->input('country'),
            'apartment' => $apartment,
        ];

        if(isset($filename1)){
            $data['profile_image'] = $filename1;
        }
        if(isset($filename2)){
            $data['class_schedule'] = $filename2;
        }

        $update = User::where('id',$userId)->update($data);
        if($update){
            $response = [
                'message' => 'Profile updated Successfully',
                'body' => User::find(Auth::user()->id),
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong ',
                'status' => 400,
            ];
            return response()->json($response,200);
        }

    }

    public function thanks(Request $request)
    {
        $data = Thank::where('service',$request->service)->first();
        $time = json_decode($data->time);

        $time = array_filter($time,function($t){
            $t->image =  URL::to('/').'/images/thanks/'.$t->image;
            return $t;
        });

        $data->time = $time;


        $response = [
            'message' => 'details found',
            'body' => $data,
            'status' => 200
        ];

        return response()->json($response,200);
    }

    public function introThanksPages()
    {
         $data = ThankServicePage::whereIn('id',[1,2,3])->get();
         $response = [
            'message' => 'Data found',
            'body' => $data,
            'status' => 200
        ];

        return response()->json($response,200);
    }
    public function getLaundryPacks()
    {
        $data = LaundryPlan::active()->get();

        foreach($data as $details){
            $description = $details->description;
            preg_match_all('!\d+!', $description, $matches);
            $details['totalQauntity'] = array_sum($matches[0]);

            $date = date('Y-m-d');
            $check = Subscription::with(['laundrycart'])->where('user_id',Auth::id())->has('laundrycart')->where('is_deleted','0')->where('is_canceled','0')->where('start','<=', $date)->where('end','>=', $date)->get();

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


        $response = [
            'message' => 'Details Found',
            'body' => $datas,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function getHousekeepingPlans()
    {
        $data = HousekeepingPlan::active()->get();

        foreach($data as $details){
            $date = date('Y-m-d');
            $check = Subscription::with(['housekeepingcart'])->where('user_id',Auth::id())->has('housekeepingcart')->where('is_deleted','0')->where('is_canceled','0')->where('start','<=', $date)->where('end','>=', $date)->get();


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


        $response = [
            'message' => 'Details Found',
            'body' => $datas,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function getStoragePlans()
    {
        $data = StoragePlan::active()->get();

        foreach($data as $details){
            $date = date('Y-m-d');
            $check = Subscription::with(['storagecart'])->where('user_id',Auth::id())->has('storagecart')->where('is_deleted','0')->where('is_canceled','0')->where('start','<=', $date)->where('end','>=', $date)->get();
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

        $response = [
            'message' => 'Details Found',
            'body' => $datas,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function changepassword(Request $request)
    {
        $v = Validator::make($request->all(),[
            // 'oldpassword' => 'required',
            'newpassword' => 'required'
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        // $check = Hash::check($request->input('oldpassword'), Auth::user()->password);
        // if($check){
            $update = Auth::user()->update(['password' => $request->input('newpassword') ]);
            if($update){
                $response = [
                    'message' => 'Password Changed Successfully!',
                    'status' => 200,
                ];
                return response()->json($response,200);
            }
        // }
        else{
            $response = [
                    'message' => 'Old Password Incorrect!',
                    'status' => 400,
                ];
                return response()->json($response,400);
        }
    }

    public function contactus(Request $request)
    {
        $v = Validator::make($request->all(),[
            'school_name' => 'required',
            'fullname' => 'required',
            //'last_name' => 'required',
            'country_code' => 'required',
            'contact' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $request->merge(['user_id' => Auth::id()]);
        $data = new Contactus($request->all());
        /*$to_emails = $request->email;
            $subject =  'Contact us';
           // $strFromEmail = "support@bemender.com";
            //$strFromEmail = env("MAIL_FROM_ADDRESS");
            $strFromEmail = "amankumar@yopmail.com";
            //$strFromName = "no-reply@yopmail.com";
            $name = $request->first_name.' '.$request->last_name;
            $phoneno = $request->country_code.' '.$request->contact;
            $schoolName = $request->school_name;
            $email = $request->email;
            $message = $request->message;
             
            $viewContent = view('emails.contact_us', compact('name','schoolName','phoneno','email','message'));
            $mail = Mail::send([], [],
                function ($message) use ($to_emails, $strFromEmail, $viewContent, $subject) {
                $message
                ->from($strFromEmail /*$strFromName*///)
               /* ->to($to_emails)
                ->subject($subject)
                ->setBody($viewContent, 'text/html');
            });*/


            //print_r($mail); die();*/
        if($data->save()){

            
            $response = [
                'message' => 'Thanks for contacting us.',
                'status' =>200
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong.',
                'status' => 400
            ];
            return response()->json($response,400);
        }
    }

    public function setPrefference(Request $request)
    {
        $data = $request->all();
        // $data = [
        //     'detergent' => $request->input('detergent'),
        //     'fabric_softner' => $request->input('fabric_softner'),
        //     'oxiclean' => $request->input('oxiclean'),
        //     'starch' => $request->input('starch'),
        //     'rush_delivery' => $request->input('rush_delivery'),
        //     'leave_laundry' => $request->input('leave_laundry'),
        //     'delivery_instructions' => $request->input('delivery_instructions'),
        //     'vaccum' => $request->input('vaccum'),
        //     'mop' => $request->input('vaccum'),
        //     'cleaning_product' => $request->input('vaccum'),
        //     'pets' => $request->input('vaccum'),
        // ];
        $update = Preferrence::where('user_id',Auth::id())->update($data);
        if($update){
            $response = [
                'message' => 'Preffernces Set successfully.',
                'status' =>200
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400
            ];
            return response()->json($response,400);
        }
    }

    public function getPrefference()
    {
        $response = [
                'message' => 'Details Found.',
                'body' => Preferrence::where('user_id',Auth::id())->first(),
                'status' =>200
        ];
        return response()->json($response,200);
    }

    public function getLaundryItems()
    {
        $data = LaundryItem::all();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' =>200
        ];
        return response()->json($response,200);
    }

    public function getdrycleanItems()
    {
        $data = Addon::where('service','Laundry')->get();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' =>200
        ];
        return response()->json($response,200);
    }

    public function addToCart(Request $request)
    {

        if($request->input('service') == 'Laundry'){

            $v = Validator::make($request->all(),[
                'service' => 'required',
                'plan_id' => 'required',
                // 'pickup_date' => 'required',
                // 'pickup_time' => 'required',
                // 'laundry_items' => 'required',
                // 'is_dryclean' => 'required|in:0,1',
                // 'dryclean_id' => 'required_if:is_dryclean,==,"1" ',
                'insurance' => 'sometimes',
                'dropoff_date' => 'required',
                'dropoff_time' => 'required',
                'dorm_name' => 'sometimes',
                'same_as_signup' => 'required',
            ]);

            if($v->fails()){
                $response = [
                    'message' => $v->errors()->first(),
                    'status' => 422,
                ];
                return response()->json($response,422);
            }

            if($request->input('laundry_items')){
                foreach(json_decode($request->input('laundry_items')) as $details1){
                    $items[] = $details1->item_id;
                    $quantity[] = $details1->quantity;
                }

                $items = implode(',',$items);
                $quantity = implode(',',$quantity);
            }

            if($request->input('is_dryclean')){
                foreach(json_decode($request->input('dryclean_id')) as $details2){
                    $items1[] = $details2->dryclean_id;
                    $quantity1[] = $details2->quantity;
                }

                $items1 = implode(',',$items1);
                $quantity1 = implode(',',$quantity1);
            }

            $data = [
                'user_id' => Auth::id(),
                'service' => $request->input('service'),
                'plan_id' => $request->input('plan_id'),
                'pickup_date' => $request->input('pickup_date'),
                'pickup_time' => $request->input('pickup_time'),
                'is_dryclean' => $request->input('is_dryclean'),
                'insurance' => $request->input('insurance'),
                'dropoff_date' => $request->input('dropoff_date'),
                'dropoff_time' => $request->input('dropoff_time'),
                'same_as_signup' => $request->input('same_as_signup'),
                'dorm_name' => $request->input('dorm_name'),
            ];

            if($request->input('is_dryclean')){
                $data['dryclean_id'] = $items1;
                 $data['dryclean_id_quantity'] = $quantity1;
            }

            if($request->input('laundry_items')){

                $data['laundry_items'] = $items ;
                $data['laundry_items_quantity'] = $quantity;
            }


            $intrested = new AddToCart($data);
            if($intrested->save()){

                $response = [
                    'message' => 'Added to cart',
                    'body' => $intrested,
                    'status' =>200
                ];
                return response()->json($response,200);
            }else{
                $response = [
                    'message' => 'Something went wrong!',
                    'status' =>400
                ];
                return response()->json($response,400);
            }


        }
        elseif($request->input('service') == 'Housekeeping'){

            $v = Validator::make($request->all(),[
                'service' => 'required',
                'plan_id' => 'required',
                'pickup_date' => 'required',
                'pickup_time' => 'required',
                'addons' => 'sometimes',
                'frequency' => 'sometimes',
                'address' => 'sometimes',
                'latitude' => 'sometimes',
                'longitude' => 'sometimes',
                'same_as_signup' => 'sometimes',
            ]);

            if($v->fails()){
                $response = [
                    'message' => $v->errors()->first(),
                    'status' => 422,
                ];
                return response()->json($response,422);
            }


            if($request->input('addons')){
                     //$data =json_decode($request->input('addons'));
//e//cho "string";
                     //dd($data);
                foreach(json_decode($request->input('addons')) as $details){
                    $items[] = $details->addon_id;
                    $quantity[] = $details->quantity;
                }

                $items = implode(',',$items);
                $quantity = implode(',',$quantity);

            }

            $data = [
                'user_id' => Auth::id(),
                'service' => $request->input('service'),
                'plan_id' => $request->input('plan_id'),
                'pickup_date' => $request->input('pickup_date'),
                'pickup_time' => $request->input('pickup_time'),
                'frequency' => $request->input('frequency'),
                'date' => $request->input('date'),
                'time' => $request->input('time'),
                'same_as_signup' => $request->input('same_as_signup'),
                'address' => $request->input('address'),
                'comment' => $request->input('comment'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ];

            if($request->input('addons')){

                $data['addons'] = $items;
                $data['addons_quantity'] = $quantity;

            }

            if($request->hasfile('image')){
                $file = $request->file('image');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('images/addtocart');
                $file->move($path, $filename);
                $data['image'] = $filename;
            }

            $intrested = new AddToCart($data);
            if($intrested->save()){

                $addons = explode(',',$intrested->addons);
                $addons_quntity = explode(',',$intrested->addons_quantity);

                $addonsItem = array_combine($addons,$addons_quntity);

                foreach($addonsItem as $key => $value){
                    $datass['addon_id'] = $key;
                    $datass['quantity'] = $value;
                    $detailsss[] = $datass;
                }

                $intrested->addonsItems = $detailsss;

                $response = [
                    'message' => 'Added to cart',
                    'body' => $intrested,
                    'status' =>200
                ];

                //$date = "2021-02-17";// date("Y-m-d",strtotime($request->pickup_date));
                /*$date = date("Y-m-d",strtotime($request->pickup_date));
                $date = date('Y-m-d', strtotime($date. ' - 1 days'));

                $save_notification['service'] = "Housekeeping";
                $save_notification['user_id'] = Auth::id();
                $save_notification['title'] = "Housekeeping Reminder";
                $save_notification['text'] = 'Your appointment schedule this day '.$date;

                Notification::insert($save_notification);
                $this->SendPushNotification($save_notification);*/
                /*$date() =$request->pickup_date;*/
                return response()->json($response,200);
            }else{
                $response = [
                    'message' => 'Something went wrong!',
                    'status' =>400
                ];
                return response()->json($response,400);
            }

        }
        elseif($request->input('service') == 'Storage'){

            $v = Validator::make($request->all(),[
                'service' => 'required',
                'plan_id' => 'required',
                'largeItem' => 'required',
                'addons' => 'sometimes',
               // 'insurance' => 'sometimes',
                // 'dropoff_date' => 'required',
                // 'dropoff_time' => 'required',
                'pickup_date' => 'required',
                'pickup_time' => 'required',
                //'address'=> 'required',
                'latitude' => 'sometimes',
                'longitude' => 'sometimes',
                'same_as_signup' => 'sometimes',
            ]);

            if($v->fails()){
                $response = [
                    'message' => $v->errors()->first(),
                    'status' => 422,
                ];
                return response()->json($response,422);
            }

            if($request->input('largeItem')){
                foreach(json_decode($request->input('addons')) as $details){
                    $items[] = $details->addon_id;
                    $quantity[] = $details->quantity;
                }

                $items = implode(',',$items);
                $quantity = implode(',',$quantity);
            }


            $data = [
                'user_id' => Auth::id(),
                'service' => $request->input('service'),
                'plan_id' => $request->input('plan_id'),
                'largeItem' => $request->input('largeItem'),
                'pickup_date' => $request->input('pickup_date'),
                'pickup_time' => $request->input('pickup_time'),
                'insurance' => $request->input('insurance'),
                'dropoff_date' => $request->input('dropoff_date'),
                'dropoff_time' => $request->input('dropoff_time'),
                'same_as_signup' => $request->input('same_as_signup'),
                'address' => $request->input('address'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
            ];

            if($request->input('largeItem')){
                $data['addons'] = $items;
                $data['addons_quantity'] =  $quantity;
            }

            $intrested = new AddToCart($data);
            if($intrested->save()){

                if($request->input('largeItem')){
                    $addons = explode(',',$intrested->addons);
                    $addons_quntity = explode(',',$intrested->addons_quantity);

                    $addonsItem = array_combine($addons,$addons_quntity);

                    foreach($addonsItem as $key => $value){
                        $datass['addon_id'] = $key;
                        $datass['quantity'] = $value;
                        $detailsss[] = $datass;
                    }

                    $intrested->addonsItems = $detailsss;
                }

                $response = [
                    'message' => 'Added to cart',
                    'body' => $intrested,
                    'status' =>200
                ];
                // 1 dAY before
                /*    $date = date("Y-m-d",strtotime($request->pickup_date));
                    $date = date('Y-m-d', strtotime($date. ' - 1 days'));
                    $oneDayBefore = $date;
                    if($oneDayBefore == date("Y-m-d")){

                        $save_notification['service'] = "Storage";
                        $save_notification['user_id'] = Auth::id();
                        $save_notification['title'] = "Storage Reminder";
                        $save_notification['text'] = 'Your appointment schedule this day '.$date;

                        Notification::insert($save_notification);
                        $this->SendPushNotification($save_notification);
                    }*/
                // End here
                // 1 hour before Time
                    //$dateTime = "2021-02-16 14:25";
                    /*$dateTime = $request->pickup_date.' '.$request->pickup_time;

                    $date = date("Y-m-d H:i",strtotime($dateTime));               
                    $date = date("Y-m-d H:i",strtotime($dateTime));
                    $time = Carbon::parse($date)->subHour();
                    $time = date("H:i",strtotime($time));
                    $save_notification['service'] = "Storage";
                    $save_notification['user_id'] = Auth::id();
                    $save_notification['title'] = "Storage Reminder";
                    $save_notification['text'] = 'Your appointment schedule this time '.$request->pickup_time;

                    Notification::insert($save_notification);
                    $this->SendPushNotification($save_notification);*/
                // End here    
                return response()->json($response,200);
            }else{
                $response = [
                    'message' => 'Something went wrong!',
                    'status' =>400
                ];
                return response()->json($response,400);
            }
        }
    }

    public function getHousekeepingItems()
    {
        $data = Addon::where('service','Housekeeping')->get();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' =>200
        ];
        return response()->json($response,200);

    }



    public function getCards()
    {
        $defaultCard = PaymentCard::where('user_id',Auth::id())->where('status','1')->first();
        $data['defaultCard'] = $defaultCard ? $defaultCard : (object) [];
        $data['allcards'] = PaymentCard::where('user_id',Auth::id())->where('status','!=','1')->get();
        $response = [
            'message' => 'Deatils Found!',
            'body' => $data,
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function getCart(Request $request)
    {
        $data = AddToCart::where('user_id',Auth::id())->where('is_deleted','0')->get();

        if(count($data) > 0){
            foreach($data as $details){
            if($details->service == 'Laundry'){

                $details = AddToCart::select(['id','user_id','service','plan_id','pickup_date','pickup_time','laundry_items','laundry_items_quantity','is_dryclean','dryclean_id','dryclean_id_quantity','insurance','dropoff_date','dropoff_time','same_as_signup','dorm_name','created_at','updated_at'])->where('id',$details->id)->first();

                $laundryPack = LaundryPlan::where('id',$details->plan_id)->first();

                // $laundry_items = explode(',',$details->laundry_items);
                // $laundry_items_quntity = explode(',',$details->laundry_items_quantity);

                // $laundryItems = array_combine($laundry_items,$laundry_items_quntity);

                // if(count($laundryItems) > 0){
                //     foreach($laundryItems as $key => $value){
                //         $datass['item_id'] = $key;
                //         $datass['quantity'] = $value;
                //         $detailsss[] = $datass;
                //     }
                // }else{
                //     $detailsss = [];
                // }

                // $details['laundryItems'] = $detailsss;
                $details['planDetails'] = $laundryPack;

                // if($details->is_dryclean == '1'){

                //     $dryclean_items = explode(',',$details->dryclean_id);
                //     $dryclean_items_quntity = explode(',',$details->dryclean_id_quantity);

                //     $drycleanItems = array_combine($dryclean_items,$dryclean_items_quntity);

                //     $detailssss = [];
                //     foreach($drycleanItems as $key => $value){
                //         $datasss['dryclean_id'] = $key;
                //         $datasss['quantity'] = $value;
                //         $detailssss[] = $datasss;
                //     }

                //     $details['drycleanItems'] = $detailssss;

                // }
                    if($details->insurance != ''){
                        $ins = explode(',',$details->insurance);
                        $insur = Insurance::where('id',$ins[0])->first();
                        $insurance['id'] = $insur->id;
                        $insurance['itemname'] = $insur->item_name;
                        $price = explode(',',$insur->prices);

                        $insurance['priceName'] = $price[$ins[1]];
                        if($ins[1] == 0){
                            $plan_name = 'Standard';
                        }
                        if($ins[1] == 1){
                            $plan_name = 'Plus';
                        }
                        if($ins[1] == 2){
                            $plan_name = 'Premium';
                        }
                        $insurance['plan_name'] = $plan_name;
                        $details['insurance_details'] = $insurance;

                    }

                    $service_fees = Fees::where('apply_services','Laundry')
                                        ->orderBy('id','desc')
                                        ->get();

                    if (count($service_fees) > 0 ) {
                        $details['service_fees'] = $service_fees; 
                    } else{
                        $details['service_fees'] = [];
                    }

                    /*$tax_feess = TaxFee::first();
                    if ($tax_feess) {  
                        $details['tax_fees'] = $tax_feess; 
                    } else{
                         
                        $details['tax_fees'] = $tax_feess; 
                    }*/
 

            }elseif($details->service == 'Housekeeping'){

                $details = AddToCart::select(['id','user_id','service','plan_id','pickup_date','pickup_time','addons','addons_quantity','frequency','same_as_signup','address','latitude','longitude','created_at','updated_at'])->where('id',$details->id)->first();

                $housekeepingPlan = HousekeepingPlan::where('id',$details->plan_id)->first();

                if(($details->addons != '') && ($details->addons != null) ){

                $addons = explode(',',$details->addons);
                $addons_quntity = explode(',',$details->addons_quantity);

                $addonsItem = array_combine($addons,$addons_quntity);


                    foreach($addonsItem as $key => $value){
                        $addonDetails = Addon::find($key);
                        $datass['addon_id'] = $key;
                        $datass['quantity'] = $value;
                        $datass['price'] = $addonDetails->price;
                        $datass['name'] = $addonDetails->description;
                        $detailsss[] = $datass;
                    }
                }else{
                    $detailsss = [];
                }

                $details['addonsItems'] = $detailsss;
                $details['planDetails'] = $housekeepingPlan;
                $detailsss = [];
                $service_fees = Fees::where('apply_services','Housekeeping')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($service_fees) > 0 ) {
                    $details['service_fees'] = $service_fees; 
                } else{
                    $details['service_fees'] = [];
                } 

                /*$tax_feess = TaxFee::where('apply_services','Housekeeping')
                                ->orderBy('id','desc')
                                ->get();
                if (count($tax_feess) > 0 ) {  
                    $details['tax_fees'] = $tax_feess; 
                } else{
                     
                    $details['tax_fees'] = []; 
                }*/


            }elseif($details->service == 'Storage'){

                $details = AddToCart::select(['id','user_id','service','plan_id','pickup_date','pickup_time','addons','addons_quantity','insurance','dropoff_date','dropoff_time','same_as_signup','address','latitude','longitude','created_at','updated_at'])->where('id',$details->id)->first();

                $storagePlan = StoragePlan::where('id',$details->plan_id)->first();

                if($details->addons ||  ($details->addons != '') ){
                    $addons = explode(',',$details->addons);
                    $addons_quntity = explode(',',$details->addons_quantity);

                    $addonsItem = array_combine($addons,$addons_quntity);

                    $detailsss = [];

                    foreach($addonsItem as $key => $value){
                        $addonDetails = Addon::find($key);
                        $datass['addon_id'] = $key;
                        $datass['price'] = $addonDetails->price;
                        $datass['name'] = $addonDetails->description;
                        $datass['quantity'] = $value;
                        $detailsss[] = $datass;
                    }

                    $details['addonsItems'] = $detailsss;

                }
                $details['addonsItems'] = isset($detailsss) ? $detailsss : [];
                $details['planDetails'] = $storagePlan;
                $service_fees = Fees::where('apply_services','Storage')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($service_fees) > 0 ) {
                    $details['service_fees'] = $service_fees; 
                } else{
                    $details['service_fees'] = [];
                }

                /*$tax_feess = TaxFee::where('apply_services','Storage')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($tax_feess) > 0 ) {  
                    $details['tax_fees'] = $tax_feess; 
                } else{
                     
                    $details['tax_fees'] = []; 
                }*/

            }
            $detailss[] = $details;
        }

        }
        else{
            $detailss = [];
        }

        $cardDetails = PaymentCard::where('user_id',Auth::id())->get();
        if( count($cardDetails) > 1){
            $cardDetails = PaymentCard::where('user_id',Auth::id())->where('status','1')->first();
        }elseif(count($cardDetails) ==  1){
            $cardDetails = PaymentCard::where('user_id',Auth::id())->first();
        }else{
            $cardDetails = (object) [];
        }

        $billingAddress = BillingAddress::where('user_id',Auth::id())->first();
        if($billingAddress == null){
            $billingAddress = (object)[];
        }

        $taxs = TaxFee::first();

        $response = [
            'message' => 'Deatils Found!',
            'body' => [
                'items' => $detailss ,
                'cardDetails' => $cardDetails,
                'billingAddress' => $billingAddress,
                'taxes' => $taxs,
            ],
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function removeCart($id)
    {
        $data = AddToCart::where('id',$id)->delete();
        $response = [
            'message' => 'Delete Successfull!',
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function deleteCard($id)
    {
        $data = PaymentCard::find($id);
        if($data){
            if($data->status == '1'){
                $details = PaymentCard::where('user_id',Auth::id())->first();
                if($details){
                    $details->update(['status' => '1']);
                }
            }
            $data->delete();
            $response = [
                'message' => 'Delete Successfull!',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function makeDefaultCard($id)
    {
        $data = PaymentCard::where('user_id',Auth::id())->update(['status' => '0']);
        if($data){
            $card = PaymentCard::find($id)->update(['status'=>'1']);
            if($card){
                $response = [
                    'message' => 'Default card setted!',
                    'status' => 200,
                ];
                return response()->json($response,200);
            }else{
                $response = [
                    'message' => 'Something went wrong!',
                    'status' => 400,
                ];
                return response()->json($response,400);
            }
        }else{
               $response = [
                    'message' => 'Sorry, Please try again later!',
                    'status' => 400,
                ];
                return response()->json($response,400);
        }

    }

    public function checkCart()
    {
        $data = AddToCart::where('user_id',Auth::id())->where('is_deleted','0')->get();
        if(count($data) > 0){
            foreach($data as $details){
                if($details->service == 'Laundry'){
                    $detailss['laundryCart'] = '1';
                }
                if($details->service == 'Housekeeping'){
                    $detailss['housekeepingCart'] = '1';
                }
                if($details->service == 'Storage'){
                    $detailss['storageCart'] = '1';
                }
            }

            if(!isset($detailss['laundryCart'])){
                $detailss['laundryCart'] = '0';
            }

            if(!isset($detailss['housekeepingCart'])){
                $detailss['housekeepingCart'] = '0';
            }

            if(!isset($detailss['storageCart'])){
                $detailss['storageCart'] = '0';
            }

            $subscription = Subscription::where('user_id',Auth::id())->where('is_deleted','0')->get();
            if(count($subscription) > 0){
                $detailss['subscription'] = '1';
            }else{
                $detailss['subscription'] = '0';
            }

            $response = [
                'message' => 'details found Successfull!',
                'body' => $detailss,
                'status' => 200,
            ];
            return response()->json($response,200);

        }else{
            $subscription = Subscription::where('user_id',Auth::id())->where('is_deleted','0')->get();
            if(count($subscription) > 0){
                $detailss['subscription'] = '1';
            }else{
                $detailss['subscription'] = '0';
            }

            $response = [
                'message' => 'details found Successfull!',
                'body' => [
                    'laundryCart' => '0',
                    'housekeepingCart' => '0',
                    'storageCart' => '0',
                    'subscription' => $detailss['subscription'],
                ],
                'status' => 200,
            ];
            return response()->json($response,200);
        }
    }

    public function addupdateCard(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name_on_card' => 'required',
            'card_type' => 'required',
            'card_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'is_default' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }


        $user_id = (Auth::id() != null ) ? Auth::id() : $request->input('user_id');

        $checkCard = PaymentCard::where('user_id',$user_id)->get();
        if(count($checkCard) > 0){
            $update = PaymentCard::where('user_id',$user_id)->update(['status' => '0']);

            $data = PaymentCard::updateOrCreate(['user_id' => $user_id,'card_number' => $request->input('card_number') ],
                [
                    'user_id' => $user_id,
                    'name_on_card' => $request->input('name_on_card'),
                    'card_type' => $request->input('card_type'),
                    'card_number' => $request->input('card_number'),
                    'expiry_month' => $request->input('expiry_month'),
                    'expiry_year' => $request->input('expiry_year'),
                    'status' => '1'
                ]);

        }else{

            $data = PaymentCard::updateOrCreate(['user_id' => $user_id, 'card_number' => $request->input('card_number') ],
                [
                    'user_id' => $user_id,
                    'name_on_card' => $request->input('name_on_card'),
                    'card_type' => $request->input('card_type'),
                    'card_number' => $request->input('card_number'),
                    'expiry_month' => $request->input('expiry_month'),
                    'expiry_year' => $request->input('expiry_year'),
                    'status' => '1'
                ]);

        }

        if($data){
            $response = [
                'message' => 'Card details Updated successfully',
                'status' => 200,
            ];

            return response()->json($response,200);
        }

    }

    public function addupdateCard_web(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name_on_card' => 'required',
            'card_type' => 'required',
            'card_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'is_default' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }


        $user_id = (Auth::id() != null ) ? Auth::id() : $request->input('user_id');

        $checkCard = PaymentCard::where('user_id',$user_id)->get();
        if(count($checkCard) > 0){
            $update = PaymentCard::where('user_id',$user_id)->update(['status' => '0']);

            $data = PaymentCard::updateOrCreate(['user_id' => $user_id,'card_number' => $request->input('card_number') ],
                [
                    'user_id' => $user_id,
                    'name_on_card' => $request->input('name_on_card'),
                    'card_type' => $request->input('card_type'),
                    'card_number' => $request->input('card_number'),
                    'expiry_month' => $request->input('expiry_month'),
                    'expiry_year' => $request->input('expiry_year'),
                    'status' => '1'
                ]);

        }else{

            $data = PaymentCard::updateOrCreate(['user_id' => $user_id, 'card_number' => $request->input('card_number') ],
                [
                    'user_id' => $user_id,
                    'name_on_card' => $request->input('name_on_card'),
                    'card_type' => $request->input('card_type'),
                    'card_number' => $request->input('card_number'),
                    'expiry_month' => $request->input('expiry_month'),
                    'expiry_year' => $request->input('expiry_year'),
                    'status' => '1'
                ]);

        }

        if($data){
            $response = [
                'message' => 'Card details Updated successfully',
                'status' => 200,
            ];

            return response()->json($response,200);
        }

    }

    public function addCard(Request $request)
    {
        $v = Validator::make($request->all(),[
            'name_on_card' => 'required',
            'card_type' => 'required',
            'card_number' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            // 'cvv' => 'required',
            'is_default' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $check = PaymentCard::where(['user_id' => Auth::id(),'card_number' => $request->input('card_number')])->first();
        if($check){
            $response = [
                 'message' => 'The card exists perivoiusly',
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        if ($request->is_default == 1) {
            $update_data = PaymentCard::where('user_id',Auth::id())->update(['status' => '0']);
            $request->merge(['user_id' => Auth::id()]);
            $data = new PaymentCard($request->all());
            $data->save();
            $card = PaymentCard::find($data->id)->update(['status'=>'1']);
        } else {
            $request->merge(['user_id' => Auth::id()]);
            $data = new PaymentCard($request->all());
            $data->save();
        }

        if($data->save()){
            $response = [
                'message' => 'Details found!',
                'body' => $data,
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function getStorageItems()
    {
        $data = Addon::where('service','Storage')->get();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' =>200
        ];
        return response()->json($response,200);
    }

    public function applyPromocode(Request $request)
    {
        $data = Coupon::where('code',$request->input('code'))->where('expiry_date','>=',Date('Y-m-d'))->first();
        if($data){
            $response = [
                'message' => 'Coupon applied successfully',
                'body' => $data,
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Invalid Coupon',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function billingAddress(Request $request)
    {
        // print_r($request->all());
        // die;
        $v = Validator::make($request->all(),[
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            // 'appartment_number' => 'required',
            // 'gate_code' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $user_id = (Auth::id()) ? Auth::id() : $request->input('user_id');



        $data = BillingAddress::updateOrCreate(
                    ['user_id' => $user_id ],
                    [
                        'user_id' => $user_id,
                        'address' => $request->input('address'),
                        'city' => $request->input('city'),
                        'state' => $request->input('state'),
                        'zipcode' => $request->input('zipcode'),
                        'appartment_number' => $request->input('appartment_number'),
                        'gate_code' => $request->input('gate_code'),
                    ]
                );

        if($data){
            $response = [
                'message' => 'Biiling Address Updated Successfully',
                'body' => $data,
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function billingAddress_web(Request $request)
    {
        // print_r($request->all());
        // die;
        $v = Validator::make($request->all(),[
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'appartment_number' => 'required',
            'gate_code' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $user_id = (Auth::id()) ? Auth::id() : $request->input('user_id');

        $data = BillingAddress::updateOrCreate(
                    ['user_id' => $user_id ],
                    [
                        'user_id' => $user_id,
                        'address' => $request->input('address'),
                        'city' => $request->input('city'),
                        'state' => $request->input('state'),
                        'zipcode' => $request->input('zipcode'),
                        'appartment_number' => $request->input('appartment_number'),
                        'gate_code' => $request->input('gate_code'),
                    ]
                );

        if($data){
            $response = [
                'message' => 'Biiling Address Updated Successfully',
                'body' => $data,
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function editPlan(Request $request)
    {
        $v = Validator::make($request->all(),[
            'service' => 'required',
            'plan_id' => 'required',
            // 'pickup_date' => 'required',
            // 'pickup_time' => 'required',
            // 'dropoff_date' => 'required',
            // 'dropoff_time' => 'required',
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $data = [
            'plan_id' => $request->input('plan_id'),
            'pickup_date' => $request->input('pickup_date'),
            'pickup_time' => $request->input('pickup_time'),
            'frequency' => $request->input('frequency'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'insurance' => $request->input('insurance'),
            'dropoff_date' => $request->input('dropoff_date'),
            'dropoff_time' => $request->input('dropoff_time'),
            'dorm_name' => $request->input('dorm_name'),
            'same_as_signup' => $request->input('same_as_signup'),
            'comment' => $request->input('comment'),
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'is_scheduled' => $request->input('is_scheduled'),
        ];

        if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/addtocart');
            $file->move($path, $filename);
            $data['image'] = $filename;
        }

        if(($request->input('addons') != '') && ($request->input('addons') != null) && ($request->input('largeItem') == null)){
            foreach(json_decode($request->input('addons')) as $details){
                $items[] = $details->addon_id;
                $quantity[] = $details->quantity;
            }

            $items = implode(',',$items);
            $quantity = implode(',',$quantity);

            $data['addons'] = $items;
            $data['addons_quantity'] = $quantity;
        }else{
            $data['addons'] = "";
            $data['addons_quantity'] = "";
        }


        if($request->input('largeItem') ){
            foreach(json_decode($request->input('addons')) as $details){
                $items[] = $details->addon_id;
                $quantity[] = $details->quantity;
            }

            $items = implode(',',$items);
            $quantity = implode(',',$quantity);

            $data['addons'] = $items;
            $data['addons_quantity'] = $quantity;
        }else if (($request->input('largeItem') != null )|| $request->input('largeItem') != 0 ){
            $data['addons'] = '';
            $data['addons_quantity'] = '';
        }

        $update = AddToCart::where('user_id',Auth::id())->where('service',$request->input('service'))->update($data);
        if($update){
            $response = [
                'message' => 'Plan updated successfully!',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400,
            ];
            return response()->json($response,400);
        }

    }

    public function booking(Request $request)
    {
        $v = Validator::make($request->all(), [
            'subtotal' => 'required',
            'tax' => 'required',
            'total' => 'required',
            'card_id' => 'required',
            'token' => 'required',
            'cart_id' => 'required',
        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }


/*
        require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/stripe/stripe-php-master/init.php');

        $secret_key = 'sk_test_gXfEpxsKxoeOg5VHwyVBx2fr00GjNpjkAo';
        $publishable_key = 'pk_test_VfuRgynPlWr9LwhbtqzI5SdA000BaVMq8p';

        $stripe_data = array('secret_key' => $secret_key, 'publishable_key' => $publishable_key);
        \Stripe\Stripe::setApiKey($stripe_data['secret_key']);

        $token = $request->input('token');

        $customer = \Stripe\Customer::create([
            'source' => $token,
        ]);

        $payment = \Stripe\Charge::create([
          'amount' => $request->input('total') * 100,
          'currency' => 'usd',
          'customer' => $customer->id,
          'description' => 'Plan purchased successfully',
          'shipping' => [
                'name' => 'Jenny Rosen',
                'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
                ],
            ],
        ]);
       /* $ccGateway = \Omnipay\Omnipay::create('Paytrace_CreditCard');
                    $ccGateway->setUserName('ashwani.dhindsa@gmail.com')
                                ->setPassword('India@1994')
                                ->setTestMode(true);

        $creditCardData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2030', 'cvv' => '123'];
        $payment = $ccGateway->purchase(['amount' => $request->input('total') * 100, 'currency' => 'USD', 'card' => $creditCardData])->send();*/

        
        $payment = $this->paymenttest($request->input('total'));        

        if ($payment) {

            $cardIds = explode(',',$request->input('cart_id'));
            foreach($cardIds as $cardId){

                $cart = AddToCart::find($cardId);
                if(isset($cart->pickup_date) && ($cart->pickup_date != '') && ($cart->pickup_date != '1') ){
                    $start = $cart->pickup_date;
                    $end = date('Y-m-d',strtotime('+30 days',strtotime($start)));
                }else{
                    $start = date('Y-m-d');
                    $end = date('Y-m-d',strtotime('+30 days',strtotime($start)));
                }

                if($cart->insurance != ''){
                    $ins = explode(',',$cart->insurance);
                    $insur = Insurance::where('id',$ins[0])->first();
                    $insurance['id'] = $insur->id;
                    $insurance['itemname'] = $insur->item_name;
                    $price = explode(',',$insur->prices);

                    $insurance['priceName'] = $price[$ins[1]];
                    if($ins[1] == 0){
                        $plan_name = 'Standard';
                    }
                    if($ins[1] == 1){
                        $plan_name = 'Premium';
                    }
                    if($ins[1] == 2){
                        $plan_name = 'Plus';
                    }
                    $insurance['plan_name'] = $plan_name;

                }

                $checkCart = AddToCart::with(['subscription'])->where('service',$cart->service)->where('user_id',Auth::id())->where('is_deleted','1')->orderby('id','DESC')->where('id','!=',$cardId)->first();
                if($checkCart){
                       $sub = Subscription::find($checkCart->subscription->id);
                       if($sub){
                           $sub->is_deleted = '1';
                           $sub->save();
                        //    print_r($sub);
                       }
                }

                $frequency = AddToCart::find($cardId)->frequency;

                $billingAddress = BillingAddress::where('user_id',Auth::id())->first();

                // if(!$billingAddress){
                //     $response = [
                //         'message' => 'Please set Billing Address first',
                //         'status' => 400,
                //     ];
                //     return response($response,400);
                // }

                $billing_address_id = ($request->input('billing_address_id') != '') ? $request->input('billing_address_id') : $billingAddress->id ;

                $data = [
                    'user_id' => Auth::id(),
                    'cart_id' => $cardId,
                    'card_id' => $request->input('card_id'),
                    'billing_address_id' => $billing_address_id,
                    'total' => $request->input('total'),
                    'coupon' => $request->input('coupon'),
                    'grautity' => $request->input('grautity'),
                    'service_fee' => $request->input('service_fee'),
                    'tax' => $request->input('tax'),
                    'subtotal' => $request->input('subtotal'),
                    'start' => $start,
                    'end' => $end,
                    'transaction_id' => $payment,
                    'charge_id' => $payment,
                ];

                $insert = new Subscription($data);
                $insert->save();
                $cart->is_deleted = '1';
                $cart->save();


                if($cart->service == 'Storage' || $cart->service == 'Housekeeping'){
                    $addonInsertData = [
                        'user_id' => Auth::id(),
                        'subscription_id' => $insert->id,
                        'addon' => $cart->addons,
                        'addon_quantity' => $cart->addons_quantity,
                    ];



                    if($cart->service == 'Storage'){
                        $addonInsert = new AddtocartStorage($addonInsertData);
                        $addonInsert->save();
                    }elseif($cart->service == 'Housekeeping'){
                        $addonInsert = new AddtocartHousekeeping($addonInsertData);
                        $addonInsert->save();
                    }

                    $orderData = [
                        'service' => $cart->service,
                        'user_id' => Auth::id(),
                        'subscription_id' => $insert->id,
                        'transaction_id' => $payment,
                        'charge_id' => $payment,
                        'order_date' => $cart->pickup_date,
                        'order_time' => $cart->pickup_time,
                        'total_amount' => $request->input('total'),
                        'card_id' => $request->input('card_id'),
                        'cart_id' => $addonInsert->id,
                        'gratuity' => $request->input('gratuity'),
                    ];

                    $orderInsert = new Order($orderData);
                    $orderInsert->save();

                }

                if($cart->service == 'Laundry'){

                    $service_feess = Fees::where('apply_services','Laundry')
                                    ->orderBy('id','desc')
                                    ->get();
                    if (count($service_feess) > 0 ) {
                       $service_fees = $service_feess; 
                    } else {
                        $service_fees = [];
                    }

                    $tax_feess = TaxFee::where('apply_services','Laundry')
                                ->orderBy('id','desc')
                                ->get();
                    if (count($tax_feess) > 0 ) {  
                        $details['tax_fees'] = $tax_feess; 
                    } else{
                         
                        $details['tax_fees'] = []; 
                    }

                    $plan = LaundryPlan::find($cart->plan_id);
                }else if($cart->service == 'Housekeeping'){

                    $service_feess = Fees::where('apply_services','Housekeeping')
                                    ->orderBy('id','desc')
                                    ->get();
                    if (count($service_feess) > 0 ) {
                       $service_fees = $service_feess; 
                    } else {
                        $service_fees = [];
                    }

                    $tax_feess = TaxFee::where('apply_services','Housekeeping')
                                ->orderBy('id','desc')
                                ->get();
                    if (count($tax_feess) > 0 ) {  
                        $tax_fees = $tax_feess; 
                    } else{
                         
                       $tax_fees = [];
                    }

                    $plan = HousekeepingPlan::find($cart->plan_id);
                }else{
                    
                    $service_feess = Fees::where('apply_services','Storage')
                                    ->orderBy('id','desc')
                                    ->get();
                    if (count($service_feess) > 0 ) {
                       $service_fees = $service_feess; 
                    } else {
                        $service_fees = [];
                    }

                    $tax_feess = TaxFee::where('apply_services','Storage')
                                ->orderBy('id','desc')
                                ->get();
                    if (count($tax_feess) > 0 ) {  
                        $tax_fees = $tax_feess; 
                    } else{
                         
                       $tax_fees = [];
                    }

                    $plan = StoragePlan::find($cart->plan_id);
                }

                if($cart->addons ||  ($cart->addons != '') ){
                    $addons = explode(',',$cart->addons);
                    $addons_quntity = explode(',',$cart->addons_quantity);

                    $addonsItem = array_combine($addons,$addons_quntity);

                    $detailsss = [];

                    foreach($addonsItem as $key => $value){
                        $addonDetails = Addon::find($key);
                        $datass['addon_id'] = $key;
                        $datass['name'] = $addonDetails->description;
                        $datass['price'] = $addonDetails->price;
                        $datass['quantity'] = $value;
                        $detailsss[] = $datass;
                    }
                }

                if (!empty($request->input('luandry_tax_fees'))) {
                    $laundry_tax = $request->input('luandry_tax_fees');
                }else{
                    $laundry_tax = "";
                }

                if (!empty($request->input('housekeeping_tax_fees'))) {
                    $housekeeping_tax = $request->input('housekeeping_tax_fees');
                }else{
                    $housekeeping_tax = "";
                }

                if (!empty($request->input('storage_tax_fees'))) {
                    $storage_tax = $request->input('storage_tax_fees');
                }else{
                    $storage_tax = "";
                }

                $items[] = [
                    'sevrice' => $cart->service,
                    'description' => $plan->description,
                    'price' => $plan->price,
                    'allDetais' => $plan,
                    'subtotal' => $request->input('subtotal'),
                    'addons' => (isset($detailsss) && (count($detailsss) > 0)) ? $detailsss : [],
                    'frequency' => (isset($frequency) && $frequency != '' ) ? $frequency : '' ,
                    'service_fees' => $service_fees,
                    'luandry_tax_fees' => $laundry_tax,
                    'housekeeping_tax_fees' => $housekeeping_tax,
                    'storage_tax_fees' => $storage_tax,
                ];

                $detailsss = [];
            }

            $billingg = BillingAddress::find($billing_address_id);
            if(!$billingg){
                $billingg =  (object) array();
            }

            $details = [
                'transactionDate' => Date('Y-m-d'),
                'billingAddress' => $billingg,
                'totalPrice' => $request->input('total'),
                "invoicePDF" => '',
                "gratuity" => ($request->input('gratuity') != '') ? $request->input('gratuity') : ''  ,
                "items" => $items,
                'cardDetails' => PaymentCard::find($request->input('card_id')),
                'taxs' => (object) [
                    'service_fee' => $request->input('service_fee'),
                    'tax' => $request->input('tax'),
                ],
            ];

            if(isset($detailsss)){
                $details['addons'] = $detailsss;
            }

            if(isset($insurance)){
                $details['insurance'] = $insurance;
            }

            if($request->input('coupon_discount')){
                    $details['discount'] = $request->input('coupon_discount');
            }

            $response = [
                'message' => 'Payment done successfully',
                'body' => $details,
                'status' => 200
            ];
            return response()->json($response, 200);
        } else {

            $response = [
                'message' => 'Something went wrong!',
                'status' => 400
            ];
            return response()->json($response, 400);
        }

        // Create a PaymentIntent:
        /*$paymentIntent = \Stripe\PaymentIntent::create([
          'amount' => 10000,
          'currency' => 'usd',
          'payment_method_types' => ['card'],
          'transfer_group' => '{ORDER10}',
        ]);

        // Create a Transfer to a connected account (later):
        $transfer = \Stripe\Transfer::create([
          'amount' => 7000,
          'currency' => 'usd',
          'destination' => 'acct_1GTsSMDfJBmgPV98',
          'transfer_group' => '{ORDER10}',
        ]);*/

        // return response()->json(['successCode' => 200, 'message' => "$paymentIntent", 'body' => $payment], 200);


        // dd($payment);
    }

    public function addToCartLaundry(Request $request)
    {
        $data = [
            'user_id' => Auth::id(),
            'subscription_id' => $request->input('subscription_id'),
            'gratuity' => $request->input('gratuity'),
        ];

        if($request->input('laundry_items')){
            foreach(json_decode($request->input('laundry_items')) as $details1){
                $items[] = $details1->item_id;
                $quantity[] = $details1->quantity;
            }

            $items = implode(',',$items);
            $quantity = implode(',',$quantity);

            $data['items_id'] = $items;
            $data['items_quantity'] = $quantity;
        }

        if($request->input('is_dryclean')){
            foreach(json_decode($request->input('dryclean_id')) as $details2){
                $items1[] = $details2->dryclean_id;
                $quantity1[] = $details2->quantity;
            }

            $items1 = implode(',',$items1);
            $quantity1 = implode(',',$quantity1);

            $data['is_dryclean'] = '1';
            $data['dryclean_id'] = $items1;
            $data['dryclean_quantity'] = $quantity1;
        }

        $insert = new AddtocartLaundry($data);
        if($insert->save()){
            $response = [
                'message' => 'Added successfully!',
                'body' => $insert,
                'status' => 200
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400
            ];
            return response()->json($response,400);
        }
    }

    public function getLaundryCart()
    {
        $datas = AddtocartLaundry::where('user_id',Auth::id())->where('is_deleted','0')->first();
        if($datas){
                $items = explode(',',$datas->items_id);
                $items_quantity = explode(',',$datas->items_quantity);
                // print_r($items_quantity);
                // print_r($items);
                // die;
                $itemsQuantity = array_combine($items,$items_quantity);
                foreach($itemsQuantity as $key => $value){
                    $item = LaundryItem::find($key);
                    $inventory[] = [
                        'itemName' => $item->name,
                        'quantity' => $value
                    ];
                }

                $total = 0;

                $dryitems = explode(',',$datas->dryclean_id);
                $dryitems_quantity = explode(',',$datas->dryclean_quantity);
                // print_r($items_quantity);
                // print_r($items);
                // die;
                $itemsQuantity = array_combine($dryitems,$dryitems_quantity);
                foreach($itemsQuantity as $key => $value){
                    $item = Addon::find($key);
                    $price = $item->price *  $value;
                    $drycleantotal[] = $price;

                    $dryclean[] = [
                        'drycleanItemName' => $item->description,
                        'quantity' => $value,
                        'price' => $price
                    ];
                }

                $details = $datas;
                $details['inventory'] = isset($inventory) ? $inventory : [];
                $details['dryclean'] = isset($dryclean) ? $dryclean : [];
                $details['total'] = isset($drycleantotal) ? array_sum($drycleantotal) : '';

                $response = [
                    'message' => 'Details found!',
                    'body' => $details,
                    'status' => 200
                ];

                return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Cart is empty!',
                'body' => [],
                'status' => 200
            ];

            return response()->json($response,200);
        }
    }

    public function getInsurance()
    {
        $data = Insurance::where('status','1')
                            ->where('id','!=',1)
                            ->get();
        $details = $data->map(function ($datas) {
            $prices = explode(',',$datas->prices);

            $datas['pricesArray'] = $prices;
            return $datas;
        });

        $response = [
            'message' => 'Details found',
            'body' => $details,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function getInsurance_new()
    {
        $data = Insurance::where('status','1')->first();
        // dd($data);
        $prices = explode(',',$data->prices);
        $planNames = ['Standard','Plus','Premium'];
        $j = 0;
        if(count($prices) > 0){
            foreach($prices as $price){
                $details[] = [
                    'id' => $j,
                    'planName' => $planNames[$j],
                    'prices' => $price,
                ];
            $j++;
            }

        }
        $data['plansDetails'] = $details;
        $response = [
            'message' => 'Details found',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function myservice()
    {
        $date = date('Y-m-d');
        $data = Subscription::with(['cart','order','order.laundrylogcomments'=> function($q){
            //$q->select('id','comments','image');
           // $q->where('id','desc');
        }])->where('user_id',Auth::id())->where('is_deleted','0')->where('is_canceled','0')->where('end','>=', $date)->get();


        if(count($data) > 0){
            foreach($data as $datas){
                if($datas->cart->service == 'Laundry'){
                    if(date('D')!='Mon')
                    {
                        $staticstart = date('Y-m-d',strtotime('last Sunday'));
                    }else{
                        $staticstart = date('Y-m-d');
                    }

                    if(date('D')!='Sat')
                    {
                        $staticfinish = date('Y-m-d',strtotime('next Saturday'));
                    }else{

                        $staticfinish = date('Y-m-d');
                    }

                    $thisWeek = Order::where('subscription_id',$datas->id)->where('created_at','>=',$staticstart)->where('created_at','<=',$staticfinish)->first();
                    // dd($thisWeek);
                    if($thisWeek){
                        $datas['this_week'] = '1';
                    }else{
                        $datas['this_week'] = '0';
                    }

                }

                if($datas->cart->service == 'Housekeeping'){

                    $frequency = $datas->cart->frequency;

                    if($frequency == '1'){
                        $staticstart= date('d.m.Y',strtotime('first day of this month'));
                        $staticfinish = date('d.m.Y',strtotime('last day of this month'));
                    }
                    else if($frequency == '3'){
                        if(date('D')!='Mon')
                        {
                            $staticstart = date('Y-m-d',strtotime('last Sunday'));
                        }else{
                            $staticstart = date('Y-m-d');
                        }

                        if(date('D')!='Sat')
                        {
                            $staticfinish = date('Y-m-d',strtotime('next Saturday'));
                        }else{

                            $staticfinish = date('Y-m-d');
                        }
                    }else{
                        $staticstart = date('Y-m-d');
                        $staticfinish = date('Y-m-d');
                    }

                    $thisWeek = Order::where('subscription_id',$datas->id)->where('created_at','>=',$staticstart)->where('created_at','<=',$staticfinish)->first();

                    if($frequency == '2'){
                        $staticstart= date('d.m.Y',strtotime('first day of this month'));
                        $staticfinish = date('d.m.Y',strtotime('last day of this month'));

                        $thisWeek = Order::where('subscription_id',$datas->id)->where('created_at','>=',$staticstart)->where('created_at','<=',$staticfinish)->where('order_status','3')->get();
                        if((count($thisWeek) > 1 ) && (count($thisWeek) < 3) ){
                            $thisWeek = 1;
                        }
                    }

                    // dd($thisWeek);
                    if($thisWeek){
                        $datas['this_week'] = '1';
                    }else{
                        $datas['this_week'] = '0';
                    }
                }

                $details[] = $datas;
            }

            $response = [
                'message' => 'Details found',
                'body' => $details,
                'status' => 200
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Cart is empty',
                'status' => 200
            ];
            return response()->json($response,200);
        }
    }

    public function bookLaundry(Request $request)
    {
        $datas = AddtocartLaundry::with(['subscription.cart'])->where('subscription_id',$request->input('subscription_id'))->orderby('id','DESC')->first();

        if($datas->is_dryclean != '' && $datas->is_dryclean !== null ){
            $dryitems = explode(',',$datas->dryclean_id);
            $dryitems_quantity = explode(',',$datas->dryclean_quantity);
            $itemsQuantity = array_combine($dryitems,$dryitems_quantity);


            foreach($itemsQuantity as $key => $value){
                $item = Addon::find($key);
                // print_r($value);
                $price = $item->price *  $value;
                $drycleantotal[] = $price;
            }

            $total = $request->input('total');

/*
            require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/stripe/stripe-php-master/init.php');

            $secret_key = 'sk_test_gXfEpxsKxoeOg5VHwyVBx2fr00GjNpjkAo';
            $publishable_key = 'pk_test_VfuRgynPlWr9LwhbtqzI5SdA000BaVMq8p';

            $stripe_data = array('secret_key' => $secret_key, 'publishable_key' => $publishable_key);
            \Stripe\Stripe::setApiKey($stripe_data['secret_key']);

            $token = $request->input('token');

            $customer = \Stripe\Customer::create([
                'source' => $token,
            ]);

            $payment = \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'usd',
            'customer' => $customer->id,
            'description' => 'Plan purchased successfully',
            'shipping' => [
                    'name' => 'Jenny Rosen',
                    'address' => [
                    'line1' => '510 Townsend St',
                    'postal_code' => '98140',
                    'city' => 'San Francisco',
                    'state' => 'CA',
                    'country' => 'US',
                    ],
                ],
            ]);
*/
            $payment = $this->paymenttest($total);
            if(!$payment){
                $response = [
                    'message' => 'Payment not sucessfully!',
                    'status' => 400
                ];
                return response()->json($response,200);
            }

            $transaction_id = $payment;
            $charge_id = $payment;

        }

        $data = [
            'user_id' => Auth::id(),
            'subscription_id' => $request->input('subscription_id'),
            'total_amount' => isset($total) ? $total : '',
            'order_date' => $datas->subscription->cart->dropoff_date,
            'order_time' => $datas->subscription->cart->dropoff_time,
            'card_id' => $request->input('card_id'),
            'cart_id' => $request->input('cart_id'),
            'gratuity' => $request->input('gratuity'),
        ];

        if(isset($transaction_id) && isset($charge_id)){
            $data['transaction_id'] = $transaction_id;
            $data['charge_id'] = $charge_id;
        }

        $insert = new Order($data);
        if($insert->save()){
            if($datas->items_id != ''){
                $items = explode(',',$datas->items_id);
                $items_quantity = explode(',',$datas->items_quantity);
                $itemsQuantity = array_combine($items,$items_quantity);
                foreach($itemsQuantity as $key => $value){
                    $item = LaundryItem::find($key);
                    $inventory[] = [
                        'itemName' => $item->name,
                        'quantity' => $value
                    ];
                }
            }

                if($datas->is_dryclean != '' && $datas->is_dryclean !== null ){
                    $dryitems = explode(',',$datas->dryclean_id);
                    $dryitems_quantity = explode(',',$datas->dryclean_quantity);
                    $itemsQuantity = array_combine($dryitems,$dryitems_quantity);
                    foreach($itemsQuantity as $key => $value){
                        $item = Addon::find($key);
                        $price =  (string) (($item->price) *  $value);

                        $dryclean[] = [
                            'drycleanItemName' => $item->description,
                            'quantity' => $value,
                            'price' => $price
                        ];
                    }

                }

                // $inventory = isset($inventory) ? $inventory : [];
                // $dryclean = isset($dryclean) ? $dryclean : [];

                $datas->is_deleted = '1';
                $datas->save();

                $result = [
                    'transactionDate' => Date('Y-m-d'),
                    // 'billingAddress' => BillingAddress::find($request->input('billing_address_id')),
                    'totalPrice' =>  isset($total) ? (string) $total : '',
                    "invoicePDF" => '',
                    "items" => isset($inventory) ? $inventory : [],
                    "dryclean" => isset($dryclean) ? $dryclean : [],
                    "gratuity" => ($request->input('gratuity') != '') ? $request->input('gratuity') : '',
                ];

                $response = [
                    'message' => 'Payment done successfully',
                    'body' => $result,
                    'status' => 200
                ];

                return response()->json($response,400);
        }else{

            $response = [
                'message' => 'Something went wrong!',
                'status' => 400
            ];

            return response()->json($response,400);

        }

    }

    public function pastOrder()
    {
        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->where('user_id',Auth::id())->where('order_status','2')->get();
        $response = [
            'message' => 'Details found!',
            'body' => $data,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function currentOrder()
    {
        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->where('user_id',Auth::id())->where('order_status','!=','2')->get();

        $response = [
            'message' => 'Details found!',
            'body' => $data,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function order()
    {
        $data = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->where('user_id',Auth::id())->where('order_status','2')->get()->toArray();
        $datas = Order::with(['subscription.cart','subscription.billingAddress','card','cart'])->where('user_id',Auth::id())->where('order_status','!=','2')->get()->toArray();
        $details = array_merge($data,$datas);

        usort($details, array($this, "date_compare"));
        $details = array_reverse($details);

        $response = [
            'message' => 'Details found!',
            'body' => $details,
            'status' => 200
        ];
        return response()->json($response,200);
    }

    function date_compare($element1, $element2) {
        $datetime1 = strtotime($element1['created_at']);
        $datetime2 = strtotime($element2['created_at']);
        return $datetime1 - $datetime2;
    }

    public function orderDetails($id)
    {
        $data = Order::with(['subscription.cart','subscription.billAddress','card','cart'])->find($id);
        

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
                        $datasss['price'] = $dryCleanDetails->price;
                        $detailssss[] = $datasss;
                    }

                    $data->drycleanItems = $detailssss;


                }

                    //$data->orderid = 'ORD'.$data->id;
                    $data->orderid = "L".$data->id;

                    $laundrylog = LaundryLog::where('orderdetails_id',$data->id)->first();
                    if($laundrylog){
                        $data->laundrylog = $laundrylog;
                    }else{
                        $data->laundrylog = (object)[];
                    }
                $service_fees = Fees::where('apply_services','Laundry')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($service_fees) > 0 ) {
                    $data->service_fees = $service_fees; 
                } else{
                    $data->service_fees = [];
                }

                $tax_feess = TaxFee::where('apply_services','Laundry')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($tax_feess) > 0 ) {
                    $data->tax_fees = $tax_feess; 
                } else{
                    $data->tax_fees = [];
                }
                   
            $data->planDetails =  LaundryPlan::where(['id'=>$data->subscription->cart->plan_id])->first();
            //echo $data;die();

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

                    // $data->specialRequestAddons = $specialRequestAddons;

                $data->addonsDetail = array_merge($detailssss,$specialRequestAddons);

                $total = (string) ( array_sum($totalPrice) + array_sum($totalPrice1) );

                $data->addonsTotalPrice = $total;

               // $data->orderid = 'ORD'.$data->id;
                $data->orderid = "H".$data->id;
                $service_fees = Fees::where('apply_services','Housekeeping')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($service_fees) > 0 ) {
                    $data->service_fees = $service_fees; 
                } else{
                    $data->service_fees = [];
                }

                $tax_feess = TaxFee::where('apply_services','Housekeeping')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($tax_feess) > 0 ) {
                    $data->tax_fees = $tax_feess; 
                } else{
                    $data->tax_fees = [];
                }
                $data->planDetails =  HousekeepingPlan::where(['id'=>$data->subscription->cart->plan_id])->first();

        }

        if($data->subscription->cart->service == 'Storage'){

                $planDescription = StoragePlan::find($data->subscription->cart->plan_id);
                $data->planDetails = $planDescription;
                $bins = preg_match_all('!\d+!', $planDescription->description, $matches);

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

               // $data->orderid = 'ORD'.$data->id;
                $data->orderid = "S".$data->id;
                $data->bins = $matches[0][0];
                 $service_fees = Fees::where('apply_services','Storage')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($service_fees) > 0 ) {
                    $data->service_fees = $service_fees; 
                } else{
                    $data->service_fees = [];
                }

                $tax_feess = TaxFee::where('apply_services','Storage')
                                    ->orderBy('id','desc')
                                    ->get();
                if (count($tax_feess) > 0 ) {
                    $data->tax_fees = $tax_feess; 
                } else{
                    $data->tax_fees = [];
                }

                $data->planDetails =  StoragePlan::where(['id'=>$data->subscription->cart->plan_id])->first();
        }
        
        $data->subscription->billing_address = $data->subscription->billAddress != null ? $data->subscription->billAddress : (object)[] ;

        $response = [
            'message' => 'Details found!',
            'body' => $data,
            'status' => 200
        ];
        return response()->json($response,200);
    }


    public function claim(Request $request)
    {
        $v = Validator::make($request->all(), [
            // 'order_id' => 'required',
            'color' => 'required',
            'brand' => 'required',
            // 'category' => 'required',
            'item' => 'required',
            'size' => 'required',
            'image' => 'required|image',
        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        // $checkOrder = Order::where('user_id',Auth::id())->where('service','Laundry')->orderby('id','DESC')->first();
        // if(!$checkOrder){
        //     $response = [
        //         'message' => 'Insurance not claimed',
        //         'body' => [
        //             'insurance_is_bought' => '0',
        //         ],
        //         'status' => 200,
        //     ];
        //     return response()->json($response,200);
        // }

        // $cart_id = Subscription::find($checkOrder->subscription_id)->value('cart_id');
        // $insurance = AddToCart::find($cart_id);
        // if(($insurance->insurance == null) || ($insurance->insurance = '') ){
        //     $response = [
        //         'message' => 'Insurance not claimed',
        //         'body' => [
        //             'insurance_is_bought' => '0',
        //         ],
        //         'status' => 200,
        //     ];
        //     return response()->json($response,200);
        // }

        $claim_id = 'LD'.rand(100,999);
        // $last_worn = Order::where('id',$request->input('order_id'))->first();
        // $last_worn = date('Y-m-d',strtotime($last_worn->created_at));
        $last_worn = date('Y-m-d');
        $data = [
            'claim_id' => $claim_id,
            'user_id' => Auth::id(),
            'order_id' => $request->input('order_id'),
            'service' => 'Laundry',
            'color' => $request->input('color'),
            'brand' => $request->input('brand'),
            'category' => $request->input('category'),
            'item' => $request->input('item'),
            'size' => $request->input('size'),
            'last_worn' => $last_worn,
            'resolution' => '0',
        ];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'. $file->getClientOriginalName();
            $path = public_path('images/claims');
            $file->move($path,$filename);
            $data['image'] = $filename;
        }

        $insert = new Claim($data);
        if($insert->save()){
            $insert->insurance_is_bought = '1';
            $response = [
                'message' => 'Thanks for complaint. We`ll contact to you shortly.',
                'body' => $insert,
                'status' => 200,
            ];
            return response($response,200);
        }else{
            $response = [
                'message' => 'Something Went Wrong!',
                'status' => 400,
            ];
            return response($response,400);
        }

    }

    public function getAllClaim()
    {
        $data = Claim::where('user_id',Auth::id())->get();
        $response = [
            'message' => 'Details found',
            'body' => $data,
            'status' => 200
        ];

        return response()->json($response,200);

    }

    public function getClaim($id)
    {
        $data = Claim::find($id);
        $response = [
            'message' => 'Details found',
            'body' => (isset($data) && $data != null) ? $data : (object)[],
            'status' => 200
        ];

        return response()->json($response,200);
    }

    public function rescheduleStorage(Request $request )
    {
        $v = Validator::make($request->all(), [
            // 'order_id' => 'required',
            'service_id' => 'required',
            // 'dropoff_date' => 'sometimes',
            // 'dropoff_time' => 'sometimes',
            // 'pickup_date' => 'sometimes',
            // 'pickup_time' => 'sometimes',
            'address'=> 'sometimes',
            'latitude' => 'sometimes',
            'longitude' => 'sometimes',
            'same_as_signup' => 'sometimes',

        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $subscription = Subscription::find($request->input('service_id'));
        $cart = AddToCart::find($subscription->cart_id);

        unset($request['service_id']);


        if($cart->update($request->all())){
            $response = [
                'message' => 'Service Rescheduled successfully',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400,
            ];
            return response()->json($response,400);
        }

    }

    public function rescheduleHousekeeping( Request $request)
    {
        $v = Validator::make($request->all(), [
            // 'order_id' => 'required',
            'service_id' => 'required',
            // 'dropoff_date' => 'sometimes',
            // 'dropoff_time' => 'sometimes',
            // 'pickup_date' => 'sometimes',
            // 'pickup_time' => 'sometimes',
            'address'=> 'sometimes',
            'latitude' => 'sometimes',
            'longitude' => 'sometimes',
            'same_as_signup' => 'sometimes',

        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $subscription = Subscription::find($request->input('service_id'));
        $cart = AddToCart::find($subscription->cart_id);

        unset($request['service_id']);

        if($cart->update($request->all())){
            $response = [
                'message' => 'Service Rescheduled successfully',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong!',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function housekeepingSpecialRequest(Request $request)
    {
        $v = Validator::make($request->all(), [
            'subscription_id' => 'required',
            'card_id'=> 'required',
            'addon' => 'required',
            'total_amount' => 'required',
            'token' => 'required',
        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }
/*
        require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/stripe/stripe-php-master/init.php');

        $secret_key = 'sk_test_gXfEpxsKxoeOg5VHwyVBx2fr00GjNpjkAo';
        $publishable_key = 'pk_test_VfuRgynPlWr9LwhbtqzI5SdA000BaVMq8p';

        $stripe_data = array('secret_key' => $secret_key, 'publishable_key' => $publishable_key);
        \Stripe\Stripe::setApiKey($stripe_data['secret_key']);

        $token = $request->input('token');

        $customer = \Stripe\Customer::create([
            'source' => $token,
        ]);

        $payment = \Stripe\Charge::create([
          'amount' => $request->input('total_amount') * 100,
          'currency' => 'usd',
          'customer' => $customer->id,
          'description' => 'Plan purchased successfully',
          'shipping' => [
                'name' => 'Jenny Rosen',
                'address' => [
                'line1' => '510 Townsend St',
                'postal_code' => '98140',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'US',
                ],
            ],
        ]);
*/
        $total = $request->input('total_amount');
        $payment = $this->paymenttest($total);

        if($payment){

            if($request->input('addon')){
                foreach(json_decode($request->input('addon')) as $details1){
                    $items[] = $details1->addon_id;
                    $quantity[] = $details1->quantity;
                }

                $itemsQuantity = array_combine($items,$quantity);

                foreach($itemsQuantity as $key => $value){
                    $addonDetails = Addon::find($key);
                    $addons[] = [
                        'addon_name' => $addonDetails->description,
                        'price' => $addonDetails->price,
                        'quantity' => $value,
                    ];
                }

                // $items = implode(',',$items);
                // $quantity = implode(',',$quantity);
            }

            $orderDetails = Order::where('subscription_id',$request->input('subscription_id'))->first();

            $AddonsDetailsCombined = array_combine($items,$quantity);

            foreach($AddonsDetailsCombined as $key => $value ){

                $checkPreviousAddons = AddtocartHousekeeping::where('subscription_id',$request->input('subscription_id'))->first();
                if($checkPreviousAddons){

                    $addon = explode(',',$checkPreviousAddons->addon);
                    $addon_quantity = explode(',',$checkPreviousAddons->addon_quantity);

                    $addon_combine = array_combine($addon,$addon_quantity);

                    $addonss = [];
                    $quantities = [];


                    foreach($addon_combine as $key1 => $value1){
                        $addonss[] = $key1;
                        $quantities[] = $value1;
                        if($key1 == $key){
                            $addonss_combiness = array_combine($addonss,$quantities);
                            $addonss = [];
                            $quantities = [];
                            foreach($addonss_combiness as $ad => $qn){
                                if($key1 == $ad){
                                    continue;
                                }else{
                                    $addonss[] =  $ad;
                                    $quantities[] =  $qn;
                                }
                            }
                            $value = 2;
                        }
                    }

                    $addonss = implode(',',$addonss);
                    $quantities = implode(',',$quantities);

                    $checkPreviousAddons->update(['addon' => $addonss,'addon_quantity' => $quantities ]);

                }

                $checkPreviousSpeialRequests = OrderSpecialrequest::where('user_id',Auth::id())->where('subscription_id',$request->input('subscription_id'))->where('addon',$key)->first();
                if($checkPreviousSpeialRequests){
                    $value = $checkPreviousSpeialRequests->addon_quantity + 1;
                    // dd($checkPreviousSpeialRequests);
                    $checkPreviousSpeialRequests->delete();
                    // $value="2";
                }



                $data[] = [
                    'user_id' => Auth::id(),
                    'order_id' => $orderDetails->id,
                    'subscription_id' => $request->input('subscription_id'),
                    'addon' =>  $key,
                    'addon_quantity' => $value,
                ];

            }

            $insert = OrderSpecialrequest::insert($data);
                if($insert){

                    $AddOnCart_cart_id =  Subscription::find($request->input('subscription_id'))->value('cart_id');
                    $AddToCart = AddToCart::find($AddOnCart_cart_id);
                    $AddToCart->comment = $request->input('comment');

                    if($request->hasFile('image')){
                        $file = $request->file('image');
                        $filename1 = time().'_'.$file->getClientOriginalName();
                        $path = public_path('images/users');
                        $file->move($path,$filename1);
                        $AddToCart->image = $filename1;
                    }

                    $AddToCart->save();



                    $result = [
                        'transactionDate' => Date('Y-m-d'),
                        'totalPrice' =>  $request->input('total_amount'),
                        "invoicePDF" => '',
                        "addons" => isset($addons) ? $addons : [],
                        "gratuity" => ($request->input('gratuity') != '') ? $request->input('gratuity') : '',
                    ];

                    $response = [
                        'message' => 'Addons Added successfully!',
                        'body' => $result,
                        'status' => 200
                    ];
                    return response()->json($response,200);
                }else{
                    $response = [
                        'message' => 'Something went wrong!',
                        'status' => 400
                    ];
                    return response()->json($result,400);
                }
        }


    }

    public function notifications()
    {
        $data = Notification::where('user_id',Auth::id())->where('service','Laundry')->get();
        if(count($data) > 0){
            $datas['laundry'] = $data;
        }else{
            $datas['laundry'] = [];
        }

        $data = Notification::where('user_id',Auth::id())->where('service','Housekeeping')->get();
        if(count($data) > 0){
            $datas['housekeeping'] = $data;
        }else{
            $datas['housekeeping'] = [];
        }

        $data = Notification::where('user_id',Auth::id())->where('service','Storage')->get();
        if(count($data) > 0){
            $datas['storage'] = $data;
        }else{
            $datas['storage'] = [];
        }

        $response = [
            'message' => 'Details found',
            'body' => $datas,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    // change notification type

    public function changeNotificationType(Request $request)
    {
        $userId = Auth::id();
        // dd($userId);
        $v = Validator::make($request->all(), [
            'type' => 'required|in:0,1,2,3', 
        ]);
        if ($v->fails()) {
            $response = [
                'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }
        $notificationType = User::where('id',$userId)->update(['notification_type'=>$request->type]);
        if ($notificationType) {
            $response = [
                'message' => 'Text notification changed successfully',
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong',
                'status' => 200,
            ];
            return response()->json($response,200);
        }
        dd("changeNotificationType");
    }

    public function getNotificationType(Request $request)
    {
        $userId = Auth::id();
        $notificationType = User::select('id','notification_type')->where('id',$userId)->first();
        if ($notificationType) {
            $response = [
                'message' => 'Detail found',
                'body' => $notificationType,
                'status' => 200,
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Something went wrong',
                'body' => $notificationType,
                'status' => 200,
            ];
            return response()->json($response,200);
        }
        dd("changeNotificationType");
    }
    //End here
    public function updateServiceAddress(Request $request)
    {
        $v = Validator::make($request->all(), [
            'in_campus' => 'required|in:0,1',
            'hall' => 'required_if:in_campus,==,1',
            'room_number' => 'required_if:in_campus,==,1',
            'address' => 'required_if:in_campus,==,0',
            'city' => 'required_if:in_campus,==,0',
            'state' => 'required_if:in_campus,==,0',
            'zipcode' => 'required_if:in_campus,==,0',
            'country' => 'required_if:in_campus,==,0',
        ]);
        if ($v->fails()) {
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $data = $request->all();
        if($data['in_campus'] == '1'){
            $data['address'] = '';
            $data['city'] = '';
            $data['state'] = '';
            $data['zipcode'] = '';
            $data['country'] = '';
        }else{
            $data['hall'] = '';
            $data['room_number'] = '';
        }


        $update = Auth::user()->update($request->all());

        if($update){
            $response = [
                'message' => 'Service Address updated',
                'status' => 200,
            ];
            return response()->json($response,200);

        }else{
            $response = [
                'message' => 'Something went wrong',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function cancleSubscription(Request $request, $id)
    {
        $data = Subscription::with('cart')->find($id);
        if($data){
            $service = $data->cart->service;
            $endDate = $data->end;
            $data->update(['is_canceled' => '1']);

            $details = [
                'subscription_id' => $id,
                'reason' => $request->input('reason'),
                'description' => $request->input('description'),
            ];

            $insert = new CancelSubscription($details);
            $insert->save();



            $to_name = Auth::user()->name;
            $to_email = Auth::user()->email;

            $body = Cmspage::where('id',10)->first(); 
            
            $body->description = str_replace(["\r\n", "\n", "\r", "\t","&nbsp",";"], ' ', $body->description);
            $body = strip_tags($body->description);

            $data = [ 'name' => Auth::user()->name, 'service' => $service, 'endDate' => $endDate,'subscription_id' => $id, 'reason' => $request->input('reason'), 'description' => $request->input('description'),'body' =>$body];


            Mail::send('emails.cancelsubscription', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject('Cancel Subscription');
                $message->from('laundry305.cqlsys@gmail.com','DormDoctors Application!');
            });

            $response = [
                'message' => 'Subscription canceled successfully!',
                'status' => 200
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'message' => 'Subscription canceled successfully!',
                'status' => 400
            ];
            return response()->json($response,400);
        }
    }

    public function getBillingAddress()
    {
        $data = BillingAddress::where('user_id',Auth::id())->get();
        $response = [
            'message' => 'Details found',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response, 200);
    }


    public function subscriptions()
    {
        $data = Subscription::with('cart')->where('user_id',Auth::id())->where('is_deleted','0')->where('is_canceled','0')->get();

        if(count($data) > 0){
            foreach($data as $details){

                if($details->cart->service == 'Laundry'){
                    $details['planDetails'] = LaundryPlan::find($details->cart->plan_id);
                }
                if($details->cart->service == 'Housekeeping'){
                    $details['planDetails'] = HousekeepingPlan::find($details->cart->plan_id);
                }
                if($details->cart->service == 'Storage'){
                    $details['planDetails'] = StoragePlan::find($details->cart->plan_id);
                }

                $datas[] = $details;
            }
        }else{
            $datas = [];
        }

        $response = [
            'message' => 'Details Found!',
            'body' => $datas,
            'status' => 200,
        ];

        return response()->json($response,200);

    }

    public function getSchoolsList()
    {
        $data = School::all();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function getbuildingList($id)
    {
        $data = Building::where('school_id',$id)->get();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response,200);
    }

    public function couponLists(Request $request)
    {   
        // dd("fdfd");
        $data = Coupon::orderBy('id','desc')->where('status','1')->where('expiry_date','>=',Date('Y-m-d'))->get();

        
        // print_r($data); die();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function getReferFriends(Request $request)
    {   
        // dd("fdfd");
        $data = ReferFriend::orderBy('id','desc')->first();

        
        // print_r($data); die();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function getPrefferenceText(Request $request)
    {   
        $dateTime = "2021-02-17 13:10";
        
        print_r(date("H:i"));
        $date = date("Y-m-d H:i",strtotime($dateTime));
        $time = Carbon::parse($date)->subHour();
        $time = date("H:i",strtotime($time));
        print_r($time); die();
        $data = PrefferenceText::orderBy('id','desc')->first();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];
        return response()->json($response,200);
    }


}
