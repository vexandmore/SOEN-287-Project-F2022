<?php
// run session_start() and check if logged in as teacher
include "login-resources/session-check-teacher.php";


$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);
if (!empty($_POST))
  {
  $sql="DELETE FROM `grades` 
    WHERE StudentID = ? AND AssignmentID  = ?";
     $stmt= $mysqli->prepare($sql);
     $stmt->bind_param("ii", $_POST["studentid"], $_POST["assignmentid"]);
     $stmt->execute();

  $sql = "INSERT INTO `grades` (AssignmentID, Grade, StudentID) VALUES (?, ?,?)";
  $stmt= $mysqli->prepare($sql);

  $assignmentid = intval($_POST["assignmentid"]);
  $grade = intval($_POST["grade"]);
  $studentid = intval($_POST["studentid"]);
  
  $stmt->bind_param("iii", $assignmentid, $grade, $studentid);
  $stmt->execute();
  }
$result = $mysqli->query("SELECT * FROM students");
$students = array ();
foreach ($result as $row) {
  $students[$row['StudentID']] = $row['FirstName'] . " " . $row['LastName'];
}
$result->close();

$result = $mysqli->query("SELECT * FROM assignments");
$assignments = array ();
foreach ($result as $row) {
  $assignments[$row['AssignmentID']] = $row['Name'];
}

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
  <link rel="stylesheet" href="styleTeacher.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  </head>
  <section id="header">
    <a id="logo" href="#"><i class="bi bi-shop"></i>Teacher Page</a>

    <div>
        <ul id="navbar">
 <li><a href="teacher page.php">My Courses</a></li>
 <li><a href="participants.php">Participants</a></li>
 <li><a href="Grades.php" data-bs-toggle="modal" data-bs-target="#exampleModal">My account</a></li>
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
          <h2>Grades</h2>
        <ul>
          
        
        </ul>
      
      </aside>
      <div>
        <ul id="navbar">
        <h1><li><a  href="teacher page.php">Home</a></li>
          <li><a  href="Assignments.php">Assignments</a></li>
          <li><a class="active" href="Grades.php">Grades</a></li>
          <li><a href="Final Marks.php">Final Marks</a></h1>
        </ul>
      </div>
      <main class="content">        
        <hr><br>
        <h2>Upload grades here:</h2>
        <form action="Grades.php" method="POST">
          <div class="form-group row">
            <label for="selectStudent" class="col-sm-3 col-form-label">Select Student</label>
            <div class="col-sm-5">
                <select id="selectStudent" class="form-control" name="studentid">
                    <?php 
                      foreach($students as $studentID => $name) {
                        echo "<option value=\"$studentID\"> $name </option>";
                      }
                    ?>
                </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="selectStudent" class="col-sm-3 col-form-label">Select Assignment</label>
            <div class="col-sm-5">
                <select id="selectStudent" class="form-control" name="assignmentid">
                    <?php 
                      foreach($assignments as $assignmentID => $name) {
                        echo "<option value=\"$assignmentID\"> $name </option>";
                      }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="type-grade" class="col-sm-3 col-form-label" name="grade">Type grade</label>
            <div class="col-sm-5">
                <input type="text" id="type-grade" class="form-control" placeholder="Type grade here" name="grade">
            </div>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Upload Grade">
        </div>
          </form>


        <br>
      </main>
    </div>
      
      <?php include 'footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>
  </html>
