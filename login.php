<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

//connection CHECK
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


session_start();
// If user is logged in, redirect to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    header("location: mycourses.html");
    exit;
}

$email = $password = "";
$email_error = $password_error = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    if (empty($email)) {
        $email_error = "No email provided";
    }
    $password = trim($_POST['password']);
    if (empty($password)) {
        $password_error = "No password provided";
    }

    if (empty($email_error) && empty($password_error)) {
        $sql = "SELECT StudentID, FirstName, LastName, Email, Password
                FROM students 
                WHERE Email=?";
        if ($statement = $con->prepare($sql)) {
            $statement->bind_param('s', $email);
            $statement->execute();
	        $statement->store_result();
            if ($statement->num_rows() == 1) {
                $statement->bind_result($StudentID, $FirstName, $LastName, $Email, $DB_Password);
                $statement->fetch();
                if ($DB_Password == $password) {
                    // Login is successful, start new session
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['Name'] = $FirstName . ' ' . $LastName;
                    $_SESSION['StudentID'] = $StudentID;
                    // Redirect to marks page
                    header("location: mycourses.html");
                    exit;

                } else {
                    // Wrong password
                    $login_error = "Invalid Email or Password ";
                }
            } else {
                // Wrong username
                $login_error = "Invalid Email or Password";
            }

            $statement->close();
        } else {
            $login_error = "something went wrong";
        }
    }
}

$con->close();
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
		
	
    </head>
    <body>

        <section id="header">
            <a id="logo" href="#"><i class="bi bi-shop"></i>Grade Management system</a>

            <div>
                <ul id="navbar">
				    <li><a href="home.html">Home</a></li>
                    <li><a href="mycourses.html">My Courses</a></li>
                    <li><a href="services.html">User Guide</a></li>
					<li><a class="active" href="login.html">My account</a></li>
                </ul>
            </div>
        </section>

        <section id="page-header">
            <h2>LOG IN!</h2>
            <p>Hi, Login to take advantage of all your services!</p>
        </section>
        <section id="form-details">
            <?php
            if (!empty($password_error)) {
                echo "<h3 style='color: red'>$password_error</h3>";
            }
            if (!empty($email_error)) {
                echo "<h3 style='color: red'>$email_error</h3>";
            }
            if (!empty($login_error)) {
                echo "<h3 style='color: red'>$login_error</h3>";
            }
            ?>

            <form action="login.php" method="POST" id="loginForm">
				<h3 style="text-decoration: underline">Enter your details here:</h3> </br>
				
				<label for="text">Enter your email id and password to Login</label><br>
 
				
                <input type="email" id="email" name = "email" placeholder="EMAIL">
				<input type="password" id="password" name="password" placeholder= "PASSWORD" size = "30" />
                <h5 style="color:red" id="input_error">Please enter a valid First Name</h5>
                <h4>Don't have an account? <a href="signup page.html"> <b>Sign up </b></a> here.</h4>
                 <button type = "button" name="submit" class="normal" onclick="logInButton()">Log in</button> <br/>
				 <h4>GMS teacher? <a href="teacher-login.html"> <b>Login </b></a> here.</h4>
				
            </form>
        </section>
        <script>
            document.getElementById("input_error").innerText = "";
            function logInButton(){
                        var valid = true;
                        var errorString = "";
                        var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                        //input validation
                        if (!document.getElementById("email").value.match(validRegex)){
                            valid = false;
                            errorString = "Please enter a valid email";
                        }
                        else if (document.getElementById("password").value == ""){
                            valid = false;
                            errorString = "Please enter a valid password";
                        }
                        // Submit form to log in
                        if (valid){
                            document.getElementById('loginForm').requestSubmit();
                        }
                        else {
                            document.getElementById("input_error").innerText = errorString;
                        }
                    }
        </script>
	
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
                <a href="mycourses.html">View My Courses</a>
                <a href="teacher page.html">View Teacher's page</a>
                <a href="#">User Guide</a>
            </div>
        </footer>

    </body>
</html>
