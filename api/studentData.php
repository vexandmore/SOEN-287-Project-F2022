<?php

// Connect to database
$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);

session_start();
// If not logged in, return error
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
    echo "ERROR: not logged in";
    exit;
}

// Once login is working, this will come from the user session
$studentID = $_SESSION['StudentID'];

/*
  Find all the assignment IDs and names, and putting them in $assignmentInfo
*/
$result = $mysqli->query("SELECT `AssignmentID`,`Name` FROM assignments");
$assignmentIDs = array();
foreach ($result as $row) {
    $assignmentInfo[] = array("id" => $row['AssignmentID'], "name" => $row['Name']);
}
$result->close();

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
$result->close();

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
$averageQuery->close();

// First, find the number of students

// Then, find the list of everyone's average grade, in order
$averages = $mysqli->query("SELECT 
                                s.StudentID, 
                                avg(g.Grade)
                            FROM students s
                                INNER JOIN grades g on g.StudentID=s.StudentID
                                GROUP BY s.StudentID
                            ORDER BY avg(g.Grade) DESC;");
$rank = 1;
// And calculate rank
foreach ($averages as $averageRow) {
    if ($averageRow['avg(g.Grade)'] > $average) {
        $rank = $rank + 1;
    }
}
$averages->close();


/*
  Find student percentile
*/
$numStudentsResult = $mysqli->query("SELECT COUNT(*) from students;");
$numStudents = $numStudentsResult->fetch_assoc()['COUNT(*)'];
$numStudentsResult->close();
$percentile = ($numStudents - $rank) / $numStudents;
$percentile *=  100;
$percentile = intval($percentile);


/*
  Find standard deviation
*/
// First get class average
$averageResult = $mysqli->query("SELECT  avg(Grade)
                            FROM grades;");
$classAverage = $averageResult->fetch_assoc()['avg(Grade)'];
$averageResult->close();

// Then get the number of students
$numStudentsResult = $mysqli->query("SELECT  count(StudentID)
                            FROM students;");
$numStudents = $numStudentsResult->fetch_assoc()['count(StudentID)'];
$numStudentsResult->close();

// Then calculate the sum of the squares of the differences of the grades
$gradesResult = $mysqli->query("SELECT Grade FROM grades;");
$standardDeviation = 0.0;
foreach($gradesResult as $row) {
    $difference = ($row['Grade'] - $classAverage);
    $standardDeviation += $difference * $difference;
}
$gradesResult->close();
$standardDeviation /= $numStudents;
$standardDeviation = round(sqrt($standardDeviation));





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
                "standard-deviation" => $standardDeviation,
                "rank" => $rank,
                "percentile" => $percentile
            )
        )
    )
);

$out_json = json_encode($out);

echo $out_json;

$mysqli->close();
?>