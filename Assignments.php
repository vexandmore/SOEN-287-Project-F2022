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
$sql = "SELECT Name, Weight, AssignmentID, DueDate FROM assignments;";
$assignments = mysqli_query($connect, $sql);
if (mysqli_num_rows($assignments) == 0) {
  $assignmentsInfo = [];
} else {
  while ($assignment = mysqli_fetch_assoc($assignments)) {
    $assignmentsInfo[$assignment['AssignmentID']] = 
            ['Name' => $assignment['Name'], 'Weight' => $assignment['Weight'], 'DueDate' => $assignment['DueDate']];
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
 <li><a href="Assignments.php" data-bs-toggle="modal" data-bs-target="#exampleModal">My account</a></li>
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
      <p class='bg-success msgBanner' id="confirmMessage"></p>
      <p class='bg-danger msgBanner' id="errorMessage"></p>
      <h2>Assignments:</h2>
      <table class="table">
        <thead>
          <tr>
            <th>Assignment Name</th>
            <th>Assignment Weight</th>
            <th>Change Assignment Weight</th>
        </thead>
        <?php
        foreach ($assignmentsInfo as $id=>$info) {
          echo "<tr>";
          echo "<td><p>" . $info['Name'] . "</p></td>";
          echo "<td><p>" . $info['Weight'] . "</p></td>";
          ?>
          <td>
            <form class='table-form' action='ModifyAssignments.php' method='post'>
              <input type='text' name='assignmentWeight' >
              <input type='hidden' name='assignmentID' value='<?php echo $id?>' >
              <input class='btn btn-primary' type='submit' value='Set Weight'>
            </form>
          </td>
          <?php
          echo "</tr>";
        }
        ?>
      </table>
      
      <hr><br>
      
        </section>
     </form>
     
     
     
     
     <head>
          <title> Use of JQuery to Add Edit Delete Table Row </title>
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
      </head>
      <body>
      
          <div class="container">
              <h1> Upload Assignment here:</h1>
              <form id="addcustomerform">
                  <div class="form-group">
                      <label>Assignment #:</label>
                      <select type="text" name="selectAssignmentNB" id="txtAssignmentNB" class="form-control" value="" required="">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                      
                  </div>
                  <div class="form-group">
                      <label>File:</label>
                      <input type="file" name="file1" id="file1"></input>
                  </div>
                  <div class="form-group">
                      <label>Due date:</label>
                      <input type="text" name="txtDueDate" id="txtDueDate" class="form-control" value="" required="">
                  </div>
                  <button type="submit" id="btnaddAssignment" class="btn btn-primary save-btn">Upload Assignment</button>
      
              </form>
              <br />
              <fieldset>
                  <legend>Assignment List
                  </legend>
                  <table class="table">
                      <thead>
                          <tr>
                              <th>AssignmentID</th>
                              <th>Assignment #</th>
                              <th>File</th>
                              <th>Due date</th>
                          </tr>
                      </thead>
                      <tbody id="tblbody">
                        <?php
                        foreach ($assignmentsInfo as $id=>$attrs) {
                          $DueDate = $attrs["DueDate"];

                          echo "<tr id='$id' data-assignmentid='$id' data-assignmentnb='$id' file='blank for now' data-duedate='$DueDate'>";
                          echo "<td class='td-data'>$id</td>";
                          echo "<td class='td-data'>$id</td>";
                          echo "<td class='td-data'>blank for now</td>";
                          echo "<td class='td-data'>$DueDate</td>";
                          echo "<td class='td-data'><button id='btnedit$id' class='btn btn-info btn-xs btn-editcustomer' 
                                onclick='showeditrow($id)'> <i class='fa fa-pencil' aria-hidden='true'></i>Edit</button> </td>";
                          echo "<td class='td-data'><button id='btndelete$id' class='btn btn-danger btn-xs btn-deleteAssignment' 
                                onclick='deleteAssignmentRow($id)'> <i class='fa fa-trash' aria-hidden='true'></i>Delete</button> </td>";
                          echo "</tr>";
                        }
                        ?>
                      </tbody>
                  </table>
              </fieldset>
          </div>
      </body>





      <script type="text/javascript">
        function CreateUniqueAssignmentID()
        {
            const ID = Date.now();
            return ID;
        }
        document.getElementById("btnaddAssignment").addEventListener("click", function (event) {
            event.preventDefault()
            var AssignmentID = CreateUniqueAssignmentID();
            var AssignmentNB = document.getElementById("txtAssignmentNB").value;
            var File = document.getElementById("file1").value;
            var DueDate = document.getElementById("txtDueDate").value;
            var btneditId = "btnedit" + AssignmentID;
            var btndeleteId = "btndelete" + AssignmentID;
            var tablerow = "<tr Id='" + AssignmentID + "'   data-AssignmentID='" + AssignmentID + "'   data-AssignmentNB='" + AssignmentNB + "' data File='" + File + "'   data-DueDate='" + DueDate + "'>"

                          + "<td class='td-data'>" + AssignmentID + "</td>"
                          + "<td class='td-data'>" + AssignmentNB + "</td>"
                          + "<td class='td-data'>" + File + "</td>"
                          + "<td class='td-data'>" + DueDate + "</td>"
                          + "<td class='td-data'>" +
                          "<button id='" + btneditId + "' class='btn btn-info btn-xs btn-editcustomer' onclick='showeditrow(" + AssignmentID + ")'><i class='fa fa-pencil' aria-hidden='true'></i>Edit</button>" +
                          "<button id='" + btndeleteId + "' class='btn btn-danger btn-xs btn-deleteAssignment' onclick='deleteAssignmentRow(" + AssignmentID + ")'><i class='fa fa-trash' aria-hidden='true'>Delete</button>"
                          + "</td>"
                          + "</tr>";
            debugger;
            document.getElementById('tblbody').innerHTML += tablerow;
            document.getElementById('txtAssignmentNB').value = "";
            document.getElementById('file1').value = "";
            document.getElementById('txtDueDate').value = "";
        });

        function showeditrow(AssignmentID)
        {
            debugger;
            var AssignmentRow = document.getElementById(AssignmentID); //this gives tr of  whose button was clicked

            var data = AssignmentRow.querySelectorAll(".td-data");

            /*returns array of all elements with
            "row-data" class within the row with given id*/

            var AssignmentID = data[0].innerHTML;
            var AssignmentNB = data[1].innerHTML;
            var File = data[2].innerHTML;
            var DueDate = data[3].innerHTML;
            var btneditId = "btnedit" + AssignmentID;
            data[0].innerHTML = '<input name="txtupdate_AssignmentID"  disabled id="txtupdate_AssignmentID" value="' + AssignmentID + '"/>';
            data[1].innerHTML='<input name="txtupdate_AssignmentNB" id="txtupdate_AssignmentNB" value="' + AssignmentNB + '"/>';
            data[2].innerHTML='<input name="txtupdate_File" id="txtupdate_File" value="' + File + '"/>';
            data[3].innerHTML='<input name="txtupdate_DueDate" id="txtupdate_DueDate" value="' + DueDate + '"/>';

            data[4].innerHTML =
                "<button class='btn btn-primary btn-xs btn-updateAssignment' onclick='updateassignments(" + AssignmentID + ")'>" +
                "<i class='fa fa-pencil' aria-hidden='true'></i>Update</button>"
                + "<button class='btn btn-warning btn-xs btn-cancelupdate' onclick='cancelupdate(" + AssignmentID + ")'><i class='fa fa-times' aria-hidden='true'></i>Cancel</button>"
                + "<button class='btn btn-danger btn-xs btn-deleteAssignment' onclick='deleteAssignmentRow(" + AssignmentID + ")'>"
                + "<i class='fa fa-trash' aria-hidden='true'></i>Delete</button>"
        }
        function cancelupdate(AssignmentID)
        {
            debugger;
            var btneditId = "btnedit" + AssignmentID;
            var btndeleteId = "btndelete" + AssignmentID;

            var AssignmentRow = document.getElementById(AssignmentID); //this gives tr of  whose button was clicked
            var data = AssignmentRow.querySelectorAll(".td-data");

            var AssignmentNB = AssignmentRow.getAttribute("data-AssignmentNB");
            var File = AssignmentRow.getAttribute("data File");
            var DueDate = AssignmentRow.getAttribute("data-DueDate");


            data[0].innerHTML = AssignmentID;
            data[1].innerHTML = AssignmentNB;
            data[2].innerHTML = File;
            data[3].innerHTML = DueDate;

            var actionbtn = "<button id='" + btneditId + "' class='btn btn-info btn-xs btn-editcustomer' onclick='showeditrow(" + AssignmentID + ")'><i class='fa fa-pencil' aria-hidden='true'></i>Edit</button>" +
                          "<button id='" + btndeleteId + "' class='btn btn-danger btn-xs btn-deleteAssignment' onclick='deleteAssignmentRow(" + AssignmentID + ")'><i class='fa fa-trash' aria-hidden='true'>Delete</button>"
            data[4].innerHTML = actionbtn;
        }
        function deleteAssignmentRow(AssignmentID)
        {
            document.getElementById(AssignmentID).remove();
        }
        function updateassignments(AssignmentID)
        {
            var btneditId = "btnedit" + AssignmentID;
            var btndeleteId = "btndelete" + AssignmentID;

            var AssignmentRow = document.getElementById(AssignmentID); //this gives tr of  whose button was clicked
            var data = AssignmentRow.querySelectorAll(".td-data");

            var AssignmentNB = data[1].querySelector("#txtupdate_AssignmentNB").value;
            var File = data[2].querySelector("#txtupdate_File").value;
            var DueDate = data[3].querySelector("#txtupdate_DueDate").value;


            data[0].innerHTML = AssignmentID;
            data[1].innerHTML = AssignmentNB;
            data[2].innerHTML = File;
            data[3].innerHTML = DueDate;

            var actionbtn = "<button id='" + btneditId + "' class='btn btn-info btn-xs btn-editcustomer' onclick='showeditrow(" + AssignmentID + ")'><i class='fa fa-pencil' aria-hidden='true'></i>Edit</button>" +
                          "<button id='" + btndeleteId + "' class='btn btn-danger btn-xs btn-deleteAssignment' onclick='deleteAssignmentRow(" + AssignmentID + ")'><i class='fa fa-trash' aria-hidden='true'>Delete</button>"
            data[4].innerHTML = actionbtn;

            // Actually add it to the database
            var toSend = {"AssignmentID": AssignmentID, "DueDate": DueDate};
            
            xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
              if (xhr.readyState == 4 && (xhr.status = 200)) {
                alert('success! ' + xhr.responseText);
              }
            }
            xhr.open("POST", "api/updateAssignment.php", true);
            xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
            xhr.send(JSON.stringify(toSend));
        }
    </script>


     
      </main>
    </div>
      
      <?php include 'footer.php';?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

  </body>
        <script>
          const params = new URLSearchParams(window.location.search);
          if (params.get("confirmMessage")) {
            document.getElementById('confirmMessage').innerText = params.get("confirmMessage");
            document.getElementById('confirmMessage').style.display = 'block';
          }
          if (params.get("errorMessage")) {
            document.getElementById('errorMessage').innerText = params.get("errorMessage");
            document.getElementById('errorMessage').style.display = 'block';
          }
        </script>
  </html>
  
