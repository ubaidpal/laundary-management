<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cronjob;
use Mail;

class EmailSentController extends Controller
{
    public function emailSentForCleanClothesTshirts(Request $request)
    { // MAil sent every users on tuesday 04:00 PM 
    	$users = User::select('id','email','first_name','last_name')->where('type','USER')->orderBy('id','desc')->get();
		try{

			$cron = new Cronjob();
			$cron->created_at = date("Y-m-d H:i:s");
			$cron->save();
			foreach ($users as $val) {

				$postData['email'] = $val->email;
				$postData['name'] = $val->first_name.' '.$val->last_name;
                $postData['subject'] = "Ahh, Clean Clothes";
                $postData['layout'] = 'emails.clean_clothes_t_shirts';

                $mail = $this->emailSend($postData);
                if($mail['status']){
                    $response['status'] = 200;
                    $response['message'] = 'Email sent successfully!';
                } else {
                    $response['message']  = $mail['message'];
                }
			}
            return response()->json($response, 200);		         
		} catch (\Exception $e) {
	        $response['status'] = 422;
	        $response['message'] = $e->getMessage();
	    	return $response;
	    }
	}

	public function emailSentForCleanClothesBasket(Request $request)
    { // MAil sent every users on Monday 10:00 PM 
    	$users = User::select('id','email','first_name','last_name')->where('type','USER')->orderBy('id','desc')->get();
		try{
			$cron = new Cronjob();
			$cron->created_at = date("Y-m-d H:i:s");
			$cron->save();

			foreach ($users as $val) {

				$postData['email'] = $val->email;
				$postData['name'] = $val->first_name.' '.$val->last_name;
                $postData['subject'] = "Ahh, Clean Clothes";
                $postData['layout'] = 'emails.clean_clothes_basket';

                $mail = $this->emailSend($postData);
                if($mail['status']){
                    $response['status'] = 200;
                    $response['message'] = 'Email sent successfully!';
                } else {
                    $response['message']  = $mail['message'];
                }
			}
            return response()->json($response, 200);		         
		} catch (\Exception $e) {
	        $response['status'] = 422;
	        $response['message'] = $e->getMessage();
	    	return $response;
	    }
	}

	public function emailItsLaundryDay(Request $request)
    { // MAil sent every users on Sunday 05:00 PM 
    	$users = User::select('id','email','first_name','last_name')->where('type','USER')->orderBy('id','desc')->get();
		try{

			$cron = new Cronjob();
			$cron->created_at = date("Y-m-d H:i:s");
			$cron->save();

			foreach ($users as $val) {

				$postData['email'] = $val->email;
				$postData['name'] = $val->first_name.' '.$val->last_name;
                $postData['subject'] = "It's Laundry Day";
                $postData['layout'] = 'emails.laundry_day';

                $mail = $this->emailSend($postData);
                if($mail['status']){
                    $response['status'] = 200;
                    $response['message'] = 'Email sent successfully!';
                } else {
                    $response['message']  = $mail['message'];
                }
			}
            return response()->json($response, 200);		         
		} catch (\Exception $e) {
	        $response['status'] = 422;
	        $response['message'] = $e->getMessage();
	    	return $response;
	    }
	}

    function emailSend($postData){ 
	    
		try{
			$email =  Mail::send($postData['layout'], $postData, function($message) use ($postData) {

				$message->to($postData['email'])
				        ->subject($postData['subject']); 
				$message->from('laundry305.cqlsys@gmail.com');
			}); 
				
			$response['status'] = 200;
			$response['message'] = "Mail sent successully.";
			return $response;
		}catch(\Execption $e){
	        $response['status'] = 422;
	        $response['message'] = $e->getMessage();
	    	return $response;
	    }
	}

}
