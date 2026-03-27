<?php
session_start();

// Set logout message before destroying session
$logout_message = "You have been logged out successfully.";
// Unset all session variables
$_SESSION = array();
// Destroy the session completely
session_destroy();
// Start fresh session to store the message
session_start();
$_SESSION['logout_message'] = $logout_message;
// Redirect to login page
header("Location: login.php");
exit;
