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
    <form action="../login/create.php" method="POST">
        LOGIN: <input type="text" name="login">
        <br />
        EMAIL: <input type="text" name="email">
        <br />
        PASSWD: <input type="password" name="passwd">
        <input type="submit" name="submit" value="OK">
        <?php
        if ($_GET[weak] == 1)
            echo "<br><h3>YOUR PASSWORD IS TOO WEAK</h3>";
        if ($_GET['empty'])
            echo "<br><h3>ALL FIELDS MUST BE FILLED</h3>";
        if ($_GET['long'] == 1)
            echo "<br><h3>SMTH IS TOO LONG</h3>";
        if ($_GET['login'])
            echo "<br><h3>ONLY LETTERS AND NUMBERS IN LOGIN</h3>";
        ?>
    </form>
</body>
