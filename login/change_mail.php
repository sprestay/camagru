<?php
include ("../config/database.php");
try {
    $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $new = $_GET[activate];
    $old = $_GET[old];
    foreach ($dbh->query("SELECT email FROM users") as $row)
    {
        $hash = hash("md5", $row[email]."//666//");
        if ($hash == $old)
        {
            $dbh->exec("UPDATE users SET email='$new' WHERE email='$row[email]'");
            header("Location: settings.php?changed=yes");
            exit;
        }

    }
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}