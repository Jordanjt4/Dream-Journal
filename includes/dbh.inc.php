<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "dreamnote";

$conn = mysqli_connect($serverName, $dBUsername, $dbPassword, $dBName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}