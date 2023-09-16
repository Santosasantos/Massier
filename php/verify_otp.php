
    <?php

    require('connect_demo.php');
    require('connect.php');

  
    if(isset($_POST['Verify'])){
        session_start();
        
        $email=$_SESSION['login_info']['email'];
        
        //$role=$_SESSION['role_ck'];

        $otp=$_POST['otp'];

        date_default_timezone_set('Asia/Dhaka');
        $date = date('y-m-d');

        $query = "SELECT * FROM user_demo WHERE email = '$email' AND verify_otp = '$otp' AND verify_expire = '$date'";
        $result = mysqli_query($conn1, $query);

        if($result){

        if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        $name=$row['name'];
        $dob=$row['dob'];
        
        $login_token=bin2hex(random_bytes(32));
       

          // insert into main dbase
             $query = "INSERT INTO `user`(`email`, `password`, `dob`, `name`, `login_token`) VALUES ('$email','$hashedPassword','$dob','$name','$login_token');";
             $result = mysqli_query($conn, $query);
            
             if($result){
             setcookie("login_token",$login_token, time() + (86400 * 365), "/");

            // check the member join a mess or not
             $query = "SELECT * FROM `mess_members` WHERE `email`='$email'";
             $result = mysqli_query($conn, $query);
     
             if($result){
             if(mysqli_num_rows($result) > 0){
                header("Location: ../html/messList_html.php");
                //header("Location: ..//html/homepage_html.php");
                exit();
            }
            else{
                header("Location: ../html/newuser_html.php");
                exit();
            }
        }

               
             }
             else{
                header("Location: ../html/verify_email_html.php?otp_error=1");
                exit();

             }

        }
        else{
            header("Location: ../html/verify_email_html.php?otp_error=2");
            exit();
        }

    }}
    else{
        header("Location: ../html/verify_email_html.php?otp_error=1");
        exit();
    }
    
    ?>