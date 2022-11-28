<?php
// run session_start() and check if logged in as teacher
include "login-resources/session-check-teacher.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="grades-style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- CSS only -->
  <link rel="stylesheet" href="styleTeacher.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  
  <style>
    td
    {
      color: black;
    }
    </style>

  </head>
  <section id="header">
    <a id="logo" href="#"><i class="bi bi-shop"></i>Teacher Page</a>

    <div>
        <ul id="navbar">
 <li><a class="active" href="teacher page.php">My Courses</a></li>
 <li><a href="participants.php">Participants</a></li>
 <li><a href="teacher page.php" data-bs-toggle="modal" data-bs-target="#exampleModal">My account</a></li>
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
          <h2>Home</h2>
        <ul>
          
        
        </ul>
      
      </aside>
      <div>
        <ul id="navbar">
        <h1><li><a class="active" href="teacher page.php">Home</a></li>
          <li><a  href="Assignments.php">Assignments</a></li>
          <li><a href="Grades.php">Grades</a></li>
          <li><a href="Final Marks.php">Final Marks</a></h1>
        </ul>
      </div>
      <main class="content">
        <h2>Personal information</h2>
        <p>First Name: Luke</p>
        <p>Last Name: Lawson</p>
        <hr><br>
        <h2>IT Desk: How Can I Help You?</h2>
        
        <form>
          <label>Name:<input type="text" name="name"></label><br>
          <label>Email: <input type="text" name="email"></label><br>
          <textarea name="comments" rows="4">Enter your message</textarea><br>
          <input type="submit" value="Submit" /><br>
        </form>
      </main>
    </div>
     <?php include 'footer.php';?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>


  </body> 
  </html>
