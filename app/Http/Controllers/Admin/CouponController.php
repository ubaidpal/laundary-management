<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\User;
use Auth;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $data = Coupon::all(); 
        return view('admin.coupons.index',['data' => $data ]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin.coupons.form',['data' => $data]);
    }

    public function create(Request $request )
    {
        $this->Validate($request,[
            'service' => 'required|in:Laundry,Housekeeping,Storage',
            'description' => 'required',
            'expiry_date' => 'required',
            'code' =>'required|unique:coupons,code',
            //'discount'=> 'required|integer',
            'total' => 'required',
            'upload_icon' => 'required|mimes:jpeg,png,jpg', 
        ]);

        $postData = $request->all();
        if(isset($request->discount_per) && !empty($request->discount_per)){
            $postData['discount'] = $request->discount_per;
        }else if(isset($request->discount_doller) && !empty($request->discount_doller)){
            $postData['discount'] = $request->discount_doller;
        }
        
        $data = new Coupon();
        $data->service = $request->service;
        $data->description = $request->description;
        $data->coupon_type = $request->coupon_type;
        $data->expiry_date = $request->expiry_date;
        $data->code = $request->code;
        $data->total = $request->total;
        $data->discount = $postData['discount'];

        if($request->hasFile('upload_icon')){
            $file = $request->file('upload_icon');

            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/users');
           
            $file->move($path,$filename);
            $data['upload_icon'] = $filename;
            // dd($data);die();
        }
        $data->upload_icon = $data['upload_icon'];

        if($data->save()){
            return redirect()->route('coupons.index')->with(['success' => 'Coupon Added Successfully!']);
        }
    }

    public function showUpdate($id)
    {
        $data = Coupon::find($id);
        return view('admin.coupons.form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
        $this->Validate($request,[
           // 'service' => 'required|in:Laundry,Housekeeping,Storage',
            'description' => 'required',
            'expiry_date' => 'required',
            //'discount' => 'required|integer',
            'code' =>'required|unique:coupons,code,'.$id,
            'total' => 'required',
            'upload_icon' => 'required|mimes:jpeg,png,jpg',
        ]);

        if($request->hasFile('upload_icon')){
            $file = $request->file('upload_icon');

            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/users');
           
            $file->move($path,$filename);
            $data['upload_icon'] = $filename;
            // dd($data);die();
        }
        // ?$data->upload_icon = $data['upload_icon'];

        $data = [
            //'service' => $request->input('service'),
            'description' => $request->input('description'),
            'expiry_date' => $request->input('expiry_date'),
            'total' => $request->input('total'),
            'upload_icon' => $data['upload_icon'],
        ];
        //$postData = $request->all();
        if(isset($request->discount_per) && !empty($request->discount_per)){
            $data['discount'] = $request->discount_per;
        }else if(isset($request->discount_doller) && !empty($request->discount_doller)){
            $data['discount'] = $request->discount_doller;
        }
         

        $update = Coupon::where('id',$id)->update($data);
        if($update){
            return redirect()->route('coupons.index')->with(['success' => 'Coupon Updated Successfully!']);
        }
        else{
            return redirect()->route('coupons.index')->with(['error' => 'Something Went Wrong!']);
        }

    }

    public function delete(Request $request)
    {
         $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = Coupon::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('coupons.index')->with(['success' => 'Coupon Deleted Successfully!']);
            }
            else{
                return redirect()->route('coupons.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }

    }

    public function status(Request $request){
        
        $authId = \Auth::id();
        $user = User::find($authId);
        if (\Hash::check($request->password, $user->password)) {

            $data = Coupon::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 1) ? 'Activated' : 'Inactived';

                return redirect()->route('coupons.index')->with(['success' => 'Coupon '. $status.' Successfully!']);

            }
            else{
                return redirect()->route('coupons.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }
}
