<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>

<?php
// session_start();
include "../php/connect.php";
?>


<!DOCTYPE html>
<html lang="en">
<?php include "meal_header.php" ?>


<body <?php if (isset($_GET['msg']) && $_GET['msg'] == 1) {

            echo 'onload="myFunction()"';
        } elseif (isset($_GET['msg']) && $_GET['msg'] == 2) {
            echo 'onload="myFunction1()"';
        } elseif (isset($_GET['msg']) && $_GET['msg'] == 3) {
            echo 'onload="myFunction2()"';
        }

        ?>>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><img src="../assets/images/m.png" height="25px" width="25px"><span>assier</span></h3>
        </div>

        <div class="side-content">
            <!-- crown -->
            <div class="profile">
                <div class="profile-img-wrapper">
                    <div class="profile-img bg-img" style="background-image: url(../assets/images/profile.webp);background-position: center;"></div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') : ?>
                        <i class="las la-crown" style="color: gold;"></i>
                    <?php endif; ?>
                </div>
                <h4><?php echo $_SESSION["login_info"]["name"]; ?></h4>
            </div>

            <div class="side-menu">



                <ul>
                    <li>
                        <a href="homepage_html.php">
                            <span class="las la-home"></span>
                            <small>Home Page</small>
                        </a>
                    </li>
                    <li>
                        <a href="<?php

                                    if (isset($_SESSION['role'])) {

                                        if ($_SESSION['role'] === "manager") {
                                            echo 'mess_member_manager.php';
                                        } else {
                                            echo 'mess_member_user.php';
                                        }
                                    }
                                    ?>">
                            <span class="las la-users"></span>
                            <small>Mess</small>
                        </a>
                    </li>

                    <li>
                    <a href="report.php">
                            <span class="las la-clipboard-list"></span>
                            <small>Report</small>
                        </a>
                    </li>

                </ul>
                </nav>
            </div>
        </div>
    </div>
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
                <?php include "navbar.php"; ?>
            </div>



        </header>
        <main>




            <div class="containerM" style="margin-top: 100px;">
                <form action="../php/meal.php" method="POST">

                    <div class="heading">Meal</div>
                    <div class="add_meal">



                        <p>Meal for</p>
                        <div class="date_container">
                            <input type="hidden" name="date" value=<?= date("Y-m-d"); ?>>
                            <p id="dateInput" class="dateInput"><?= $date = date("Y-m-d"); ?></p><br>

                        </div>
                        <p>Number of Meals</p>
                        <div class="meal-entryM" id="meal-entry-1">
                            <div class="centered">
                                <select class="meal-type" style="margin-right: 30px;" name="meal_type" required>
                                    <option value="breakfast">Breakfast</option>
                                </select>
                                <input type="number" min="0" name="meal_no_b" value="<?php
                                                                                if (isset($_COOKIE['meal'])) {
                                                                                    $default = $_COOKIE['meal'];
                                                                                    $default_meal = unserialize($default);
                                                                                    echo $default_meal['breakfast'];
                                                                                } else {
                                                                                    echo 0;
                                                                                }
                                                                                ?>">
                            </div>
                        </div>

                        <div class="meal-entryM" id="meal-entry-2">
                            <div class="centered">
                                <select class="meal-type" style="margin-right: 30px;" name="meal_type" required>
                                    <option value="lunch">Lunch</option>
                                </select>
                                <input type="number" min="0" name="meal_no_l" value="<?php
                                                                                if (isset($_COOKIE['meal'])) {
                                                                                    $default = $_COOKIE['meal'];
                                                                                    $default_meal = unserialize($default);
                                                                                    echo $default_meal['lunch'];
                                                                                } else {
                                                                                    echo 0;
                                                                                }
                                                                                ?>">

                            </div>
                        </div>

                        <div class="meal-entryM" id="meal-entry-2">
                            <div class="centered">

                                <select class="meal-type" style="margin-right: 30px;" name="meal_type" required>
                                    <option value="lunch">Dinner</option>
                                </select>
                                <input type="number" min="0" name="meal_no_d" value="<?php
                                                                                if (isset($_COOKIE['meal'])) {
                                                                                    $default = $_COOKIE['meal'];
                                                                                    $default_meal = unserialize($default);
                                                                                    echo $default_meal['dinner'];
                                                                                } else {
                                                                                    echo 0;
                                                                                }
                                                                                ?>">
                            </div>
                        </div>
                    </div>
                    <div class="default_meal_div" style="display: none;">
                        <div>
                            <input type="checkbox" class="default_meal" name="default_meal" <?php
                                                                                            if (isset($_COOKIE['meal'])) {
                                                                                                $default = $_COOKIE['meal'];
                                                                                                $default_meal = unserialize($default);
                                                                                                if ($default_meal['set'] == 1) {
                                                                                                    echo 'checked';
                                                                                                }
                                                                                            } ?>>


                            <label for="default_meal">Set as default meal</label><br>
                        </div>
                    </div>

                    <div class="default_meal_div">
                        <div>
                            <!-- <input type="button" value="  View Meal  "> -->
                            <input type="button" value="  View Meal  " class="view_meal" onclick="location.href='mealDetails_html.php';"></button>
                            <input type="submit" name="submit" value="Send Request ">
                        </div>
                    </div>
                </form>
            </div>


            <div id="snackbar" class="snackbar" style="background: linear-gradient(#5fdb73, #12f530);color:black;left: 55%;top:110px;">
                Meal Request send
            </div>

            <div id="snackbar1" class="snackbar" style="background: linear-gradient(#5fdb73, #12f530); color:black;left: 55%;top:110px;">
                Meal request updated
            </div>

            <div id="snackbar2" class="snackbar" style="left: 55%;top:110px;">
                Meal couldn't be updated
            </div>


        </main>
    </div>
</body>

</html>