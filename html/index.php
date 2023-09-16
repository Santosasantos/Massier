<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    include '../php/connect.php';

    if (isset($_COOKIE['login_token'])) {

        $token = $_COOKIE['login_token'];

        $query = "SELECT * FROM `user` WHERE `login_token`='$token'";
        $result = mysqli_query($conn, $query);

        echo $token;
        echo mysqli_num_rows($result);

        if ($row = mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            session_start();

            $_SESSION['login_info'] = $row;
            $email = $_SESSION['login_info']['email'];

            //check joined mess
            $query = "SELECT * FROM `mess_members` WHERE `email`='$email'";
            $result = mysqli_query($conn, $query);

            echo mysqli_num_rows($result);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    header("Location: messList_html.php");
                    exit();
                } else {
                    header("Location: newuser_html.php");
                    exit();
                }
            }


            //


        } else {

            header("Location: login_html.php");
        }
    } else {
        header("Location: login_html.php");
    }






    ?>

</body>

</html>
