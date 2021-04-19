<?php

	// UPLOAD IMAGES FOR USER
	function UploadImage($file, $destinationPath) {
        try{
		    $imgName = $file->getClientOriginalName();
            $ext = explode('?', \File::extension($imgName));
            $main_ext = $ext[0];
            $finalName = time()."_".rand(1,10000).'.'.$main_ext; 
		    $path = public_path('assets/images/'); 
            $upload  = $file->move($path,$finalName); 
		    return $path = $upload;
		}catch (\Execption $e) {
			 $response['status'] = 400;
	         $response['message'] = $e->getMessage()->withInput();
	         return $response;
	    }
	}

	function emailSend($postData){ 
	    
		try{
			$email =  Mail::send($postData['layout'], $postData, function($message) use ($postData) {

				$message->to($postData['email'])
				        ->subject($postData['subject']); 
				$message->from('anesthesiacaselogs@gmail.com');
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

	function contactUs($postData){ 
	    
		try{
			$email =  Mail::send($postData['layout'], $postData, function($message) use ($postData) {

				$message->to($postData['email'])
				        ->subject($postData['subject']); 
				$message->from('anesthesiacaselogs@gmail.com');
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