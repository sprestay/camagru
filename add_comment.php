<?php
$com = addslashes($_POST[comment]); ///!!!!!
session_start();
$login = addslashes($_SESSION[logged_on_user]);
$src = $_POST[src];
include("config/database.php");
try {
    $dbh = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //условие на пустую колонку!!!!
    $com = htmlspecialchars($com); //добавил
    if ($com && strlen($com) < 200) {
    $likes = $dbh->query("SELECT likes FROM `$src` WHERE user='$login'");
    $likes = $likes->fetchColumn();
    if (!$likes)
        $likes = 0;
    $dbh->exec("INSERT INTO `$src` VALUES('$login','$com','$likes')");
    $sth = $dbh->query("SELECT user FROM all_img WHERE src='$src'");
    $user = $sth->fetchColumn();
    $user = addslashes($user);
    $sth = $dbh->query("SELECT * FROM users WHERE login='$user' AND send=1");
    if ($sth->fetch())
    {
        $sth = $dbh->query("SELECT email FROM users WHERE login='$user'");
        $email = $sth->fetchColumn();
        mail($email, "INSTA_LIKE SITE", "your photo was commented!!!!");
    }
}
    header("Location: comment.php?img=$src");
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}