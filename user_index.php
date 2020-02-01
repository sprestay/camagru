<?php
session_start();
if (!$_SESSION[logged_on_user])
    header("Location: /login/login_page.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <a href="user_index.php" style="float: left; text-decoration: none; color: black">INSTA_LIKE SITE</a>
            <div class="album">
                <a class="album" href="album.php">ALBUM</a>
            </div>
            <div class="album">
                <a class="album" href="login/settings.php"> SETTINGS</a>
            </div>
            <div class="login_button">
                <a class="login_button" href="login/logout.php">LOGOUT</a>
            </div>
        </div>
        <?php
        include ("push_items.php");
        push_items($_GET[page]);
        include ("make_pages.php");
        make_pages();
        ?>
    </body>
</html>