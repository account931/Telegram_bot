<?php
 //used to chat with a bot with predefined messages

 //credentialls are in Credntials/credentials.php (BOT_TOKEN, CHAT_ID)
  require 'Credentials/credentials.php'; //Composer autoload
  
//define('BOT_TOKEN', '12345678:replace-me-with-real-token');
define('API_URL', 'https://api.telegram.org/bot'.BOT_TOKEN.'/'); //BOT_TOKEN is from {Credntials/credentials.php}

//gets the current page URL, i.e http://localhost/telegram_Bot/auto_respond_chat.php
$currentPage =(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
define('WEBHOOK_URL', $currentPage);




function apiRequestWebhook($method, $parameters) {
  if (!is_string($method)) {
    echo "Method name must be a string\n";
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    //error_log("Parameters must be an array\n");
	echo "Parameters must be an array\n";
    return false;
  }

  $parameters["method"] = $method;

  header("Content-Type: application/json");
  echo json_encode($parameters);
  return true;
}



function exec_curl_request($handle) {
  $response = curl_exec($handle);

  if ($response === false) {
    $errno = curl_errno($handle);
    $error = curl_error($handle);
    echo "Curl returned error $errno: $error";
    curl_close($handle);
    return false;
  }

  $http_code = intval(curl_getinfo($handle, CURLINFO_HTTP_CODE));
  curl_close($handle);

  if ($http_code >= 500) {
    // do not wat to DDOS server if something goes wrong
    sleep(10);
    return false;
  } else if ($http_code != 200) {
    $response = json_decode($response, true);
    echo "Request has failed with error {$response['error_code']}: {$response['description']}";
    if ($http_code == 401) {
      throw new Exception('Invalid access token provided');
    }
    return false;
  } else {
    $response = json_decode($response, true);
    if (isset($response['description'])) {
      //error_log("Request was successful: {$response['description']}\n");
	  echo "Request was successful: {$response['description']}";
    }
    $response = $response['result'];
  }

  return $response;
}



function apiRequest($method, $parameters) {
  if (!is_string($method)) {
    echo "Method name must be a string";
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    echo "Parameters must be an array";
    return false;
  }


  foreach ($parameters as $key => &$val) {
    // encoding to JSON array parameters, for example reply_markup
    if (!is_numeric($val) && !is_string($val)) {   
      $val = json_encode($val);
    }
	
  }
  echo "<br>" .$val. "<br>"; //MINE!!!!!!!!!!!!!!!!!!!1
  
  $url = API_URL.$method.'?'.http_build_query($parameters);

  $handle = curl_init($url);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);//drop SSL
 
  echo $handle;  echo "<br>OK 11112"; //NEW 
  return exec_curl_request($handle);
  
}



function apiRequestJson($method, $parameters) {
  if (!is_string($method)) {
    echo "Method name must be a string";
    return false;
  }

  if (!$parameters) {
    $parameters = array();
  } else if (!is_array($parameters)) {
    echo "Parameters must be an array";
    return false;
  }

  $parameters["method"] = $method;

  $handle = curl_init(API_URL);
  curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($handle, CURLOPT_TIMEOUT, 60);
  curl_setopt($handle, CURLOPT_POST, true);
  curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($parameters));
  curl_setopt($handle, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

  curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);//drop SSL
  return exec_curl_request($handle);
}



function processMessage($message) {
  // process incoming message
  $message_id = $message['message_id'];
  $chat_id = $message['chat']['id'];
  if (isset($message['text'])) {
    // incoming text message
    $text = $message['text'];

    if (strpos($text, "/start") === 0) {
      apiRequestJson("sendMessage", array('chat_id' => $chat_id, "text" => 'Hello', 'reply_markup' => array(
        'keyboard' => array(array('Hello', 'Hi')),
        'one_time_keyboard' => true,
        'resize_keyboard' => true)));
    } else if ($text === "Hello" || $text === "Hi") { 
      apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => 'Nice to meet you'));
    } else if (strpos($text, "/stop") === 0) {
      // stop now
    } else {
      apiRequestWebhook("sendMessage", array('chat_id' => $chat_id, "reply_to_message_id" => $message_id, "text" => 'Cool'));
    }
  } else {
    apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => 'I understand only text messages'));
  }
}


//define('WEBHOOK_URL', 'http://localhost/telegram_Bot/auto_respond_chat.php'); //defined in 1st lines with $currentPage

if (php_sapi_name() == 'cli') {
  // if run from console, set or delete webhook
  apiRequest('setWebhook', array('url' => isset($argv[1]) && $argv[1] == 'delete' ? '' : WEBHOOK_URL));
  exit;
}




//------------------------------------------------------------------
/*
$content = file_get_contents("php://input");
$update = json_decode($content, true);
*/

//-------------
//$dataX = '{"id":"5cfa32707c902a3231b5258e3b93f24bcc","type": "Feature","geometry": {"coordinates": [28.652198, 50.267998],"type": "Point"}, "properties": {"title": "Nuhavn", "description": "School Nu Inserted with Php cURL"} }';
$url = "http://127.0.0.1"; //$HTTP_RAW_POST_DATA ; //"php://input";

  $curl = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      //CURLOPT_POSTFIELDS => $dataX,//"{\n  \"customer\" : \"con\",\n  \"customerID\" : \"5108\",\n  \"customerEmail\" : \"jordi@correo.es\",\n  \"Phone\" : \"34600000000\",\n  \"Active\" : false,\n  \"AudioWelcome\" : \"https://audio.com/welcome-defecto-es.mp3\"\n\n}",
      CURLOPT_HTTPHEADER => array(
         "cache-control: no-cache",
         "content-type: application/json",
         "x-api-key: whateveriyouneedinyourheader"
      ),
  ));
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //must option to Kill SSL, otherwise sets an error
  $update = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error happened #:" . $err;

  } else if ($update) {
	  echo "OKKK <br>";
  }
//-------------


if (!$update) { 
  echo "<br>receive wrong update, must not happen";
  exit;
}

echo 222;
if (isset($update["message"])) {
  processMessage($update["message"]);
  
} else {
	echo "<br> update['message'] not set ";
	$testX = ['text'=> 'Hello', 'message_id'=> 5, 'chat'=>['id'=>557882038]];
	processMessage($testX); //mine
}