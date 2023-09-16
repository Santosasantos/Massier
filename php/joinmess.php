<?php
include 'connect.php';
session_start();

$mess_id = $_POST['mess_id'];

echo $_SESSION['login_info']['email'];

if (isset($_SESSION['login_info']['email'])) {
   $member= $_SESSION['login_info']['email'];

  
   //add memeber to mess member list

   $query = "INSERT INTO `mess_members`(`mess_id`, `email`, `role`) VALUES ('$mess_id','$member','member')";
   $result = mysqli_query($conn, $query);

   if($result){
   $_SESSION['mess_info']['mess_id']=$mess_id;

   header("Location: ../html/homepage_html.php");
   exit();
   }

   else{
    header("Location: ../html/newuser_html.php");
 }

}
else{
   header("Location: ../html/newuser_html.php");
}


?>