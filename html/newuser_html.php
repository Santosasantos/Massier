<?php
session_start();
if (!isset($_SESSION['login_info'])) {
  header("Location: login_html.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Massier Login</title>
  <link rel="stylesheet" href="../css/newuser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <script src="../js/login.js"></script>


</head>

<body>

  <div class="login-text">
    <h2>Hi, <?php

            echo $_SESSION['login_info']['name']; ?></h2>
  </div>
  </div>
  <!-- <div id="txth4">You can join an existing mess</div> -->
  <div class="login-box">
    <h2 id="txt">Join a mess</h2>
    <form id="join-form" action="../php/joinmess.php" method="POST">
      <div class="user-box">
        <input type="text" name="mess_id" required="">
        <label>Mess ID</label>
      </div>

      <div class="user-box">
        <p onclick="CreateMessForm()">Want to create new mess?</p>
      </div>

      <input class="submit_mess" type="submit" value="Join">

    <form>
    <a href="logout.php">
    <input class="submit_mess" style="margin-left: 85px;" type="button" value="Logout">
    </a>
    </form>


    </form>

  


    <form id="create-form" style="display:none;" action="../php/createmess.php" method="POST">
      <div class="user-box">
        <input type="text" name="mess_name" required="">
        <label>Mess name</label>
      </div>
      <div class="user-box">
        <input type="text" name="mess_address" required="">
        <label>Address</label>
      </div>


      <div class="user-box">
        <p onclick="joinMessForm()">Want to join existing mess?</p>
      </div>

      <input class="submit_mess" type="submit" value="Create">
     
      <form>
    <a href="logout.php">
    <input class="submit_mess" style="margin-left: 45px;" type="button" value="Logout">
    </a>
    </form>

    </form>

  </div>


</body>

</html>