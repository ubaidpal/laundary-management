<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Cmspage;

class BasicController extends Controller
{

    public function help()
    {
        $data = Faq::all();
        $response = [
            'message' => 'Details Found!',
            'body' => $data,
            'status' => 200,
        ];
        return response()->json($response,200);
    }

    public function policy()
    {
        $response = [
            'message' => 'Details Found',
            'body' => Cmspage::where('url','policy')->first(),
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function terms()
    {
        $response = [
            'message' => 'Details Found',
            'body' => Cmspage::where('url','terms')->first(),
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function aboutus()
    {
        $response = [
            'message' => 'Details Found',
            'body' => Cmspage::where('url','aboutus')->first(),
            'status' => 200
        ];
        return response()->json($response,200);
    }

    public function faq()
    {
        $data['LaundryQuestions'] = Faq::where('service','Laundry')->get();
        $data['HousekeepingQuestions'] = Faq::where('service','Housekeeping')->get();
        $data['StorageQuestions'] = Faq::where('service','Storage')->get();

        $response = [
            'message' => 'Details Found',
            'body' => $data,
            'status' => 200
        ];
        return response()->json($response,200);
    }

}
