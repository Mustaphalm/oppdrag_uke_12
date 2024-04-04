<?php
session_start();
include "db.connect.php";

// Sjekker om admin er logget inn
if (!isset($_SESSION['admin_logged_in'])) {
    header("location: admin_logg_inn.php");
    exit();
}

// Ditt admin-dashboard innhold her
echo "<h2> Administrator Dashboard </h2>";
echo "<p> Velkommen, " . $_SESSION['admin_username'] . "!</p>";

// Vis oversikt over henvendelser






$sql = "SELECT * FROM tickets";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0 ){
    echo "<h3>Oversikt over henvendelser:</h3>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Brukernavn</th><th>Emne</th><th>Status</th><th>Handlinger</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['ticket_id'] . "</td>"; // Sjekk at dette samsvarer med kolonnenavnene i databasetabellen
        echo "<td>" . $row['name'] . "</td>"; // Sjekk at dette samsvarer med kolonnenavnene i databasetabellen
        echo "<td>" . $row['description'] . "</td>"; // Sjekk at dette samsvarer med kolonnenavnene i databasetabellen
        echo "<td>" . $row['status'] . "</td>";
        echo "<td><a href='endre_status.php?id=" . $row['ticket_id'] . "&status=Lukket'>Endre til Lukket</a> | <a href='endre_status.php?id=" . $row['ticket_id'] . "&status=Åpen'>Endre til Åpen</a> | <a href='endre_status.php?id=" . $row['ticket_id'] . "&status=Pågår'>Endre til Pågår</a> | <a href='slett_saker.php?id=" . $row['ticket_id'] . "'>Slett sak</a></td>";
    }
    
    echo "</table>";
} else {
    echo "<p>Ingen henvendelser å vise.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <a href="index.php">Tilbake til hovedsiden</a>




