<?php
session_start();
if (!isset($_SESSION['login_info'])) {
    header("Location: login_html.php");
    exit;
}

include "../php/connect.php"; // Include your database connection code

// Check if the user has submitted a delete request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_expense"])) {
    $expenseId = mysqli_real_escape_string($conn, $_POST["delete_expense"]);

    // Perform deletion (replace 'cost' with your table name)
    $deleteQuery = "DELETE FROM cost WHERE cost_id = $expenseId"; // Customize this query as needed

    if (mysqli_query($conn, $deleteQuery)) {
        // Expense deleted successfully
    } else {
        echo "Error deleting expense: " . mysqli_error($conn);
    }
}

// Fetch expenses from the database
$query = "SELECT * FROM cost"; // Customize this query as needed
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$expenses = array();

while ($row = mysqli_fetch_assoc($result)) {
    $expenses[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include "view_exp_header.php" ?>
    <body>
      <header>
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

        <!-- Display Expenses -->
        <main>
        <h2>Expenses of <?php echo date('F Y')?></h2>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Type</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Amount</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($expenses as $expense) { ?>
                    <tr>
                        <td><?php echo $expense["date"]; ?></td>
                        <td><?php echo $expense["type"]; ?></td>
                        <td><?php echo $expense["description"]; ?></td>
                        <td><?php echo $expense["amount"]; ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="delete_expense" value="<?php echo $expense["cost_id"]; ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </main>
                </div>
        <!-- ... -->

        <!-- Your existing HTML structure -->
        <!-- ... -->
    </body>
</html>
