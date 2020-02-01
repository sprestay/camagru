<!DOCTYPE html>
<html>
    <head>
    </head>
</body>
<form action="save_cPNG.php" method="POST">
            <div class="web">
                <?php
                $new_photo = session_id();
                if (!file_exists("done"))
                    mkdir("done");
                if ($_FILES['file']['type'] == "image/jpeg")// || $_FILES['file']['type'] == "image/png")
                    move_uploaded_file($_FILES['file']['tmp_name'], "done/$new_photo");
                if (file_exists("done/$new_photo"))
                {
                    echo "<img src='done/$new_photo' class='photo'>";
                    echo "<img src='$_GET[mask]' class='mask_style'>";
                }
                ?>
                <?php
                if (file_exists("done/$new_photo") && $_GET[mask])
                {
                    echo "<input type='image' name='picture' class='shoot' src='http://pngimg.com/uploads/instagram/instagram_PNG11.png'>";// onclick='takeSnapshot()'>";
                    echo "<input type='hidden' id='mask_t' name='mask' value=" . $_GET[mask] . ">";
                    echo "<input type='hidden' id='photo' name='photo' value=" .$new_photo. ">";
                }
                ?>
            </div>
        </form>
    </body>
</html>