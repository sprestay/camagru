<?php
session_start();
if (!$_SESSION[logged_on_user])
    header("Location: ./login/login_page.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/index.css" rel="stylesheet">
        <link href="css/album.css" rel="stylesheet">
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
            <div class="mask_block">
                <a href="album.php?mask=masks/1.png"><img class="mask_in_block" src="masks/1.png"></a>
                <a href="album.php?mask=masks/2.png"><img class="mask_in_block" src="masks/2.png"></a>
                <a href="album.php?mask=masks/3.png"><img class="mask_in_block" src="masks/3.png"></a>
                <a href="album.php?mask=masks/5.png"><img class="mask_in_block" src="masks/5.png"></a>
                <a href="album.php?mask=masks/6.png"><img class="mask_in_block" src="masks/6.png"></a>
                <a href="album.php?mask=masks/7.png"><img class="mask_in_block" src="masks/7.png"></a>
                <a href="album.php?mask=masks/8.png"><img class="mask_in_block" src="masks/8.png"></a>
            </div>
                <div>
                <?php
                include ("video.php");
                ?>
                </div>
                <div class="chooser">
                    <a href="album_c.php">DOWNLOAD FROM<br> DEVICE?</a>
                </div>
            <div class="user_alb" id="alb_web">
                <?php
                include ("push_user.php");
                push_user(1);
                ?>
    </body>
</html>