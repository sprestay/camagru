<?php
include ("database.php");
try {
        $testsn = new PDO ("mysql:host=127.0.0.1",$DB_USER, $DB_PASSWORD);
        $testsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $testsn->exec("CREATE DATABASE IF NOT EXISTS camagru");
        $testsn = null;
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
try {
    $dbh = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("CREATE TABLE IF NOT EXISTS `users` (`login` VARCHAR(50) NOT NULL, `password` VARCHAR(50) NOT NULL, email VARCHAR(50), ver TINYINT(1), `send` TINYINT(1))");
    $pass = hash("md5", "root");
    $test = $dbh->query("SELECT * FROM users WHERE login='sprestay'");
    if (!$test->fetch())
        $dbh->exec("INSERT INTO `users` VALUES('sprestay', '$pass','fjavkex@gmail.com', 1, 1)");


    $dbh->exec("CREATE TABLE IF NOT EXISTS all_img (src VARCHAR(200) NOT NULL, user VARCHAR(50) NOT NULL, likes INT)");

} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}