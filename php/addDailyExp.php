<?php

include 'connect.php';
session_start();

$today=date("Y-m-d");

$items = array();
$prices = array();
$exp_ids = array();
$emails = array();
$status = array();

// $manager = $_SESSION['manager'];


if (isset($_POST['add_meal'])) {

    $items = $_POST['item'];
    $prices = $_POST['price'];
    $exp_ids = $_POST['exp_id'];
    $date = $_POST['date'];
    $status = $_POST['st'];
    $emails = $_POST['mail'];

    $mess_id = $_SESSION['mess_info']['mess_id'];


    foreach ($emails as $i => $mail) {

        
       // echo $status[$i].$prices[$i].$items[$i].$exp_ids[$i];
        

        if ($status[$i] == "pending") {
            $sql = "UPDATE `expense` SET `date_of_approve`='$today',`amount`='$prices[$i]',`description`='$items[$i]',`status`='approved' WHERE `exp_id`='$exp_ids[$i]'";
            $result = mysqli_query($conn, $sql);
        }
       
    }

  exit;

}
 header("Location: ../html/dailyExpenseManager_html.php");
exit();
?>
