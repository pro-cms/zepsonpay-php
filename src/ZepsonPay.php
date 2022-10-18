<?php

namespace Zepson\ZepsonpaySDK;

class ZepsonPay
{

    const BASE_URL = "https://zepsonpay.com/api/v1/";



    // "base_url" => "https://41.59.112.185/api/v1/",
    // "api_key" => "YOUR_API_KEY",//constructor
    // "api_secret" => "YOUR_API_SECRET", //constructor
    // "device_id" => "YOUR_DEVICE_ID",//for android transaction
    // "environment" => "sandbox",//for adroid use android

    public function __construct($api_key=null, $api_secret=null, $environment=null)
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->environment = $environment;
    }

    public function makePayment(array $data)
    {
        //verify data
        if(isset($data['amount']) && isset($data['purpose']) && isset($data['ext_trxn_reff'])   && isset($data['phone']) && isset($data['operator'])){
             if(!empty($data['amount']) && !empty($data['purpose']) && !empty($data['ext_trxn_reff']) && !empty($data['phone']) && !empty($data['operator'])){
               if($this->environment == "android" && !isset($data['device'])|| empty($data['device'])){
                return [
                    'success' => false,
                    'message' => 'device_id is required for android transaction'
                
                ];
                  
               } 
               else {
                 
               }
            $url = self::BASE_URL . "collection";
            $data['api_key'] = $this->api_key;
            $data['api_secret'] = $this->api_secret;
            $data['environment'] = $this->environment;
               
            

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close($ch);
            //decode to array
      
            //print response body
            return new PaymentResponse($server_output);
             }
             
             return [
                'success' => false,
                'message' =>  'Required parameters are missing'
            
            ];
        }
        return [
            'success' => false,
            'message' => 'Invalid Request Data Provided'
        
        ];
        

    }

    public function paymentStatus($data)
    {
        if(!isset($data['ext_trxn_reff']) ||empty($data['ext_trxn_reff'])){
            return [
                'success' => false,
                'message' => 'External Transaction Reference is required'
            
            ];
        }
        $url = self::BASE_URL . "collection/status";
        $data = [
            'api_key' => $this->api_key,
            'api_secret' => $this->api_secret,
            'environment' => $this->environment,
            'ext_trxn_reff' => $data['ext_trxn_reff']
        ];

        $data = http_build_query($data);
        $url = $url . "?" . $data;
         
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL =>  $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);

        curl_close($curl);
        //print response body
        return new PaymentResponse($response);
    }
}
