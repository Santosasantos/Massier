<?php

include 'connect_demo.php';
include 'connect.php';

  
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $dob=$_POST['dob'];

        $fullName= mysqli_real_escape_string($conn1, $fullName);
        $email  = mysqli_real_escape_string($conn1, $email );
        $password= mysqli_real_escape_string($conn1, $password );
      
        // check email on dbase 
        $sql= "SELECT * FROM `user` WHERE `email`='$email'";
        if ($conn->query($sql)=== true) {
          header("Location: ../html/login_html.php?login_error=2");
        exit();
        }
        else{
       $sql = "INSERT INTO user_demo(`email`, `password`, `dob`,`name`) VALUES ('$email', '$hashedPassword','$dob','$fullName')";
       
       if ($conn1->query($sql)=== true) {
       $query = "SELECT * FROM `user_demo` WHERE `email` = '$email' ";

       $result = mysqli_query($conn1, $query);

       if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        session_start();

        $_SESSION['login_info']=$row;
        
        include 'send_otp.php';

      }
      else{
        header("Location: ../html/login_html.php?login_error=2");
        exit();
      }
            
          
    }else{
        header("Location: ../html/login_html.php?login_error=2");
        exit();
    }
  }
?>