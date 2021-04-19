<?php

require 'vendor/autoload.php';

$ccGateway = \Omnipay\Omnipay::create('Paytrace_CreditCard');

$amount = isset($_GET['amount']) ? $_GET['amount'] : '0.00';



$ccGateway->setUserName('ashwani.dhindsa@gmail.com')
	->setPassword('India@1994')
	->setTestMode(true);

$creditCardData = ['number' => '4242424242424242', 'expiryMonth' => '06', 'expiryYear' => '2025', 'cvv' => '123'];




$response = $ccGateway->purchase([ "csc"=> "999", 'amount' => $amount, 'currency' => 'USD', 'card' => $creditCardData,
"billing_address"=> [
                        "name"=> "Amit Bansal",
                        "street_address"=> "8320 E. West St.",
                        "city"=> "Spokane",
                        "state"=> "WA",
                        "zip"=> "85284"
                        ]
                    ])->send();

print_r($response->getTransactionReference());
die;

if ($response->isSuccessful()) {
    // SUCCESS
   $response = [
    'message' => $response->getMessage(),
    'trasactionId' => $response->getTransactionReference(),
    'status' => '200'
   ];
    
   return $response;
} else {

    $response = [
    'message' => $response->getMessage(),
    'status' => '400'
    // 'trasactionId' => $response->getTransactionReference(),
   ];
    
   return $response;
	
}
die;
$chGateWay = \Omnipay\Omnipay::create('Paytrace_Check');
$chGateWay->setUserName('ashwani.dhindsa@gmail.com')
	->setPassword('India@1994')
	->setTestMode(true);

$checkData = ['routingNumber' => '325070760', 'bankAccount' => '1234567890', 'name' => 'John Doe'];

$response = $chGateWay->purchase(['amount' => '10.00', 'currency' => 'USD', 'check' => $checkData])->send();

if ($response->isSuccessful()) {
	// SUCCESS
    echo $response->getMessage();
} else {
	// FAIL
    echo $response->getMessage();
}

?>