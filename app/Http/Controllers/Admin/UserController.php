<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StaffMember;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Auth;
use Hash; 


class UserController extends Controller
{
    public function index()
    {
        $data = User::user()->get();
        return view('admin.users.index',['data' => $data]);
    }

    public function view($id)
    {
        $data = User::find($id);
        return view('admin.users.view',['data' => $data]);
    }

    public function single(Request $request)
    {
        return view('admin.users.addform');
    }



    public function create(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'dob' => 'required',
            'school_name' => 'required',
            'in_campus' => 'required|in:0,1',
            'hall' => 'required_if:in_campus,==,1',
            'room_number' => 'required_if:in_campus,==,1',
            'address' => 'required_if:in_campus,==,0',
            'city' => 'required_if:in_campus,==,0',
            'zipcode' => 'required_if:in_campus,==,0',
            'country' => 'required_if:in_campus,==,0',
            'doorcode' => 'required_if:in_campus,==,0',
            'pname'  => 'required',
            'pemail' => 'required',
            'pcontact' => 'required',
            'card_type' => 'required',
            'card_number' => 'required',
            'card_month' => 'required',
            'card_year' => 'required',
            'card_cvv' => 'required',
            'gratuity' => 'required',
        ],[
            'hall.required_if' => ' The hall field is required',
            'room_number.required_if' => ' The room number field is required',
            'address.required_if' => ' The address field is required',
            'city.required_if' => ' The city field is required',
            'zipcode.required_if' => ' The zipcode field is required',
            'country.required_if' => ' The country field is required',
            'doorcode.required_if' => ' The doorcode field is required',
        ]);


        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'dob' => $request->input('dob'),
            'school_name' => $request->input('school_name'),
            'in_campus' => $request->input('in_campus'),
            'hall' => ($request->input('hall') !== null) ? $request->input('hall') : '',
            'room_number' => ($request->input('room_number') !== null) ? $request->input('room_number') : '',
            'address' => ($request->input('address') !== null) ? $request->input('address') : '',
            'city' => ($request->input('city') !== null) ? $request->input('city') : '',
            'country' => ($request->input('country') !== null) ? $request->input('country') : '',
            'zipcode' => ($request->input('zipcode') !== null) ? $request->input('zipcode') : '',
            'doorcode' => ($request->input('doorcode') !== null) ? $request->input('doorcode') : '',
            'pname'  => $request->input('pname'),
            'pemail' => $request->input('pemail'),
            'pcontact' => $request->input('pcontact'),
            'card_type' => $request->input('card_type'),
            'card_number' => $request->input('card_number'),
            'card_month' => $request->input('card_month'),
            'card_year' => $request->input('card_year'),
            'card_cvv' => $request->input('card_cvv'),
            'gratuity' => $request->input('gratuity'),
        ];

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/users');
            $file->move($path,$filename);
            $data['profile_image'] = $filename;
        }

        $insert = new User($data);

        if($insert->save()){
            return redirect()->route('users.index')->with(['success' => 'User Updated Successfully ']);
        }
        else{
            return redirect()->route('users.index')->with(['error' => 'Something Went Wrong ']);
        }
    }

    public function showEditForm($id)
    {
        $data = User::find($id);
        // dd($data);
        return view('admin.users.form',['data' => $data]);
    }


    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'email' => 'required|unique:users,id,'.$id,
            'username' => 'required|unique:users,id,'.$id,
            'dob' => 'required',
            'school_name' => 'required',
            'in_campus' => 'required|in:0,1',
            'hall' => 'required_if:in_campus,==,1',
            'room_number' => 'required_if:in_campus,==,1',
            'address' => 'required_if:in_campus,==,0',
            'city' => 'required_if:in_campus,==,0',
            'zipcode' => 'required_if:in_campus,==,0',
            'country' => 'required_if:in_campus,==,0',
            'doorcode' => 'required_if:in_campus,==,0',
            'pname'  => 'required',
            'pemail' => 'required',
            'pcontact' => 'required',
            'card_type' => 'required',
            'card_number' => 'required',
            'card_month' => 'required',
            'card_year' => 'required',
            'card_cvv' => 'required',
            'gratuity' => 'required',
        ],[
            'hall.required_if' => ' The hall field is required',
            'room_number.required_if' => ' The room number field is required',
            'address.required_if' => ' The address field is required',
            'city.required_if' => ' The city field is required',
            'zipcode.required_if' => ' The zipcode field is required',
            'country.required_if' => ' The country field is required',
            'doorcode.required_if' => ' The doorcode field is required',
        ]);

        $data = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'contact' => $request->input('contact'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'dob' => $request->input('dob'),
            'school_name' => $request->input('school_name'),
            'in_campus' => $request->input('in_campus'),
            'hall' => $request->input('hall'),
            'room_number' => $request->input('room_number'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'zipcode' => $request->input('zipcode'),
            'doorcode' => $request->input('doorcode'),
            'pname'  => $request->input('pname'),
            'pemail' => $request->input('pemail'),
            'pcontact' => $request->input('pcontact'),
            'card_type' => $request->input('card_type'),
            'card_number' => $request->input('card_number'),
            'card_month' => $request->input('card_month'),
            'card_year' => $request->input('card_year'),
            'card_cvv' => $request->input('card_cvv'),
            'gratuity' => $request->input('gratuity'),
        ];

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/users');
            $file->move($path,$filename);
            $data['profile_image'] = $filename;
        }

        $update = User::where('id',$id)->update($data);
        if($update){
            return redirect()->route('users.index')->with(['success' => 'User Updated Successfully ']);
        }
        else{
            return redirect()->route('users.index')->with(['error' => 'Something Went Wrong ']);
        }
    }

   /* public function status($id,$status)
    {
        $data = User::where('id',$id)->update(['status' => $status]);
        if($data){
            $status = ($status == 0) ? 'Inactivated' : 'Activated';
            return redirect()->back()->with(['success' => 'User '.$status.' Successfully!'  ]);
        }
    }*/

    public function status(Request $request)
    {

        $postData = $request->all(); 
        $authId = Auth::id();
        if (Auth::user()->type == 'ADMIN') {
           $user = User::find($authId);
        }else{
            $user = StaffMember::find($authId);
            
        }
        if (Hash::check($request->password, $user->password)) {
             
            $data = User::where('id',$request->user_id)->update(['status' => $request->status]);
            //print_r($data);die();
            if($data){
                $status = ($request->status == 0) ? 'Inactivated' : 'Activated';
                $response['status'] = true;
                //Session::flash('success','message send');
                $response['success'] = 'User '.$status.' Successfully!';
                return response()->json($response); 
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
        
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();

        if (Auth::user()->type == 'ADMIN') {
           $user = User::find($authId);
        }else{
            $user = StaffMember::find($authId);
            
        }
        if (Hash::check($request->password, $user->password)) {
            $delete = User::find($request->user_id)->delete();
            if($delete){
                return redirect()->route('users.index')->with(['success' => 'User Deleted Successfully']);
            }
            else{
                return redirect()->route('users.index')->with(['error' => 'Something Went Wrong']);
            }
        }
        else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }

        
    }

    public function exportExcel()
    {
        return Excel::download(new UserExport, 'Userlist.xlsx');
    }

}
