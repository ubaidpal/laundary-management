<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrefferenceText; 

class PrefferenceController extends Controller
{
   	public function index(Request $request,$id)
    {
    	$data = PrefferenceText::find($id);
    	return view('admin.preferences.prefferences',compact('data'));
    }

    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'text' => 'required', 
        ]);

        $data = [ 
        	'text' => $request->input('text'),
        ];
 
        if(PrefferenceText::where('id',$id)->update($data)){
          return redirect()->route('prefferences.button',['id'=>1])->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->route('prefferences.button',['id'=>1])->with(['error' => 'Something Went Wrong!']);
        }
    
    }
}
