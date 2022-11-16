<?php
session_start();
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
   $grades_contents = '<table>
            <tr>
                <th  style=\'width: 150px;\'> Assignment </th>
                <th  style=\'width: 150px;\'> Grade </th>
            </tr>';
    foreach ($result as $row){
        $grades_contents .= '<tr>';
        $grades_contents .=    '<td> Assignment ' .$row["AssignmentID"]. '</td>';
        $grades_contents .=     ' <td> Grade: ' .$row["Grade"]. '</td>';
        $grades_contents .=    '</tr>';
    }
    $grades_contents .= '</table>';

}
else{
    echo "No values to display";
}
$connect -> close();
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
		    <li><a href="myaccount.php">My account</a></li>
                    <li><a href="logout.php">Logout</a></li>
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
	
	<footer class="section-p1">
            <div class="col">
                <i class="bi bi-shop"></i>
                <h4>Contact</h4>
                <p><strong>Address: </strong> 640 Callas Street, Los Pierrefonds, Montreal</p>
                <p><strong>Phone: </strong> +1 (514) 538-4020</p>
                <div class="follow">
                    <h4>Follow us</h4>
                    <div class="icon">
                        <i class="bi bi-facebook"></i>
                        <i class="bi bi-instagram"></i>
                        <i class="bi bi-twitter"></i>
                        <i class="bi bi-youtube"></i>
                        <i class="bi bi-pinterest"></i>
                    </div>
                </div>
            </div>

            <div class="col">
                <h4>My Account</h4>
                <a href="signup page.html">Sign up</a>
                <a href="mycourses.php">View My Courses</a>
                <a href="teacher page.html">View Teacher's page</a>
                <a href="#">User Guide</a>
            </div>
        </footer>

        <script src="demo-data.js"></script>
        <script src="student-grades.js"></script>
    </body>
</html>
