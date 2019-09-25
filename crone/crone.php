<?php

include '../Credentials/api_credentials.php'; //Currency api key
require '../Credentials/credentials.php'; //Telegram API

class Currency
 {
	 
  public $currencyX; //must be public
  
  public static function askCurrencyApi()
	{
		
	     //form the URL for Currency API
	     $data_url = "https://openexchangerates.org/api/latest.json?app_id=".API_KEY;  //
	
	     // Gets the Currency API
		 /*
         if (!$json = file_get_contents($data_url)) {
		     echo "<br>Currency php Error</br>";
	     }
		 */
         //$obj = json_decode($json,true);//,  true used for [], not  used  for '->';
	
         /*
		 echo $json;
		 */
         //print_r($obj); // display the JSOn to screen
         //echo json_encode($obj); // MAke sure JSOn encode  gotten result 
		 
		 
		 
		 //cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $data_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
	    //pass the data
        //CURLOPT_POSTFIELDS => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
        CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache",
         "content-type: application/json",
         "x-api-key: whateveriyouneedinyourheader"
        ),
        ));
       curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error
       $response = curl_exec($curl);
       $err = curl_error($curl);
       curl_close($curl);
      if ($err) {
          echo "cURL Error #:" . $err;
      } else {
         echo "<p> STATUS OK =></p><p>Below is response from API-></p>";
	
	    $obj = json_decode($response,true);//,  true used for [], not  used  for '->';
        echo $obj['rates']['UAH'];
		$GLOBALS["currencyX"] = "Today ".  date("d.m.Y") . " 1 USD is " .$obj['rates']['UAH'] . "UAH";
      }
//END cURL -> Version for localhost, cURL is not supported on zzz.com.ua hosting-------------
	
	}
	
	
	//-----------------------------------------------
	public static function sendCurrencyToBot($currency){
		//construct the url to use in cURL
  $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage"; //Mega Fix-> must be https://api.telegram.org/bot" . botToken
  
  //https://api.telegram.org/bot[BOT_API_KEY]/sendMessage?chat_id=[MY_CHANNEL_NAME]&text=[MY_MESSAGE_TEXT] //send message via GET in browser, working
  
  $s = $currency; // trim($_POST['myMessageX']);
 
  
  //construct data to pass in cURL body (id in $url and in $data must be the same-> it is $this->UUID, a uniue generated number ) 
  //$dataX = '{"id":"' . $this->UUID . '" ,"type": "Feature","geometry": {"coordinates": [' . $myLng . ',' . $myLat . '],"type": "Point"}, "properties": {"title":"' . $myName . '", "description":"' . $myDescript.'"} }'; //MEGA FIX->mega Error was here, {$myName, $myDescript} must be in {""}
	//$dataX = '{"chat_id":' . CHAT_ID . ', "text": "Hello, testing message-2"}';
	
	//if use below {CHAT_ID}(56454**), message is sent to bot only, if {CHANNEL_NAME} message is sent to Channel, not to bot
	$dataX = '{"chat_id":"' . CHANNEL_NAME . '", "text":"'. $s . '"}'; //chatName, message. 
	
	
	  
	  
//cURL Start-> Version for localhost and 000webhost.com, cURL is not supported on zzz.com.ua hosting
  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
	  //pass the data
      CURLOPT_POSTFIELDS => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
      CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache",
         "content-type: application/json",
         "x-api-key: whateveriyouneedinyourheader"
      ),
  ));
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  if ($err) {
      echo "cURL Error #:" . $err;
  } else {
    echo "<p> STATUS OK =></p><p>Below is response from TELEGRAM API-></p>";
    echo $response;
  }
//END cURL -> Version for localhost, cURL is not supported on zzz.com.ua hosting-------------
		
	}
	
	
	
	
	
 } //end class
	
	
	
	
	
	// run Class RunWeatherRequest to send file_get_contents($data_url)
	 Currency::askCurrencyApi();
	 Currency::sendCurrencyToBot($GLOBALS["currencyX"]);
?>