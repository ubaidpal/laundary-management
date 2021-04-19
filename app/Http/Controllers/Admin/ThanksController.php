<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Thank;
use App\Models\ThankServicePage;
use App\Models\SchoolThank;
use App\Models\School;

class ThanksController extends Controller
{
    public function index()
    {
        $data = Thank::first();
        $schools = School::orderBy('id','desc')->get();
        return view('admin.thanks.index',['data' => $data ,'schools' =>$schools]);
    }

    public function schoolsThanksPage(Request $request)
    {
        //dd($request->school_id);

        $schools = School::orderBy('id','desc')->get();
        $data = SchoolThank::where('school_id',$request->school_id)->first(); 
        // dd($data->id);
        return view('admin.thanks.schools.index',['data' => $data ,'schools'=>$schools]);
    }

    public function laundryindex(Request $request,$service)
    {

        if ($service == 'Laundry') {
           // dd($service);
            $data = ThankServicePage::where('id',1)->first();
        }elseif ($service == 'Housekeeping') {
            $data = ThankServicePage::where('id',2)->first(); 
        }elseif($service == 'Storage'){
            $data = ThankServicePage::where('id',3)->first();
            
        }
        // print_r($data);die(); 
         // dd($data);
        return view('admin.thanks.intro_text_service',['data' => $data ]);
    }

    public function serviceLaundryindex(Request $request)
    {
        $data = Thank::where('id',2)
                        ->where('service','Laundry')->first(); 

        return view('admin.thanks.service.laundry',['data' => $data ]);
    }

    public function serviceHousekeepingindex(Request $request)
    {

         
        $data = Thank::where('id',3)
                        ->where('service','Housekeeping')->first(); 
        return view('admin.thanks.service.housekeeping',['data' => $data ]);
    }

    public function serviceStorageindex(Request $request)
    {

         
        $data = Thank::where('id',4)
                        ->where('service','Storage')->first(); 
        return view('admin.thanks.service.storage',['data' => $data ]);
    }

    public function serviceLaundryHousekeepingindex(Request $request)
    {

         
        $data = Thank::where('id',5)
                        ->where('service','laundry_housekeeping')->first(); 
        return view('admin.thanks.service.laundry_housekeeping',['data' => $data ]);
    }

    public function update(Request $request,$id)
    {
        // dd($request->all());
        $details = [];

        foreach($request->input as $input){
            // dd($input);
            $data = [
                'name' => $input['day'],
                'm_s_t' => $input['m_s_t'],
                'm_e_t' => $input['m_e_t'],
                'e_s_t' => $input['e_s_t'],
                'e_e_t' => $input['e_e_t'],
            ];

            if( isset($input['image']) &&  is_file($input['image'])){
                $file = $input['image'];
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('images/thanks');
                $file->move($path, $filename);
                $data['image'] = $filename;
            }else{
                $data['image'] = $input['image_text'];;
            }

            $details[] = $data;
        }


        $details = json_encode($details);
        $data = Thank::find($id)->update(['text' => $request->input('description'), 'time' => $details ]);
        if($data){

        }else{

        }

        return redirect()->route('thanks');
    }



    public function thanksServiceUpdate(Request $request,$id)
    {

        $data = ThankServicePage::find($id);
        $data->title = $request->title;
        $data->description = $request->description;         
        if($request->hasFile('upload_image')){
            $file = $request->file('upload_image');
            $filename2 = time().'_'.$file->getClientOriginalName();
            $path = public_path('images/thanks');
            $file->move($path,$filename2);
            $data['image'] = $filename2;
        }

        $data->image = $data['image'];
        $data->save();

        return redirect()->back();
    }

    public function serviceUpdate(Request $request,$id)
    {
       
        $details = [];

        foreach($request->input as $input){
            // dd($input);
            $data = [
                'name' => $input['day'],
                'm_s_t' => $input['m_s_t'],
                'm_e_t' => $input['m_e_t'],
                'e_s_t' => $input['e_s_t'],
                'e_e_t' => $input['e_e_t'],
            ];

            if( isset($input['image']) &&  is_file($input['image'])){
                $file = $input['image'];
                $filename = time(). '_' . $file->getClientOriginalName();
                $path = public_path('images/thanks');
                $file->move($path, $filename);
                $data['image'] = $filename;
            }else{
                $data['image'] = $input['image_text'];;
            }

            $details[] = $data;
        }


        $details = json_encode($details);
        $data = Thank::find($id)->update(['text' => $request->input('description'), 'time' => $details ]);        
        return redirect()->back();
    }

    public function schoolsThanksPageUpdate(Request $request,$id)
    {
       
        $schools = School::orderBy('id','desc')->get();
        $data = SchoolThank::where('school_id',$id)->first(); 

        return view('admin.thanks.schools.index',['data' => $data ,'schools'=>$schools]);
    }

    public function schoolThanksUpdatePage(Request $request,$id)
    {
        $details = [];

        foreach($request->input as $input){
            // dd($input);
            $data = [
                'name' => $input['day'],
                'm_s_t' => $input['m_s_t'],
                'm_e_t' => $input['m_e_t'],
                'e_s_t' => $input['e_s_t'],
                'e_e_t' => $input['e_e_t'],
            ];

            if( isset($input['image']) &&  is_file($input['image'])){
                $file = $input['image'];
                $filename = time().'_'.$file->getClientOriginalName();
                $path = public_path('images/thanks');
                $file->move($path, $filename);
                $data['image'] = $filename;
            }else{
                $data['image'] = $input['image_text'];;
            }

            $details[] = $data;
        }


        $details = json_encode($details);
          

        $check = SchoolThank::where('school_id',$id)->first();      
        if ($check) {
            $data = SchoolThank::where('school_id',$id)->update(['text' => $request->input('description'), 'time' => $details ]);
        }else{
            $data = SchoolThank::insert(['school_id' =>$id, 'text' => $request->input('description'), 'time' => $details ]);
        }
        return redirect()->back();
    }

}
