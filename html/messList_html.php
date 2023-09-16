<?php
session_start();
if (!isset($_SESSION['login_info'])) {
  header("Location: login_html.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mess List</title>
  <link rel="stylesheet" href="../css/newuser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
  <script src="../js/login.js"></script>
</head>

<body>
  <div class="login-text">
    <h2>Hi, <?php

            echo $_SESSION['login_info']['name']; ?></h2>
  </div>
  <div id="txth4">Here is your joined mess</div>
  <div class="login-box">
    <h2 id="txt">Select mess to join</h2>
    <form id="join-form" action="../php/messList.php" method="POST">

      <div class="user-box">
        <?php
        require("../php/connect.php");

        $messNameArr = array();
        $messIdArr = array();
        $myRole = array();

        $email = $_SESSION['login_info']['email'];

        // Find members
        $query = "SELECT * FROM `mess_members` AS mm INNER JOIN `mess` AS m ON mm.mess_id = m.mess_id WHERE mm.email = '$email'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $messName[] = $row['mess_name'];
          $messIdArr[] = $row['mess_id'];
          $myRole[] = $row['role'];
        }
        ?>

        <select name="mess_Id" required="">
          <?php foreach ($messIdArr as $i => $ix) : ?>
            <option value="<?php echo $messIdArr[$i]; ?>"><?php echo $messName[$i]; ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="user-box">
        <p onclick="window.location.href = 'newuser_html.php';">Want to Add a new mess?</p>
      </div>



      <input class="submit_mess" type="submit" value="Join">
      <form>
    <a href="logout.php">
    <input class="submit_mess" style="margin-left: 85px;" type="button" value="Logout">
    </a>
    </form>

    </form>
  </div>

</body>

</html>