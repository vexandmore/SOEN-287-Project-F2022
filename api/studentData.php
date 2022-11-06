<?php

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);


// Find all the assignment IDs
$result = $mysqli->query("SELECT `AssignmentID`,`Name` FROM assignments");
$assignmentIDs = array();
foreach ($result as $row) {
    $assignmentInfo[] = array("id" => $row['AssignmentID'], "name" => $row['Name']);
}

$assignments = array();

// Find the median of each
foreach ($assignmentInfo as $info) {
    $id = $info['id'];
    $result = $mysqli->query("SELECT Grade FROM grades WHERE AssignmentID=$id ORDER BY Grade ASC");
    $mid_index = floor($result->num_rows/2);
    if ($result->num_rows % 2 == 0) {
        $result->data_seek($mid_index);
        $mid = $result->fetch_assoc()['Grade'];
        $result->data_seek($mid_index - 1);
        $mid_1 = $result->fetch_assoc()['Grade'];
        $median = ($mid + $mid_1)/2;
    } else {
        $result->data_seek($mid_index);
        $median = $result->fetch_assoc()['Grade'];
    }
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