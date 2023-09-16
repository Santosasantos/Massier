<?php
include 'connect.php';

// session_start();
$dateArray = array(); 
$mealRateArray = array(); 
$startOfMonth = date('Y-m-01'); 
$endOfMonth = date('Y-m-t'); 
$mess_id = $_SESSION['mess_info']['mess_id'];

// Loop through each day of the month
$currentDate = $startOfMonth;
while ($currentDate <= $endOfMonth) {
    
    $query_total_expenses = "SELECT SUM(`amount`) AS total_amount
        FROM `expense`
        WHERE `date_of_req` BETWEEN '$startOfMonth' AND '$currentDate'
        AND `mess_id` = '$mess_id'
        AND `status` = 'approved'";
    
    $result_total_expenses = mysqli_query($conn, $query_total_expenses);

    
    $query_total_meals = "SELECT SUM(`lunch`) + SUM(`breakfast`) + SUM(`dinner`) AS total_meals
        FROM `meal`
        WHERE `date` BETWEEN '$startOfMonth' AND '$currentDate'
        AND `mess_id` = '$mess_id'";
    
    $result_total_meals = mysqli_query($conn, $query_total_meals);

    // Fetch the results
    $row_expenses = mysqli_fetch_assoc($result_total_expenses);
    $row_meals = mysqli_fetch_assoc($result_total_meals);

    // Calculate the meal rate for the current day
    if ($row_expenses['total_amount'] > 0 && $row_meals['total_meals'] > 0) {
        $mealRate = $row_expenses['total_amount'] / $row_meals['total_meals'];
        $formattedDate = date('d-M', strtotime($currentDate)); // Format date as "dd-Mon"
        
        // Store the date in $dateArray and the meal rate in $mealRateArray
        $dateArray[] = $formattedDate;
        $mealRateArray[] = number_format($mealRate, 2);
    } else {
    
        $formattedDate = date('d-M', strtotime($currentDate)); 
        
        
        $dateArray[] = $formattedDate;
        $mealRateArray[] = 0;
    }

    // Move to the next day
    $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
}

?>
