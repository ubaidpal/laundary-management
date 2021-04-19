<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReferFriend;

class ReferAFriend extends Controller
{
    public function editReferFriends(Request $request,$id)
    {
    	$data = ReferFriend::find($id);
    	// dd($data);
    	return view('admin.referfriend.edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
    	$this->validate($request,[
            'text' => 'required', 
        ]);

        $data = [ 
        	'text' => $request->input('text'),
        ];


        if(ReferFriend::where('id',$id)->update($data)){
          return redirect()->route('referfriend.sales.button',['id'=>1])->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->route('referfriend.sales.button',['id'=>1])->with(['error' => 'Something Went Wrong!']);
        }
    	//return view('admin.referfriend.edit',compact('data'));
    }
}
