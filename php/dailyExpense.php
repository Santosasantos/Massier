<?php
 include 'connect.php';
 session_start();

$item=array();
$price=array();
if(isset($_POST['submit_exp'])){

   $date=date("Y-m-d");
   $email=$_SESSION['login_info']['email'];
   $mess_id=$_SESSION['mess_info']['mess_id'];
   

   if(isset($_POST['price'])){

   $item=$_POST['item'];
   $price=$_POST['price'];

   
   foreach ($price as $i => $pr) { 

    $query = "SELECT MAX(exp_id) FROM expense";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $expId = $row['MAX(exp_id)']; 
        $newExpId = $expId + 1;     
    } 
    else{
        $newExpId=0;
    }

    $sql = "INSERT INTO `expense`(`exp_id`, `date_of_req`, `amount`, `description`, `status`, `email`, `mess_id`) VALUES ('$newExpId','$date','$price[$i]','$item[$i]','pending','$email','$mess_id')";
    $result_1 = mysqli_query($conn, $sql);

   }

   if($result_1){
    header("Location: ../html/dailyexpense_html.php?msg=1");
    exit();
}
else{
    header("Location: ../html/dailyexpense_html.php?msg=2");
    exit();
}

   }
   else{
    header("Location: ../html/dailyexpense_html.php?msg=3");
    exit();
   }

}

?>