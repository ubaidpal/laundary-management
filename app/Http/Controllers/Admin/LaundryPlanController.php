<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaundryPlan;
use App\Models\User;
use App\Models\Cmspage;
use Auth;
use Hash;
use Mail;

class LaundryPlanController extends Controller
{
    public function index(Request $request)
    {
        $data = LaundryPlan::all();
        return view('admin.laundryplans.index',['data' => $data ]);
    }

    public function single()
    {
        $data = (object) null;
        return view('admin.laundryplans.form',['data' => $data]);
    }

    public function create(Request $request )
    {

        $this->Validate($request,[
            'description' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ]);

        $data = new LaundryPlan($request->all());
        if($data->save()){
            return redirect()->route('laundryplans.index')->with(['success' => 'Plan Added Successfully!']);
        }
    }

    public function showUpdate($id)
    {
        $data = LaundryPlan::find($id);
        return view('admin.laundryplans.form',['data' => $data]);
    }

    public function update(Request $request,$id)
    {
         $this->Validate($request,[
            'description' => 'required',
            'weight' => 'required',
            'price' => 'required',
        ]);

        $data = [
            'description' => $request->input('description'),
            'weight' => $request->input('weight'),
            'price' => $request->input('price'),
        ];
        $update = LaundryPlan::where('id',$id)->update($data);
        if($update){
            return redirect()->route('laundryplans.index')->with(['success' => 'Plan Updated Successfully!']);
        }
        else{
            return redirect()->route('laundryplans.index')->with(['error' => 'Something Went Wrong!']);
        }

    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (Hash::check($request->password, $user->password)) {
            $data = LaundryPlan::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('laundryplans.index')->with(['success' => 'Plan Deleted Successfully!']);
            }
            else{
                return redirect()->route('laundryplans.index')->with(['error' => 'Something went Wrong!']);
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
         if (Hash::check($request->password, $user->password)) {

            $data = LaundryPlan::where('id',$request->user_id)->update(['status' => $request->status]);
            if($data){
                $status = ($request->status == 1) ? 'Activated' : 'Inactived';



                 
                 
                $usersemails = User::where('id','!=',$authId)
                                    ->where('status','1')->get();
                //print_r($usersemails); die;
                //return false;
                 
                foreach ($usersemails as $value) {
                    // dd($value2);
                    $to_emails = $value->email;
                    $subject =  'Laundry plan is '.$status;
                   // $strFromEmail = "support@bemender.com";
                    //$strFromEmail = env("MAIL_FROM_ADDRESS");
                    $strFromEmail = "amankumar@yopmail.com";
                    //$strFromName = "no-reply@yopmail.com";
                    $name = $value->first_name.' '.$value->last_name;
                    $planTitle = 'Laundry Plan';
                    $type = '1';

                    $body =  Cmspage::where('id','10')->first();
                    $body->description = str_replace(["\r\n", "\n", "\r", "\t","&nbsp",";"], ' ', $body->description);
                    $body = strip_tags($body->description);

                    $body = strip_tags($body);
                    //dd($body);
                    $status = $status;
                    $viewContent = view('emails.emailsend', compact('name','status','planTitle','type','body'));
                    //print_r($viewContent); die();
                    $mail = Mail::send([], [],
                        function ($message) use ($to_emails, $strFromEmail, $viewContent, $subject) {
                        $message
                        ->from($strFromEmail /*$strFromName*/)
                        ->to($to_emails)
                        ->subject($subject)
                        ->setBody($viewContent, 'text/html');
                    });
                }

                // Send email for contact us
                //dd("tttt");

                return redirect()->route('laundryplans.index')->with(['success' => 'Plan '. $status.' Successfully!']);

            }
            else{

                return redirect()->route('laundryplans.index')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }

    }
}
