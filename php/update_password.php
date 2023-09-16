<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php

    require('connect.php');
  
    if(isset($_GET['email']) && isset($_GET['reset_token'])){
       
        $email=$_GET['email'];
        $reset_token=$_GET['reset_token'];
        date_default_timezone_set('Asia/Dhaka');

        $date = date('y-m-d');

        $query = "SELECT * FROM user WHERE email = '$email' AND reset_token = '$reset_token' AND reset_expire = '$date'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            echo "
            <div class='login-text'>
            <h2>Welcome again to Massier</h2>
          </div>
          <div class='login-box'>
            <h2 id='txt'>Password Reset</h2>
        
            <form id='password-reset-form' method='POST'>
            <div class='user-box'>
            <input type='password' name='new_password' required=''>
            <label>New password</label>
            </div>
            <input class='submit' type='submit' name='reset_pass' value='Reset'>
            <input  type='hidden' name='email' value='$email'>

            </form>
            </div>

            ";
        }
        else{
            echo "<p class='invalid'>Invalid or expire link</p>
                  <a class='invalid'  href='../html/login_html.php'>Try again? Login</a>";
        }

    }
    ?>

    <?php
    if(isset($_POST['reset_pass'])){
    
        $email = $_POST['email'];
        $password = $_POST['new_password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
       $sql = "UPDATE `user` SET `password`='$hashedPassword' WHERE `email`='$email'";
        
       if ($conn->query($sql)=== true) {
        ob_clean();

        echo "<link rel='stylesheet' href='../css/login.css'>
              <p class='invalid'>congratulations! Your password successfully reset</p>
              <a class='invalid'  href='../html/login_html.php'>Login in now</a>";
        
    }
    else{
        echo "<p class='invalid'>Password can't be reset</p>
        <a class='invalid'  href='../html/login_html.php'>Try again? Login</a>";
    }

    }
    ?>

</body>
</html>