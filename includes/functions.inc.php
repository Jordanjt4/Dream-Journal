<?php

function emptyInputsSignup($username, $pwd) {
    $result;

    if(empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function invalidUid($username) {
    $result;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }

    return $result;
}

function uidExists($conn, $username) {
    $result;
    $sql = "SELECT * FROM users WHERE usersUid = ?;"; // this is the query
    $stmt = mysqli_stmt_init($conn); // initialize a blank statement, bad to let user inject queries directly

    if (!mysqli_stmt_prepare($stmt, $sql)) { // prepare the query, but still uses the placeholder
        header("location: ../signup.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "s", $username); // put in the actual data, interprets it as a string and NOT sql query
    mysqli_stmt_execute($stmt); // submit the form

    $resultData = mysqli_stmt_get_result($stmt); 

    if ($row = mysqli_fetch_assoc($resultData)) { // try to get a matching row
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $pwd) {
    $result;
    $sql = "INSERT INTO users (usersUid, usersPwd) VALUES (?, ?);"; 
    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt, $sql)) { 
        header("location: ../signup.html?error=stmtfailed");
        exit();
    } 

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPwd); 
    mysqli_stmt_execute($stmt);

    header("location: ../signup.php?error=none");
    exit();
}

function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username);

    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin"); 
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin"); 
        exit();
    } else if ($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../home.php"); 
        exit();
    }
}

function updateEntry($conn, $entryId, $title, $content, $date) {
    $userId = $_SESSION["userid"];

    $sql = "UPDATE entries 
        SET entriesTitle = ?, entriesContent = ?, entriesDate = ?
        WHERE entriesId = ? AND usersId = ?";
    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt, $sql)) { 
        header("location: ../home.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "sssii", $title, $content, $date, $entryId, $userId);
    mysqli_stmt_execute($stmt);

    header("location: ../home.php?error=none");
    exit();
}

function createEntry($conn, $title, $content, $date) {
    $userId = $_SESSION["userid"];

    $sql = "INSERT INTO entries (usersId, entriesTitle, entriesContent, entriesDate) VALUES (?, ?, ?, ?);"; 
    $stmt = mysqli_stmt_init($conn); 

    if (!mysqli_stmt_prepare($stmt, $sql)) { 
        header("location: ../home.php?error=stmtfailed");
        exit();
    } 

    mysqli_stmt_bind_param($stmt, "isss", $userId, $title, $content, $date);
    mysqli_stmt_execute($stmt);

    $newId = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);

    return $newId;
}

function deleteEntry($conn, $entryId) {
    $userId = $_SESSION["userid"];

    $sql = "DELETE FROM entries WHERE entriesId = ? AND usersId = ?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../home.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $entryId, $userId);
    mysqli_stmt_execute($stmt);

    $deletedRow = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);

    return $deletedRow > 0;
}