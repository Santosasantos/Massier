<?php

include 'connect.php';
session_start();

$lunch =array();
$breakfast =array();
$dinner =array();
$email=array();
$status=array();
$date=date("Y-m-d");

if(isset($_POST['add_meal'])){
    
$breakfast = $_POST['br'];
$lunch =$_POST['ln'];
$dinner =$_POST['dr'];

$status=$_POST['st'];

$email=$_POST['mail'];
$mess_id=$_SESSION['mess_info']['mess_id'];

foreach ($email as $i => $mail) {
    echo $status[$i];
    if($status[$i]==='approved'){
     $sql = "UPDATE `meal` SET`breakfast`='$breakfast[$i]',`lunch`='$lunch[$i]',`dinner`='$dinner[$i]',`status`='approved' WHERE `email`='$email[$i]' AND `mess_id`='$mess_id' AND `date`='$date' ";
     $result = mysqli_query($conn, $sql);
    }
    else{
       
     $sql =  "SELECT * FROM `meal` WHERE `date`='$date'  AND `mess_id`=$mess_id AND `email`='$email[$i]'";
     $result = mysqli_query($conn, $sql);

     $row_no=mysqli_num_rows($result);
     echo $row_no;

     if($row_no === 0){
        $sql = " INSERT INTO `meal`(`date`, `mess_id`, `email`, `breakfast`, `lunch`, `dinner`,`status`) VALUES 
        ('$date','$mess_id','$email[$i]','$breakfast[$i]','$lunch[$i]','$dinner[$i]','approved')";
         $result = mysqli_query($conn, $sql);
     }
     else{
      
         $sql = "UPDATE `meal` SET`breakfast`='$breakfast[$i]',`lunch`='$lunch[$i]',`dinner`='$dinner[$i]',`status`='approved' WHERE `email`='$email[$i]' AND `mess_id`='$mess_id' AND `date`='$date' ";
        $result = mysqli_query($conn, $sql);
     }
      

    }
}

    header("Location: ../html/meal_manager_html.php");
    exit; 
}






?>