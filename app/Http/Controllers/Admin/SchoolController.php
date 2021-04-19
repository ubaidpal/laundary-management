<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Validation\Validator;
use App\Models\Building;
use App\Models\SchoolAvailability;
use App\Models\User;
use Auth;

class SchoolController extends Controller
{
    public function index()
    {
        $data = School::with('availability')->get(); 
        // echo "<pre>"; print_r($data->toArray()); die();
        return view('admin.schools.index',['data' => $data ]);
    }

    public function single()
    {
        $availability = SchoolAvailability::orderBy('id','desc')->get();
        
        return view('admin.schools.form',compact("availability","data"));
    }

    public function singleAvailability()
    {
        return view('admin.schools.availability.form');
    }

    public function addAvailability()
    {
        $data = SchoolAvailability::orderBy('id','desc')->get();
        return view('admin.schools.availability.index',compact('data'));
    }

    public function create(Request $request)
    {
        // print_r($request->all()); die();
        $this->validate($request,[
            'school_name' => 'required|string',
            'building'    => 'required',
            'school_availability'    => 'required',
        ]);

        //echo "<pre>"; print_r($request->all()); die();
        $checkSchoolName = School::where('school_name',$request->school_name)->first();
        if ($checkSchoolName) {
            // return redirect()->back()->with(['error' => 'School name already exists!']);
            $response['success'] = 'School name already exists!';
            $response['status'] = false;
            return response()->json($response,200);  
        }

        //$buildings = implode(',', $request->building);
        $data = new School();
        $data->school_name = $request->school_name; 
        $data->availability_id = $request->school_availability; 
        

        if($data->save()){

            $school_id = $data->id; 
            foreach ($request->building as $key => $value) {
                
                $building = new Building;
                $building->school_id    = $school_id;
                $building->building      = $value;
                $building->save();
            }
            $response['status'] = true;
            $response['success'] = 'School Added Successfully!';
            return response()->json($response,200); 
            //return redirect()->route('schools.index')->with(['success' => 'School Added Successfully!']);
        }
        else{
            $response['status'] = false;
            $response['success'] = 'Something Went Wrong!';
            return response()->json($response,200);
            return redirect()->route('schools.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function createAvailability(Request $request)
    {
        // print_r($request->all()); die();
        $this->validate($request,[
            'start_time' => 'required',
            'end_time'    => 'required',
        ]);
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        // echo "<pre>"; print_r($request->all()); die();
        if ($startTime >= $endTime) {
            return redirect()->back()->with(['error' => 'Please select diffrent time']);
        }
        $checkAlreadyTime = SchoolAvailability::where(function($q) use ($startTime,$endTime){
                $q->where('start_time','==', $startTime)
                ->where('end_time','==',$endTime);
                $q->orWhere(function($qq)use ($startTime,$endTime){

                    $qq->where('start_time','==', $endTime)
                        ->where('end_time','==',$startTime);
                });

        })
        ->first();
        //var_dump($checkAlreadyTime); die();        
        if ($checkAlreadyTime) {
            // return redirect()->back()->with(['error' => 'School name already exists!']);
            $response['status'] = false; 
            return redirect()->route('schools.single_vailability')->with(['success' => 'This time already exists!!']); 
        }
        //$buildings = implode(',', $request->building);

        $data = new SchoolAvailability();
        $data->start_time = $request->start_time; 
        $data->end_time = $request->end_time;         

        if($data->save()){
            
            $response['status'] = true;
            $response['success'] = 'Time Added Successfully!';
            return redirect()->route('schools.add_availability')->with(['success' => 'Time Added Successfully!']);
        }else{
            $response['status'] = false;
            $response['success'] = 'Something Went Wrong!';
            return redirect()->route('schools.add_availability')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $data = School::with('availability')->find($id);
        // echo "<pre>"; print_r($data->toArray()); die;
        $availability = SchoolAvailability::orderBy('id','desc')->get();
        return view('admin.schools.form',['data'=> $data,'availability' => $availability]);
    }

    public function showEditAvailabilityForm($id)
    {
        $data = SchoolAvailability::find($id);
        return view('admin.schools.availability.form',['data'=> $data]);
    }


    public function updateAvailability(Request $request,$id)
    {
        //print_r($request->all()); die();
        $this->validate($request,[
            'start_time' => 'required',
            'end_time'    => 'required',
        ]);
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        if ($startTime >= $endTime) {
            return redirect()->back()->with(['error' => 'Please select diffrent time']);
        } 
        // echo "<pre>"; print_r($request->all()); die();
        $checkAlreadyTime = SchoolAvailability::where(function($q) use ($startTime,$endTime){
                $q->where('start_time','==', $startTime)
                ->where('end_time','==',$endTime);
                $q->orWhere(function($qq)use ($startTime,$endTime){

                    $qq->where('start_time','==', $endTime)
                        ->where('end_time','==',$startTime);
                });

        })
        ->first();
        // var_dump($checkAlreadyTime); die();        
        if ($checkAlreadyTime) {
            return redirect()->back()->with(['error' => 'This time already exists!!']);
            $response['status'] = false; 
            return redirect()->route('schools.single_vailability')->with(['success' => 'This time already exists!!']); 
        }

        $data = [
            'start_time' => $request->input('start_time'),
            'end_time' => $request->input('end_time'),
        ];

        if(SchoolAvailability::where('id',$id)->update($data)){
            $response['status'] = true;
            $response['success'] = 'Time Updated Successfully!';
            return redirect()->route('schools.add_availability')->with(['success' => 'Time Updated Successfully!']);

        }
        else{
            $response['status'] = false;
            $response['success'] = 'Something Went Wrong!';
            return redirect()->route('schools.add_availability')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function update(Request $request,$id)
    {
        //print_r($request->all()); die();
        $this->validate($request,[
            'school_name' => 'required', 
        ]);

        $checkSchoolName = School::where('school_name',$request->school_name)
                                    ->where('id',$id)->first();
        if (!$checkSchoolName) {
             
            $checkSchool = School::where('school_name',$request->school_name)->first();
            if ($checkSchool) {
                
                $response['success'] = 'School name already exists!';
                $response['status'] = false;
                return response()->json($response,200);  
            }
        }

        $data = [
            'school_name' => $request->input('school_name'),
            'availability_id' => $request->input('school_availability'),
        ];

        if(School::where('id',$id)->update($data)){
            $building_id = $request->building_id;
            $buldingName = $request->building;

            //echo "<pre>"; print_r($buldingName); die();
            // Add multiple skills cases category
                Building::where('school_id',$id)->delete();
                
                foreach ($buldingName as $key => $value) {
                    $anesData['school_id'] = $id; 
                    $anesData['building'] = $value; 
                    Building::updateBuilding($anesData);
                }
            // End here
            $buldingName = implode(',', $buldingName);
            Building::where('id',$building_id)->update(['building' => $buldingName]);
            $response['status'] = true;
            $response['success'] = 'School Updated Successfully!';
            return response()->json($response,200);
          return redirect()->route('schools.index')->with(['success' => 'School Updated Successfully!']);
        }
        else{
            $response['status'] = false;
            $response['success'] = 'Something Went Wrong!';
            return response()->json($response,200);
            return redirect()->route('schools.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $delete = School::where('id',$request->user_id)->delete();
            if($delete){
                return redirect()->route('schools.index')->with(['success' => 'School Deleted Successfully!']);
            }
            else{
                return redirect()->route('schools.index')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function deleteAvailability(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $delete = SchoolAvailability::where('id',$request->user_id)->delete();
            if($delete){
                return redirect()->route('schools.add_availability')->with(['success' => 'Deleted Successfully!']);
            }
            else{
                return redirect()->route('schools.add_availability')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

}

