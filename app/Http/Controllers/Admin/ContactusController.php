<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contactus;
use Auth;

class ContactusController extends Controller
{
    public function index()
    {
    	//dd("Dd");
    	$data = Contactus::orderBy('id','desc')
                        ->with('schoolname')
                        ->get();
        //echo "<pre>"; print_r($data->toArray()); die();
    	return view('admin.contactus.index',compact('data'));
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = Contactus::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('contactus.index')->with(['success' => 'Insurance Plan Deleted Successfully!']);
            }
            else{
                return redirect()->route('contactus.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }
}
