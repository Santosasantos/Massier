<?php

$host = "localhost"; 
$db = "project_massier"; 
$user = "root"; 
$password = "";  


$conn = mysqli_connect($host, $user, $password, $db);


 if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>