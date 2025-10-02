<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// if user not logged in, redirect
if (!isset($_SESSION["useruid"])) {
    header("location: home.html");
    exit();
}

// check if request came from a form
if (isset($_POST["submit"])) {  
    $noteId = trim(isset($_POST["noteId"]) ? $_POST["noteId"] : '');
    $title = trim(isset($_POST["title"]) ? $_POST["title"] : ''); // remove white spaces before and after
    $content = trim(isset($_POST["content"]) ? $_POST["content"] : '');
    $date = isset($_POST["date"]) ? $_POST["date"] : '';

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputsSignup($content, $date) !== false) {
        header("location: ../home.php?error=emptyinput"); 
        exit();
    }

    if(!empty($_POST['noteId'])) {
        updateEntry($conn, $noteId, $title, $content, $date);
    } else {
        $newId = createEntry($conn, $title, $content, $date);
        header("location: ../home.php?error=none"); 
        exit();
    }
}