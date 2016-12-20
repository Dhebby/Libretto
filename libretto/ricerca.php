<?php
require("config.php");
require("funzioni.php");
session_start();
?>
<!doctype html>
<html>
    <head>
        <title>Ricerca</title>
    </head>
    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $login = $_POST["login"];
            $password = $_POST["password"];
            if (utenteValido($login, $password)) {
                $_SESSION["autenticato"] = $login;
            } else {
                echo "<p> Nome utente o password errate, ritorna al <a href=\"indice.php\">Login</a></p>";
            }
        } else {
            if (!isset($_SESSION['autenticato'])) {
                echo "<p>Non sei autenticato, vai al <a href=\"indice.php\">Login</a></p>";
            }
        }

        if (isset($_SESSION['autenticato'])) {
            ?>
            <div id="ricerca">
                <h2>Ricerca Studenti</h2>
                <form action="risultati.php" method="post">
                    Matricola: <input name="matricola" type="text" /><br/>
                    Cognome: <input name="cognome" type="text"/><br/>
                    Nome: <input name="nome" type="text"/><br/>
                    <input type="submit" value="Cerca"/>
                </form>
                <a href="studente.php">Aggiungi nuovo studente</a><br/>
                <a href="esame.php">Registra nuovo esame</a><br/><br/>
                <a href="logout.php">Logout</a>
            </div>
        <?php } ?>
    </body>
</html>

