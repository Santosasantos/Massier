<?php
 include 'connect_demo.php';

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\SMTP;
   use PHPMailer\PHPMailer\Exception;

    $email = $_SESSION['login_info']['email'];

    $query = "SELECT * FROM `user_demo` WHERE `email` = '$email' ";
    $result = mysqli_query($conn1, $query);

    $cmd_output = shell_exec('ipconfig');
preg_match_all('/IPv4 Address[^:]+:\s+([^\r\n]+)/', $cmd_output, $matches);
$localIP = isset($matches[1][0]) ? trim($matches[1][0]) : "Not Found";


    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        $otp=rand(100000, 999999);
        date_default_timezone_set('Asia/Dhaka');
        $date = date('y-m-d');
        $name=$row['name'];
     
        $query = "UPDATE `user_demo` SET `verify_otp`='$otp',`verify_expire`='$date' WHERE `email` = '$email' ";
        $result = mysqli_query($conn1, $query);

        if($result){
            sentMail($email,$otp,$name,$localIP);
        }
        else "Server error";
    }
    else{
        echo "invalid email";  
    }

    function sentMail($email,$otp,$name,$localIP){
        
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
// localhost

$mail->isHTML(true);                                  
$mail->Subject = 'Email verification';
$mail->Body    = "Hi,$name<br>

                  Please click here to verify email<br>
<a href=' http://$localIP/massier/php/verify_otp_link.php?email=$email&otp=$otp'>verify email</a><br>
<br>Nb: The link will expire soon
";

$mail->send();
echo "<link rel='stylesheet' href='../css/login.css'>
<p class='invalid'>Your email verification link has been sent<br>
please check your inbox
</p>
<a class='invalid'  href='../html/login_html.php'>Try again ? Login</a>";
} catch (Exception $e) {

"<link rel='stylesheet' href='../css/login.css'>
<p class='invalid'>Could not sent mail<br> </p>
<a class='invalid'  href='../html/login_html.php'>Try again ? Login</a>";
}
}




?>
