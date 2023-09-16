<?php 
    include 'connect.php';
   

    $email = $_SESSION['login_info']['email'];
    $mess_id=$_SESSION['mess_info']['mess_id'];

 
    $start_date ='2023-09-01';
    $end_date = '2023-09-30'; 
    

    $breakfastArr=array();
    $lunchArr=array();
    $dinnerArr=array();
    $dateArr=array();

    

    //find meal 
    $query = "SELECT * FROM `meal` WHERE `email` = '$email' AND `mess_id` = '$mess_id' AND `status` = 'approved' AND `date` BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);
    

    while ($row = mysqli_fetch_assoc($result)) {
        $dateArr[]= $row['date'];
        $breakfastArr[]= $row['breakfast'];
        $lunchArr[]= $row['lunch'];
        $dinnerArr[]=$row['dinner'];

    }

?>




    




