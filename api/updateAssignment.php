<?php 
// Takes raw data from the request
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json, true);
// Get ID and due date we want to change
$AssignmentID = $data['AssignmentID'];
$DueDate = $data['DueDate'];

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "UPDATE assignments 
        SET DueDate='$DueDate'
        WHERE AssignmentID=$AssignmentID;";
mysqli_query($connect, $sql);

$connect->close();
?>