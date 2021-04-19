<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request; 
use App\Models\User;
use App\Models\StaffMember;
use Auth;


class ClaimController extends Controller
{
    public function index()
    {
        $data = Claim::with(['user','order'])/*->where('status','0')*/->get();
        return view('admin.claims.index',['data' => $data]);
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);
        if (Auth::user()->type == 'ADMIN') {
           $user = User::find($authId);
        }else{
            $user = StaffMember::find($authId);
            
        }
        
        if (\Hash::check($request->password, $user->password)) {

                $data = Claim::find($request->user_id)->delete();
                if($data){
                    return redirect()->route('claims.index',['message' => "Claim Deleted successfully!" ]);
                }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }

    }

    public function view($id)
    {
        $data = Claim::with(['user','order'])->where('id',$id)->first();
        //dd($data);
        // $data = OrderDetail::with('order.user','addons','items')->find($id);
        return view('admin.claims.view',['data' => $data]);
    }

    public function updateStatus(Request $request)
    {
        $data = Claim::find($request->input('id'));
        if($data->update(['status' => $request->input('claim_status'),'date_resolved' => Date('Y-m-d'),'resolution' => $request->input('claim_status') ])){
            return '1';
        }else{
            return '0';
        }
    }

    public function resolutionupdate(Request $request)
    {
        $data = Claim::find($request->input('id'));
        if($data->update(['resolution' => $request->input('resolution')])){
            return '1';
        }else{
            return '0';
        }
    }

}
