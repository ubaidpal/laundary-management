<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffMember;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 

class StaffMembersController extends Controller
{
    public function index()
    {
        $data = StaffMember::get();
        return view('admin/staff_members/index',['data' => $data]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin/staff_members/form',['data'=>$data]);
    }

    public function create(Request $request)
    { 
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:staff_members',
            'password' => 'required',
            'contact' => 'required',
            'upload_image' => 'required',
            //'address' => 'required',
            'role_assignment' => 'required',
            'school_assignment' => 'required'
        ]);

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename = $file->getClientOriginalName();
            $path = public_path('images/staff_members');
            $file->move($path,$filename);
            $request->merge(['profile_image' => $filename]);
        }

        $data = new StaffMember($request->all());

        if($data->save()){
            return redirect()->route('staff_members.index')->with(['sucess' => 'Staff Member Added Successfully!']);
        }else{
            return redirect()->route('staff_members.index')->with(['sucess' => 'Something Went Wrong!']);
        }

    }

    public function view($id)
    {
        $data = StaffMember::find($id);
        return view('admin/staff_members/view',['data' => $data]);
    }

    public function showEditForm($id)
    {
        $data = StaffMember::find($id);
        return view('admin/staff_members/form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            //'email' => 'required|email|unique:staff_members,email,'.Auth::id(),
            //'password' => 'required',
            'contact' => 'required',
            'upload_image' => 'sometimes',
            //'address' => 'required',
            'role_assignment' => 'required',
            'school_assignment' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
            //'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            //'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
            'role_assignment' => $request->input('role_assignment'),
            'school_assignment' => $request->input('school_assignment'),
        ];

        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/staff_members');
            $file->move($path,$filename);
            $data['profile_image'] = $filename;
        }

        $update = StaffMember::where('id',$id)->update($data);
        if($update){
            return redirect()->route('staff_members.index')->with(['success' => 'Staff Member Updated Successfully ']);
        }
        else{
            return redirect()->route('staff_members.index')->with(['error' => 'Something Went Wrong ']);
        }
    }

    public function status(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);
        if (Hash::check($request->password, $user->password)) {

            $data = StaffMember::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 0) ? 'Inactivated' : 'Activated';
                $response['status'] = true; 
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
        $user = User::find($authId);

        if (Hash::check($request->password, $user->password)) {
            $delete = StaffMember::find($request->user_id)->delete();

            if($delete){
                return redirect()->route('staff_members.index')->with(['success' => 'Staff Member Deleted Successfully']);
            }
            else{
                return redirect()->route('staff_members.index')->with(['error' => 'Something Went Wrong']);
            }
        }
        else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

}
