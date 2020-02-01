<?php
include ("auth.php");
session_start();
if ($_POST[login] == NULL || $_POST[passwd] == NULL || !auth($_POST[login], $_POST[passwd]))
{
        $_SESSION[logged_on_user] = NULL;
        header("Location: ./login_page.php?wrong=yes");
}
else
{
    $_SESSION[logged_on_user] = $_POST[login];
    header("Location: ../user_index.php");
}
?>