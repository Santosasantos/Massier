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
<body style="padding-top: 50px;">

    <?php
    include('../php/connect.php');
    // session_start();

    if (isset($_GET['email'])) {
        $month = $_GET['month'];
        $email = $_GET['email'];
    } else {
        $month = "September";
        $email = $_SESSION['login_info']['email'];
    }

    $mess_id = $_SESSION['mess_info']['mess_id'];
    $start_date = '2023-09-01';
    $end_date = '2023-09-30';

    $dateArr = array();
    $memberArr = array();
    $itemArr = array();
    $priceArr = array();
    $exp_ids = array();

    // Find daily exp
    $query = "SELECT * FROM `expense` WHERE `mess_id` = '$mess_id' AND `status` = 'approved' AND `date_of_req` BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $dateArr[] = $row['date_of_req'];
        $memberArr[] = $row['email'];
        $itemArr[] = $row['description'];
        $priceArr[] = $row['amount'];
        $exp_ids[] = $row['exp_id'];
    }
    ?>

    <br>
    <form method="POST" action="../php/addDailyExp.php">

        <div class="table_container">

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Email</th>
                        <th>Item</th>
                        <th>Price</th>
                    </tr>
                    <?php
                    foreach ($dateArr as $index => $mealDate) {
                        $dte = $dateArr[$index];
                        $email = $memberArr[$index];
                        $item = $itemArr[$index];
                        $price = $priceArr[$index];
                        $ex_id = $exp_ids[$index];

                        echo '
                    <tr style="background-color: rgb(138, 209, 138);font-weight: 200;">
                        <td> <input type="date" name="dte[]"  value="' . $dte . '" class="inp" > </td>
                        <td> <input type="email" name="em[]" value="' . $email . '" class="inp" > </td>
                        <td> <input type="text" min="0" name="it[]" value="' . $item . '" class="inp" > </td>
                        <td> <input type="number" name="pr[]" value="' . $price . '" class="inp" > </td>
                        <input type="hidden" name="id[]"  value="' . $ex_id . '" class="inp" >
                    </tr>';
                    }
                    ?>
                </thead>
                <tbody></tbody>
                <tfoot></tfoot>
            </table>

        </div>

        <div class="totals-container">
     

            <div class="total-box" style="background-color:#1edd8d;color:black">
                <p>Balance: <span id="total-cost">0</span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black">
                <p>Cost: <span id="total-balance">0</span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black">
                <p>Remaining: <span id="total-expense">0</span></p>
            </div>
            <div class="total-box" style="background-color: #1edd8d;color:black">
                <p>Total Meal: <span id="total-meal-bottom"></span></p>
            </div>
            <input class="total-box" style="background-color: #007BFF;font-size:16px;" type="submit" name="correction" id="correction-request">
     
        </div>
    </form>

    <script src="../js/mealDetails.js"></script>

</body>
</html>