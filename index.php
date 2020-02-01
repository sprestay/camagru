<?php
session_start();
if ($_SESSION[logged_on_user])
    header("Location: user_index.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/index.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <a href="index.php" style="float: left; text-decoration: none; color: black">INSTA_LIKE SITE</a>
            <div class="login_button">
                <a class="login_button" href="login/login_page.php">LOGIN</a>
            </div>
        </div>
        <?php
        include ("config/setup.php");
        include ("push_items.php");
        push_items($_GET[page]);
        include ("make_pages.php");
        make_pages();
        ?>
    </body>
</html>