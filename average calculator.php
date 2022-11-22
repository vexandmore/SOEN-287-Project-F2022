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

// snip
foreach ($result as $row){
        $grades_contents .= '<tr>';
        $grades_contents .=    '<td> Assignment ' .$row["AssignmentID"]. '</td>';
        $grades_contents .=     ' <td> Grade: ' .$row["Grade"]. '</td>';
        $grades_contents .=    '</tr>';
    
        
    }
        $Marks = $results/ //number of assignments? I was not sure what to do in that step
        
        echo $Marks
    }
