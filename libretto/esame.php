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
                <h2>Nuovo esame</h2>

                <form action="esameInserito.php" method="post">
                    Studente: <select name="studente">
                        <?php
                        $studente = getStudenti();
                        foreach ($studente as $riga) {
                            echo "<option value=\"" . $riga[0] . "\">" . $riga[0] . " " . $riga[1] . " " . $riga[2] . "</option>";
                        }
                        ?>
                    </select><br/>
                    Corso: <select name="corso">
                        <?php
                        $corso = getCorso();
                        foreach ($corso as $riga) {
                            echo "<option value=\"" . $riga[0] . "\">" . $riga[2] . " - " . $riga[1] . "</option>";
                        }
                        ?>
                    </select><br/>
                    Voto: <input name="voto" type="number" min="18" max="30" required/>
                    Lode: <input name="lode" type="checkbox" value="lode"/>
                    Data esame: <input name="data" type="date" required/><br/> 
                    <input type="submit" value="Aggiungi"/>
                </form>

                <a href="ricerca.php">Torna al form di ricerca</a><br/>
                <a href="studente.php">Aggiungi nuovo studente</a><br/>
                <a href="logout.php">Logout</a>
            </div>
        <?php } ?>
    </body>
</html>