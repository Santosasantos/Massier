<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<?php include 'meal_details_m_header.php'; ?>

<body   >
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

    require("../php/mealDetails.php");
    $_SESSION['selected_email'] = $_SESSION['login_info']['email'];
    require("../php/calculation.php");
    ?>


    <div class="month_selector" style="margin-top: 50px;">
        <!-- <button class="add-button" id="left-button"><</button> -->
        <!-- <h3 id="month-name" class="add-button">August</h3> -->
        <!-- <button class="add-button" id="right-button">></button> -->
    </div>
    <br>

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
                <td>' . $mealDate . '</td>
                <td id="br">' . $breakfast . '</td>
                <td id="lnc"> ' . $lunch . '</td>
                <td id="dnr">' . $dinner . '</td>
                <td id="ttl">' . $ttl_meal . '</td>
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
        <div class="total-box" style="background-color:#1edd8d;color:black;">
            <p>Deposite: <span id="total-cost"><?= $my_total_deposite_meal ?></span></p>
        </div>
        <div class="total-box" style="background-color: #1edd8d;color:black;">
            <p>Cost: <span id="total-balance"><?= $my_total_bill ?></span></p>
        </div>
        <div class="total-box" style="background-color: <?= $my_total_balance_meal < 0 ? '#fa3d3d' : '#1edd8d' ?>; color: black;">
            <p>Remaining: <span id="total-expense"><?= $my_total_balance_meal ?></span></p>
        </div>

        <div class="total-box" style="background-color: #1edd8d;color:black;">
            <!-- <p>Total Meal: <span id="total-meal-bottom">$totalApprovedMeal?></span></p> -->
            <p>Total Meal: <span id="total-meal-bottom"><?= $my_total_meal ?></span></p>
        </div>
        <!-- <div class="total-box" style="background-color: #007BFF;">
            <p><span id="correction-request">Correction Request</span></p>
        </div> -->
    </div>

    <script src="../js/mealDetails.js"></script>
</body>

</html>