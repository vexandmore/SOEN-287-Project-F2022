<?php

session_start();
// check if used is logged in as student
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    if (!isset($_SESSION['TeacherID'])) {
        header('HTTP/1.0 401 Forbidden');
        $login_error = "You are logged in as a student, not a teacher";
        $error_code = "401";
        include "login_error.php";
        die();
    }
} else {
    header('HTTP/1.0 403 Unauthorized');
    $login_error = "You are not logged in";
    $error_code = "403";
    include "login_error.php";
    die();
}

?>