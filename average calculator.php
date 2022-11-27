<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$sql = "SELECT AssignmentID, Grade FROM grades WHERE StudentID=40291824"; //hardcoded student ID in this part
$result = $connect->query($sql);

$grades = [];

foreach ($result as $row) {
    $grades[] = intval($row['Grade']);
}

$sum=0;
$count=0;

foreach ($grades as $grade) {
    $sum+=$grade;
    count++;
}

echo $sum/$count;


?>
