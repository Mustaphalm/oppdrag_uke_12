<?php
    // Starte økten for å lagre brukerdata
    session_start();
    // Inkludere koblingen til databasen
    include "db.connect.php";

    // Sjekke om brukeren er logget inn
    if (!isset($_SESSION['brukernavn'])) {
        // Hvis ikke, omdirigere tilbake til logg inn-siden
        header("Location: logg.inn.php");
        exit();
    }

    // Hente brukerens henvendelser basert på brukernavn
    $brukernavn = $_SESSION['brukernavn'];
    $sql = "SELECT * FROM tickets WHERE name='$brukernavn'";
    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Min Profil</title>

    <!-- Link tilbake til index -->
    <a href="index.php">Tilbake til hovedsiden</a>
</head>
<body>
    <h2>Min Profil - Mine Henvendelser</h2>
    <table>
        <tr>
            <th>Saksnummer</th>
            <th>Navn</th>
            <th>Beskrivelse</th>
            <th>Status</th>
            <th>Kategori</th>
        </tr>
        <?php
            // Sjekke om det er henvendelser for brukeren
            if (mysqli_num_rows($result) > 0) {
                // Gå gjennom hver rad med resultatet og vis henvendelsesinformasjonen
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['saksnummer'] . "</td>"; // Vis saksnummer
                    echo "<td>" . $row['name'] . "</td>"; // Vis navn
                    echo "<td>" . $row['description'] . "</td>"; // Vis beskrivelse
                    echo "<td>" . $row['status'] . "</td>"; // Vis status
                    echo "<td>" . $row['category'] . "</td>"; // Vis kategori
                    echo "</tr>";
                }
            } else {
                // Hvis ingen henvendelser ble funnet
                echo "<tr><td colspan='5'>Ingen henvendelser funnet.</td></tr>";
            }
        ?>
    </table>
</body>
</html>




function text () {
    return "text"; 
}

for ($1 = 0: $1 <= 10; i++) {
    ehco . "" ; 
}

let tall = 50
while ("tall <= 50")
console.log(tall)
tall++

$tall = 15

if ($tall > 0) {
    echo "vinter";
}
 elseif ($tall => 0 $$ => 20) {
    echo "vår eller sommer"; 
 }

 $tekst = helttall

 $santellerusant = true

 $tekst = text; 



$tall = class ();


$person-> hoyde = 180;  


function tekst () {
    echo "tekst"
}

function hello world () {
    echo "hello world"
}

