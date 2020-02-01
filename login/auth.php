<?php 
function auth($login, $passwd)
{
    $login = addslashes($login); //new
    $passwd = addslashes($passwd); //new
     if ($login != NULL && $passwd != NULL)
     {
        include ("../config/database.php");
        try {
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $passwd = hash("md5", $passwd);
            $sth = $dbh->query("SELECT * FROM users WHERE login='$login' AND password='$passwd' AND ver=1");
            if (!$sth->fetch())
                return (false);
            else
                return (true);
        }   catch (PDOException $e) {
                echo 'Подключение не удалось: ' . $e->getMessage();
            }
     } else
        return false;
 }
 ?>