<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'gms';

//connection CHECK
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Create table if it doesn't exist
$con->query("CREATE TABLE IF NOT EXISTS `students` (
	`StudentID` int(11) NOT NULL,
	`Name` varchar(128) NOT NULL,
	`Email` varchar(128) NOT NULL,
	`Password` varchar(128) NOT NULL,
	PRIMARY KEY (`StudentID`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

//Various verification (lines 15-36)
if ( !isset($_POST['firstName'], $_POST['lastName'], $_POST['email']) ) {
	
	exit('Please fill both of the name fields and the email field');
}

if ( empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email']) || empty($_POST['id'])) {
	
	exit('Please complete singup form');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['lastName']) == 0) {
    exit('Name is not valid');
}

if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['firstName']) == 0) {
    exit('Name is not valid');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid');
}

if (isset($_POST['teacher_check']) && $_POST['teacher_check'] = "teacher-check") {
	$table = "teachers";
	$id_column = "TeacherID";
	$logged_in_page = "teacher page.php";
} else {
	$table = "students";
	$id_column = "StudentID";
	$logged_in_page = "mycourses.php";
}

// Verifying existence of id (i.e. the account)
if ($stmt = $con->prepare("SELECT $id_column FROM $table WHERE $id_column = ?")) {
	
	$stmt->bind_param('s', $_POST['id']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result and check if the email is already registered
	if ($stmt->num_rows > 0) {
		// email exists already
		echo 'id is already registered';
	} else {
	
    //new email, account can be created
		if ($stmt = $con->prepare("INSERT INTO $table (FirstName, LastName, Email, $id_column, Password) VALUES (?, ?, ?, ?, ?)")) {
			$firstname = $_POST['firstName'];
			$lastname = $_POST['lastName'];
			$email = $_POST['email'];
			$id = intval($_POST['id']);
			$password = $_POST['password'];
			$stmt->bind_param('sssis', $firstname, $lastname, $email, $id, $password);
			$stmt->execute();
			// Now that the account is created, log them in by initializing the session
			session_start();
			$_SESSION['loggedin'] = true;
			$_SESSION['Name'] = $firstname . ' ' . $lastname;
			$_SESSION[$id_column] = $id;
			$_SESSION['Email'] = $email;
			header("Location: $logged_in_page");
			die();
		} else {
			echo 'Could not prepare statement!';
		}
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$con->close();
?>