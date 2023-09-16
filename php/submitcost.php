<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $type = $_POST['type'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    echo $type.$description.$amount;

    // Perform input validation here if needed

    // Create a database connection (adjust the connection details as needed)
    include "connect.php";
    // Insert data into the 'cost' table
    $sql = "INSERT INTO `cost` (`date`, `mess_id`, `type`, `description`, `amount`) 
            VALUES (CURDATE(), ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $mess_id = $_SESSION['mess_info']['mess_id']; 
    $stmt->bind_param("issi", $mess_id, $type, $description, $amount);

    if ($stmt->execute()) {
        // Data inserted successfully
        
        header("Location: ../html/monthly_manager.php");
    } else {
        // Error in inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
