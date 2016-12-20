<?php

function dbconnect() {
    $conn = @mysqli_connect(HOST, USERNAME, PASSWORD) or
            die("Errore nella connessione al db: " . mysqli_connect_error());

    mysqli_select_db($conn, DBNAME) or
            die("Errore nella sezione del db: " . mysqli_error($conn));

    return $conn;
}

function utenteValido($utente, $password) {
    $conn = dbconnect();
    $sql = "SELECT password FROM admin WHERE username = '" . addslashes($utente) . "'";

    $risposta = mysqli_query($conn, $sql) or
            die("Errore nella query: " . $sql . "\n" . mysqli_error($conn));

    if (mysqli_num_rows($risposta) == 0)
        return FALSE;
    $riga = mysqli_fetch_row($risposta);
    mysqli_close($conn);

    return (md5($password) == $riga[0]);
}

function effettuaRicerca($dati, $count) {
    $conn = dbconnect();
    $sql = "SELECT matricola, cognome, nome FROM studenti";
    switch ($count) {
        case 1:
            if ($dati['matricola'] != "")
                $sql .= " WHERE " . $dati['matricola'];
            if ($dati['cognome'] != "")
                $sql .= " WHERE " . $dati['cognome'];
            if ($dati['nome'] != "")
                $sql .= " WHERE " . $dati['nome'];
            break;
        case 2:
            if ($dati['matricola'] != "" && $dati['cognome'] != "")
                $sql .= " WHERE " . $dati['matricola'] . " AND " . $dati['cognome'];
            if ($dati['matricola'] != "" && $dati['nome'] != "")
                $sql .= " WHERE " . $dati['matricola'] . " AND " . $dati['nome'];
            if ($dati['cognome'] != "" && $dati['nome'] != "")
                $sql .= " WHERE " . $dati['cognome'] . " AND " . $dati['nome'];
            break;
        case 3:
            $sql .= " WHERE " . $dati['matricola'] . " AND " . $dati['cognome'] . "AND" . $dati['nome'];
            break;
        default:
            break;
    }

    $risultato = mysqli_query($conn, $sql);
    $esito = array();
    while ($riga = mysqli_fetch_row($risultato)) {
        $esito[] = $riga[0];
        $esito[] = $riga[1];
        $esito[] = $riga[2];
    }
    mysqli_close($conn);

    return $esito;
}

function studente($matr) {
    $conn = dbconnect();
    $sql = "SELECT studenti.nome AS nome, cognome, data_nascita, lauree.nome AS laurea "
            . "FROM studenti INNER JOIN lauree "
            . "ON FK_laurea=PK_id AND matricola=" . $matr;
    $risultato = mysqli_query($conn, $sql);
    $riga = mysqli_fetch_assoc($risultato);

    mysqli_close($conn);

    return $riga;
}

function getDati($matr) {
    $conn = dbconnect();
    $sql = "SELECT corsi.nome AS corso, CONCAT_WS(' ', d1.nome, d1.cognome) AS docente1, "
            . "CONCAT_WS(' ', d2.nome, d2.cognome) AS docente2, lauree.nome AS laurea, "
            . "corsi.cfu AS cfu, CONCAT_WS(' ', esami.voto, esami.lode) AS voto, "
            . "esami.data AS data, CONCAT_WS(' ', admin.nome, admin.cognome) AS amministr "
            . "FROM esami "
            . "INNER JOIN corsi ON FK_corso=corsi.PK_id "
            . "INNER JOIN docenti AS d1 ON FK_docente1=d1.PK_id "
            . "LEFT OUTER JOIN docenti AS d2 ON FK_docente2=d2.PK_id "
            . "INNER JOIN lauree ON corsi.FK_laurea=lauree.PK_id "
            . "INNER JOIN admin ON FK_admin=admin.PK_id "
            . "WHERE FK_studente=" . $matr;
    $risultato = mysqli_query($conn, $sql);
    $esito = array();
    while ($riga = mysqli_fetch_assoc($risultato)) {
        $riga = aggiustaVoto($riga);
        $esito[] = $riga;
    }

    mysqli_close($conn);
    return $esito;
}

