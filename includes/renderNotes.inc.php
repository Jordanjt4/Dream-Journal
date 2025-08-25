<?php

session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';
$userId = $_SESSION['userid'];

$sql = "SELECT entriesId, entriesTitle, entriesContent, entriesDate FROM entries WHERE usersId = ? ORDER BY entriesDate DESC;";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../home.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $userId);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['entriesId'];
    $title = $row['entriesTitle'];
    $content = $row['entriesContent'];
    $date = $row['entriesDate'];
    echo  "<div class=\"note-card\"
        data-id = \"$id\"
        data-title = \"$title\"
        data-content = \"$content\"
        data-date = \"$date\">";
        echo "<h3 class=\"note-title\">" . $row['entriesTitle'] . "</h3>";
        echo "<div class=\"note-actions\">";
            echo "<i class=\"fa-solid fa-pencil\" onclick=\"openNoteDialog(this)\"></i>";
            echo "<i class=\"fa-solid fa-circle-xmark\" onclick=\"deleteNote(" . $row['entriesId'] . ", this)\"></i>";
        echo "</div>";
        echo "<p class=\"note-content\" style=\"padding: 5%;\">" . $row['entriesContent'] . "</p>";
        echo "<p class=\"note-date\" style=\"padding: 5%;\">" . $row['entriesDate'] . "</p>";
    echo  "</div>";
}
