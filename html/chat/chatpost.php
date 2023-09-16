<?php

session_start();

    $text = $_POST['usermsg'];
	
	$text_message = "<div class='msgln'><span class='chat-time'>".date("g:i A")."</span> <b class='user-name'>".$_SESSION["login_info"]["name"]."</b> ".stripslashes(htmlspecialchars($text))."<br></div>";
        file_put_contents("log.html", $text_message, FILE_APPEND | LOCK_EX);
   
?>