<?php



if ($_SERVER['REQUEST_METHOD']=='POST')

    {
    
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
    $connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    $sql = "SELECT AssignmentID, Grade FROM 'grades' WHERE StudentID=40291824" //hardcoded student ID in this part
    $result = $connect->query($sql);
    $grades_contents = "";

     if (mysqli_num_rows($result)>0){
         while($row = mysqli_fetch_assoc($result)){
             
           echo "<tr>";
            echo "<td>" . $row['grades'] . " AVG: " . $row['//final grades? not sure where the average will appear'] . "</td>";
            echo "</tr>";
        }
?>
