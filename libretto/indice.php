<?php
require("config.php");
require("funzioni.php");
session_start();
?>
<!doctype html>
<html>
    <head>
        <title>Autenticazione</title>
    </head>
    <body>
        <form action="ricerca.php" method="post">
            Login: <input name="login" type="text" /><br/>
            Password: <input name="password" type="password"/><br/>
            <input type="submit" value="Login"/>
        </form>
    </body>
</html>