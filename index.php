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
      <!--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">-->
	  

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 
	  
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- Fa fa lib -->

      <link rel="stylesheet" type="text/css" media="all" href="css/myCSS.css">
      <!--<script src="core_js/weather_core.js"></script>--><!--  Core Random JS-->


	  
	
	  
	  <meta name="viewport" content="width=device-width" />

     </head>
	
     <body>
	   
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
			       <a href="bot_send_message_via_curl.php"><i class="fa fa-plug" aria-hidden="true"></i> Send a message to Telegram channel via bot</a>
				</li>
				
				<li class="list-group-item break-word">
				   <a href="auto_respond_chat.php"> <i class="fa fa-plug" aria-hidden="true"></i> Chat with a bot =><span style="font-size:0.8em; margin-left:0.5em;">({$_SERVER[HTTP_HOST]&$_SERVER[REQUEST_URI]} is used)</span></a>
				</li>
				<!--
				<li class="list-group-item">
				   <a href="auto_respond_chat_original.php"> <i class="fa fa-plug" aria-hidden="true"></i> Chat with a bot (000webhost Original)</a>
				</li>
				
				<li class="list-group-item">
				   <a href="auto_respond_chat_original2.php"> <i class="fa fa-plug" aria-hidden="true"></i> Chat with a bot (000webhost Edited)-2</a>
				</li>
				-->
			  </ul>
			  
			 </div>
			  
             
		           	 			 
				 
                                    
     
    	</div><!-- /.container -->	
				  		
    </div><!-- /.wrapper -->

                

       
		
		
		
		  <!-----Footer ---->
		        
				<div class="footer "> <!--navbar-fixed-bottom  fixxes bootom problem-->
				    <!--Contact: --> <strong>dimmm931@gmail.com</strong><br>
					<?php  echo date("Y"); ?>
				</div>
		<!--END Footer ---->  
		
		
		
		
		
		
		<!-----------------  Button to change Style theme------------------------->
	   <input type="button" class="btn" value=">>" id="changeStyle" style="position:absolute;top:0px;left:0px;" title="click to change theme"/>
	   <!-----------------  Button to change Style theme------------------------->
		
		
		
		
		
		
    
    </body>
</html>





