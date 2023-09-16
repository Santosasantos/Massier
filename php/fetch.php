<?php

include "../php/connect.php";

$mess_id = $_SESSION['mess_info']['mess_id'];
$currentMonthYear = date('Y-m');


$sql = "SELECT date,type,description,amount FROM cost WHERE mess_id = ? AND DATE_FORMAT(date, '%Y-%m') = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $mess_id,$currentMonthYear);
$stmt->execute();
$result = $stmt->get_result();

// Prepare data for JSON response
$data = [];
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['date']."</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" .$row['description']."</td>";
        echo "<td>" . $row['amount'] . "</td>";
        echo "</tr>";
    }
}
else {
    echo "<tr><td colspan='3'>No cost information available for this mess ID.</td></tr>";
}

// Close the database connection
$stmt->close();
$conn->close();

?>
