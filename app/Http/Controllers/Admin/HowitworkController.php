<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDetail;
use App\Models\HowItWork;
use Session;
use App\Models\User;

class HowitworkController extends Controller
{
    public function index()
    {
    	return view('admin.howitwork.index');
    }

    public function howitworkForms(Request $request,$type)
    {

    	return view('admin.howitwork.forms',compact('type'));
    }

    public function howitworkLaundryIndex(Request $request,$type)
    {
    	$data = HowItWork::with('worksdetails')->where('type', $type)->first();
    	if ($data) {
    		 $data = $data;
    	}
    	return view('admin.howitwork.laundryindex',compact('data'));
    }



    public function create(Request $request)
    {
    	$this->validate($request,[
            'title' => 'required',
            'description' => 'required',  
        ]);

        $detail = HowItWork::where('type', $request->plan_type)->first(); 
        $ids = $detail->id; 
    	foreach ($request->title as $key => $value) { 

			$data = new WorkDetail;
	        $data->title = $value;
	        $data->work_id = $ids;
	        $data->description = $request->description[$key]; 
			$data->save();
		} 

		return redirect()->route('how_it_work.index',['type' =>$request->plan_type])->with(['success' => 'Content Added Successfully!']);
    } 

    public function editForm(Request $request,$id,$type)
    {
    	$data = WorkDetail::where('id', $id)->first();
    	return view('admin.howitwork.laundryeditform',compact('data','type'));
    }

    public function update(Request $request,$id,$type)
    {
    	$this->validate($request,[
            'title' => 'required',
            'description' => 'required',  
        ]);

        $data = WorkDetail::whereId($id)->first();  

		 
        $data->title = $request->title; 
        $data->description = $request->description; 
		$data->save();
		 

		return redirect()->route('how_it_work.index',['type' =>$type])->with(['success' => 'Content Updated Successfully!']);
    } 

    public function delete(Request $request)
    {
        $authId = \Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = WorkDetail::where('id',$id)->delete();
            if($delete){
                return redirect()->route('how_it_work.index',['type' =>$request->delete_type])->with(['success' => 'Deleted Successfully!']);
            }
            else{
                return redirect()->route('how_it_work.index',['type' =>$request->delete_type])->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

}
