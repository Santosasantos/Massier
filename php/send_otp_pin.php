<?php
 include 'connect.php';
 include 'connect_demo.php';

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

    $email = $_SESSION['login_info']['email'];

    $query = "SELECT * FROM `user` WHERE `email` = '$email' ";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        $otp=rand(100000, 999999);
        date_default_timezone_set('Asia/Dhaka');
        $date = date('y-m-d');
        $name=$row['name'];
     
        $query = "UPDATE `user_demo` SET `verify_otp`='$otp',`verify_expire`='$date' WHERE `email` = '$email' ";
        $result = mysqli_query($conn1, $query);

        if($result){
            sentMail($email,$otp,$name);
        }
        else "Server error";
    }
    else{
        echo "invalid email";  
    }

    function sentMail($email,$otp,$name){
        
        require('PHPMailer/PHPMailer.php');
        require('PHPMailer/SMTP.php');
        require('PHPMailer/Exception.php');
       
        $mail = new PHPMailer(true);

    //Server settings
      try{        
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'massier.messmate@gmail.com';                     //SMTP username
    $mail->Password   = 'iavxoeofknocfjkk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    //Recipients
    $mail->setFrom('user.massier@gmail.com', 'Massier');
    $mail->addAddress($email, 'User');    

    //Content 
    //otp verify
    $mail->isHTML(true);                                  
    $mail->Subject = 'Email Verification OTP';
    $mail->Body    = "Hi,$name<br>
                      Your email verification<br>
                      OTP id <strong>$otp</strong>
    <br><br>Nb: The otp will expire soon";

    $mail->send();
   
    header("Location: ../html/verify_email_html.php");
    exit();



 } catch (Exception $e) {
    
 }

// // otp 
 }

?>
