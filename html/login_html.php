<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Massier Login</title>
  <link rel="stylesheet" href="../css/login.css">
  <script src="../js/login.js"></script>

  <script src="../js/snackbar.js"></script>
  <link rel="stylesheet" href="../css/snackbar.css">

</head>
<?php require("../php/login.php"); ?>

<body <?php if (isset($_GET['login_error']) && $_GET['login_error'] == 1) {

        echo 'onload="myFunction()"';
      } elseif (isset($_GET['login_error']) && $_GET['login_error'] == 2) {
        echo 'onload="myFunction1()"';
      }
      elseif (isset($_GET['login_error']) && $_GET['login_error'] == 3) {
        echo 'onload="myFunction2()"';
      }
      ?>>

  <div class="login-text" action="login.php" method="POST">
    <h2>Welcome to Massier</h2>
  </div>
  <div class="login-box">
    <h2 id="txt">Login</h2>


    <form id="login-form" action="../php/login.php" method="POST">
      <div class="user-box">
        <input type="text" id="email" name="login_email" required="">
        <label>Email</label>
      </div>
      <div class="user-box">
        <input type="password" id="password" name="login_password" required="">
        <label>Password</label>
      </div>
      <!-- Sign up link -->
      <div class="user-box">
        <p onclick="showSignUpForm()">Don't have an account? Sign Up</p>
        <a onclick="showPassResetForm()">Password Reset</a>
      </div>
      <!-- Login button -->

      <input class="submit" id="login" type="submit" name="submit" value="Log in">
    </form>

    <form id="signup-form" style="display:none;" action="../php/signup.php" method="POST">
      <!-- Sign up fields -->
      <div class="user-box">
        <input type="text" name="fullname" required="">
        <label>Name</label>
      </div>
      <div class="user-box">
        <input type="email" name="email" required="">
        <label>Email Address</label>
      </div>

      <div class="dob">
        <p>Date of birth</p>
        <input type="date" name="dob" required="">
      </div>

      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <!-- Login link -->
      <div class="user-box">
        <p onclick="showLoginForm()">Already have an account? Log in</p>
      </div>
      <!-- Sign up button -->
      <input class="submit" type="submit" name="submit" value="Sign up">
    </form>


    <form id="password-reset-form" style="display:none;" action="../php/password_reset.php" method="POST">
      <div class="user-box">
        <input type="text" name="reset_email" required="">
        <label>Email</label>
      </div>

      <!-- Sign up link -->
      <div class="user-box">
        <p onclick="showLoginForm()">Already have an account? Log in</p>

      </div>
      <!-- Login button -->
      <input class="submit" type="submit" name="submit" value="Reset">
    </form>


  </div>

  <div id="snackbar" class="snackbar">
    Wrong email or password
  </div>

  <div id="snackbar1" class="snackbar">
    This email already registered<br>
    Please Login
  </div>

  <div id="snackbar2" class="snackbar">
   Please verify your email
  </div>

</body>

</html>