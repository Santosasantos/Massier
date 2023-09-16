<?php
session_start();
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $membername=$_POST['member'];
    $type = $_POST['deposit_type'];
    $amount = $_POST['amount'];


    // Perform input validation here if needed

    // Create a database connection (adjust the connection details as needed)
   include 'connect.php';

    // Insert data into the 'cost' table
    $sql = "INSERT INTO `balance` (`date`, `mess_id`, `email`, `amount`, `balance_type`) 
            VALUES (CURDATE(), ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $mess_id = $_SESSION['mess_info']['mess_id']; // Assuming you have a session variable for 'mess_id'

    $stmt->bind_param("isis", $mess_id, $membername, $amount, $type);

    if ($stmt->execute()) {
        // Data inserted successfully
        header("Location: ../html/balance_manager.php");
    
    } else {
        // Error in inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
