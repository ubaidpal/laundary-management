<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;
use App\Models\User;
use Auth;

class AddonController extends Controller
{
    public function index(Request $request)
    {
        $data = Addon::all();
        return view('admin.addons.index',['data' => $data ]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin.addons.form',['data' => $data]);
    }

    public function create(Request $request )
    {
        $this->Validate($request,[
            'service' => 'required|in:Laundry,Housekeeping,Storage',
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = new Addon($request->all());
        if($data->save()){
            return redirect()->route('addons.index')->with(['success' => 'Addon Added Successfully!']);
        }
    }

    public function showUpdate($id)
    {
        $data = Addon::find($id);
        return view('admin.addons.form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
        $this->Validate($request,[
            'service' => 'required|in:Laundry,Housekeeping,Storage',
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'service' => $request->input('service'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];
        $update = Addon::where('id',$id)->update($data);
        if($update){
            return redirect()->route('addons.index')->with(['success' => 'Addon Updated Successfully!']);
        }
        else{
            return redirect()->route('addons.index')->with(['error' => 'Something Went Wrong!']);
        }

    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = Addon::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('addons.index')->with(['success' => 'Addon Deleted Successfully!']);
            }
            else{
                return redirect()->route('addons.index')->with(['error' => 'Something went Wrong!']);
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

            $data = Addon::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 1) ? 'Activated' : 'Inactived';

                return redirect()->route('addons.index')->with(['success' => 'Addon '. $status.' Successfully!']);

            }
            else{
                return redirect()->route('addons.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }
}
