<?php
include 'connect.php';

$mess_id= $_SESSION['mess_info']['mess_id'];
//today date
$date = date("Y-m-d");


$query = "SELECT mm.`email`, ua.`name`
          FROM `mess_members` mm
          JOIN `user` ua ON mm.`email` = ua.`email`
          WHERE mm.`mess_id`='$mess_id'";

$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0){
    $messMemberNameArray = array();
    $breakfast=array();
    $lunch=array();
    $dinner=array();
    $status=array();


    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        $name = $row['name'];
        $messMemberNameArray[$email] = $name;
    }

    foreach ($messMemberNameArray as $email => $name) {
        $query = "SELECT * FROM `meal` WHERE `date`='$date' AND `mess_id`= '$mess_id' AND `email`='$email'";
        $result = mysqli_query($conn, $query);

        $mealArray = array();

        if(mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)) {
            
                $breakfast[$email]=$row['breakfast'];
                $lunch[$email]=$row['lunch'];
                $dinner[$email]=$row['dinner'];
                $status[$email]=$row['status'];

            } 

        }
        

    }

}




?>