<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel= "stylesheet" href="style.css">
    <title>Legg til hendvendelse</title>
</head>
<body>

<a href="index.php"> Tilbake til Hovedsiden</a>

<h2>Legg til hendvendelse</h2>
<form action="" method="post">
    <label for="name">Navn:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">E-post:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="description">Beskrivelse av problemet:</label><br>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

    <label for="category">Kategori:</label><br>
    <select id="category" name="category" required>
        <option value="Faktura">Faktura</option>
        <option value="Support">Support</option>
        <option value="Vedlikehold">Vedlikehold</option>
        <option value="Programvarelisens">Programvarelisens</option>
    </select><br><br>

    <!-- <label for="saksnummer">Saksnummer:</label><br>
    <input type="text" id="saksnummer" name="saksnummer" required><br><br> -->

    <input type="submit" value="Legg til henvendelse.">
</form>

<?php
// Inkluderer databasekoblingen
include 'db.connect.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sjekker om skjemaet er sendt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Henter og rens innsendte data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $status = 'Åpen'; // Setter statusen til 'Åpen'

    // Genererer et unikt saksnummer ved å bruke timestamp
    $saksnummer = time(); // Dette vil gi et tall basert på nåværende tidspunkt i millisekunder

    // SQL-spørring for å sette inn henvendelse
    $sql = "INSERT INTO Tickets (name, email, description, category, status, saksnummer)
            VALUES ('$name', '$email', '$description', '$category', '$status', '$saksnummer')";

    // Utfører spørringen og sjekker resultatet
    if (mysqli_query($conn, $sql)) {
        echo "Henvendelse lagt til! Saksnummer: " . $saksnummer;
    } else {
        echo "Feil ved innsetting av henvendelse: " . mysqli_error($conn);
    }
}
?>


</body>
</html>
