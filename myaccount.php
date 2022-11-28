<?php
session_start();

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Login Page</title>
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
		
        <style>
            table {
                max-width: 500px;
            }

            #user-info {
                padding: 15px;
            }
        </style>
    </head>
    <body>

        <section id="header">
            <a id="logo" href="#"><i class="bi bi-shop"></i>Grade Management system</a>

            <div>
                <ul id="navbar">
                    <?php
                    if ((isset($_SESSION['StudentID']))) {
                        echo "<li><a href=\"mycourses.php\">My Courses</a></li>";
                    } else {
                        echo "<li><a href=\"teacher page.php\">My Courses</a></li>";
                    }
                    ?>
                    <li><a href="participants.php">Participants</a></li>
					<li><a class="active" href="myaccount.php">My account</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </section>

        <section id="page-header">
            <h2>USER PAGE</h2>
        </section>
        <section id="user-info">
            <h3>Data</h3>
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <?php
                    if (isset($_SESSION['StudentID'])) {
                        echo "<th>Student ID</th>";
                    } else {
                        echo "<th>Teacher ID</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if (isset($_SESSION['StudentID'])) {
                            echo "<td> " . $_SESSION['Name'] . "</td>";
                            echo "<td> " . $_SESSION['Email'] . "</td>";
                            echo "<td> " . $_SESSION['StudentID'] . "</td>";   
                        } else {
                            echo "<td> " . $_SESSION['Name'] . "</td>";
                            echo "<td> " . $_SESSION['Email'] . "</td>";
                            echo "<td> " . $_SESSION['TeacherID'] . "</td>";
                        }
                        ?>
                    </tr>
                </tbody>
            </table>
        </section>
	
	<?php include 'footer.php';?>

    </body>
</html>
