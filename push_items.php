<?php
function push_items($page)
{
    //session_start();
    include ("config/database.php");
try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($page > 0)
            $page--;
        $page = $page * 5;
        foreach($dbh->query("SELECT * FROM all_img LIMIT $page,5") as $row)
        {
            if ($_SESSION[logged_on_user] != NULL) {
            echo "<div class='pic'>";
            echo "<a href=comment.php?img=" . $row[src] . ">";
            echo "<img style='display: block' width=400px src=" . $row[src] . ">";
            echo "</a>";
            echo "<p class='user_p'>". $row[user] . "</p>";
            echo "<div style='display: inline-block; float:right'>";
            echo "<a href=like.php?src=".$row[src].">";
            echo "<img width=30px src=http://pngimg.com/uploads/like/like_PNG14.png ></a>";
            echo "<p style='display:inline'>".$row[likes]."</p>";
            echo "</div>";
            echo "</div>";
            }
            else {
                echo "<div class='pic'>";
            echo "<img style='display: block' width=400px src=" . $row[src] . ">";
            echo "<p class='user_p'>". $row[user] . "</p>";
            echo "<div style='display: inline-block; float:right'>";
            echo "<img width=30px src=http://pngimg.com/uploads/like/like_PNG14.png >";
            echo "<p style='display:inline'>".$row[likes]."</p>";
            echo "</div>";
            echo "</div>";
            }
        }
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
        }
}