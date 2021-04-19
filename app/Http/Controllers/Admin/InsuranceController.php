<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\User;
use Auth;

class InsuranceController extends Controller
{
   	public function index()
   	{
		$data = Insurance::orderBy('id','desc')
                            ->where('id','!=',1)
                            ->get(); 
   		return view('admin.insurance.index',compact('data'));
   	}

    public function planIndex()
    {
        $data = Insurance::orderBy('id','asc')->first(); 
        //dd($data);die();
        return view('admin.insurance.planindex',compact('data'));
    }

   	public function single()
   	{ 
 		return view('admin.insurance.form');
   	}

   	public function editForm(Request $request,$id)
   	{ 
   		$data = Insurance::find($id);
 		return view('admin.insurance.form',compact('data'));
   	} 

    public function planedit(Request $request,$id)
    { 
        $data = Insurance::find($id);
        return view('admin.insurance.planedit',compact('data'));
    }

   	public function create(Request $request)
    {
    	
    	$this->validate($request,[
            'item_name' => 'required',  
        ]); 

        $prices = $request->input('price'); 
        if (!empty($prices[0])) {
        	$price1 = $prices[0];
        }else{
		 	$price1 = '-';
    	} 

    	if (!empty($prices[1])) {
        	$price2 = $prices[1];
        }else{
		 	$price2 = '-';
    	}

    	if (!empty($prices[2])) {
        	$price3 = $prices[2];
        }else{
		 	$price3 = '-';
    	} 

    	$pricess = $price1.','.$price2.','.$price3;

    	$data = new Insurance;
    	$data->item_name = $request->input('item_name');
    	$data->prices = $pricess;
    	if ($data->save()) {
    		return redirect()->route('insurance.index')->with(['success' => 'Insurance Plan Added Successfully!']);
    	}else{
    		return redirect()->route('insurance.index')->with(['success' => 'Something went wrong']);
    	} 
    }

    public function updateplan(Request $request,$id)
    {
    	 
    	$this->validate($request,[
            'item_name' => 'required',  
        ]); 

        $prices = $request->input('price'); 
        if (!empty($prices[0])) {
        	$price1 = $prices[0];
        }else{
		 	$price1 = '-';
    	} 

    	if (!empty($prices[1])) {
        	$price2 = $prices[1];
        }else{
		 	$price2 = '-';
    	}

    	if (!empty($prices[2])) {
        	$price3 = $prices[2];
        }else{
		 	$price3 = '-';
    	} 

    	$pricess = $price1.','.$price2.','.$price3;

    	$data = Insurance::find($id);
    	$data->item_name = $request->input('item_name');
    	$data->prices = $pricess;
    	if ($data->save()) {
    		return redirect()->route('insurance.index')->with(['success' => 'Insurance Plan updated Successfully!']);
    	}else{
    		return redirect()->route('insurance.index')->with(['success' => 'Something went wrong']);
    	}
    }

    public function editupdateplan(Request $request,$id)
    {
         
        /*$this->validate($request,[
            'item_name' => 'required',  
        ]); */

        $prices = $request->input('price'); 
        if (!empty($prices[0])) {
            $price1 = $prices[0];
        }else{
            $price1 = '-';
        } 

        if (!empty($prices[1])) {
            $price2 = $prices[1];
        }else{
            $price2 = '-';
        }

        if (!empty($prices[2])) {
            $price3 = $prices[2];
        }else{
            $price3 = '-';
        } 

        $pricess = $price1.','.$price2.','.$price3;

        $data = Insurance::find($id);
        //$data->item_name = $request->input('item_name');
        $data->prices = $pricess;
        if ($data->save()) {
            return redirect()->route('insurance.planindex')->with(['success' => 'Insurance Plan updated Successfully!']);
        }else{
            return redirect()->route('insurance.planindex')->with(['success' => 'Something went wrong']);
        }
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = Insurance::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('insurance.index')->with(['success' => 'Insurance Plan Deleted Successfully!']);
            }
            else{
                return redirect()->route('insurance.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

}
