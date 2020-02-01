<?php
if ($_POST[login] != NULL && $_POST[email] != NULL)
{
    include ("../config/database.php");
    try {
            $login = addslashes($_POST[login]); ///ATTENTION!!!!!!!!!!!
            $login = htmlspecialchars($login);
            $email = addslashes($_POST[email]);
            $email = htmlspecialchars($email);
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $dbh->query("SELECT * FROM users WHERE login='$login' AND email='$email'");
            if ($sth->fetch())
            {
                $new_pass = uniqid();
                $hash = hash("md5", $new_pass);
                $dbh->exec("UPDATE users SET password='$hash' WHERE email='$email' AND login='$login'");
                $headers = ("Content-Type: text/html; charset=UTF-8\r\n");
                mail("$_POST[email]","password recovery", "your new password is <strong>$new_pass</strong>, don`t forget to change it in <b>Settings</b>", $headers);
                header("Location: ./login_page.php?forgot=1");
            } else
            {
                header("Location: ./forgot_page.php?wrong=1");
                exit;
            }
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
} else {
    header("Location: ./forgot_page.php?empty=1");
    exit;
}
?>