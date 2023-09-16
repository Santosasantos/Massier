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

<script src="../js/snackbar.js"></script>
<link rel="stylesheet" href="../css/snackbar.css">

<?php include 'header.php'; ?>

<body <?php if (isset($_GET['msg']) && $_GET['msg'] == 1) {

            echo 'onload="myFunction()"';
        } elseif (isset($_GET['msg']) && $_GET['msg'] == 2) {
            echo 'onload="myFunction1()"';
        } elseif (isset($_GET['msg']) && $_GET['msg'] == 3) {
            echo 'onload="myFunction2()"';
        }
        ?>>

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


        <main>
            <div class="wrapper">
                <div class="container">
                    <div class="sub-container">
                        <!-- Budget -->
                        <div class="total-amount-container">
                            <h3>Budget</h3>
                            <p class="hide error" id="budget-error">
                                Value cannot be empty or negative
                            </p>
                            <input type="number" min="0" id="total-amount" placeholder="Enter Total Amount" />
                            <button class="submit" id="total-amount-button">Set Budget</button>
                        </div>

                        <!-- Expenditure -->
                        <div class="user-amount-container">
                            <h3>Expenses</h3>
                            <p class="hide error" id="product-title-error">
                                Values cannot be empty
                            </p>
                            <input type="text"  class="product-title" id="product-title" placeholder="Enter Title of Product" />
                            <input type="number" min="0" id="user-amount" placeholder="Enter Cost of Product" />
                            <button class="submit" id="check-amount">Add expense</button>
                        </div>
                    </div>
                    <!-- Output -->
                    <div class="output-container flex-space">
                        <div>
                            <p>Total Budget</p>
                            <span id="amount">0</span>
                        </div>
                        <div>
                            <p>Expenses</p>
                            <span id="expenditure-value">0</span>
                        </div>
                        <div>
                            <p>Balance</p>
                            <span id="balance-amount">0</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="../php/dailyExpense.php">
                    <!-- List -->
                    <div class="list">
                        <h3>Expense List</h3>
                        <div class="list-container" id="list"></div>
                    </div>
                    <!-- Submit Expense Button -->
                    <div class="submit-expense-container">
                        <input type="submit" class="submit primary" id="submit-expense" name="submit_exp" value="Submit Expense">
                    </div>

            </div>
            </form>



        </main>
    </div>

    <div id="snackbar" class="snackbar" style="background: linear-gradient(#5fdb73, #12f530);color:black;top: 70px;">
        Daily expense request sent
    </div>

    <div id="snackbar1" class="snackbar" style="top: 70px;">
        Daily expense request couldn't Sent
    </div>

    <div id="snackbar2" class="snackbar" style="top: 70px;">
        Please fill add any expense
    </div>
    <!-- Script -->
    <script src="../js/daily.js"></script>
</body>

</html>