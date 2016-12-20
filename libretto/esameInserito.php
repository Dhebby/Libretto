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
            if (!isset($_POST['lode']))
                $lode = "";
            else
                $lode = $_POST['lode'];

            if ($_POST['voto'] != 30 && $lode == "lode") {
                echo "<p>La lode &egrave; applicabile solo ad un voto pari a 30, esame non inserito</p><br/>";
                echo "<a href=\"esame.php\">Ritorna al form di inserimento esame</a><br/>";
            } else {

                $dati = array('studente' => $_POST['studente'], 'corso' => $_POST['corso'], 'voto' => $_POST['voto'],
                    'lode' => $lode, 'data' => $_POST['data']);

                if (controlloCorso($_POST['corso'])) {
                    echo "<p>L'esame che si vuole inserire &egrave; gi&agrave; stato registrato, inserimento non effettuto.</p><br/>";
                    echo "<a href=\"esame.php\">Ritorna al form di inserimento esame</a><br/>";
                } else {

                    addEsame($dati);
                    ?>

                    <h3>Riepilogo dati esame inserito</h3>
                    <p>
                        <strong>Studente: </strong><?php echo $dati['studente'] ?><br/>
                        <strong>Corso: </strong><?php echo $dati['corso'] ?><br/>
                        <strong>Voto: </strong><?php echo $dati['voto'] ?><br/>
                        <strong>Lode: </strong><?php echo $dati['lode'] ?><br/>
                        <strong>Data esame: </strong><?php echo $dati['data'] ?><br/>
                    </p>
                    <p>Inserimento avvenuto con successo.</p><br/>
                    <p>Vai al <?php echo "<a href=\"libretto.php?matr=" . $dati['studente'] . "\">libretto</a" ?> dello studente a cui hai appena inserito l'esame</p><br/>
                    <a href="ricerca.php">Vai al form di ricerca</a><br/>
                    <a href="studente.php">Aggiungi nuovo studente</a><br/>
                    <a href="esame.php">Registra nuovo esame</a><br/><br/>
                    <a href="logout.php">Logout</a>
                <?php
                }
            }
        }
        ?>
    </body>
</html>