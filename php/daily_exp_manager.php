<?php
include 'connect.php';

$mess_id = $_SESSION['mess_info']['mess_id'];
// today's date
$date = date("Y-m-d");

$query = "SELECT mm.`email`, ua.`name`
          FROM `mess_members` mm
          JOIN `user` ua ON mm.`email` = ua.`email`
          WHERE mm.`mess_id`='$mess_id'";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $messMemberNameArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $email = $row['email'];
        $name = $row['name'];
        $messMemberNameArray[$email] = $name;
    }

    $items = array();
    $prices = array();
    $exp_ids = array();
    $status = array();
    $emails = array();

    $query = "SELECT * FROM `expense` WHERE `mess_id`='$mess_id' AND `date_of_req`='$date'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $items[] = $row['description'];
            $prices[] = $row['amount'];
            $exp_ids[] = $row['exp_id'];
            $status[] = $row['status'];
            $emails[] = $row['email'];
        }
    }
}
?>
