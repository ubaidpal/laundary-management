<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\School;
use App\Models\StaffMember;
use App\Models\EmergencyMessage;
use Session; 
use App\Models\Notification;

class EmergencyMessageController extends Controller
{
    public function usersindex(Request $request)
    {
        $data = EmergencyMessage::whereHas('users')->get();
    	return view('admin.emergency_message.index',compact('data'));
    }

    public function schoolindex(Request $request)
    {
        $data = EmergencyMessage::whereHas('schools')->get();
       ///dd($data);
        return view('admin.emergency_message.school_index',compact('data'));
    }

    public function single(Request $request)
    {
    	$data = User::user()->get();
    	$schools = School::get();
    	//dd($data);
    	return view('admin.emergency_message.form',compact('data','schools'));
    }

    public function showUserEditForm($id)
    {
        $data =  User::user()->get();
        $usersss = EmergencyMessage::where('id',$id)
                                    ->with('usersnames')
                                    ->first();
         //echo "<pre>"; print_r($usersss->toArray()); die();
       return view('admin.emergency_message.form',compact('data','usersss'));
    }
   
    public function showSchoolEditForm($id)
    {
        $schools = School::get(); 
        $schoolss = EmergencyMessage::where('id',$id)
                                    ->with('schools')
                                    ->first();
        // echo "<pre>"; print_r($schoolss->toArray()); die();
       return view('admin.emergency_message.school_form',compact('schools','schoolss'));
    }

    public function schoolform(Request $request)
    { 
    	$schools = School::get(); 
    	return view('admin.emergency_message.school_form',compact('schools'));
    }

    

    public function create(Request $request)
    {
    	$postData = $request->all();
    	$this->validate($request,[
            'users_name' => 'required',
            'date' => 'required',
            //'time' => 'required', 
            'message' => 'required', 
        ],['users_name' => 'Please select user name']);
    	   

           //print_r(); die();
        if (isset($request->users_name)) {
           $date = date("Y-m-d",strtotime($request->date));
           $time = date("h:i a",strtotime($request->date));
   
   	    	$users = $request->users_name;

            $users_ids  =  implode(',', $users);
    	    	
            $message = new EmergencyMessage();
    		$message->user_id = $users_ids;
    		$message->date = $date;
    		$message->time = $time;
            $message->message = $request->message;
    		$message->save();

    	}
        if(\Auth::user()->type == 'ADMIN'){

        
    	   return redirect()->route('emergencymessage.usersindex')->with(['success' => 'Added Successfully!']); 
        }else{

            return redirect()->route('staff.emergencymessage.usersindex')->with(['success' => 'Added Successfully!']); 
        }
    } 

    public function usersmessageUpdate(Request $request)
    {
        $postData = $request->all();
        $this->validate($request,[
            'users_name' => 'required',
            'date' => 'required',
            //'time' => 'required', 
            'message' => 'required', 
        ],['users_name' => 'Please select user name']);
        

        if (isset($request->users_name)) {
            $date = date("Y-m-d",strtotime($request->date));
            $time = date("h:i a",strtotime($request->date));

            $users = $request->users_name;
           // foreach ($users as $key => $value) { 
            $users_ids  =  implode(',', $users);
                $message = EmergencyMessage::find($request->message_id);
                //print_r($request->message_id); die();
                $message->user_id = $users_ids;
                $message->date = $request->date;
                $message->time = $request->time;
                $message->message = $request->message;
                $message->save();

                //$save_notification['service'] = $data->service;
               /* $save_notification['user_id'] = $value;
                $save_notification['title'] = "Emergency message";
                 
                $save_notification['text'] = $request->message;
                Notification::insert($save_notification);

                $this->SendPushNotification($save_notification);*/

            //}
        }
        if(\Auth::user()->type == 'ADMIN'){

            return redirect()->route('emergencymessage.usersindex')->with(['success' => 'Updated Successfully!']);
        }else
        {
            return redirect()->route('staff.emergencymessage.usersindex')->with(['success' => 'Updated Successfully!']);

        }
        return redirect()->back();
    }

    public function schoolcreate(Request $request)
    {
    	$postData = $request->all();
    	$this->validate($request,[
            'school_ids' => 'required',
            'date' => 'required',
            //'time' => 'required', 
            'message' => 'required', 
        ],['school_ids' => 'Please select school name']); 

    	if (isset($request->school_ids)) {


            $users  = User::whereIn('school_name',$request->school_ids)->get();
            //dd($users); 
            $school_ids = implode(',', $request->school_ids);
            //print_r($ids);die();

    		//foreach ($request->school_ids as $key => $value) {
    		$date = date("Y-m-d",strtotime($request->date));
            $time = date("h:i a",strtotime($request->date));

			$message = new EmergencyMessage;
			$message->school_id = $school_ids;
			$message->date = $date;
    		$message->time = $time;
            $message->message = $request->message;
    		$message->save(); 



    		//}

            foreach ($users as $key => $value) { 
                //$save_notification['service'] = $data->service;
                $save_notification['user_id'] = $value->id;
                $save_notification['title'] = "Emergency message";
                 
                $save_notification['text'] = $request->message;
                Notification::insert($save_notification);

                $this->SendPushNotification($save_notification);

            }
    	} 
        if(\Auth::user()->type == 'ADMIN'){
    	Session::flash('success','Added sucessfully');
    	return redirect()->route('emergencymessage.schoolindex')->with(['success' => 'Added Successfully!']);
        }else{
        return redirect()->route('staff.emergencymessage.schoolindex')->with(['success' => 'Added Successfully!']);

        }
    }

