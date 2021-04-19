<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HousekeepingPlan;
use App\Models\User;
use Auth;

class HousekeepingPlanController extends Controller
{
    public function index(Request $request)
    {
        $data = HousekeepingPlan::all();
        return view('admin.housekeepingplans.index',['data' => $data ]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin.housekeepingplans.form',['data' => $data]);
    }

    public function create(Request $request )
    {

        $this->Validate($request,[
            'description' => 'required',
            'bedroom' => 'required',
            'price' => 'required',
        ]);

        $data = new HousekeepingPlan($request->all());
        if($data->save()){
            return redirect()->route('housekeepingplans.index')->with(['success' => 'Plan Added Successfully!']);
        }
    }

    public function showUpdate($id)
    {
        $data = HousekeepingPlan::find($id);
        return view('admin.housekeepingplans.form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
        $this->Validate($request,[
            'description' => 'required',
            'bedroom' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'description' => $request->input('description'),
            'bedroom' => $request->input('bedroom'),
            'price' => $request->input('price'),
            'frequency' => $request->input('frequency'),
        ];

        $update = HousekeepingPlan::where('id',$id)->update($data);
        if($update){
            return redirect()->route('housekeepingplans.index')->with(['success' => 'Plan Updated Successfully!']);
        }
        else{
            return redirect()->route('housekeepingplans.index')->with(['error' => 'Something Went Wrong!']);
        }

    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = HousekeepingPlan::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('housekeepingplans.index')->with(['success' => 'Plan Deleted Successfully!']);
            }
            else{
                return redirect()->route('housekeepingplans.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function status(Request $request){
        $authId = Auth::id();
        $user = User::find($authId);
        if (\Hash::check($request->password, $user->password)) {

            $data = HousekeepingPlan::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 1) ? 'Activated' : 'Inactived';

                return redirect()->route('housekeepingplans.index')->with(['success' => 'Plan '. $status.' Successfully!']);

            }
            else{
                return redirect()->route('housekeepingplans.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }
}
