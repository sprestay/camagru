<?php

function make_pages()
{
    include ("config/database.php");
    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $i = 0;
        $page = 1;
        echo "<div class='page_block'>";
        foreach($dbh->query("SELECT * FROM all_img") as $row)
        {
            if ($i % 5 == 0)
            {
                if ($_SESSION[logged_on_user] != NULL)
                    echo "<a class='pages' href='user_index.php?page=".$page."'>".$page."</a>";
                else
                    echo "<a class='pages' href='index.php?page=" . $page . "'>" .$page ."</a>";
                $page++;
            }
            $i++;
        }
        echo "</div";
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
}