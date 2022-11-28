<?php
include "login-resources/session-check-student.php";
include "api/studentData.php";

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
$connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
 /*if (my_sqli_connect_errno()){
    exit('Failed to connect to MySQL' .mysqli_connect_error());
 }*/

$sql = "SELECT AssignmentID, Grade FROM grades WHERE StudentID=" . intval($_SESSION['StudentID']);
$result = $connect->query($sql);

$grades_contents = "";

// check if the sql database has at least 1 row
if ($result -> num_rows > 0){
        // makes a table from the db values
        $grades_contents = '<table class = "table">
    <tr>
        <th  style=\'width: 150px;\'> Assignment </th>
        <th  style=\'width: 150px;\'> Grade </th>
        <th  style=\'width: 150px;\'> Median </th>
    </tr>';
        $medianValues = array();
        foreach ($assignments as $key => $value) {
            $medianValues = $value;
        }
        foreach ($result as $row) {
            $grades_contents .= '<tr>';
            $grades_contents .=    '<td> Assignment ' . $row["AssignmentID"] . '</td>';
            $grades_contents .=     ' <td>' . $row["Grade"] . '</td>';
            $grades_contents .=     '<td>' . $medianValues . '</td>';
            //  $grades_contents .=     '<td>' . $median . '</td>';
            $grades_contents .=    '</tr>';
        }
        $grades_contents .= '</table>';
    }
    // If there are no rows, the student has no grades yet;
    // this is a normal scenario, so no error.
    $connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Grades</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="grades-style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		
	
    </head>
    <body>

        <section id="header">
            <a id="logo" href="#"><i class="bi bi-shop"></i>Grade Management system</a>

            <div>
                <ul id="navbar">
                    <li><a class="active" href="mycourses.php">My Courses</a></li>
                    <li><a href="participants.php">Participants</a></li>
		            <li><a href="mycourses.php" data-bs-toggle="modal" data-bs-target="#exampleModal">My account</a></li>
                    <li><a href="logout.php" >Logout</a></li>
                </ul>
            </div>
        </section>

        <section id="page-header">
            <h2>GRADES</h2>
        </section>

        <section id="grades">
            <h2>Grades</h2>
            <?php
                echo $grades_contents;
            ?>
        </section>
        <section id="report">
            <h2>Report</h2>
            <h3 id="reportStatistics">Statistics</h3>
            <table class="table" id="statisticsTable">
                <thead>
                    <th>Standard Deviation</th>
                    <th>Rank</th>
                    <th>Percentile</th>
                </thead>
                <tbody></tbody>
            </table>
            <h3 id="reportMedians">Assignment Medians</h3>
            <table class="table" id="mediansTable">
                <thead>
                    <th>Assignment</th>
                    <th>Median</th>
                </thead>
                <tbody></tbody>
            </table>
        </section>
	
	<?php include 'footer.php';?>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">My Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <tr>
                        <?php
                        if (isset($_SESSION['StudentID'])) {
                            echo "<td id='myname'> " . $_SESSION['Name'] . "</td><br>";
                            echo "<td id='myemail'> " . $_SESSION['Email'] . "</td><br>";
                            echo "<td id='myid'> " . $_SESSION['StudentID'] . "</td><br>";   
                        } else {
                            echo "<td id='myname'> " . $_SESSION['Name'] . "</td><br>";
                            echo "<td id='myemail'> " . $_SESSION['Email'] . "</td><br>";
                            echo "<td id='myid'> " . $_SESSION['TeacherID'] . "</td><br>";
                        }
                        
                        ?>
                        

                    </tr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary"> <a href="logout.php" style="color:white; text-decoration: none;">Logout</a> </button>
                </div>
                </div>
            </div>
        </div>

        <script src="demo-data.js"></script>
        <script src="student-grades.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


    </body>
</html>

