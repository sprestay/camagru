<?php
include ("config/database.php");
session_start();
try
{
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $src = $_GET[src];
    $login = $_SESSION[logged_on_user];
    $login = addslashes($login); ///123
    $test = $dbh->query("SELECT * FROM `$src` WHERE user='$login'");
    if (!$test->fetch())
        $dbh->exec("INSERT INTO `$src` VALUES ('$login', '', 0)");
    $sth = $dbh->query("SELECT likes FROM `$src` WHERE user='$login'");
    if (!$sth->fetchColumn())
        $dbh->exec("UPDATE `$src` SET likes=1 WHERE user='$login'");
    else
        $dbh->exec("UPDATE `$src` SET likes=0 WHERE user='$login'");

    $count = $dbh->query("SELECT COUNT(DISTINCT user) FROM `$src` WHERE likes=1");
    $count = $count->fetchColumn();
    $dbh->exec("UPDATE all_img SET likes='$count' WHERE src='$src'");
    $count = 0;
    foreach($dbh->query("SELECT * FROM all_img") as $row)
    {
        $count++;
        if ($row[src] == $_GET[src])
            break;
    }
    $flag = 0;
    if ($count % 5 == 0)
        $flag++;
    $count = intval($count / 5) + 1 - $flag;
    header("Location: user_index.php?page=$count");

} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}