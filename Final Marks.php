<?php


$mysqli = new mysqli("127.0.0.1", "root", "", "gms", 3306);
if (!empty($_POST))
  {
  $sql="DELETE FROM `final grades` 
    WHERE StudentID = ?";
     $stmt= $mysqli->prepare($sql);
     $stmt->bind_param("i", $_POST["studentid"]);
     $stmt->execute();

  $sql = "INSERT INTO `final grades` (FinalGrade, StudentID) VALUES (?,?)";
  $stmt= $mysqli->prepare($sql);
  $stmt->bind_param("si", $_POST["grade"], $_POST["studentid"]);
  $stmt->execute();
  }
$result = $mysqli->query("SELECT * FROM students");
$students = array ();
foreach ($result as $row) {
  $students[$row['StudentID']] = $row['FirstName'] . " " . $row['LastName'];
}

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Final Marks</title>
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
<li><a href="home.html">Home</a></li>
 <li><a href="mycourses.html">My Courses</a></li>
 <li><a class="active" href="services.html">User Guide</a></li>
 <li><a href="myaccount.html">My account</a></li>
 <li><a href="login.html">Logout</a></li>
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
          <h2>Final Marks</h2>
        <ul>
          
        
        </ul>
      
      </aside>
      <h4><li><a class="active" href="teacher page.html">Home</a></li>
        <li><a href="Assignments.html">Assignments</a>
        <li><a href="Grades.html">Grades</a></li>
        <li><a href="Final Marks.html">Final Marks</a></h4>
      <main class="content">
        <h2>Final marks:</h2>
        <p>William Lee: A-</p>
        <p>Mohammad Ali: B</p>
        <p>Sophia Smith: C+</p>
        
        <hr><br>

        <html>
  <head>
    <title>student calculate</title>
    <!-- link for font  -->
    <link
      href=
"https://fonts.googleapis.com/css?family=Righteous&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <!-- main html  -->
    <div class="container">
      <h1>Student grade calculator</h1>
      <div class="screen-body-item">
        <div class="app">
          <div class="form-group">
            <!-- option for taking the input -->
            <input
              type="text"
              class="form-control"
              placeholder="ASSIGNMENT1"
              id="assignment1"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="ASSIGNMENT2"
              id="assignment2"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="MIDTERM"
              id="midterm"
            />
          </div>
          <div class="form-group">
            <input
              type="text"
              class="form-control"
              placeholder="FINAL"
              id="final"
            />
          </div>
          <div>
            <input
              type="button"
              value="Show percentage & letter grade"
              class="btn btn-primary"
              onclick="calculate()"
            />
          </div>
        </div>
      </div>
      <!-- for showing the result-->
      <div class="form-group showdata">
        <p id="showdata"></p>
      </div>
    </div>
    <!--adding external javascript file-->
    <script src="Grade_calc.js"></script>
    <p>Insert the grades over 100%</p>
    <p>Evaluation scheme: Assignment1 (10%); Assignment2 (10%); Midterm (30%); Final(50%). </p>
  </body>
</html>

        <h2>Upload final marks here</h2>
        <form action="Final Marks.php" method="POST">
          <div class="form-group row">
            <label for="selectStudent" class="col-sm-3 col-form-label">Select Student</label>
            <div class="col-sm-5">
                <select name="studentid" id="selectStudent" class="form-control">
                  <?php
                  foreach (($students) as $id=>$name) {
                  echo "<option value=\"$id\"> $name </option>";
                  }
                  ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="type-grade" class="col-sm-3 col-form-label">Select grade</label>
            <div class="col-sm-5">
              <select name="grade" id="selectStudent" class="form-control">
                <option>A+</option>
                <option>A</option>
                <option>A-</option>
                <option>B+</option>
                <option>B</option>
                <option>B-</option>
                <option>C+</option>
                <option>C</option>
                <option>C-</option>
                <option>D+</option>
                <option>D</option>
                <option>D-</option>
                <option>F</option>
                
            </select>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" 
             class="btn btn-primary" 
             value="Upload Final Mark"
             >
            
        </div>
          </form>

       

        
       <br>
      </main>
      <footer class="footer">&copy; Copyright Concordia University.</footer>
    </div>
  </body>