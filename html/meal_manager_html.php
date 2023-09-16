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


        

    <?php require("../php/meal_manager.php"); ?>
    <form method="POST" action="../php/addMeal.php">

        <main class="table">

            <section class="table__header">
                <div class="header_container">
                    <div class="centered">
                        <h1>Today's Meal</h1>
                    </div>
                    <div class="top__btn" style="position: absolute;right: 35px;top:20px;">
                        <div class="meal__details">

                            <input type="button" class="meal__details-btn" value="Details Meal" onclick="location.href='mealDetails_manager_html.php'">

                        </div>
                        <div class="meal__details">
                            <input type="submit" name="add_meal" class="meal__details-btn" value="Add">
                        </div>
                    </div>
                </div>
            </section>


            <section class="table__body">
                <table class=".c">
                    <thead>
                        <tr>
                            <th> SL <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Member <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Breakfast <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Lunch <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Dinner <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Total <span class="icon-arrow">&UpArrow;</span></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($messMemberNameArray as $email => $name) {

                            if (isset($status[$email])) {
                                $breakfastValue = $breakfast[$email];
                                $lunchValue = $lunch[$email];
                                $dinnerValue = $dinner[$email];
                                $statusValue = $status[$email];
                            } else {
                                $breakfastValue = 0;
                                $lunchValue = 0;
                                $dinnerValue = 0;
                                $statusValue = 'pending';
                            }

                            $rowColorClass = $statusValue == 'approved' ? 'background-color: rgb(138, 209, 138);' : 'background-color: rgb(209, 138, 138);';



                            $i++;
                            echo '
    <tr style="' . $rowColorClass . '">
        <td>' . $i . '</td>
        <input type="hidden" name="st[]" value="' . $statusValue . '">
        <input type="hidden" name="mail[]" value="' . $email . '">
        <td> <p class="members">' . $name . '</p></td>
        <td> <input type="number" min="0" name="br[]" value="' . $breakfastValue . '" class="inp" id="breakfast-' . $i . '"> </td>
        <td> <input type="number" min="0" name="ln[]" value="' . $lunchValue . '" class="inp" id="lunch-' . $i . '"> </td>
        <td> <input type="number" min="0" name="dr[]" value="' . $dinnerValue . '" class="inp" id="dinner-' . $i . '"> </td>
        <td> <strong>' . $statusValue . '</strong></td>
    </tr>
    ';
                        }
                        ?>

                    </tbody>
                </table>
    </form>
    </section>
    </main>
    <script src="../js/meal_manager.js"></script>
</body>

</html>