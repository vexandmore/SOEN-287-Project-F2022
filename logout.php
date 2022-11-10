<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Load student login page (in future will pick either teacher or student page)
header("location: login.php");
exit;
?>