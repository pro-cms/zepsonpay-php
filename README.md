
# ZEPSON PAY PHP SDK

![Logo](https://raw.githubusercontent.com/pro-cms/zepsonpay-php/master/flow.png)

Zepson pay is the software as a service payment gateway designed to make payment integration through API's easly and avaliable to anyone.
Zepson Engineers  works on real world researches to get solution suitable for your business.


## Features

- Collection (also available android pay)
- Desbursement
- Transaction Enquiry  (also available android pay)
- Transaction reversal
- Fraud Check



## Documentation

[Read Detailed Developer Documentation](https://zepsonpay.com/public/docs)


## How to integrate to PHP/Laravel Application
    1.Install Zepson Pay Package
    2. Prepare your API key, API secret and environment from zepsonpay.com developer dashboard
    3. Create an Instance of ZepsonPay Class
    4. Pass Required Parameters
    5. Call makePayment to initiate makePayment
    6. Call paymentStatus to get transaction paymentStatus

 



 


## Installation

Install my-project with composer in php or Laravel application

```bash
  composer require zepson/zepsonpay-php
```


## Create Instance of Zepson pay class
 
 Create an instance of ZepsonPay class using bellow instruction. Note that parameters in the example are all
 mandatory when initializing the class.
 api_key and api_secret ca be obtained from https://zepsonpay.com developer portal

```php
<?php 

    $api_key = "YOUR_ZEPSONPAY_API_KEY";
    $api_secret = "YOUR_ZEPSONPAY_API_SECRET";
    $environment = "android"; //sandbox, produciton, zepsonpay and android. currently support android (v1.0)
    //creating instance of zepsonpay class.
    $zp = new Zepson\ZepsonpaySDK\ZepsonPay($api_key, $api_secret, $environment);
```

## Make payment
 
To complete payment , the parameters in the example are required. Make payment can sometimes 
be reffered to us Collection.

```php
 
$data = [
    'amount' => 100,
    'purpose' => 'For testing purposes',
    'ext_trxn_reff' => '1JF61RJWOK', //for android transaction this is equal to operators transaction id received after payment
    'phone' => '0688950846', //customer phone
    'operator' => 'vodacom', //operator to charge from
    'device' => '00000000-0000-0000-6da8-08a4x40d4b97' // only for android transactions obtained after registering device in gateway.zepsonsms.co.tz
];

    //make payment
 $response = $zp->makePayment($data);
```
After making payment, please reffer to call back sections below to see how can you work with different
responses from the api.


## Transaction enquiry(Check transaction status)
 
To check status, the parameter  in the example is required. Transaction status is sometimes 
reffered to as transaction enquiry

```php
 
$data = [
    'ext_trxn_reff' => '1JF61RJWOK', //for android transaction this is equal to operators transaction id received after payment
];

    //make payment
 $response = $zp->paymentStatus($data);
```
After receiving response, please reffer to call back sections below to see how can you work with different
responses from the api.


## Available payment response helpers

 We have prepared a list of helpers to help make your process much easy, you can use this for 
 any type of transaction /environment.
 
### check if payment is successfull
```php 
    $zp->isPaymentSuccess();
```

This returns zepsonpay status codes described below.

| CODE | DESCRIPTION      
| :-------- | :------- |  
| `ZPSUCCESS`      | `payment is successfull completed` | 
| `ZPPENDING`      | `payment is being processed` | 
| `ZPFAILED`      | `payment request failed` | 
| `ZPEXISTED`      | `Payment refference code existed, send transaction enquiry/status to check` | 
| `ZPFRAUD`      | `Payment is marked as fraud due to failure to pass fraud matrix` | 


### get full transaction response as array
```php 
    $zp->getFullResponseArray();
```


### get full transaction response as Json
```php 
    $zp->getFullResponseJson();
```


### get   transaction ID
```php 
    $zp->getTransactionId();
```


### get external  transaction ID
```php 
    $zp->getExternalTransactionId();
```

### get   Response message
```php 
    $zp->getMessage();
```


### get response transaction message
```php 
    $zp->getTransactionMessage();
```



### get errors
```php 
    $zp->getErrors();
```

# ANDROID TRANSACTION 

Here is is quite simple and does not require much documents, your integration approval is done automatically.

Here you will need an account at gateway.zepsonsms.co.tz , go to device section and register your phone(Android),

create your zepsonpay account and create your app, business category select android, you'll get your app id and app key, use them to integrate with our API.,

your required to add device id( from Zepson SMS gateway) and your webhook secret by going to your gateway.zepsonsms.co.tz account, tools and select webhook, the create webhook, add url https://zepsonpay.com/webhook , you will get your webhook secret key, use it to integrate with our API.

## For enquiries please visit zepsonpay.com

![Logo](https://raw.githubusercontent.com/pro-cms/zepsonpay-php/master/logo.png)

Zepson pay is the software as a service payment gateway designed to make payment integration through API's easly and avaliable to anyone.
Zepson Engineers  works on real world researches to get solution suitable for your business.


## Roadmap

- Mnos Collection
- Mno's Desbursement
- Zepon pay agregation (Still in progress)
- VPN tunnelling (in progress)

## Contributing

Contributions are always welcome to help make the package more user friendly!
 

## Authors

- [@pro-cms](https://www.github.com/pro-cms)
- [@pbijampola](https://www.github.com/pbijampola)
- [@Zepson-Tech](https://www.github.com/Zepson-Tech)
## License

[MIT](https://choosealicense.com/licenses/mit/)


