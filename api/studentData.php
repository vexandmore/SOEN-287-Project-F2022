<?php

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);

// Once login is working, this will come from the user session
$studentID = 40215874;
//$studentID = 40291824;

/*
  Find all the assignment IDs and names, and putting them in $assignmentInfo
*/
$result = $mysqli->query("SELECT `AssignmentID`,`Name` FROM assignments");
$assignmentIDs = array();
foreach ($result as $row) {
    $assignmentInfo[] = array("id" => $row['AssignmentID'], "name" => $row['Name']);
}

$assignments = array();

/*
  Find the median of each Assignment
*/
foreach ($assignmentInfo as $info) {
    // get the ID for this assignment
    $id = $info['id'];
    // Get all grades from that ID, in sorted order
    $result = $mysqli->query("SELECT Grade FROM grades WHERE AssignmentID=$id ORDER BY Grade ASC");
    // Get the index of the middle element in the result
    $mid_index = floor($result->num_rows/2);
    // If there are an even number of grades
    if ($result->num_rows % 2 == 0) {
        $result->data_seek($mid_index);
        $mid = $result->fetch_assoc()['Grade'];
        $result->data_seek($mid_index - 1);
        $mid_1 = $result->fetch_assoc()['Grade'];
        $median = ($mid + $mid_1)/2;
    } else {
        // If there are an odd number of grades
        $result->data_seek($mid_index);
        $median = $result->fetch_assoc()['Grade'];
    }
    // Add the information about the assignment to the $assignments array
    $assignments[] = array("name" => $info['name'], "median" => $median);
}

/*
  Find student ranking
*/
// First, find this student's average grade
$averageQuery = $mysqli->query("SELECT 
                                    s.StudentID, 
                                    avg(g.Grade)
                                FROM students s
                                    INNER JOIN grades g on g.StudentID=s.StudentID and s.StudentID=$studentID
                                GROUP BY s.StudentID;");
foreach ($averageQuery as $averageRow) {
    $average = $averageRow['avg(g.Grade)'];
}

// First, find the list of everyone's average grade, in order
$averages = $mysqli->query("SELECT 
                                s.StudentID, 
                                avg(g.Grade)
                            FROM students s
                                INNER JOIN grades g on g.StudentID=s.StudentID
                                GROUP BY s.StudentID
                            ORDER BY avg(g.Grade) DESC;");
$rank = 1;
foreach ($averages as $averageRow) {
    if ($averageRow['avg(g.Grade)'] > $average) {
        $rank = $rank + 1;
    }
}





$out = array (
    "assignments" => $assignments,
    "studentData" => array(
        array(
            "name" => "Sophie", 
            "assignments" => array(
                array("name" => "Assignment1", "grade" => 88),
                array("name" => "Assignment2", "grade" => 70),
                array("name" => "Assignment3", "grade" => 92)
            ),
            "report" => array(
                "standard-deviation" => 15,
                "rank" => $rank,
                "percentile" => 51
            )
        )
    )
);

$out_json = json_encode($out);

echo $out_json;

?>