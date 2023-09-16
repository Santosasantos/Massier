<?php
include 'connect.php';
//central meal calculation

if(isset($_SESSION['selected_email'])){
  $email=$_SESSION['selected_email'];


$start_date=date('Y-m-d',strtotime('2023-09-01'));
$end_date=date('Y-m-d',strtotime('2023-09-30'));
$today=date('y-m-d');

$total_meal=0;
$total_daily_exp=0;
$meal_rate=0;
$total_deposite_meal=0;
$total_deposite_month=0;
$manager_balance_meal=0;
$manager_balance_month=0;
$total_cost_from_other=0;

$mess_id=$_SESSION['mess_info']['mess_id'];



//find total meal
$query_meal="SELECT `mess_id`,
        SUM(`lunch`) + SUM(`breakfast`) + SUM(`dinner`) AS total_meals
        FROM `meal`
        WHERE `date` BETWEEN '$start_date' AND '$end_date'
        AND `mess_id` = '$mess_id'
        GROUP BY `mess_id`";

$result = mysqli_query($conn, $query_meal);
 if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$total_meal=$row['total_meals'];
 }

 //find total meal
$query_bazar="SELECT `mess_id`,
`status`,
SUM(`amount`) AS total_amount
FROM `expense`
WHERE `date_of_req` BETWEEN '$start_date' AND '$end_date'
AND `mess_id` = '$mess_id'
AND `status` = 'approved'
GROUP BY `mess_id`, `status`
";

$result = mysqli_query($conn, $query_bazar);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$total_daily_exp=$row['total_amount'];
}

$meal_rate=$total_daily_exp/$total_meal;
$meal_rate= number_format($meal_rate, 2);

//total deposite meal
$query_total_deposite_meal="SELECT SUM(`amount`) AS total_amount
FROM `balance`
WHERE `date` BETWEEN '$start_date' AND '$end_date'
  AND `mess_id` = '$mess_id'
  AND `balance_type` = 'meal'
GROUP BY `mess_id`, `balance_type`";

$result = mysqli_query($conn, $query_total_deposite_meal);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$total_deposite_meal=$row['total_amount'];
}

//total deposite month
$query_total_deposite_month="SELECT SUM(`amount`) AS total_amount
FROM `balance`
WHERE `date` BETWEEN '$start_date' AND '$end_date'
  AND `mess_id` = '$mess_id'
  AND `balance_type` = 'month'
GROUP BY `mess_id`, `balance_type`";

$result = mysqli_query($conn, $query_total_deposite_month);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$total_deposite_month=$row['total_amount'];
}

//
$manager_balance_meal=$total_deposite_meal-$total_daily_exp;
//$manager_balance_month=$total_deposite_month-$total_                                                                         p;
//

//total no of meal consumption of a member

//$email='shishir2515@student.nstu.edu.bd';


$my_total_meal=0;
$my_total_daily_exp=0;
$my_total_bill=0;
$my_total_deposite_meal=0;
$my_total_deposite_month=0;

$query_my_meal="SELECT `mess_id`,
        SUM(`lunch`) + SUM(`breakfast`) + SUM(`dinner`) AS total_meals
        FROM `meal`
        WHERE `date` BETWEEN '$start_date' AND '$end_date'
        AND `mess_id` = '$mess_id' AND `email` = '$email'
        GROUP BY `mess_id`";

$result = mysqli_query($conn, $query_my_meal);
 if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$my_total_meal=$row['total_meals'];
 }

//


//my total bazar
$query_my_total_daily_exp="SELECT `mess_id`,
`status`,
SUM(`amount`) AS total_amount
FROM `expense`
WHERE `date_of_req` BETWEEN '$start_date' AND '$end_date'
AND `mess_id` = '$mess_id'
AND `status` = 'approved' AND `email` = '$email'
GROUP BY `mess_id`, `status`
";


$result = mysqli_query($conn, $query_my_total_daily_exp);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$my_total_daily_exp=$row['total_amount'];
}

$my_total_bill=$my_total_meal*$meal_rate;
$my_total_bill= number_format($my_total_bill, 2);

//my total deposite for meal
$query_my_deposite_meal="SELECT SUM(`amount`) AS total_amount
FROM `balance`
WHERE `date` BETWEEN '$start_date' AND '$end_date'
  AND `email` = '$email'
  AND `mess_id` = '$mess_id'
  AND `balance_type` = 'meal'
GROUP BY `email`, `mess_id`, `balance_type`";

$result = mysqli_query($conn, $query_my_deposite_meal);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$my_total_deposite_meal=$row['total_amount'];
}


//my total deposite for month
$query_my_deposite_month="SELECT SUM(`amount`) AS total_amount
FROM `balance`
WHERE `date` BETWEEN '$start_date' AND '$end_date'
  AND `email` = '$email'
  AND `mess_id` = '$mess_id'
  AND `balance_type` = 'month'
GROUP BY `email`, `mess_id`, `balance_type`";

$result = mysqli_query($conn, $query_my_deposite_month);
if(mysqli_num_rows($result) > 0){
$row = mysqli_fetch_assoc($result);
$my_total_deposite_month=$row['total_amount'];
}


//other cost 
$query_for_other_cost = "SELECT SUM('amount') AS total_cost FROM cost WHERE mess_id = '$mess_id' AND 'date' BETWEEN '$start_date' AND '$end_date' AND 'type' = 'others' GROUP BY mess_id, type";
$result=mysqli_query($conn, $query_for_other_cost);
if(mysqli_num_rows($result)>0){
  $row=mysqli_fetch_assoc($result);
  $total_cost_from_other=$row['total_cost'];
}




$my_total_balance_meal=$my_total_deposite_meal-$my_total_bill;


}
?>