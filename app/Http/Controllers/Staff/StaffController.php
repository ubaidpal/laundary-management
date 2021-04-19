<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LaundryLog;

class StaffController extends Controller
{
    public function showlogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::guard('staff')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
            return redirect()->route('staff.home');
        }else{
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
    }

    public function home()
    {
        $currentYear  =  (int)Date('Y');
        for($i = 01 ; $i<=12;$i++ ){
            if(strlen($i) == 1){
                $i = "0".$i;
            }

            $startDate = $currentYear.'-'.$i.'-'."01";
            $endDate = $currentYear.'-'.$i.'-'."31";

            $weightPlan[] = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('weight_plan');

            $weightRecieved = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('weight_received');

            $weightOver = LaundryLog::where('created_at', '>=' ,$startDate)->where('created_at','<=',$endDate)->sum('overweight');

            $totalWeightOver[] = $weightRecieved +  $weightOver;
        }

        return view('staff.dashboard',['usersCountMonthly' => [],'weightCollected' => $weightPlan,'weightOver' => $totalWeightOver]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('staff.login');
    }

    public function showProfile()
    {

        $data = Auth::user();
        return view('staff.profile',['data' => $data]);
    }

    public function updateProfile(Request $request)
    {

        // dd($request->all());

        $this->validate($request,[
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:users,email,'.Auth::id(),
            'profile_image' => 'sometimes'
        ]);

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'contact' => $request->input('contact'),
        ];

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/staff_members');
            $file->move($path,$filename);
            $data['profile_image'] = $filename;
        }

        $update = StaffMember::where('id',Auth::user()->id)->update($data);
        if($update){
            return redirect()->route('staff.home')->with(['success' => 'Profile Updated Successfully!']);
        }
        else{
            return redirect()->route('staff.profile.show')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showPassword()
    {
        return view('staff.password');
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
            $update = StaffMember::where('id',Auth::user()->id)->update(['password' => Hash::make($request->input('password'))]);
            if($update){
                return redirect()->back()->with(['success' => 'Password Changes Successfully!']);
            }
        }
    }


}
