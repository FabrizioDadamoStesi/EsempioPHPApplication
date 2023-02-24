<?php

// Connessione al database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

// Creazione della tabella dei giochi, se non esiste già
$sql = "CREATE TABLE IF NOT EXISTS videogiochi (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titolo VARCHAR(30) NOT NULL,
    piattaforma VARCHAR(30) NOT NULL,
    anno_lancio YEAR(4) NOT NULL,
    genere VARCHAR(30) NOT NULL
)";
if (mysqli_query($conn, $sql)) {
    echo "Tabella videogiochi creata con successo<br>";
} else {
    echo "Errore nella creazione della tabella videogiochi: " . mysqli_error($conn) . "<br>";
}

// Aggiunta di un gioco al database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $piattaforma = mysqli_real_escape_string($conn, $_POST['piattaforma']);
    $anno_lancio = mysqli_real_escape_string($conn, $_POST['anno_lancio']);
    $genere = mysqli_real_escape_string($conn, $_POST['genere']);

    $sql = "INSERT INTO videogiochi (titolo, piattaforma, anno_lancio, genere)
            VALUES ('$titolo', '$piattaforma', '$anno_lancio', '$genere')";

    if (mysqli_query($conn, $sql)) {
        echo "Gioco aggiunto con successo";
    } else {
        echo "Errore nell'aggiunta del gioco: " . mysqli_error($conn);
    }
}

// Chiusura della connessione al database
mysqli_close($conn);

?>
