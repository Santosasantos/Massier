<?php session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}
?>

<?php
// session_start();
include '../php/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php include "balance_header.php" ?>

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

                <div class="txt-container">
                    <h1>Deposit to your desired account balance</h1>
                </div>

                <div class="sub-container">
                    <!-- Budget -->

                    <!-- Expenditure -->
                    <div class="user-amount-container">
                        <form action="../php/submitdeposit.php" method="post">
                            <h3>Deposit To</h3>
                            <p class="hide error" id="product-title-error">
                                Values cannot be empty
                            </p>
                            <select name="member" class="custom-select">
                                <option value="">Select from the member list</option>
                                <?php
                                $messid = 1;
                                $sql = "SELECT email FROM mess_members WHERE mess_id = $messid";
                                $res = $conn->query($sql);

                                if ($res->num_rows > 0) {
                                    while ($row = $res->fetch_assoc()) {
                                        echo '<option value="' . $row['email'] . '">' . $row['email'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <hr>
                            <select name="deposit_type" id="deposit_type" class="custom-select">
                                <option value="">Select the Deposit type</option>
                                <option value="meal">For Meal</option>
                                <option value="month">For Month</option>
                            </select>
                            <input type="number" id="amount" name="amount" placeholder="Enter the Amount" />
                            <button type="submit" class="submit" name="submit" id="check-amount">Add deposit</button>
                        </form>
                    </div>
                </div>
                <!-- Output -->
            </div>


    </div>

    </main>
</body>

</html>