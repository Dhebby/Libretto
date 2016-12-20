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
        if (!isset($_SESSION["autenticato"]))
            echo "<p>Non sei autenticato, vai al <a href=\"indice.php\">Login</a></p>";
        else {
            ?>
            <div id="studente">
                <h2>Nuovo studente</h2>

                <form action="studenteInserito.php" method="post">
                    Matricola: <input name="matricola" type="number" min="1" max="999999" required/><br/>
                    Cognome: <input name="cognome" type="text" maxlength="50" required/><br/>
                    Nome: <input name="nome" type="text" maxlength="50" required/><br/> 
                    Data di nascita: <input name="data_nascita" type="date" required/><br/> 
                    Laurea: 
                    <select name="laurea">
                        <option value="TWM">TWM</option>
                        <option value="informatica">informatica</option>
                    </select><br/>
                    <input type="submit" value="Aggiungi"/>
                </form>

                <a href="ricerca.php">Torna al form di ricerca</a><br/>
                <a href="esame.php">Registra nuovo esame</a><br/><br/>
                <a href="logout.php">Logout</a>
            </div>
        <?php } ?>
    </body>
</html>