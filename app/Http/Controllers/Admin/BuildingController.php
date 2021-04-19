<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Building;
use Illuminate\Validation\Validator;

class BuildingController extends Controller
{
    public function index()
    {
        $data = Building::get();
        
        return view('admin.buildings.index',['data' => $data ]);
    }

    public function single()
    {
        $schools = School::all();
        return view('admin.buildings.form',['schools' => $schools]);
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'school_id' => 'required',
            'building' => 'required',
        ]);

        $data = new Building($request->all());
        if($data->save()){
            return redirect()->route('buildings.index')->with(['success' => 'Building Added Successfully!']);
        }
        else{
            return redirect()->route('buildings.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $data = Building::find($id);
        $schools = School::all();
        return view('admin.buildings.form',['data'=> $data,'schools' => $schools ]);
    }

     public function update(Request $request,$id)
    {
        $this->validate($request,[
            'school_name' => 'required',
        ]);

        $data = [
            'school_name' => $request->input('school_name'),
        ];

        if(Building::where('id',$id)->update($data)){
          return redirect()->route('buildings.index')->with(['success' => 'Building Updated Successfully!']);
        }
        else{
            return redirect()->route('buildings.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete($id)
    {
        $delete = Building::where('id',$id)->delete();
        if($delete){
            return redirect()->route('buildings.index')->with(['success' => 'Building Deleted Successfully!']);
        }
        else{
            return redirect()->route('buildings.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

}

