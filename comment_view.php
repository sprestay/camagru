<?php
include ("config/database.php");
try {
    $dbh = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $src = $_GET[img];
    echo "<img width=300px src=" .$src. ">";
    foreach ($dbh->query("SELECT * FROM `$src`") as $row)
    {
        if ($row[comment])
        {
            echo "<h3>".$row['user']."</h3>";
            echo "<p>".$row['comment']."</p>";
        }
    }
}
catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>