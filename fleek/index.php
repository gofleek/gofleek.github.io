<?php

switch($_SERVER['REQUEST_METHOD'])
{
case 'GET': 
        $the_request = &$_GET;
        include "loader.html";
        break;
case 'POST': 
        $the_request = &$_POST; 
        if($_POST["serviceCode"]) {
    // Reads the variables sent via POST
  $sessionId   = $_POST["sessionId"];  
  $serviceCode = $_POST["serviceCode"];  
  $text = $_POST["text"];
  $url='https://script.google.com/macros/s/AKfycbzql62yqSlM-2KDFPpXRy3jm-ZwTi1XMTkNjZq1KMLGIjPKRbOP/exec';
  $url=$url.'?t='.$text.'&si='.$sessionId.'&sc='.$serviceCode;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  
  $result = curl_exec($ch);
  
  curl_close($ch);
  header('Content-type: text/plain');
  echo " $result \n ";
  }
  else {
   
    ini_set('error.log','ussd-error.log');

    require 'bdapps_cass_sdk.php';

    $appid= "APP_045968";
    $password="@Notredame0";
    $ussdserverurl = "https://developer.bdapps.com/ussd/send";
    
    $responseMsg = "select from the menu \n 1. MESSAGE \n 2. STORE";
    
    try{
      $receiver = new UssdReceiver();
      $ussdSender = new UssdSender($ussdserverurl,$appid,$password);
      $sessionId = $receiver->getSessionId();
      $address = $receiver->getAddress();
      $ussdOperation = $receiver->getUssdOperation();
      $content =$receiver->getMessage();
    
    
      if ($ussdOperation == "mo-init"){
    
        try {
    
            $ussdSender->ussd($sessionId, $responseMsg , $address);
    
        }
        catch (Exception $e) {
            $ussdSender->ussd($sessionId,'Sorry error ocured \n Try again ',$address);
            file_put_contents('USSDERROR.tct','some error occured');
    
    
        }
      }
      else {
    
        switch($content){
    
            case "1*0" : 
                $ussdSender->ussd($sessionId, $responseMsg , $address);
    
            case "1" :
                $ussdSender->ussd($sessionId, " you have dialed 1 \n 0. back \n ", $address);
    
           
        }
      }
    
    }
    catch (Exception $e) {
        file_put_contents('USSDERROR.tct','some error occured');
    }
  }
        break;

default:
}




  
  




?>
