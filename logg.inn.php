
<?php
    // Starte økten for å lagre brukerdata
    session_start();
    // Inkludere koblingen til databasen
    include "db.connect.php";

    // Sjekke om skjemaet er sendt
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Funksjon for å validere skjemadata
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Hente og validere brukernavn og passord fra skjemaet
        $brukernavn = validate($_POST['brukernavn']);
        $passord = validate($_POST['passord']);

        // Sjekke om brukernavn eller passord er tomme
        if (empty($brukernavn) || empty($passord)) {
            echo "<p class='error-message'>Både brukernavn og passord er påkrevd!</p>";
        } else {
            // Hashing av passordet - anbefaler å bruke password_hash() for sikrere hashing
            $hashed_password = md5($passord);

            // SQL-spørring for å hente brukeren basert på brukernavn og passord
            $sql = "SELECT * FROM users WHERE username='$brukernavn' AND password='$hashed_password'"; 
            // Utfører spørringen
            $result = mysqli_query($conn, $sql);

            // Sjekker om brukeren ble funnet
            if ($result && mysqli_num_rows($result) === 1) {
                // Henter brukerdata
                $row = mysqli_fetch_assoc($result);
                // Lagrer brukernavn og ID i økten
                $_SESSION['brukernavn'] = $row['username'];
                
                // Omdirigerer til min_profil.php etter vellykket innlogging
                header("Location: min_profil.php");
                exit();
            } else {
                // Utgive en feilmelding hvis brukeren ikke ble funnet
                echo "<p class='error-message'>Feil brukernavn eller passord!</p>";
            } 
        }
    }
?>

<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logg inn</title>
</head>
<body>

<a href="index.php">Tilbake til hovedsiden</a>

    <h2 class="h2-3">Logg Inn</h2>
    <div class="loggin">
        <form action="" method="post">
            <!-- Inndatafelt for brukernavn -->
            <label for="brukernavn">Brukernavn:</label>
            <input type="text" id="brukernavn" name="brukernavn" placeholder="Brukernavn" required><br/>
            <!-- Inndatafelt for passord -->
            <label for="passord">Passord:</label>
            <input type="password" id="passord" name="passord" placeholder="Passord" required><br/>
            <!-- Knapp for å sende inn logindata -->
            <input type="submit" value="Logg Inn">
        </form>

        <a href="registrering.php" class="back-link"> Ikke en kunde? Registrer her</a>

        <!-- logg ut -->

    <form action="admin_logg_ut.php" method="post">
        <button type="submit"> Logg ut</button>
</form>
</div>


</body>
</html>