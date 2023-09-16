<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en" title="Massier">


<?php include 'meal_manager_header.php'; ?>

<body class=".b" style="background-image: url(../assets/images/html_table.jpg);margin:40px;">

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



<body style="background-image: url(../assets/images/html_table.jpg);margin:40px;">

    <?php require("../php/daily_exp_manager.php"); ?>

    <form method="POST" action="../php/addDailyExp.php">

        <main class="table">

            <section class="table__header">
                <div class="header_container">
                    <div class="centered">
                        <h1>Today's Expense</h1>
                    </div>
                    <div class="top__btn" style="position: absolute;right: 35px;top:20px;">
                        <div class="meal__details">

                            <input type="button" class="meal__details-btn" value="Details Meal" onclick="location.href='daily_exp_manager_details.php'">

                        </div>
                        <div class="meal__details">
                            <input type="submit" name="add_meal" class="meal__details-btn" value="Add">
                        </div>
                    </div>
                </div>
            </section>


            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> SL <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Member <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Items <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Price <span class="icon-arrow">&UpArrow;</span></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;


                        //



                        foreach ($items as $ix => $item) {

                            $emailValue = $emails[$ix];
                            $priceValue = $prices[$ix];
                            $expIdValue = $exp_ids[$ix];
                            $statusValue = $status[$ix];
                            $itemValue = $items[$ix];

                            $rowColorClass = $statusValue == 'approved' ? 'background-color: rgb(138, 209, 138);' : 'background-color: rgb(209, 138, 138);';

                            $i++;
                            echo '
    <tr style="' . $rowColorClass . '">
        <td>' . $i . '</td>

        <input type="hidden" name="st[]" value="' . $statusValue . '">
        <input type="hidden" name="mail[]" value="' . $emailValue . '">
        <input type="hidden" name="exp_id[]" value="' . $expIdValue . '">
        <input type="hidden" name="date" value="' . $date . '">

        <td> <p class="members">' . $messMemberNameArray[$emailValue] . '</p></td>
        <td> <input type="text" name="item[]" value="' . $itemValue . '" class="inp" id="breakfast-' . $i . '"> </td>
        <td> <input type="number" min="0" name="price[]" value="' . $priceValue . '" class="inp" id="lunch-' . $i . '"> </td>
        
    </tr>
    ';
                        }



                        ?>

                    </tbody>
                    <!-- <a href="dailyexpense_html.php">
        <button style="position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            padding: 7px 18px;
            font-size: 24px;
            cursor: pointer;">+</button>
    </a> -->
                </table>

    </form>

    </section>
    </main>
    <script src="../js/meal_manager.js"></script>

  


</body>

</html>