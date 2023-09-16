<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verify email</title>
  <link rel="stylesheet" href="../css/newuser.css">
  <script src="../js/login.js"></script>

  <link rel="stylesheet" href="../css/snackbar.css">
  <script src="../js/snackbar.js"></script>

</head>

<body <?php if (isset($_GET['otp_error']) && $_GET['otp_error'] == 1) {

        echo 'onload="myFunction()"';
      } elseif (isset($_GET['otp_error']) && $_GET['otp_error'] == 2) {
        echo 'onload="myFunction1()"';
      }
      ?>>
  <div class="login-text">
    <h2>Hi, Username</h2>
  </div>
  <div id="txth4">Please check you inbox for OTP</div>
  <div class="login-box">
    <h2 id="txt">Verify email</h2>
    <form id="join-form" action="../php/verify_otp.php" method="POST">
      <div class="user-box">
        <input type="number" name="otp" required="">
        <label>OTP</label>
      </div>

      <div class="user-box">
        <!-- <p href="/php/send_otp.php">Didn't get OTP? Resend</p> -->
      </div>

      <input class="submit_mess" type="submit" name="Verify" value="Verify">
    </form>


  </div>

  <div id="snackbar" class="snackbar">
    Network error please try again
  </div>

  <div id="snackbar1" class="snackbar">
    OTP doesn't match<br>
    Please try again
  </div>

</body>

</html>