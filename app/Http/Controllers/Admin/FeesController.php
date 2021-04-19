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
use App\Models\TaxFee;
use App\Models\HousekeepingPlan;
use App\Models\LaundryPlan;
use App\Models\StoragePlan;
use App\Models\CancelSubscription;
use App\Models\Fees;
use Maatwebsite\Excel\Facades\Excel;
use DB;
class FeesController extends Controller
{
    public function index()
    {
        //$data = LaundryLog::with('orderdetails.order.user','orderdetails.addons.addondetails')->get();
        $data = Fees::All();
       // echo $data;die();
        //die();
        return view('admin.fees.index',['data' => $data ]);
    }

    public function taxindex()
    {
        //$data = LaundryLog::with('orderdetails.order.user','orderdetails.addons.addondetails')->get();
        $data = TaxFee::first();
       // echo $data;die();
        //die();
        return view('admin.fees.tax_index',['data' => $data ]);
    }

    public function printableFees()
    {
        $data = Fees::All();
        
        return view('admin.fees.printable_index',['data' => $data ]);
    }

    public function update(Request $request,$id)
    {
       // die('okok');
        $data = Fees::whereId($id)->first();
        if($request->isMethod('Post')){
               // dd($request->all());
                //$update_fees['tax_fees'] = $request->tax_fees;
                $update_fees['service_fees'] = $request->service_fees;
                $update_fees['apply_services'] = $request->apply_services;
                Fees::whereId($id)->update($update_fees);
                return redirect()->route('fees')->with(['success' => 'Fees Updated Successfully!']);
        }
        //echo $data;die();
        //die();
        return view('admin.fees.edit',['data' => $data ]);
    }



    public function single(Request $request)
    {
         return view('admin.fees.form');
    } 

    public function taxsingle(Request $request)
    {
         return view('admin.fees.tax_form');
    } 

    public function create(Request $request)
    {

        $this->validate($request,[
            //'tax_fees' => 'required',
            'service_fees' => 'required', 
            'apply_services' => 'required',
        ]);

        $data = new Fees;
       // $data->tax_fees = $request->tax_fees;
        $data->service_fees = $request->service_fees;
        $data->apply_services = $request->apply_services;
        
        if($data->save()){
            return redirect()->route('fees')->with(['success' => 'Fees Added Successfully!']);
        }
        else{
            return redirect()->route('fees')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function taxcreate(Request $request)
    {
       // dd($request->all());

        $this->validate($request,[
            'tax_fees' => 'required', 
            'apply_services' => 'required',
        ]);

        $data = new TaxFee;
        $data->tax = $request->tax_fees; 
        $data->apply_services = $request->apply_services;
        
        if($data->save()){
            return redirect()->route('tax_fees.index')->with(['success' => 'Tax Added Successfully!']);
        }
        else{
            return redirect()->route('tax_fees.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function taxupdate(Request $request,$id)
    {
       // die('okok');
        $data = TaxFee::whereId($id)->first();
        if($request->isMethod('Post')){
               // dd($request->all());
                $update_fees['tax'] = $request->tax_fees; 
                // $update_fees['apply_services'] = $request->apply_services;
                TaxFee::whereId($id)->update($update_fees);
                return redirect()->route('tax_fees.index')->with(['success' => 'Tax Updated Successfully!']);
        }
        //echo $data;die();
        //die();
        return view('admin.fees.tax_edit',['data' => $data ]);
    }

   
   
    public function taxdelete(Request $request)
    {
        $authId = \Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = TaxFee::where('id',$id)->delete();
            if($delete){
                return redirect()->route('fees')->with(['success' => 'Tax Deleted Successfully!']);
            }
            else{
                return redirect()->route('fees')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function delete(Request $request)
    {
        $authId = \Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {

            $delete = Fees::where('id',$id)->delete();
            if($delete){
                return redirect()->route('fees')->with(['success' => 'Fees Deleted Successfully!']);
            }
            else{
                return redirect()->route('fees')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }



   


}
