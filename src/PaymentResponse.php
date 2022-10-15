<?php

namespace Zepson\ZepsonpaySDK;

class PaymentResponse
{

    public $response;
    public $response_json;

    public function __construct($response)
    {
        $this->response_json = $response;
        $this->response = json_decode($response, true);
    }

    public function isPaymentSuccess()
    {
        if ($this->response['success'] == true) {
            return $this->response['code'];
        } else {
            return $this->response['code'];
        }
    }

    public function getTransactionId()
    {
        return $this->response['data']['transaction_id'];
    }

    public function getExternalTransactionId()
    {
        return $this->response['data']['ext_trxn_reff'];
    }

    public function getMessage()
    {
        return $this->response['message'];
    }

    public function getErrors()
    {
        return $this->response['errors'];
    }

    public function getTransactionMessage()
    {
        return $this->response['data']['message'];
    }

    public function getFullResponseArray()
    {
        return $this->response;
    }

    public function getFullResponseJson()
    {
        return $this->response_json;
    }
}
