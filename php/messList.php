<?php
session_start();
$_SESSION['mess_info']['mess_id']=$_POST['mess_Id'];
echo $_SESSION['mess_info']['mess_id'];
header("Location: ../html/homepage_html.php");
?>