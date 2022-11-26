<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (!$connect) {
    die("Error connecting to database " . mysqli_connect_error());
}


$sql = "SELECT count(*)
FROM information_schema.columns
WHERE table_name = 'assignments';";

$result = $connect->query($sql);

if (mysqli_fetch_assoc($result)['count(*)'] < 3) {
    echo "Assignment table is missing the weight column";
    $sql = "ALTER TABLE assignments ADD Weight decimal(10,5)";
    if (!$connect->query($sql)) {
        die("could not add weight column to database " . $connect->mysqli_error());
    } else {
        echo "Added weight column to database";
    }
} else {
    echo "Weight column table already in database";
}

$connect->close();

?>