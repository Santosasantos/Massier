<?php 
	session_start();

	unset($_SESSION['login_info']);
	unset($_SESSION['mess_info']);
	// unset($_SESSION['email']);
	// unset($_SESSION['name']);
	// unset($_SESSION['role_ck']);
	// unset($_SESSION['mess_id']);
	// unset($_SESSION['manager']);
	unset($_SESSION['role']);
	unset($_SESSION["success_message"]);
	unset($_SESSION['selected_email']);

	setcookie("login_token", "", time() - 3600, "/");
	header("Location: login_html.php");
	exit();
	
?>
