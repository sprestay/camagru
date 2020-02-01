<!DOCTYPE html>
<html>
    <head>
        <style>
            body {
            background-color:orange;
        }
            form {
            width: 300px;
            height: 250px;
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -125px 0 0 -125px;
        }
        </style>
    </head>
    <body>
        <form action="../login/login.php" method="POST">
            LOGIN: <input type="text" name="login">
            <br>
            PASSWD: <input type="password" name="passwd">
            <input type="submit" name="submit" value="OK">
            <a href="create_page.php">CREATE</a>
            <a href="forgot_page.php">FORGOT YOUR PASSWORD?</a>
            <?php
                if ($_GET[wrong])
                    echo "<br><h3>wrong email or passwd! or account is not activated</h3>";
                if ($_GET[ver] == 'no')
                    echo "<br><h3>verification message was sent to your email";
                if ($_GET[already])
                    echo "<br><h3>email or login is already used";
                if ($_GET[activate])
                    echo "<br><h3>successfully activated";
                if ($_GET[forgot])
                    echo "<br><h3>new password was send to your email</h3>";
        ?>
        </form>
    </body>
</html>