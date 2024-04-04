<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sjekk status</title>
</head>
<body>
    <h2>Sjekk Status</h2>

    <!-- Lenke tilbake til hovedsiden -->
    <a href="index.php">Tilbake til hovedsiden</a>

    <!-- Skjema for å sjekke status -->
    <form action="" method="post">
        <label for="saksnummer"> Saksnummer:</label><br>
        <input type="text" id="saksnummer" name="saksnummer" required><br><br>
        <input type="submit" value="Sjekk Status">
    </form>

  


    <?php
    // Inkluderer databasetilkoblingen
    include 'db.connect.php';

    // Sjekker om skjemaet er sendt
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Henter og rens innsendt saksnummer
        $saksnummer = mysqli_real_escape_string($conn, $_POST['saksnummer']);

        // SQL-spørring for å hente status basert på saksnummer
        $sql = "SELECT * FROM tickets WHERE saksnummer = ?";
        
        // Bruk av forberedt uttalelse
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $saksnummer);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Saksnummeret ble funnet, vis statusen
                $row = mysqli_fetch_assoc($result);
                echo "<h3>Informasjon for saksnummer $saksnummer:</h3>";
                echo "Navn: " . $row['name'] . "<br>";
                echo "E-post: " . $row['email'] . "<br>";
                echo "Beskrivelse: " . $row['description'] . "<br>";
                echo "Status: " . $row['status'] . "<br>";
                echo "Kategori: " . $row['category'] . "<br>";
                echo "Opprettet: " . $row['timestamp'] . "<br>";
            } else {
                // Saksnummeret ble ikke funnet
                echo "Ingen henvendelse med dette saksnummeret ble funnet.";
            }
        } else {
            echo "Feil ved henting av status: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>
