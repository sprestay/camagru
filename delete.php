<?php
include ("config/database.php");
try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->exec("DELETE FROM all_img WHERE src='$_POST[del]'");
        $dbh->exec("DROP TABLE `$_POST[del]`");
        $dbh= NULL;
try {
        $login = $_POST[login];
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach($dbh->query("SELECT * FROM all_img WHERE user='$login'") as $row)
        {
                echo "<div class='pic'>";
                echo "<script src='js.js'></script>";
                echo "<img style='display: block' onclick='like()' id='$login' width=400px src=" . $row[src] . ">";
                echo "</div>";
        }
    }   catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
            }
}
 catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>