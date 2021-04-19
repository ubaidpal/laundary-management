<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\CancelSubscription;
use App\Models\Preferrence;
use App\Models\User;
use App\Models\Claim;
use App\Models\Order;
use App\Models\OrderAssign;
use View;
use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
         

        $newOrders = Order::where(['order_status'=>'0'])->count(); 
        $todayschedule = Order::whereDate('order_date','=', Carbon::today()->toDateString())->count();
         
        $claims = Claim::where(['status'=>'0'])->count(); 
        $CancelSubscription = CancelSubscription::whereNull('action')->count(); 

        $staffId = \Auth::id();

        $OrderAssign = OrderAssign::whereHas('ordersss')->where('staff_id',$staffId)->count(); 

        //echo "<pre>";    print_r($OrderAssign);die();
        View::share(['new_orders' => $newOrders,'claims' => $claims,'cancelsubscription' => $CancelSubscription,'today_schedule' => $todayschedule,'newOrderAssign' => $OrderAssign]);
        
        return $next($request);
    });
    }    
    public function defaultPrefferences($user_id)
    {
        $check = Preferrence::where('user_id',$user_id)->first();
        if($check){
            return true;
        }

        /*$data = [
            'user_id' => $user_id,
            'detergent' => 'Hypoallargenic',
            'fabric_softner' => '0',
            'oxiclean' => '0',
            'starch' => 'None',
            'rush_delivery' => '0',
            'leave_laundry' => '2',
            'delivery_instructions' => '',
        ];
        $insert = new Preferrence($data);
        if($insert){
            return true;
        }else{
            return false;
        }*/

        $insert = new Preferrence;
        $insert->user_id = $user_id;
        $insert->detergent = 'Hypoallargenic';
        $insert->fabric_softner = '0';
        $insert->oxiclean = '0';
        $insert->starch = '0';
        $insert->rush_delivery = '0';
        $insert->leave_laundry = '2';
        $insert->delivery_instructions = '';
        $insert->vaccum = '2';
        $insert->mop = '2';
        $insert->cleaning_product = '2';
        $insert->pets = '2';
        if($insert->save()){
            return true;
        }else{
            return false;
        }
    }

    function SendPushNotification($notification){
    //dd($notification);
        $FCM_KEY='AAAAtTdQtfA:APA91bFI9gnFJLw_wEjKiLAXhadUBVcoPcdgh5nH2XPk4WK_OW1MfwuKwMUM8IO9L03yfCpyLM31oyK7_1idUU3czir0e9k4GSHVPkZP_Zn-ngiva166DZGxjH9ob_CqgrzWRHSRWPNX';
        error_reporting(0);

        $notifDbDetails = array
        (
            "body"          => $notification['text'],
            "message"       => $notification    ,
            "title"         => 'title',
            "msgcnt"        => "1"          ,
            "soundname"     => "beep.wav"   ,
            "badge_count"     =>0,
            "timeStamp"     => time()       ,
           // "notification_type"  => $message['notify_type']
        );

        $devicedata = User::where(['id'=>$notification['user_id']])->first();
        if(!empty($devicedata)){
            $device_type = $devicedata->device_type;
            $device_token=$devicedata->device_token;
            //$device_token= '6B61A540BB1F293C236B43B6AB91C4BC91C1788E24914BA0B8D47FCA35A164E6';

        }
        //echo $devicedata;die();
        $url = 'https://fcm.googleapis.com/fcm/send';
        if($device_type == 1) //ios
        { // for ios

            if(strlen(trim($device_token)) != 64){
                return false;
            }
            try{
                $data = $notification;
                //prx($data['body']['id']);
                $apnsServer = 'ssl://gateway.sandbox.push.apple.com:2195';
                /* Make sure this is set to the password that you set for your private key
                when you exported it to the .pem file using openssl on your OS X */
                $privateKeyPassword = '';
                /* Put your own message here if you want to */
                $message = $notification['text'];
                /* Pur your device token here */
                $deviceToken = $device_token;
                /* Replace this with the name of the file that you have placed by your PHP
                script file, containing your private key and certificate that you generated
                earlier */
                $pushCertAndKeyPemFile = dirname(dirname(dirname(dirname(__FILE__)))) . '/pem_file/Certificates.pem';
               //dd($pushCertAndKeyPemFile);
                $stream = stream_context_create();
                stream_context_set_option($stream,
                'ssl',
                'passphrase',
                $privateKeyPassword);
                stream_context_set_option($stream,
                'ssl',
                'local_cert',
                $pushCertAndKeyPemFile);
                $connectionTimeout = 20;
                $connectionType = STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT;
                $connection = stream_socket_client($apnsServer,
                $errorNumber,
                $errorString,
                $connectionTimeout,
                $connectionType,
                $stream);
                if (!$connection){
                     //echo "Failed to connect to the APNS server. Error no = $errorNumber<br/>";
                     exit;
                }else{
                   //echo "Successfully connected to the APNS. Processing...</br>";
                }

                $messageBody['aps'] = array('alert' => $message,
                'sound' => 'default',
                'badge' => $badge_count + $messages_count,
                'body' => $data
                );
//dd($messageBody);die();
                $payload = json_encode($messageBody);
                $notification = chr(0) .
                pack('n', 32) .
                pack('H*', $deviceToken) .
                pack('n', strlen($payload)) .
                $payload;
                $wroteSuccessfully = fwrite($connection, $notification, strlen($notification));
                if (!$wroteSuccessfully){
                   // echo "Could not send the message<br/>"; die();
                }else {
                   // echo "Successfully sent the message<br/>"; die();
                }
                fclose($connection);
            }catch(Exception $ex){
                // try once again for socket busy error (fwrite(): SSL operation failed with code 1.
                // OpenSSL Error messages:\nerror:1409F07F:SSL routines:SSL3_WRITE_PENDING)
                sleep(5); //sleep for 5 seconds
                $wroteSuccessfully = fwrite($connection, $notification, strlen($notification));
                if ($wroteSuccessfully){
                    return true;
                }else{
                    return false;
                }
            }

        }else{ // for android
           //dd($notifDbDetails);
            $fields = array(
                'registration_ids' => array($device_token),
                'data'             => $notifDbDetails,
            );
            $headers = array(
                'Content-Type: application/json',
                'Authorization: key='.$FCM_KEY
              );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, @$url );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, @$headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( @$fields ) );
            $result = curl_exec($ch );
           // dd($result);
            curl_close( $ch );
            return $result;
        }

    }

public function paymenttest($amount)
    {

    $ch = curl_init();
    $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',

    );

    $url = 'http://18.215.23.194/paytrace_amit/test.php?amount='.$amount;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);

    $transaction_id = $authToken;

    return $transaction_id;

    }

}
