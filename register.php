<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'signup';

//connection CHECK
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

//Various verification (lines 15-36)
if ( !isset($_POST['firstName'], $_POST['lastName'], $_POST['email']) ) {
	
	exit('Please fill both of the name fields and the email field');
}

if ( empty($_POST['firstName']) || empty($_POST['lastName']) || empty($_POST['email'])) {
	
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


// Verifying existence of email (i.e. the account)
if ($stmt = $con->prepare('SELECT email, password FROM signup WHERE email = ?')) {
	
	$stmt->bind_param('e', $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result and check if the email is already registered
	if ($stmt->num_rows > 0) {
		// email exists already
		echo 'Email is already registered';
	} else {
	
    //new email, account can be created
if ($stmt = $con->prepare('INSERT INTO signup (lastName, firstName, email) VALUES (?, ?, ?)')) {
	
	echo 'You have successfully registered, you can now login!';
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