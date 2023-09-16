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
<?php include "header.php" ?>

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
            <div class="container" style="position: absolute;top:23%;left:35%;">
                <div class="sub-container">
                    <!-- Budget -->

                    <!-- Expenditure -->

                    <div class="user-amount-container" style="background: linear-gradient(#141e30, #243b55);">
                        <form action="../php/submitcost.php" method="post">
                            <h3 style="color: aliceblue;">Expenses</h3>
                            <p class="hide error" id="product-title-error">
                                Values cannot be empty
                            </p>
                            <select name="type" class="custom-select">
                                <option selected="">Select the cost type</option>
                                <option value="house_rent">House Rent</option>
                                <option value="gas_bill">Gas Bill</option>
                                <option value="electricity_bill">Electricity Bill</option>
                                <option value="water_bill">Water Bill</option>
                                <option value="maid_bill">Maid Bill</option>
                                <option value="internet_bill">Internet Bill</option>
                                <option value="others">Others</option>
                            </select>
                            <hr>
                            <input type="text" id="description" name="description" placeholder="Enter description" />
                            <input type="number" min="0" id="amount" name="amount" placeholder="Enter the Amount" />
                            <div style="display: flex;justify-content:center;align-items:center;">
                            <button type="submit" class="submit" name="submit" id="check-amount">Add expense</button>
                       
                            <form >      

                        <button  style="width:fit-content;margin-left:220px;" class="submit" value="View Expense" > <a style="color:#fff" href="view_expenses.php">View Expenses</a></button>
                        </form>
                       

                        </div>
                    
                       
                        </form>

                       

                    </div>
                </div>
                <!-- Output -->
            </div>

            
    </div>
    
    </main>
    </div>
</body>

</html>