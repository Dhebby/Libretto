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
            $matr = $_GET["matr"];
            $studente = studente($matr);
            $dati = getDati($matr);
            ?>
            <div id="libretto">
                <h2>Libretto</h2>
                <p>
                    <strong>Nome: </strong><?php echo $studente['nome'] ?><br/>
                    <strong>Cognome: </strong><?php echo $studente['cognome'] ?><br/>
                    <strong>Matricola: </strong><?php echo $matr ?><br/>
                    <strong>Data di nascita: </strong><?php echo $studente['data_nascita'] ?><br/>
                    <strong>Corso di laurea: </strong><?php echo $studente['laurea'] ?><br/>
                </p>
                <h3>Esami sostenuti</h3>
                <table border="1">
                    <tr>
                        <th>Corso</th>
                        <th>Docente1</th>
                        <th>Docente2</th>
                        <th>Laurea</th>
                        <th>CFU</th>
                        <th>Voto</th>
                        <th>Data</th>
                        <th>Admin</th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($dati); $i++) {
                        echo "<tr>";
                        foreach ($dati[$i] as $elemento) {
                            echo "<td>" . $elemento . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </table>

                <br/>
                <a href="ricerca.php">Nuova ricerca</a><br/>
                <a href="studente.php">Aggiungi nuovo studente</a><br/>
                <a href="esame.php">Registra nuovo esame</a><br/><br/>
                <a href="logout.php">Logout</a>
            </div>
        <?php } ?>
    </body>
</html>