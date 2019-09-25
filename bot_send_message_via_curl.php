<!doctype html>
<!--------------------------------Bootstrap  Main variant ------------------------------------------>
  <html lang="en-US">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="Content-Type" content="text/html">
      <meta name="description" content="Telegram Bot" />
      <meta name="keywords" content="Telegram Bot, telegram, send message">
      <title>Telegram Bot</title>
  
      <!--Favicon-->
      <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	  

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 
	  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Fa fa lib -->

      <link rel="stylesheet" type="text/css" media="all" href="css/myCSS.css">
      <!--<script src="core_js/weather_core.js"></script>--><!--  Core Random JS-->
	  
	  <meta name="viewport" content="width=device-width" />
     </head>
	
     <body>
	 
	 <script>
	 //prevent-form-resubmission-when-page-is-refreshed-f5-ctrlr
	 if ( window.history.replaceState ) {
         window.history.replaceState( null, null, window.location.href );
     }
	 </script>
	   
       <div id="headX" class=" text-center myShadow colorAnimate head-style" style ='background-color:lavender;padding:10px;'> <!--#2ba6cb;--> <!--.head-style sets bg image, .colorAnimate sets animation-->
	   
         <h1 id="h1Text">	 
		     <span id="textChange" class="textShadow"> Telegram Bot</span>  
			 <i class="fa fa-telegram" aria-hidden="true"></i>
		 </h1> 
		    
	   </div>
	   
	


         <br>
         <div class="wrapper grey">
    	   <div class="container">
		   
		   
		   
		     
			 <div class="col-sm-12 col-xs-12 myShadow shrink colorAnimate head-style" style="background-color:lavender;">  <!--.head-style sets bg image, .colorAnimate sets animation-->
			  
			  <ul class="list-group">
			     <li class="list-group-item">
			         <a href="index.php" class="text-danger"><i class="fa  fa-home" aria-hidden="true"></i> Back to index.php</a>
				  </li><br>
			  </ul> 
			 </div> 
			  
             
		       
             <!------------------  Form to send messages ------------------------->
             <div class="col-sm-12 col-xs-12 myShadow shrink colorAnimate head-style" style="background-color:lavender;">
			     <h2>Send message to Bot</h2>
                     <form class="form-horizontal" action="" method="post">
                         <div class="form-group">
                             <label class="control-label col-sm-2" for="email">Email:</label>
                             <div class="col-sm-10">
                                  <input type="text" class="form-control" id="myMess" placeholder="Enter the message" name="myMessageX" required>
                            </div>
                         </div>
	
   
                       <div class="form-group">        
                          <div class="col-sm-offset-2 col-sm-10">
                              <button type="submit" class="btn btn-default" name="buttonX">Send message</button>
                          </div>
                       </div>
                  </form>
             </div>			 
			 <!---------------------  Form to send messages ------------------------>	 
                                    
            <br><br>
    	</div><!-- /.container -->	
				  		
    </div><!-- /.wrapper -->

                

       
		
		
		

































 

 <div class="col-sm-12 col-xs-12 break-word">


<?php
//sends a message to certain channel with bot via form php curl  
 
  //credentialls are in Credntials/credentials.php (BOT_TOKEN, CHAT_ID)
  require 'Credentials/credentials.php'; //Composer autoload
  
  //if u clicke the submit button
  if (isset($_POST['buttonX'])){
	  runApiRequest();
  }
  
  
  

function runApiRequest(){
	
 //construct the url to use in cURL
  $url = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendMessage"; //Mega Fix-> must be https://api.telegram.org/bot" . botToken
  
  //https://api.telegram.org/bot[BOT_API_KEY]/sendMessage?chat_id=[MY_CHANNEL_NAME]&text=[MY_MESSAGE_TEXT] //send message via GET in browser, working
  
  $s = trim($_POST['myMessageX']);
 
  
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
    echo "<p> STATUS OK =></p><p>Below is response from API-></p>";
    echo $response;
  }
//END cURL -> Version for localhost, cURL is not supported on zzz.com.ua hosting-------------

//Version for zzz.com.ua, which does not work with cURL
/*
$response = file_get_contents($url,null,null);
*/
  
	$messageAnswer = json_decode($response, TRUE); //gets the cUrl response and decode to normal array
	//if(isset($messageAnswer['message'])){}
	
	unset($_POST['buttonX']); //can reload without resending $_POST
	unset($_REQUEST);
}
?>
</div>






		  <!-------------- Footer ----------->
		        
				<div class="footer "> <!--navbar-fixed-bottom  fixxes bootom problem-->
				    <!--Contact: --> <strong>dimmm931@gmail.com</strong><br>
					<?php  echo date("Y"); ?>
				</div>
		<!----------- END Footer -------------->  
		
		
    
    </body>
</html>