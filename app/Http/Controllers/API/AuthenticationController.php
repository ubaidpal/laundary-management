<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Preferrence;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use App\Models\User;
use App\Models\Cmspage;
use App\Models\Waiter;
use Tymon\JWTAuth\Facades\JWTAuth as TymonJWTAuth;
use Tymon\JWTAuth\JWTAuth;
use Omnipay\Omnipay;

class AuthenticationController extends Controller
{

     public function login(Request $request)
     {
        $v = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
            'device_type' => 'required',
            'device_token' => 'required',
        ]);
        if($v->fails()){
            $response = [
                'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

            if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') ])){

                if(Auth::user()->status == '0'){
                    return response()->json(['message' => 'User inactive by Admin. Please contact admin or try again later.','status' => 400],400);
                }

                $user = User::with('school','building')->find(Auth::id());
                $user->device_type = $request->input('device_type');
                $user->device_token = $request->input('device_token');
                $user->user_token =  TymonJWTAuth::fromUser($user);

                $prefference = $this->defaultPrefferences(Auth::id());

                // $request->session()->put('hello', $user->user_token);

                if($user->save()){
                    $response = [
                    'message' => 'Login Successfully',
                    'body' => $user,
                    'status' => 200,
                    ];

                    return response()->json($response,200);
                }else{
                    $response = [
                        'message' => 'Something Went Wrong',
                        'status' => 400,
                    ];
                    return response()->json($response,400);
                }

            }
            else{
                $response['message'] = 'Incorrect email or password.';
                $response['status'] = 400;
                return response()->json($response, 400);
            }

    }

    public function checkemail(Request $request)
    {
        $v = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email',
            'username' => 'required',
        ]);

        if($v->fails()){
            $response = [
                'message' => $v->errors()->first(),
                'body' => [
                    'emailIsExist' => '1',
                ],
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $checkUsername = User::where('username',$request->input('username'))->first();
        if($checkUsername){
            $response = [
                'message' => 'The username is exists!',
                'body' => [
                    'usernameIsExist' => '1',
                ],
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $checkemail = User::where('email',$request->input('email'))->first();
        if($checkemail){
            $response = [
                'message' => 'The email is exists!',
                'body' => [
                    'emailIsExist' => '1',
                ],
                'status' => 422,
            ];
            return response()->json($response,422);
        }

        $response = [
                'message' => 'Email doesn`t exist',
                'body' => [
                    'emailIsExist' => '0',
                    'usernameIsExist' => '0',
                ],
                'status' => 200,
            ];
            return response()->json($response,200);
    }

    public function register(Request $request)
    {
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
            // 'doorcode' => 'required_if:in_campus,==,0',
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'country_code' => 'required',
            'contact' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'image' => 'required',
            // 'schedule' => 'required',
            'pfirst_name' => 'required',
            'plast_name' => 'required',
            'pemail' => 'required',
            //'pcontact' => 'required|numeric',
            'pcontact' => 'required',
            'pcountry_code' => 'required'
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
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/users');
            $file->move($path,$filename);
            $request->merge(['profile_image' => $filename ]);
        }

        if($request->hasFile('schedule')){
            $file = $request->file('schedule');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/class_schedule');
            $file->move($path,$filename);
            $request->merge(['class_schedule' => $filename ]);
        }
        $data = new User($request->all());
        
        if (!empty($request->apartment)) {
            $apartment = $request->apartment;
        }else{
            $apartment = "";
        }
        $data->apartment = $apartment;

        if($data->save()){
            $data->user_token = TymonJWTAuth::fromUser($data);
            $data->save();
            $prefference = $this->defaultPrefferences($data->id);
            $response = [
                    'message' => 'Sign up Successfully',
                    'body' => User::with('school','building')->find($data->id),
                    'status' => 200,
                ];
                return response()->json($response,200);
        }
        else{
            $response = [
                'message' => 'Something went wrong ',
                'status' => 400,
            ];
            return response()->json($response,400);
        }
    }

    public function logout(){
        Auth::user()->update(['device_token' => '','user_token' => '']);
        $logout = Auth::logout();
        $response = [
            'message' => 'Logout Successfully',
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function forgetPassword(Request $request)
    {
        $v = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        if($v->fails()){
            $response = [
                'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

            $user = User::where('email',$request->input('email'))->first();
            $type = 1;

        if($user){

            $to_name = $user->name;
            $to_email = $user->email;

            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 60; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $restPassword = DB::table('password_resets')
                ->updateOrInsert(
                    ['email' => $user->email],
                    [
                        'email' => $user->email,
                        'token' => $randomString,
                        'created_at' => Date('Y-m-d H:i:s')]
                );

                if(!$restPassword){
                    return response()->json(['message' => 'Something went wrong','status'=>400],400);
                }

            $body = Cmspage::where('id','9')->first();
           /* $string = htmlentities($body, null, 'utf-8');
            $content = str_replace("&nbsp;", "", $string);
            $body = html_entity_decode($content);*/
            $body->description = str_replace(["\r\n", "\n", "\r", "\t","&nbsp",";"], ' ', $body->description);
            $body = strip_tags($body->description);
            $data = ['name'=> $user->name , 'token' => $randomString , 'type' => $type ,'body' => $body ];
            //dd($data);

            $mail = Mail::send('emails.forgetpassword', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Reset Password');
            $message->from('laundry305.cqlsys@gmail.com','DormDoctors Application!');
            });

                $response = [
                'message' => 'Mail sent Successfully. Please check your mail for instructions',
                'status' => 200
                ];
                return response()->json($response,200);
        }
        else{
            $response = [
                'message' => 'Email doesn`t exits',
                'status' => 404
            ];
            return response()->json($response,404);

        }
    }

    public function resetPassword(Request $request, $token)
    {
        // dd('asdasd');
        $email = DB::table('password_resets')->where('token',$token)->value('email');
        $type = $request->input('type');
        if($email){
            return view('auth.passwords.reset',['token' => $token ,'email' => $email,'type' => $type]);
        }
        else{
            return 'Token Expired.';
        }
    }

    public function updatePassword(Request $request,$token)
    {

       $v =  Validator::make($request->all(),[
            'password' => 'required|confirmed',
        ]);

        if($v->fails()){
            // dd($v->errors());
            return redirect()->back()->withErrors($v->errors());
        }

        $data = DB::table('password_resets')->where('token',$token)->where('email',$request->input('email'))->value('email');
        if($data){
            $password = Hash::make($request->input('password'));

            if($request->input('type') == 1){
                $update = User::where('email',$request->input('email'))->update(['password' => $password]);
            }else if($request->input('type') == 2){
                $update = Waiter::where('email',$request->input('email'))->update(['password' => $password]);
            }else{
                return 'Wrong details';
            }
            if($update){
                DB::table('password_resets')->where('token',$token)->where('email',$request->input('email'))->delete();
                return 'Password Changed Successfully';
            }
            else{
                return 'Something went wrong';
            }
        }
        else{
            return redirect('/');
        }
    }

    /*public function paymenttest(Request $request)
    {
        $ch = curl_init();
        $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',

        );

        $url = 'http://18.215.23.194/paytrace_amit/test.php?amount=256.00';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $body = '{}';

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Timeout in seconds
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $authToken = curl_exec($ch);

        $transaction_id = $authToken;

        return $transaction_id;

    }*/

    
}
