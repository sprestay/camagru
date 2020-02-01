<?php
session_start();
if (!$_SESSION[logged_on_user])
    {
        header ("Location: login/login_page.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link href="css/index.css" rel="stylesheet">
    <link href="css/album.css" rel="stylesheet">
</head>
<body>
    <div>
    <?php
    include ("comment_view.php");
    ?>
    </div>
    <form action="add_comment.php" method="POST">
    <input type="text" name="comment">
    <?php
    $login = $_SESSION[logged_on_user];
    $login = addslashes($login);
    echo "<input type='hidden' name='login' value='". $login ."'>";
    echo "<input type='hidden' name='src' value='".$_GET[img]."'>";
    ?>
    <input type="submit" value="OK">
    <br>
    <a href="user_index.php">BACK_TO_MAIN</a>
    <a href="login/logout.php">LOGOUT</a>
</form>
</body>
</html>