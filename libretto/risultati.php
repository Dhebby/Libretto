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
            <div id="risultati">
                <h2>Risultati ricerca</h2>
                <?php
                $studente = array('matricola' => "", 'cognome' => "", 'nome' => "");
                $count = 0;
                if ($_POST["matricola"] != "") {
                    $studente['matricola'] = "matricola='" . addslashes(trim($_POST["matricola"])) . "'";
                    $count++;
                }
                if ($_POST["cognome"] != "") {
                    $studente['cognome'] = "cognome='" . addslashes(trim($_POST["cognome"])) . "'";
                    $count++;
                }
                if ($_POST["nome"] != "") {
                    $studente['nome'] = "nome='" . addslashes(trim($_POST["nome"])) . "'";
                    $count++;
                }
                $risultato = effettuaRicerca($studente, $count);

                if (count($risultato) > 0) {
                    for ($i = 0; $i < count($risultato); $i = $i + 3) {
                        echo "<a href=\"libretto.php?matr=" . $risultato[$i + 0] . "\" >" 
                                . $risultato[$i + 0] . " " . $risultato[$i + 1] . " " . $risultato[$i + 2] . "</a><br/>";
                    }
                }
                ?>
                <br/>
                <a href="ricerca.php">Nuova ricerca</a><br/>
                <a href="studente.php">Aggiungi nuovo studente</a><br/>
                <a href="esame.php">Registra nuovo esame</a><br/><br/>
                <a href="logout.php">Logout</a>
            </div>
        <?php } ?>
    </body>
</html>
