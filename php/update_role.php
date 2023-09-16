<?php
session_start();
include "connect.php";


//Check if the user is logged in
if (!isset($_SESSION["login_info"])) {
    header("Location: login_html.php"); 
    exit();
}


$loggedInUserEmail = $_SESSION["login_info"]["email"];
$memberEmailToPromote = $_GET['new_email'];

// // Define the roles
$managerRole = 'manager';
$regularMemberRole = 'member';

$messid=$_SESSION['mess_info']['mess_id'];

// // Update the role of the logged-in user to manager (role 2)
$updateLoggedInUserRoleSQL = "UPDATE `mess_members` SET `role`='$regularMemberRole' WHERE `mess_id`='$messid' AND `email`='$loggedInUserEmail'";
mysqli_query($conn, $updateLoggedInUserRoleSQL);

// // Find the member who was previously the manager and update their role to regular member (role 1)
$updatePreviousManagerRoleSQL = "UPDATE `mess_members` SET `role`='$managerRole' WHERE `mess_id`='$messid' AND `email`='$memberEmailToPromote' ";
mysqli_query($conn, $updatePreviousManagerRoleSQL);

// $updateOnMessTableSQL="UPDATE `mess` SET `manager`='$memberEmailToPromote' WHERE `mess_id`=$messid";
// mysqli_query($conn, $updateOnMessTableSQL);

// //Redirect back to the login page with a success message
$_SESSION["success_message"] = "Successfully changed the manager!";
header("Location: ../html/homepage_html.php");
exit();
?>