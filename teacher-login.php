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
        $sql = "SELECT TeacherID, FirstName, LastName, Email, Password
                FROM teachers
                WHERE Email=?";
        if ($statement = $con->prepare($sql)) {
            $statement->bind_param('s', $email);
            $statement->execute();
	        $statement->store_result();
            if ($statement->num_rows() == 1) {
                $statement->bind_result($TeacherID, $FirstName, $LastName, $Email, $DB_Password);
                $statement->fetch();
                if ($DB_Password == $password) {
                    // Login is successful, start new session
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['Name'] = $FirstName . ' ' . $LastName;
                    $_SESSION['TeacherID'] = $TeacherID;
                    $_SESSION['Email'] = $Email;
                    // Redirect to marks page
                    header("location: teacher%20page.php");
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


$login_error = $email_error . $password_error . $login_error;

if (!empty($login_error)) {
    $error_code = "403";
    include "login-resources/login_error.php";
}

$con->close();
?>