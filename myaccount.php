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
                    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
                        echo "<li><a href=\"mycourses.php\">My Courses</a></li>";
                    } else {
                        echo "<li><a href=\"teacher page.html\">My Courses</a></li>";
                    }
                    ?>
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
                    if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
                        echo "<th>Student ID</th>";
                    } else {
                        echo "<th>Teacher ID</th>";
                    }
                    ?>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        if ((isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
                            echo "<td> " . $_SESSION['Name'] . "</td>";
                            echo "<td> " . $_SESSION['Email'] . "</td>";
                            echo "<td> " . $_SESSION['StudentID'] . "</td>";   
                        } else {
                            echo "<td> Luke Lawson </td>";
                            echo "<td> lukelawson@gmail.com </td>";
                            echo "<td> 4073615 </td>";
                        }
                        ?>
                    </tr>
                </tbody>
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

    </body>
</html>
