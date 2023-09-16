<?php
 include 'connect.php';
 session_start();

$mess_id=$_SESSION['mess_info']['mess_id'];
$email=$_SESSION['login_info']['email'];


if(isset($_POST['submit'])){

    $date = $_POST['date'];
    $breakfast =$_POST['meal_no_b'];
    $lunch =$_POST['meal_no_l'];
    $dinner =$_POST['meal_no_d'];

    //validate inputs
    $date = mysqli_real_escape_string($conn, $date);
    $breakfast = mysqli_real_escape_string($conn, $breakfast);
    $lunch = mysqli_real_escape_string($conn, $lunch);
    $dinner = mysqli_real_escape_string($conn,  $dinner);
    //

    //check if meal submitted or not
    $query="SELECT * FROM `meal` WHERE `date`='$date' AND `mess_id`='$mess_id' AND `email`='$email' ";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){

        $query1="SELECT * FROM `meal` WHERE `date`='$date' AND `mess_id`='$mess_id' AND `email`='$email' AND `status`='approved' ";
        $result1 = mysqli_query($conn, $query1);

        if(mysqli_num_rows($result1) > 0){
            //could not be updated
            header("Location: ../html/meal_html.php?msg=3");
            exit();
        }
        else{
        $query = " UPDATE `meal` SET `breakfast`='$breakfast',`lunch`='$lunch',`dinner`='$dinner',`manager`='$manager' WHERE `date`='$date' AND `mess_id`='$mess_id' AND `email`='$email' ";
        $result = mysqli_query($conn, $query);
        //request updated
        header("Location: ../html/meal_html.php?msg=2");
        exit();
    }

    }
    else{
        $query = " INSERT INTO `meal`(`date`, `mess_id`, `email`, `breakfast`,`lunch`, `dinner`, `status`) VALUES ('$date','$mess_id','$email','$breakfast','$lunch','$dinner','pending') ";
        $result = mysqli_query($conn, $query);
        //meal set
        header("Location: ../html/meal_html.php?msg=1");
        exit();
    }

}


if(isset($_POST['default_meal'])){
    if(isset($_COOKIE['meal'])){
    
    }
    else{
        $default= array('breakfast' => $breakfast, 'lunch' => $lunch, 'dinner' => $dinner, 'set'=>1);
        $default_meal = serialize($default);
        setcookie("meal",$default_meal,time()+86400*30,"/");
        echo 'set';
    }

}
else{
    if(isset($_COOKIE['meal'])){
       
        setcookie("meal", "", time() - 3600, "/");
        echo 'removed';
        
    }
}


 ?>