    public function schoolupdate(Request $request)
    {
        $postData = $request->all();
        $this->validate($request,[
            'school_ids' => 'required',
            'date' => 'required',
            //'time' => 'required', 
            'message' => 'required', 
        ],['school_ids' => 'Please select school name']); 

        if (isset($request->school_ids)) {
            //foreach ($request->school_ids as $key => $value) {
                $date = date("Y-m-d",strtotime($request->date));
                $time = date("h:i a",strtotime($request->date));

                $school_ids = implode(',', $request->school_ids);
                $message = EmergencyMessage::find($request->message_id);
                $message->school_id = $school_ids;
                $message->date = $date;
                $message->time = $time;
                $message->message = $request->message;
                $message->save(); 

                //$save_notification['service'] = $data->service;
                /*$save_notification['user_id'] = $value;
                $save_notification['title'] = "Emergency message";
                 
                $save_notification['text'] = $request->message;
                Notification::insert($save_notification);

                $this->SendPushNotification($save_notification);*/

           // }
        } 
        if(\Auth::user()->type == 'ADMIN'){
            Session::flash('success','Added sucessfully');
            return redirect()->route('emergencymessage.schoolindex')->with(['success' => 'Updated Successfully!']);
        }else{
            Session::flash('success','Added sucessfully');
            return redirect()->route('staff.emergencymessage.schoolindex')->with(['success' => 'Updated Successfully!']);

        }
    }

    public function usersdelete(Request $request)
    {
        $authId = \Auth::id();
        if (Auth::user()->type == 'ADMIN') {
           $user = User::find($authId);
        }else{
            $user = StaffMember::find($authId);
            
        }

        if (\Hash::check($request->password, $user->password)) {
            $data = EmergencyMessage::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('emergencymessage.usersindex')->with(['success' => ' Deleted Successfully!']);
            }
            else{
                return redirect()->route('emergencymessage.usersindex')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    } 

    public function schooldelete(Request $request)
    {
        $authId = \Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {
            $data = EmergencyMessage::where('id',$request->user_id)->delete();
            if($data){
                return redirect()->route('emergencymessage.usersindex')->with(['success' => ' Deleted Successfully!']);
            }
            else{
                return redirect()->route('emergencymessage.usersindex')->with(['error' => 'Something went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function getUsers(Request $request)
    {
        $current_date = date('Y-m-d');
        $current_time = date("H:i");

        $users  = EmergencyMessage::where('date', $current_date)
                                ->where('time', $current_time)
                                ->get(); 
        try{
            foreach ($users as $key => $value) {
                $userId = explode(',', $value->user_id); 

                foreach ($userId as $key => $val) {

                    $save_notification = new Notification;
                    $save_notification->user_id = $val;
                    $save_notification->title = "Emergency alert";
                    $save_notification->text = $value->message;
                    $save_notification->save();
                    //dd("dd");
                    $save_notification['user_id'] = $val;
                    $save_notification['title'] = "Emergency message"; 
                    $save_notification['text'] = $value->message; 
                    $send = $this->SendPushNotification($save_notification); 
                }
               
                //Notification::insert($save_notification);
                
            }
            echo "Sent Successfully";
        }catch(Exception $e){
            \Log::error( $e->getMessage() );
        } 
    }

    public function getSchools(Request $request)
    {
        $current_date = date('Y-m-d');
        $current_time = date("H:i"); 
        $users = \DB::table('emergency_messages')
                    //->join('schools', 'emergency_messages.school_id', '=', 'schools.id')
                    ->join("schools",\DB::raw("FIND_IN_SET(schools.id,emergency_messages.school_id)"),">",\DB::raw("'0'"))
                    ->join('users','schools.id','=','users.school_name') 
                    ->where('emergency_messages.date', $current_date)
                    ->where('time', $current_time)
                    ->whereNotNull('emergency_messages.school_id')
                    ->select('emergency_messages.*','emergency_messages.school_id','users.id as userId','emergency_messages.message') 
                    ->get(); 
        try{
            foreach ($users as $key => $value) { 

                    $save_notification = new Notification;
                    $save_notification->user_id = $value->userId;
                    $save_notification->title = "Emergency alert";
                    $save_notification->text = $value->message;
                    $save_notification->save();
                    //dd("dd");
                    $save_notification['user_id'] = $value->userId;
                    $save_notification['title'] = "Emergency message"; 
                    $save_notification['text'] = $value->message; 
                    $this->SendPushNotification($save_notification);  
            }

            echo "Sent Successfully";
        }catch(Exception $e){
            \Log::error( $e->getMessage() );
        } 
    }

}
