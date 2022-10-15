<?php

require "../vendor/autoload.php";
use Zepson\ZepsonpaySDK\ZepsonPay;

$api_key = "eae1a6ac-aa11-4af8-8a8a-68336de3b0cd";
$api_secret = "eae1a6ac-aa11-4af8-8a8a-68336de3b0cd";
$environment = "android";

$zp = new ZepsonPay($api_key, $api_secret, $environment);
 
$data = [
    // 'amount' => 100,
    // 'purpose' => 'purpose',
    'ext_trxn_reff' => '9JF681RJWOK',
    // 'phone' => '0688950846',
    // 'operator' => 'vodacom',
    // 'device' => '00000000-0000-0000-6da8-08a4c30f4b97'

];
// $payment = $zp->makePayment($data);
// $status = $payment->getTransactionId();

$response = $zp->paymentStatus($data);
$status  = $response->getMessage();
 
print_r($status);