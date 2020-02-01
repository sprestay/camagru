<?php
$type = mime_content_type('done/'.$_POST[photo]);
/*if ($type == "image/png")
    $dest = imagecreatefrompng('done/'.$_POST[photo]);
else*/ if ($type == "image/jpeg")
    $dest = imagecreatefromjpeg('done/'.$_POST[photo]);
else header("Location: album_c.php?error=yes");

$src = imagecreatefrompng($_POST[mask]);

$width = imagesx($dest) * 0.35;
$height = imagesy($src) * ($width / imagesx($src));

$new_image = imagecreatetruecolor($width, $height);
imagefill($new_image, 0,0,0x7fff0000);

imagecopyresampled($new_image, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));
$src = $new_image;

$pos = imagesx($dest) * 0.30;
imagecopy($dest, $src, $pos,0,0,0, imagesx($src), imagesy($src));
$new_photo = uniqid(); // изменил
$new_photo .= ".jpg";
imagejpeg($dest, "img/".$new_photo);
unlink('done/'.$_POST[photo]);////удаление фото
include ("config/database.php");
session_start();
try {
    $dbh = new PDO ($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $login = $_SESSION[logged_on_user]; ///here 2 str
    $login = addslashes($login);
    $dbh->exec("INSERT INTO all_img VALUES('img/$new_photo', '$login', 0)");
    $dbh->exec("CREATE TABLE IF NOT EXISTS `img/$new_photo` (user VARCHAR(50) NOT NULL, comment VARCHAR(200), likes TINYINT(1) DEFAULT 0)");
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
header("Location: album_c.php");
?>