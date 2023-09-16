<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include 'meal_details_m_header.php'; ?>

<body>


<?php
    include "sidebar.php";
    ?>
    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">
                    <label for="">

                    </label>
                </div>
                <?php

                include "navbar.php"; ?>
            </div>
        </header>



    <?php

    // include('../php/connect.php');


    if (isset($_GET['email'])) {
        $month = $_GET['month'];
        $email = $_GET['email'];
    } else {
        $month = "September";
        $email = $_SESSION['login_info']['email'];
    }

    $_SESSION['selected_email'] = $email;
    include("../php/calculation.php");

    $mess_id = $_SESSION['mess_info']['mess_id'];
    //$mess_id=1693664645;


    $start_date = '2023-09-01';
    $end_date = '2023-09-30';


    $breakfastArr = array();
    $lunchArr = array();
    $dinnerArr = array();
    $dateArr = array();


    //find meal 
    $query = "SELECT * FROM `meal` WHERE `email` = '$email' AND `mess_id` = '$mess_id' AND `status` = 'approved' AND `date` BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);


    while ($row = mysqli_fetch_assoc($result)) {
        $dateArr[] = $row['date'];
        $breakfastArr[] = $row['breakfast'];
        $lunchArr[] = $row['lunch'];
        $dinnerArr[] = $row['dinner'];
    }

    ?>

    <?php require("../php/loadMonthAndMember.php"); ?>
    <form method="GET" action="mealDetails_manager_html.php">
        <div class="month_container" >
            <div class="month_selector" style="display: none;" >
                <select  id="month-name" class="add-button" name="month">
                    <?php foreach ($monthArr as $month) {
                        echo '<option>' . $month . '</option>';
                    };
                    ?>
                </select>
            </div>

            <div class="month_selector">
                <select id="member-name" class="add-button" name="email">
                    <?php foreach ($emailArr as $email) {

                        echo '<option>' . $email . '</option>';
                    };
                    ?>
                </select>
            </div>

            <div class="month_selector">
                <input class="add-button" type="submit" value="Show">
            </div>
        </div>
    </form>



    <br>
    <form method="POST" action="../php/updateManagerMeal.php">
        <div class="table_container">

            <table>
                <thead>

                    <tr>
                        <th>Date</th>
                        <th>Breakfast</th>
                        <th>Lunch</th>
                        <th>Dinner</th>
                        <th>Total Meal</th>
                    </tr>
                    <?php

                    $totalBreakfast = 0;
                    $totalLunch = 0;
                    $totalDinner = 0;
                    $totalApprovedMeal = 0;


                    foreach ($dateArr as $index => $mealDate) {
                        $breakfast = $breakfastArr[$index];
                        $lunch = $lunchArr[$index];
                        $dinner = $dinnerArr[$index];


                        $ttl_meal = $breakfast + $lunch + $dinner;

                        $totalBreakfast += $breakfast;
                        $totalLunch += $lunch;
                        $totalDinner += $dinner;

                        $totalApprovedMeal += $ttl_meal;


                        echo '
                <tr style="background-color: rgb(138, 209, 138);font-weight: 200;">
                
                <td> <input type="date" name="dte[]" readonly value="' . $mealDate . '" class="inp" > </td>
                <td> <input type="number" min="0" name="br[]" value="' . $breakfast . '" class="inp" > </td>
                <td> <input type="number" min="0" name="ln[]" value="' . $lunch . '" class="inp" > </td>
                <td> <input type="number" min="0" name="dr[]" value="' . $dinner . '" class="inp" > </td>
                
                <input type="hidden" name="mail" value="' . (isset($_GET['email']) ? $_GET['email'] : $_SESSION['login_info']['email']) . '" class="inp">
            <td>' . $ttl_meal . '</td>
                </tr>';
                    }
                    ?>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <!--  -->
                    <tr>
                        <td>Total</td>
                        <td class="total-breakfast"><?= $totalBreakfast ?></td>
                        <td class="total-lunch"><?= $totalLunch ?></td>
                        <td class="total-dinner"><?= $totalDinner ?></td>
                        <td class="total-meal"><?= $totalApprovedMeal ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- Wrap each <p> element in a <div> with different background colors -->
        <div class="totals-container">
            <div class="total-box" style="background-color:#1edd8d;color:black">
                <p>Deposite: <span id="total-cost"><?= $my_total_deposite_meal ?></span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black">
                <p>Cost: <span id="total-balance"><?= $my_total_bill ?></span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black">
                <p>Remaining: <span id="total-expense"><?= $my_total_balance_meal ?></span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black;">
                <p>Total Meal: <span id="total-meal-bottom"><?= $my_total_meal ?></span></p>
            </div>

            <input class="total-box" style="background-color: #007BFF;font-size:16px;" type="submit" name="correction" id="correction-request">

        </div>

    </form>

    <script src="../js/mealDetails.js"></script>
</body>

</html>