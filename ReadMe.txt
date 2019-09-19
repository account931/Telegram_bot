Application to intereaction with Telegram_bot.

============================
#GitHub repository misses folder {Credentials/credentials.php} as it contains private telegram tokens and thus this folder is added to .gitignor.txt
If you clone this repository, create {Credentials/credentials.php} and add to it:
    define('BOT_TOKEN', '80*******'); //Bot API
    define('BOT_USERNAME', 'Cp*****'); //Bot Username
    define('BOT_ID', '80*****'); //Bot ID
    define('CHAT_ID', '55******');  //channel "@testt931" ID  
    define('CHANNEL_NAME', '@tes*******');  //channel name
	
	
==========================
#bot_send_message_via_curl.php => sends a message to certain channel with bot via form php curl. Uses JS to prevent-form-resubmission-when-page-is-refreshed-f5

#auto_respond_chat => to chat with a bot with predefined messages. Doesnot work completely. Uses (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";



==========================
HTTP METHODS

https://api.telegram.org/bot<token>/getMe  GET => returns bot ID, name

https://api.telegram.org/bot<token>/setwebhook  GET => delete a webhook

https://api.telegram.org/bot<token>/getUpdates GET => gets JSON messages from BOT, not channel