<?php
include 'connect.php';

$emailArr = array();
$nameArr = array();
$monthArr = array('January', 'February', 'March', 'August');
$naameAr = array();
$balanceArr = array();

// Find members
$query = "SELECT * FROM `mess_members` WHERE `mess_id`='$mess_id' ";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $emailArr[] = $row['email'];
}

foreach ($emailArr as $email) {

    $query = "SELECT `name` FROM `user` WHERE `email`='$email' ";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);
    $nameArr[$email] = $row['name'];
    $naameAr[] = $row['name'];

    //calculate the balance for each member
    $query_balance = "SELECT SUM(`amount`) AS total_amount
    FROM `balance`
    WHERE `date` BETWEEN '$start_date' AND '$end_date'
      AND `email` = '$email'
      AND `mess_id` = '$mess_id'
      AND `balance_type` = 'meal'
    GROUP BY `email`, `mess_id`, `balance_type`";

    $result_balance = mysqli_query($conn, $query_balance);

    if (mysqli_num_rows($result_balance) > 0) {
        $row_balance = mysqli_fetch_assoc($result_balance);
        $balanceArr[] = $row_balance['total_amount'];
    } else {
        // If there are no balance records for this member, set their balance to 0
        $balanceArr[] = 0;
    }
}
?>
