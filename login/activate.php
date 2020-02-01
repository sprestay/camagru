<?php
include ("../config/database.php");
try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        foreach($dbh->query("SELECT email FROM users") as $row)
        {
            $hash = hash("md5", $row[email]."//666//");
            if ($hash == $_GET[activate])
            {
                $dbh->query("UPDATE users SET ver=1 WHERE email='$row[email]'");
                header("Location: login_page.php");
                exit;
            }
        }
    }
    catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
echo "Как ты сюда попал?";
?>