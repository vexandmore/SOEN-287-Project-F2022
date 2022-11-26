<?php
// run session_start() and check if logged in as teacher
include "login-resources/session-check-teacher.php";

// connect to database
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

// creating a connection and checking whether the connection can be established 
try {
  $connect = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
} catch (mysqli_sql_exception $e) {
  die("Error connecting to database " . $e);
}

// Load assignments in from db into $assignmentsInfo variable
$sql = "SELECT Name, Weight, AssignmentID FROM assignments;";
$assignments = mysqli_query($connect, $sql);
if (mysqli_num_rows($assignments) == 0) {
  $assignmentsInfo = [];
} else {
  while ($assignment = mysqli_fetch_assoc($assignments)) {
    $assignmentsInfo[$assignment['AssignmentID']] = ['Name' => $assignment['Name'], 'Weight' => $assignment['Weight']];
  }
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Assignments</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="grades-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- CSS only -->
  <link rel="stylesheet" href="styleTeacher.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  </head>
  <section id="header">
    <a id="logo" href="#"><i class="bi bi-shop"></i>Teacher Page</a>

    <div>
        <ul id="navbar">
 <li><a href="teacher page.php">My Courses</a></li>
 <li><a href="participants.php">Participants</a></li>
 <li><a href="myaccount.php">My account</a></li>
 <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
      
  </section>

</section>
  <body>
    <div class="container">
      <header class="header">
        
      </header>
      <aside class="left">
        <section id="page-header">
          <br>
          <h2>Assignments</h2>
        <ul>
          
        
        </ul>
      
      </aside>
      <div>
        <ul id="navbar">
        <h1><li><a href="teacher page.php">Home</a></li>
          <li><a class="active" href="Assignments.php">Assignments</a></li>
          <li><a href="Grades.php">Grades</a></li>
          <li><a href="Final Marks.php">Final Marks</a></h1>
        </ul>
      </div>
    <main class="content">
      <h2>Assignments:</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Assignment Name</th>
            <th>Assignment Weight</th>
        </thead>
        <?php
        foreach ($assignmentsInfo as $id=>$info) {
          echo "<tr>";
          echo "<td><p>" . $info['Name'] . "</p></td>";
          echo "<td><p>" . $info['Weight'] . "</p></td>";
          echo "</tr>";
        }
        ?>
      </table>
      
      <hr><br>
      <h2>Upload assignments here:</h2>
      <form>
        <section id="addAssignment">
          <form>
              <input type="text" placeholder="Select folder">
              <br/>
              <input class="btn btn-primary" type="submit" value="Upload Assignment">
          </form>
        </section>
     </form>

     
      </main>
    </div>
      
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
                <a href="teacher page.php">View Teacher's page</a>
                <a href="#">User Guide</a>
            </div>
        </footer>
  </body>
  </html>
  