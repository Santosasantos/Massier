<?php 
    
    include 'connect.php';
    include 'connect_demo.php';


    if(isset($_POST['submit'])){

        $email = $_POST['login_email'];
        $password =$_POST['login_password'];


        $email = mysqli_real_escape_string($conn, $email);
        $password  = mysqli_real_escape_string($conn, $password );
        

        $query = "SELECT * FROM `user` WHERE `email` = '$email' ";
        echo $query;
        $result = mysqli_query($conn, $query);


         if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

         if(password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['login_info']=$row;

            $login_token=bin2hex(random_bytes(32));
    
            // update into main login token
               $query = " UPDATE `user` SET `login_token`='$login_token' WHERE  `email`='$email' ";
               $result = mysqli_query($conn, $query);
              
                if($result){
                setcookie("login_token",$login_token, time() + (86400 * 365), "/");
                
  
            //   // check the member join a mess or not
               $query = "SELECT * FROM `mess_members` WHERE `email`='$email'";
               $result = mysqli_query($conn, $query);

               if($result){
        
                if(mysqli_num_rows($result) > 0){
             

                   header("Location: ../html/messList_html.php");
                  
                   exit();
                }
                   else{
                    header("Location: ../html/newuser_html.php");
                    exit();
                }

                }
              
                }
            }

            else{
                header("Location: ../html/login_html.php?login_error=1");
                exit();
            }


         } 
             else {

                $query = "SELECT * FROM `user_demo` WHERE `email` = '$email' ";
                $result = mysqli_query($conn1, $query);
            
                if(mysqli_num_rows($result) > 0){ 
                    header("Location: ../html/login_html.php?login_error=3");
                exit();
                }
                else{
                    header("Location: ../html/login_html.php?login_error=1");
                    exit();
                }

          } 

        
    }
    else{ 
    
    }

?>