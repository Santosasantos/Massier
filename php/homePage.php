<?php

include 'connect.php';
$email=$_SESSION['login_info']['email'];
$mess_id=$_SESSION['mess_info']['mess_id'];

 echo $mess_id;

 //find user info
 $query = "SELECT * FROM `user` WHERE `email` = '$email' ";
 $result = mysqli_query($conn, $query);

 if(mysqli_num_rows($result) > 0){
     $row = mysqli_fetch_assoc($result);
     $_SESSION['login_info']= $row;
}


//find role
$query = "SELECT `role` FROM `mess_members` WHERE `email`='$email' AND `mess_id`='$mess_id'";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $_SESSION['role'] = $row['role'];
   
}



$query = "SELECT * FROM `mess_members` WHERE `email`='$email' ";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);

    $query = "SELECT * FROM `mess` WHERE `mess_id` = '$mess_id' ";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    //session
    $_SESSION['mess_info']=$row; 
    }
}

$mess_name=$_SESSION['mess_info']['mess_name'];
$name=$_SESSION['login_info']['name'];
$role=$_SESSION['role'];


?>