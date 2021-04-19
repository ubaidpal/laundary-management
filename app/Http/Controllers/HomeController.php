<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cmspage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

     public function cmspages($url)
    {
        $data = Cmspage::where('url',$url)->first();
        return view('common',['data' => $data]);
    }

    public function demoCardToken()
    {

        require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/stripe/stripe-php-master/init.php');

        \Stripe\Stripe::setApiKey("sk_test_gXfEpxsKxoeOg5VHwyVBx2fr00GjNpjkAo");

        $create_token = \Stripe\Token::create([
            'card' => [
                "number" => "4242424242424242",
                "exp_month" => 04,
                "exp_year" => 24,
                "cvc" => "123"
            ]
        ]);

        return ($create_token['id']);
    }
}