function getStudenti() {
    $conn = dbconnect();
    $sql = "SELECT matricola, nome, cognome FROM studenti";
    $risultato = mysqli_query($conn, $sql);
    $esito = array();
    while ($riga = mysqli_fetch_row($risultato)) {
        $esito[] = $riga;
    }

    mysqli_close($conn);
    return $esito;
}

function getCorso() {
    $conn = dbconnect();
    $sql = "SELECT corsi.PK_id AS id, corsi.nome AS corso, lauree.nome AS laurea "
            . "FROM corsi INNER JOIN lauree ON FK_laurea = lauree.PK_id ORDER BY laurea, corso";
    $risultato = mysqli_query($conn, $sql);
    $esito = array();
    while ($riga = mysqli_fetch_row($risultato)) {
        $esito[] = $riga;
    }

    mysqli_close($conn);
    return $esito;
}

function addStudente($dati) {
    $conn = dbconnect();
    if ($dati['laurea'] == "TWM")
        $dati['laurea'] = 2;
    else
        $dati['laurea'] = 1;

    $sql = "INSERT INTO studenti (matricola, FK_laurea, nome, cognome, data_nascita) "
            . "VALUES ('" . $dati['matricola'] . "', '" . $dati['laurea'] . "', '" . $dati['nome']
            . "', '" . $dati['cognome'] . "', '" . $dati['data_nascita'] . "')";
    $risultato = mysqli_query($conn, $sql);
    mysqli_close($conn);
}

function addEsame($dati) {
    $conn = dbconnect();

    if ($dati['lode'] == "lode")
        $dati['lode'] = 1;
    else
        $dati['lode'] = 0;

    $sql = "INSERT INTO esami (FK_corso, FK_studente, voto, lode, data, FK_admin) VALUES ("
            . "(SELECT corsi.PK_id FROM corsi WHERE corsi.PK_id='" . $dati['corso'] . "'), "
            . "(SELECT studenti.matricola FROM studenti WHERE matricola='" . $dati['studente'] . "'), "
            . "'" . $dati['voto'] . "', '" . $dati['lode'] . "', '" . $dati['data'] . "', "
            . "(SELECT admin.PK_id FROM admin WHERE username='" . $_SESSION["autenticato"] . "'))";

    $risultato = mysqli_query($conn, $sql) or die("Errore nella query: " . $sql . "\n" . mysqli_error($conn));
    mysqli_close($conn);
}

function controlloStudente($dati) {
    $conn = dbconnect();
    $sql = "SELECT * FROM studenti WHERE matricola='" . $dati['matricola']
            . "' OR (nome='" . $dati['nome'] . "' AND cognome='" . $dati['cognome']
            . "' AND (data_nascita='" . $dati['data_nascita'] . "' OR FK_laurea ='" . $dati['laurea'] . "'))";
    $risultato = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return (mysqli_fetch_row($risultato) != NULL);
}

function controlloCorso($corso) {
    $conn = dbconnect();
    $sql = "SELECT PK_id FROM corsi WHERE PK_id=" . $corso;

    $risultato = mysqli_query($conn, $sql);

    mysqli_close($conn);
    return (mysqli_fetch_row($risultato) != NULL);
}

function aggiustaVoto($riga) {
    $voto = explode(" ", $riga['voto']);
    if ($voto[1] == 1)
        $voto[1] = "e lode";
    else
        $voto[1] = "";
    $riga['voto'] = implode(" ", $voto);
    return $riga;
}

function aggiustaMatricola($num) {
    $count = strlen($num);
    switch ($count) {
        case 1:
            $num = "00000" . $num;
            break;
        case 2:
            $num = "0000" . $num;
            break;
        case 3:
            $num = "000" . $num;
            break;
        case 4:
            $num = "00" . $num;
            break;
        case 5:
            $num = "0" . $num;
        default:
            break;
    }
    return $num;
}
