<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cmspage;
use Illuminate\Validation\Validator;
use App\Models\User; 
use Auth;

class CmspagesController extends Controller
{
    public function index()
    {
        $data = Cmspage::where('id','!=',11)->get();
        return view('admin.cmspages.index',['data' => $data ]);
    }

    public function single()
    {
        return view('admin.cmspages.form');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'url' => 'required|string|regex:/^[a-zA-Z]+$/u|unique:cmspages',
            'title' => 'required|string',
            'description' => 'required',
        ]);

        $data = new Cmspage($request->all());
        if($data->save()){
            return redirect()->route('cmspages.index')->with(['success' => 'Page Added Successfully!']);
        }
        else{
            return redirect()->route('cmspages.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $data = Cmspage::find($id);
        return view('admin.cmspages.form',['data'=> $data]);
    }

     public function update(Request $request,$id)
    {
        $this->validate($request,[
            'url' => 'required|string|regex:/^[a-zA-Z]+$/u|unique:cmspages,id,'.$id,
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = [
            'url' => $request->input('url'),
            'title' => $request->input('title'),
            'description' => htmlspecialchars_decode($request->input('description')),
        ];


        if(Cmspage::where('id',$id)->update($data)){
          return redirect()->route('cmspages.index')->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->route('cmspages.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete(Request $request)
    {

        $authId = Auth::id();
        $user = User::find($authId);
        $id = $request->user_id;
        if (\Hash::check($request->password, $user->password)) {
            if($id == 1 || $id == 3 || $id == 9 || $id == 10 || $id== 11){
                //return redirect()->route('cmspages.index')->with(['error' => 'Sorry you can`t delete this page!']);
                $response['status'] = false;
                $response['error'] = false;
                $response['success'] = "Sorry you can`t delete this page!";
                return response()->json($response);
            }

            $delete = Cmspage::where('id',$id)->delete();
            if($delete){
                return redirect()->route('cmspages.index')->with(['success' => 'Event Deleted Successfully!']);
            }
            else{
                return redirect()->route('cmspages.index')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['error'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

    public function aboutus()
    {
        $data = Cmspage::where('url','aboutus')->first();
        return view('admin.cmspages.aboutus',['data'=> $data]);
    }

    public function aboutusupdate(Request $request,$id)
    {
        $this->validate($request,[
            'url' => 'required|string|regex:/^[a-zA-Z]+$/u|unique:cmspages,id,'.$id,
            //'title' => 'required',
            'description' => 'required',
        ]);

        $data = [
            //'url' => $request->input('url'),
            //'title' => $request->input('title'),
            'description' => htmlspecialchars_decode($request->input('description')),
        ];


        if(Cmspage::where('id',$id)->update($data)){
          return redirect()->route('cmspages.aboutus')->with(['success' => 'Updated Successfully!']);
        }
        else{
            return redirect()->route('cmspages.aboutus')->with(['error' => 'Something Went Wrong!']);
        }
    }

}

