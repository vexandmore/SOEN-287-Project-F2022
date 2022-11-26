<?php
include 'login-resources/session-check-teacher.php';

$error = '';
// Grab form details
if (!isset($_POST['assignmentWeight']) || !isset($_POST['assignmentID'])) {
    $error .= "Assignment weight or ID missing";
}
$weight = floatval($_POST['assignmentWeight']);
if ($weight == 0.0) {
    $error .= "ERROR: weight is zero or not a number";
}
$id = intval($_POST['assignmentID']);

if (!empty($error)) {
    // If there is an error, show it in the assignments page
    header("location: Assignments.php?errorMessage=$error");
    die();
}


$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (!$connect){
    die('Failed to connect to MySQL' .mysqli_connect_error());
}


$sql = "UPDATE assignments SET Weight=? WHERE AssignmentID=?;";
$stmt = $connect->prepare($sql);
if (!$stmt) {
    die('SQL error: ' . mysqli_error($connect));
}


if (!($stmt->bind_param("di", $weight, $id))) {
    die('SQL error: ' . mysqli_error($connect));
}


if (!$stmt->execute()) {
    die('SQL error: ' . mysqli_error($connect));
}


$connect->close();

// Show success message
header("location: Assignments.php?confirmMessage=Assignment+weight+changed");
?>