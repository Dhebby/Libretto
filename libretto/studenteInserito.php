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
            if (strlen($_POST['matricola']) > 6) {
                echo "<p>Numero di matricola non valido, studente non inserito</p><br/>";
                echo "<a href=\"studente.php\">Ritorna al form di inserimento studente</a><br/>";
            } else {
                $matricola = aggiustaMatricola($_POST['matricola']);
                $dati = array('matricola' => $matricola, 'cognome' => $_POST['cognome'], 'nome' => $_POST['nome'],
                    'data_nascita' => $_POST['data_nascita'], 'laurea' => $_POST['laurea']);
                if (controlloStudente($dati)) {
                    echo "<p>Lo studente che si vuole inserire &egrave gi&agrave presente, inserimento non effettuto.</p><br/>";
                    echo "<a href=\"studente.php\">Ritorna al form di inserimento studente</a><br/>";
                } else {
                    addStudente($dati);
                    ?>
                    <div id="studenteInserito">
                        <h3>Riepilogo dati studente inserito</h3>
                        <p>
                            <strong>Matricola: </strong><?php echo $dati['matricola'] ?><br/>
                            <strong>Cognome: </strong><?php echo $dati['cognome'] ?><br/>
                            <strong>Nome: </strong><?php echo $dati['nome'] ?><br/>
                            <strong>Data di nascita: </strong><?php echo $dati['data_nascita'] ?><br/>
                            <strong>Laurea: </strong><?php echo $dati['laurea'] ?><br/>
                        </p>
                        <p>Inserimento avvenuto con successo.</p><br/>
                        <p>Vai al <?php echo "<a href=\"libretto.php?matr=" . $matricola . "\">libretto</a" ?> dello studente appena inserito</p><br/>
                        <a href="ricerca.php">Vai al form di ricerca</a><br/>
                        <a href="studente.php">Aggiungi nuovo studente</a><br/>
                        <a href="esame.php">Registra nuovo esame</a><br/><br/>
                        <a href="logout.php">Logout</a>
                    </div>

                <?php
                }
            }
        }
        ?>
    </body>
</html>