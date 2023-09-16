<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>

<?php
//session_start();
include "../php/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "balance_header.php";

$_SESSION['selected_email'] = $_SESSION['login_info']['email'];

include "../php/calculation.php";
include "../php/loadMonthAndMember.php";
include "../php/meal_rate_track.php";

$jsLabels = json_encode($naameAr);
$jsBalance = json_encode($balanceArr);

$jsDate = json_encode($dateArray);
$jsMealRate = json_encode($mealRateArray);

?>

<body>
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
            <div class="container">
                <div class="main">
                    <div class="cards">
                        <div class="card">
                            <div class="card-content">
                                <div class="number"><?php echo $total_deposite_meal; ?></div>
                                <div class="card-name">Total Deposite</div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-money-check"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="number"><?php echo $total_daily_exp; ?></div>
                                <div class="card-name">Total Bazar</div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="number"><?php echo $manager_balance_meal ?></div>
                                <div class="card-name">Balance</div>
                            </div>
                            <div class="icon-box">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content">
                                <div class="number"><?php echo $meal_rate ?></div>
                                <div class="card-name">Meal Rate</div>
                            </div>
                            <div class="icon-box">
                            <i class="fas fa-bangladeshi-taka-sign"></i>
                            </div>
                        </div>
                    </div>
                    <div class="charts">
                        <div class="chart">
                            <h2>Daily Meal Rate</h2>
                            <div>
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                        <div class="chart doughnut-chart">
                            <h2>Member's Balance</h2>
                            <div>
                                <canvas id="doughnut"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

            <script>
                var ctx = document.getElementById('lineChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo $jsDate; ?>,
                        datasets: [{
                            label: 'Meal Rate',
                            data: <?php echo $jsMealRate; ?>,
                            backgroundColor: [
                                'rgba(85,85,85, 1)'

                            ],
                            borderColor: 'rgb(41, 155, 99)',

                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            </script>




            <script>
                var ctx2 = document.getElementById('doughnut').getContext('2d');
                var myChart2 = new Chart(ctx2, {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo $jsLabels ?>,

                        datasets: [{
                            label: 'Members Balance',
                            data: <?php echo $jsBalance ?>,
                            backgroundColor: [
                                'rgba(41, 155, 99, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(120, 46, 139,1)'

                            ],
                            borderColor: [
                                'rgba(41, 155, 99, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(120, 46, 139,1)'

                            ],
                            borderWidth: 1
                        }]

                    },
                    options: {
                        responsive: true
                    }
                });
            </script>



            <a href="balance_manager.php" style="bottom: 100px;" class="fab">Add Balance</a>
            <a href="balance_show_member.php" class="fab">My Balance</a>

        </main>
</body>

</html>