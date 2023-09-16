<?php

 include 'connect.php';
 session_start();

 $mess_name = $_POST['mess_name'];
 $mess_address =$_POST['mess_address'];
 

 if (isset( $_SESSION['login_info']['email'])) {
    $manager= $_SESSION['login_info']['email'];

    //generate mess id
    $query = "SELECT MAX(mess_id) FROM mess";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastMessId = $row['MAX(mess_id)']; 
        $newMessId = $lastMessId + 1;     
    } 
    else{
        $newMessId=0;
    }
    

    //create mess
    $query = "INSERT INTO `mess`(`mess_id`, `mess_name`, `address`) VALUES ('$newMessId','$mess_name','$mess_address') ";
    $result = mysqli_query($conn, $query);

    $_SESSION['mess_info']['mess_id']=$newMessId;


   //add manager to mess member list
    $query = "INSERT INTO `mess_members`(`mess_id`, `email`, `role`) VALUES ('$newMessId','$manager','manager');";
    $result = mysqli_query($conn, $query);

     //change role as manager

    $date=date('y-m-d');

    $query = "SELECT MAX(manager_id) FROM manages";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $lastManagersId = $row['MAX(manager_id)']; 
        $newManagersId = $lastManagersId + 1;     
    } 
    else{
        $newManagersId=0;
    }

   
    $query = "INSERT INTO `manages`(`manager_id`, `mess_id`, `email`, `starting_date`) VALUES ('$newManagersId','$newMessId','$manager','$date')";
    $result = mysqli_query($conn, $query);

    header("Location: ../html/homepage_html.php");
    exit();
 }
else{
    header("Location: ../html/newuser_html.php");
}
 

?>