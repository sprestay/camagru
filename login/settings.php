<?php
session_start();
if (!$_SESSION[logged_on_user])
    header("Location: login_page.php");
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link href="css/index.css" rel="stylesheet">
            <link href="css/album.css" rel="stylesheet">
            <style>
                body {
                    background-color: orange;
                }
            </style>
        </head>
    <body>
    <form action="changer.php" method="POST" style="text-align: center">
        NEW_LOGIN: <input type="text" name="login"><br>
        NEW_EMAIL: <input type="text" name="email"><br>
        NEW_PASSWD: <input type="password" name="passwd"><br>
        WOULD YOU LIKE TO GET MSG?: 
        <?php
        include ("../config/database.php");
        try {
                $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $login = $_SESSION[logged_on_user];
                $login = addslashes($login); ///????????
                $sth = $dbh->query("SELECT send FROM users WHERE login='$login'");
                $send = $sth->fetchColumn();
                if ($send == 1)
                {
                    echo "<input type='radio' name='send' value='1' checked>YES";
                    echo "<input type='radio' name='send' value='0'>NO";
                } else
                {
                    echo "<input type='radio' name='send' value='1'>YES";
                    echo "<input type='radio' name='send' value='0' checked>NO";
                }

        }   catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
        }
        ?>
        <br>
        <input type="submit" name="submit" value="CHANGE">
        <?php
        if ($_GET[wrong])
            echo "<h3>passwd is too weak</h3>";
        if ($_GET[email])
            echo "<h3>verification email was sent</h3>";
        if ($_GET[duplog])
            echo "<h3>login is already in use</h3>";
        if ($_GET[changed])
            echo "<h3>email verified and changed</h3>";
        if ($_GET[dupmail])
            echo "<h3>email is already in use</h3>";
        if ($_GET[long])
            echo "<h3>SMTH IS TOO LONG</h3>";
        if ($_GET['login'])
            echo "<h3> ONLY NUMBERS AND LETTERS IN LOGIN</h3>";
        ?>
    </form>
</body>
</html>


