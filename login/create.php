<?php
if ($_POST[submit] === "OK" && $_POST[login] != NULL && $_POST[passwd] != NULL && $_POST[email] != NULL)
{
    if (strlen($_POST[login]) >= 50 || strlen($_POST[passwd]) >= 50 || strlen($_POST[email]) >= 50) // добавил
        {
            header ("Location: create_page.php?long=1");
            exit;
        }
    include ("../config/database.php");
    try {
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $login = $_POST[login];
            if (!ctype_alnum($login))
            {
                header("Location: create_page.php?login=1");
                exit;
            }
            $login = htmlspecialchars($login); //добавил
            $login = addslashes($login); //добавил
            if (strlen($_POST[passwd]) < 5 || ctype_alpha($_POST[passwd]) || ctype_digit($_POST[passwd]) || !ctype_alnum($_POST[passwd]))   
            {
                header("Location: create_page.php?weak=1");
                exit;
            }
            $passwd = htmlspecialchars($passwd); //добавил
            $passwd = addslashes($passwd); //new
            $passwd = hash('md5',$_POST[passwd]);
            $email = $_POST[email];
            $email = htmlspecialchars($email); //добавил
            $email = addslashes($email); //new
            $sth = $dbh->query("SELECT * FROM users WHERE login='$login' OR email='$email'");
            if ($sth->fetch())
            {
                header("Location: login_page.php?already=yes");
                exit;
            }
            $dbh->exec("INSERT INTO `users` VALUES('$login', '$passwd','$email', 0, 1)");
            $headers = ("Content-Type: text/html; charset=UTF-8\r\n");
            $hashmail = hash("md5", $email."//666//");
            mail("$email","email verification", "<a href=".$DB_HOST."/login/activate.php?activate=$hashmail>activate me</a>", $headers);
            header("Location: login_page.php?ver=no");
    }
    catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
}
else
    header("Location: create_page.php?empty=yes");
?>