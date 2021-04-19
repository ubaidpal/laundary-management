<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoragePlan;
use App\Models\StorageReview;
use App\Models\User;
use Auth;

class StoragePlanController extends Controller
{
    public function index(Request $request)
    {
        $data = StoragePlan::all();
        return view('admin.storageplans.index',['data' => $data ]);
    }

    public function printableStorageReview(Request $request)
    {
        $data = StoragePlan::all();
        return view('admin.storageplans.printable_index',['data' => $data ]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin.storageplans.form',['data' => $data]);
    }

    public function create(Request $request )
    {

        $this->Validate($request,[
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = new StoragePlan($request->all());
        if($data->save()){
            return redirect()->route('storageplans.index')->with(['success' => 'Plan Added Successfully!']);
        }
    }

    public function showUpdate($id)
    {
        $data = StoragePlan::find($id);
        return view('admin.storageplans.form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
         $this->Validate($request,[
            'description' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ];
        $update = StoragePlan::where('id',$id)->update($data);
        if($update){
            return redirect()->route('storageplans.index')->with(['success' => 'Plan Updated Successfully!']);
        }
        else{
            return redirect()->route('storageplans.index')->with(['error' => 'Something Went Wrong!']);
        }

    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $data = StoragePlan::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('storageplans.index')->with(['success' => 'Plan Deleted Successfully!']);
            }
            else{
                return redirect()->route('storageplans.index')->with(['error' => 'Something went Wrong!']);
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

            $data = StoragePlan::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 1) ? 'Activated' : 'Inactived';

                return redirect()->route('storageplans.index')->with(['success' => 'Plan '. $status.' Successfully!']);

            }
            else{
                return redirect()->route('storageplans.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function storageReview(Request $request)
    {
        $data = StorageReview::all();
        return view('admin.storageplans.storage-review',['data' => $data ]);
    }

    public function StorageReviewupdate(Request $request)
    {
        
            
        if($request->isMethod('post')){
                $this->Validate($request,[
                'message' => 'required',
            ]);

            $data = [
                'message' => $request->input('message'),
            ];
            $update = StorageReview::where('id',1)->update($data);
            if($update){
                return redirect()->route('storage.review')->with(['success' => 'Message Updated Successfully!']);
            }
            else{
                return redirect()->route('storage.review')->with(['error' => 'Something Went Wrong!']);
            }    
        }else{
            $data = StorageReview::whereId(1)->first();
            return view('admin.storageplans.storage-review-update',['data' => $data ]);
        }
        

    }
}
