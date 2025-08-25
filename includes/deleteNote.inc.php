<?php 

session_start();

if (!isset($_SESSION["useruid"])) {
    header("location: home.html");
    exit();
}

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

$entryId = isset($_POST['id']) ? $_POST['id'] : 0;

if ($id === 0) {
    header("location: home.html");
    exit();
} else {
    deleteEntry($conn, $entryId);
}