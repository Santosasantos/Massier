<?php
include 'connect.php';
include 'calculation.php';

if (isset($_SESSION['selected_email'])) {
    $email = $_SESSION['selected_email'];
} else {
    $email = $_SESSION['login_info']['email'];
}

$start_date = date('Y-m-d', strtotime('2023-09-01'));
$end_date = date('Y-m-d', strtotime('2023-09-30'));

$startOfMonth = date('Y-m-01');
$endOfMonth = date('Y-m-t');

$today = date('y-m-d');

$mess_id = $_SESSION['mess_info']['mess_id'];
$costTypes = array();
$costAmounts = array();

$dateArray = array();
$mealCountArray = array();

$query = "SELECT `type`, SUM(`amount`) AS total_amount
          FROM `cost`
          WHERE `mess_id` = '$mess_id'
          AND `date` BETWEEN '$start_date' AND '$end_date'
          GROUP BY `type`";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $costTypes[] = $row['type'];
        $costAmounts[] = $row['total_amount'];
    }
}

$currentDate = $startOfMonth;
while ($currentDate <= $endOfMonth) {

    $query_total_meals = "SELECT SUM(`lunch`) + SUM(`breakfast`) + SUM(`dinner`) AS total_meals
        FROM `meal`
        WHERE `date` = '$currentDate'
        AND `email`='$email'
        AND `mess_id` = '$mess_id'";

    $result_total_meals = mysqli_query($conn, $query_total_meals);

    $row_meals = mysqli_fetch_assoc($result_total_meals);

    // Calculate the meal rate for the current day
    if ($row_meals['total_meals'] > 0) {
        $formattedDate = date('d-M', strtotime($currentDate)); 
        $dateArray[] = $formattedDate;
        $mealCountArray[] = (int)$row_meals['total_meals'];
    } else {
        $formattedDate = date('d-M', strtotime($currentDate));

        // Store the date in $dateArray and 0 in $mealCountArray
        $dateArray[] = $formattedDate;
        $mealCountArray[] = 0;
    }

    // Move to the next day
    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
}

// Close the database connection
mysqli_close($conn);
?>
