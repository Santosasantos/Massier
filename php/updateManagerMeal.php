<?php

include 'connect.php';
session_start();

$lunch =array();
$breakfast =array();
$dinner =array();
$date=array();
$email=array();

if(isset($_POST['correction'])){

$breakfast = $_POST['br'];
$lunch =$_POST['ln'];
$dinner =$_POST['dr'];
$date=$_POST['dte'];

$email=$_POST['mail'];
$mess_id=$_SESSION['mess_info']['mess_id'];

  
foreach ($date as $i => $datei) {

    $sql = "UPDATE `meal` SET `breakfast`='$breakfast[$i]', `lunch`='$lunch[$i]', `dinner`='$dinner[$i]', `status`='approved' WHERE `email`='$email' AND `mess_id`='$mess_id' AND `date`='$date[$i]'";
    $result = mysqli_query($conn, $sql);

}

header("Location: ../html/meal_manager_html.php");
 exit;

}

?>





