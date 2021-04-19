<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LaundryLogs;
use App\Http\Controllers\Controller;
use App\Models\Addon;
use Illuminate\Http\Request;
use App\Models\LaundryLog;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\HousekeepingPlan;
use App\Models\LaundryPlan;
use App\Models\StoragePlan;
use App\Models\CancelSubscription;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class CancelSubscriptionsController extends Controller
{
    public function index()
    {
        //$data = LaundryLog::with('orderdetails.order.user','orderdetails.addons.addondetails')->get();
        $data = CancelSubscription::with('subscription.user')->get();
      //echo $data;die();
        //die();
        return view('admin.cancel_subscriptions.index',['data' => $data ]);
    }

    public function printableCancelation()
    { 
        $data = CancelSubscription::with('subscription.user')->get(); 
        return view('admin.cancel_subscriptions.printable_index',['data' => $data ]);
    }

    public function view($id)
    {
        $data = CancelSubscription::with('subscription.user')->whereId($id)->first();
        return view('admin.cancel_subscriptions.view',['data' => $data ]);
    }

    public function update(Request $request)
    {
         $this->validate($request,[
            'action' => 'required',
            'resolution' => 'required',
            'notes' => 'required',
        ]);

        $data = [
            'action' => $request->input('action'),
            'resolution' => $request->input('resolution'),
            'notes' => $request->input('notes'), 
        ];
        if(CancelSubscription::where('id',$request->cancelations_id)->update($data)){
           return redirect()->back()->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->back()->with(['error' => 'Something Went Wrong!']);
        }
    }
   

   
   
   




   


}
