<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/9c9978f0e5.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="resources/css/common.css">
        <link rel="stylesheet" href="resources/css/login.css">
        
    </head>

    <body>
        <div class="login_wrapper">
            <div class="login_stack">
                <img id="dreaming_cow" src="resources/images/login_cow.png" alt="Cow Login;">
                <div class="login_box">
                    <h1 style="text-align: center; font-size: 40px">Login</h1>
                    <form action="includes/login.inc.php" method="post">
                        <label for="username" style="font-size: 25px">Username</label><br>
                        <input type="text" id="username" name="username"><br>
                        <label for="password" style="font-size: 25px">Password</label><br>
                        <input type="text" id="password" name="password"><br><br>
                        <input type="submit" id="login_button" style="font-size: 20px" value="Login" name="submit">
                    </form>

                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo "<p style='color: #FF4F6E; text-align: center;'>Fill in all fields</p>";
                            } else if ($_GET["error"] == "wronglogin") {
                                echo "<p style='color: #FF4F6E; text-align: center;'>Incorrect login credentials</p>";  
                            } 
                        }
                    ?>
                </div>
            </div>
        </div>

        <script src="resources/js/parallax.js"></script>
        <div class="parallax">
            <img id="cloud1" class="layer" src="resources/images/cloud1.png" data-depth="0.05" style="position: fixed; bottom: 0; left: 0;">
            <img id="cloud3" class="layer" src="resources/images/cloud3.png" data-depth="0.1" style="position: fixed; bottom: 0; right: 0;">
            <img id="cloud2" class="layer" src="resources/images/cloud2.png" data-depth="0.2" style="position: fixed; bottom: 0;">
        </div>
    </body>
</html>

