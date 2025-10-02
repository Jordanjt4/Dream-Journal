<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/9c9978f0e5.js" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200'>
        <link rel="stylesheet" href="resources/css/index.css">
        <link rel="stylesheet" href="resources/css/common.css">
        <link rel="stylesheet" href="resources/css/home.css">
        <script src="resources/js/home.js" defer></script>
    </head>

    <body>
        <button id="musicBtn"><i class="fa-solid fa-music"></i></button>
        <header>
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<h1>Welcome Back " . $_SESSION["useruid"] . "</h1>";
                    echo '<div class="header-right">';
                        echo "<button class=\"add-dream-btn\" onclick=\"openDreamDialog()\">+ Add Dream</button>";
                        echo "<div class=\"logout-btn\"><a href='includes/logout.inc.php'>Logout</a></div>";
                    echo '</div>';
                } else {
                    header("location: index.html"); 
                    exit();
                }
            ?>
        </header>
        
        <div class="main-body"> 
            <main id="notes-container" class="notes-grid">
                <?php 
                    include 'includes/renderNotes.inc.php';
                ?>
            </main>
        
            <dialog class="dialogue" id="noteDialog">
                <div class="dialogue-content">
                    <div class="dialogue-header">
                        <h2 class="dialogue-title" id="dialogueTitle">Add New Note</h2>
                        <button class="close-btn" onclick="closeDreamDialog()">x</button>
                    </div>

                    <form id="noteForm" method="POST" action="includes/createNote.inc.php"> 
                        <input type="hidden" id="noteId" name="noteId">
                        <div class="form-group">
                            <label for="noteTitle" class="form-label">Title</label>
                            <input type="text" id="noteTitle" class="form-input" name="title" maxlength="255" placeholder="Enter dream title..." required>
                        </div>

                        <div class="form-group"> 
                            <label for="noteContent" class="form-label">Content</label>
                            <textarea id="noteContent" class="form-textarea" name="content" maxlength="4194303" placeholder="Write your dream here..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="noteDate" class="form-label">Date</label>
                            <input type="date" id="noteDate" class="form-input" name="date" placeholder="Enter date dreamed..." required>
                        </div>

                        <div class="dialogue-actions">
                            <button type="button" class="cancel-btn" onclick="closeDreamDialog()">Cancel</button>
                            <button type="submit" class="save-btn" name="submit">Save Dream</button>
                        </div>
                        <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "emptyinput") {
                                    echo "<p style='color: #FF4F6E; text-align: center;'>Fill in all fields</p>";
                                } else if ($_GET["error"] == "stmtfailed") {
                                    echo "<p style='color: #FF4F6E; text-align: center;'>Something went wrong, try again</p>";  
                                } 
                            }
                        ?>
                    </form>
                </div>
            </dialog>
        

            <div class="parallax">
                <img id="cloud1" class="layer" src="resources/images/cloud1.png" data-depth="0.05" style="position: fixed; bottom: 0; left: 0;">
                <img id="cloud3" class="layer" src="resources/images/cloud3.png" data-depth="0.1" style="position: fixed; bottom: 0; right: 0;">
                <img id="cloud2" class="layer" src="resources/images/cloud2.png" data-depth="0.2" style="position: fixed; bottom: 0;">
            </div>

            <script src="resources/js/index.js"></script>
            <script src="resources/js/parallax.js"></script>
        </div>
    </body>
</html>