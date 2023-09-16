<?php

include 'connect.php';
session_start();

$dateArr =array();
$emailArr =array();
$itemArr =array();
$priceArr=array();
$idAr=array();

if(isset($_POST['correction'])){

    $dateArr =$_POST['dte'];
    $emailArr =$_POST['em'];
    $itemArr =$_POST['it'];
    $priceArr=$_POST['pr'];
    $idAr=$_POST['id'];

$email=$_POST['mail'];
$mess_id=$_SESSION['mess_id'];

  
foreach ($dateArr as $i => $datei) {



     $sql="UPDATE `expense` SET `date_of_req`='$dateArr[$i]',`mess_id`='$mess_id',`email`='$email',`description`='itemArr[$i]',`amount`='$priceArr[$i]'  WHERE `exp_id`='$idAr[$i]'";
     $result = mysqli_query($conn, $sql);

 
}

header("Location: ../html/daily_exp_manager_details.php");
 exit();

}

?>





