<?php

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);


// Find all the assignment IDs and names, and putting them in $assignmentInfo
$result = $mysqli->query("SELECT `AssignmentID`,`Name` FROM assignments");
$assignmentIDs = array();
foreach ($result as $row) {
    $assignmentInfo[] = array("id" => $row['AssignmentID'], "name" => $row['Name']);
}

$assignments = array();

// Find the median of each Assignment
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
                "rank" => 18,
                "percentile" => 51
            )
        )
    )
);

$out_json = json_encode($out);

echo $out_json;

?>