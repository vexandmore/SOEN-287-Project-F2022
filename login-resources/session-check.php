<?php

session_start();
// check if used is logged in
if (!(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)) {
    header('HTTP/1.0 403 Unauthorized');
    $login_error = "You are not logged in";
    $error_code = "403";
    include "login_error.php";
    die();
}

?>