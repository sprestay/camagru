<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
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
    <form action="../login/forgot.php" method="POST">
        LOGIN: <input type="text" name="login">
        <br />
        EMAIL: <input type="text" name="email">
        <br />
        <input type="submit" name="submit" value="OK">
        <?php
        if ($_GET[wrong])
            echo "<br><h3>no user with this login/email</h3>";
        if ($_GET['empty'])
            echo "<br><h3>no empty fields!</h3>";
        ?>
    </form>
</body>