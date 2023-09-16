<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<?php

include 'header.php' ?>

<body>

    <?php
    //session_start();
    require("../php/homePage.php");

    ?>

    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3><img src="../assets/images/m.png" height="25px" width="25px"><span>assier</span></h3>
        </div>

        <div class="side-content">




            <div class="profile">
                <div class="profile-img-wrapper">
                    <div class="profile-img bg-img" style="background-image: url(../assets/images/profile.webp);background-position: center;"></div>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'manager') : ?>
                        <i class="las la-crown" style="color: gold;"></i>
                    <?php endif; ?>
                </div>
                <h4><?= $name ?></h4>
            </div>








            <div class="side-menu">

                <ul>
                    <li>
                        <a href="" class="active">
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

            <div class="page-header">
                <h1>Hi, <?= $name ?></h1>
                <small>Welcome to <?php
                                    if (isset($_SESSION['mess_info']['mess_name'])) {
                                        echo $mess_name;
                                    } else 'Massier' ?></small>
            </div>

            <div class="page-content">

                <div class="analytics">

                    <a href="<?php
                                if (isset($_SESSION['role'])) {
                                    if ($_SESSION['role'] === 'manager') {
                                        echo 'meal_manager_html.php';
                                    } else {
                                        echo 'meal_html.php';
                                    }
                                }
                                ?>">
                        <div class="card" style="background: #11a8c3;">
                            <div class="card-head">
                                <h2 class="indicator one">Meal</h2>
                                <span class="las la-utensils"></span>
                            </div>

                            <small>Details about meal</small>
                        </div>
                    </a>


                    <div class="card" style="background: #52dc72;" onclick="dailyExp();">
                        <div class="card-head">
                            <h2 class="indicator two" style="font-size: 20px; font-weight: 700;"><a href="#"></a>Daily Expense</h2>
                            <span class="las la-lightbulb"></span>
                        </div>
                        <small>Details about Daily Expenses</small>
                    </div>

                    <script>
                        function dailyExp() {
                            <?php if (isset($_SESSION['role'])) {
                                if ($_SESSION['role'] === 'manager') {
                                    echo "window.location.href = 'dailyExpenseManager_html.php';";
                                } else {
                                    echo "window.location.href = 'dailyexpense_html.php';";
                                }
                            } ?>
                        }
                    </script>

                    <div class="card" style="background: rgb(240, 83, 83);" onclick="monthlyExp();">
                        <div class="card-head">
                            <h2 class="indicator four" style="font-size: 20px; font-weight: 700;">
                                </a>Monthly Expense</h2>
                            <span class="las la-store-alt"></span>
                        </div>
                        <small>Details about monthly expense</small>
                    </div>
                    <script>
                        function monthlyExp() {
                            <?php if (isset($_SESSION['role'])) {
                                if ($_SESSION['role'] === 'manager') {
                                    echo "window.location.href = 'monthly_manager.php';";
                                } else {
                                    echo "window.location.href = 'monthly_user.php';";
                                }
                            } ?>
                        }
                    </script>

                    <div class="card" style="background: #a14ae0;" onclick="balance();">
                        <div class="card-head">
                            <h2 class="indicator three"><a href="#"></a>Balance</h2>
                            <span class="las la-wallet"></span>
                        </div>
                        <small>Details about Balance</small>
                    </div>

                    <script>
                        function balance() {
                            <?php if (isset($_SESSION['role'])) {
                                if ($_SESSION['role'] === 'manager') {
                                    echo "window.location.href = 'balance_show.php';";
                                } else {
                                    echo "window.location.href = 'balance_show_member.php';";
                                }
                            } ?>
                        }
                    </script>


                </div>

                <div class="chat-content">
                    <button id="messengerbtn" class="active">
                        <i class="fas fa-comment-alt"></i>
                    </button>
                    <iframe id="chat-frame" class="hidden" src="chat/chat.php" frameborder="0" style="overflow: hidden;"></iframe>
                </div>

            </div>

        </main>

    </div>
</body>

</html>