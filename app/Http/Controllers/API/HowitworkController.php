<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkDetail;
use App\Models\HowItWork;
use Validator;
use App\Models\User;

class HowitworkController extends Controller
{
    public function index(Request $request)
    {
    	$v = Validator::make($request->all(),[
            'type' => 'required', 
        ]);

        if($v->fails()){
            $response = [
                 'message' => $v->errors()->first(),
                'status' => 422,
            ];
            return response()->json($response,422);
        }

    	$type = $request->type;
    	$data = HowItWork::with('worksdetails')->where('type',$type)->first();
    
    	$response = [
            'message' => 'data found',
            'body' => $data,
            'status' => 200,
        ];

        return response()->json($response,200);

    }
}
