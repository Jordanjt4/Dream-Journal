<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputsSignup($username, $pwd) !== false) {
        header("location: ../signup.php?error=emptyinput"); // put something in the url to notify what went wrong
        exit();
    }

    if (invalidUid($username) !== false) {
        header("location: ../signup.php?error=invaliduid"); 
        exit();
    }

    if (uidExists($conn, $username) !== false) {
        header("location: ../signup.php?error=uidexists"); 
        exit();
    }

    createUser($conn, $username, $pwd); 

} else {
    header("location: ../signup.html");
    exit();
}