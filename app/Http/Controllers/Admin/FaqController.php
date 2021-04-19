<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;
use App\Models\User; 

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::get();
        return view('admin.faqs.index',['data' => $data ]);
    }

    public function single()
    {
        return view('admin.faqs.form');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'service' => 'required',
            'question' => 'required|string',
            'answer' => 'required',
        ]);

        $data = new Faq($request->all());
        if($data->save()){
            return redirect()->route('faqs.index')->with(['success' => 'Question Added Successfully!']);
        }
        else{
            return redirect()->route('faqs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function showEditForm($id)
    {
        $data = Faq::find($id);
        return view('admin.faqs.form',['data'=> $data]);
    }

     public function update(Request $request,$id)
    {
        $this->validate($request,[
            'service' => 'required',
            'question' => 'required|string',
            'answer' => 'required',
        ]);

        $data = [
            'service' => $request->input('service'),
            'question' => $request->input('question'),
            'answer' => htmlspecialchars_decode( str_replace("&nbsp;"," ",$request->input('answer'))),
        ];


        if(Faq::where('id',$id)->update($data)){
          return redirect()->route('faqs.index')->with(['success' => 'Faq Updated Successfully!']);
        }
        else{
            return redirect()->route('faqs.index')->with(['error' => 'Something Went Wrong!']);
        }
    }

    public function delete(Request $request)
    {
        $authId = Auth::id();
        $user = User::find($authId);

        if (\Hash::check($request->password, $user->password)) {

            $delete = Faq::where('id',$request->user_id)->delete();
            if($delete){
                return redirect()->route('faqs.index')->with(['success' => 'Faq Deleted Successfully!']);
            }
            else{
                return redirect()->route('faqs.index')->with(['error' => 'Something Went Wrong!']);
            }
        }else{
            $response['status'] = false;
            $response['success'] = "Invalid password";
            return response()->json($response);
        }
    }

}
