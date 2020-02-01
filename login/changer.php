<?php
include ("../config/database.php");
session_start();
if (strlen($_POST[login]) >= 50 || strlen($_POST[passwd]) >= 50 || strlen($_POST[email]) >= 50) // добавил
        {
            header ("Location: settings.php?long=1");
            exit;
        }
try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $login = $_SESSION[logged_on_user];
        $login = addslashes($login); // ???
        $send = $_POST[send];
        $dbh->exec("UPDATE users SET send='$send' WHERE login='$login'");
        if ($_POST[passwd] != NULL && (strlen($_POST[passwd]) < 5 || ctype_alpha($_POST[passwd]) || ctype_digit($_POST[passwd]) || !ctype_alnum($_POST[passwd]))) //changes!
            {
                header("Location: settings.php?wrong=1");
                exit;
            }
        if ($_POST[passwd] != NULL)
        {
            $login = $_SESSION[logged_on_user];
            $login = addslashes($login); // ???
            $passwd = addslashes($passwd); //new
            $passwd = htmlspecialchars($passwd); //добавил
            $passwd = hash("md5", $_POST[passwd]);
            $dbh->exec("UPDATE users SET password='$passwd' WHERE login='$login'");
        }
        if ($_POST[login] != NULL)
        {
            $login = $_SESSION[logged_on_user];
            $login = addslashes($login); // ???
            $new_login = $_POST[login];
            if (!ctype_alnum($new_login))
            {
                header("Location: settings.php?login=1");
                exit;
            }
            $new_login = addslashes($new_login); //new
            $new_login = htmlspecialchars($new_login); //добавил
            $ver = $dbh->query("SELECT * FROM users WHERE login='$new_login'");
            if ($ver->fetch())
            {
                header("Location: settings.php?duplog=1");
                exit;
            }
            $dbh->exec("UPDATE users SET login='$new_login' WHERE login='$login'");
            $dbh->exec("UPDATE all_img SET user='$new_login' WHERE user='$login'");
            foreach($dbh->query("SELECT * FROM all_img") as $row)
            {
                $table = $row[src];
                $dbh->exec("UPDATE `$table` SET user='$new_login' WHERE user='$login'");
            }
            $_SESSION[logged_on_user] = $new_login;
        }
        if ($_POST[email] != NULL)
        {
            $new_email=$_POST[email];
            $new_email = addslashes($new_email); //new
            $new_email = htmlspecialchars($new_email); //добавил
            $ver = $dbh->query("SELECT * FROM users WHERE email='$new_email'");
            if ($ver->fetch())
            {
                header("Location: settings.php?dupmail=1");
                exit;
            }
            $login = $_SESSION[logged_on_user];
            $login = addslashes($login); // ???
            $sth = $dbh->query("SELECT email FROM users WHERE login='$login'");
            $email = $sth->fetchColumn();
            $hashmail = hash("md5", $email."//666//");
            $headers = ("Content-Type: text/html; charset=UTF-8\r\n");
            mail("$new_email","email verification", "<a href=".$DB_HOST."/login/change_mail.php?activate=$new_email&old=$hashmail>activate me</a>", $headers);
            header("Location: ./settings.php?email=ver");
            exit;
        }
        header("Location: ../user_index.php");
}
    catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }