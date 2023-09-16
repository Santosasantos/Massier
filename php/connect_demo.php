<?php

$host = "localhost"; 
$db = "project_massier_demo"; 
$user = "root"; 
$password = "";  


$conn1 = mysqli_connect($host, $user, $password, $db);


 if (!$conn1) {
    die("Connection failed: " . mysqli_connect_error());
}


?>