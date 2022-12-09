<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

$StudentID = intval($_POST['StudentID']);

$sql = "SELECT g.Grade, a.Weight 
        FROM grades g INNER JOIN assignments a ON a.AssignmentID=g.AssignmentID 
        WHERE g.StudentID=$StudentID;"; //hardcoded student ID in this part
$result = $connect->query($sql);



$avg = 0;

foreach ($result as $row) {
    $avg += intval($row['Grade']) * floatval($row['Weight']);
}

echo $avg;

$connect->close();
?>
