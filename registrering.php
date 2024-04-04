<!DOCTYPE html>
<html lang="no">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registrering</title>
</head>
<body>

<main>
    <div class="registration-container">

    <!-- Lenke tilbake til hovedsiden -->
    <a href="index.php">Tilbake til hovedsiden</a>

        <h2>Bli Kunde</h2>
        <!-- Registreringsskjema -->
        <form class="registration-form" method="post">
    <label for="fornavn">Fornavn:</label>
    <input type="text" id="fornavn" name="fornavn" placeholder="Fornavn" required><br/>

    <label for="etternavn">Etternavn:</label>
    <input type="text" id="etternavn" name="etternavn" placeholder="Etternavn" required><br/>

    <label for="brukernavn">Brukernavn:</label>
    <input type="text" id="brukernavn" name="brukernavn" placeholder="Velg et brukernavn" required><br/>

    <label for="passord">Passord:</label>
    <input type="password" id="passord" name="passord" placeholder="Velg et passord" required><br/>
    
    <!-- Legg til en skjult input for å angi brukerens rolle -->
    <input type="hidden" id="rolle" name="rolle" value="Begrenset tilgang">

    <button type="submit">Registrer deg</button><br/>

    <a href="Logg.inn.php">Allerede en konto? Logg inn her</a>

    <!-- PHP-kode for registrering -->
    <?php
        // Inkluderer databasekoblingen
        include "db.connect.php"; // Juster stien ved behov

        // Håndterer registreringslogikk når skjemaet sendes
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Funksjon for validering av inndata
            function validate($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // Valider og rens inndata
            $fornavn = validate($_POST['fornavn']);
            $etternavn = validate($_POST['etternavn']);
            $brukernavn = validate($_POST['brukernavn']);
            $passord = validate($_POST['passord']);
            $rolle = $_POST['rolle']; // Hent rollen fra skjemaet

            // Sjekk om alle påkrevde felt er oppgitt
            if (empty($fornavn) || empty($etternavn) || empty($brukernavn) || empty($passord)) {
                echo "Alle felt er påkrevd!";
                exit();
            }

            // Hashing av passordet
            $hashed_password = md5($passord);

            // Sjekk om brukernavnet allerede eksisterer ved hjelp av en forberedt uttalelse
            $check_username_query = "SELECT * FROM users WHERE username=?";
            $stmt_check = mysqli_prepare($conn, $check_username_query);

            if ($stmt_check === false) {
                echo "Feil i forberedt uttalelse: " . mysqli_error($conn);
                exit();
            }

            mysqli_stmt_bind_param($stmt_check, "s", $brukernavn);
            mysqli_stmt_execute($stmt_check);
            mysqli_stmt_store_result($stmt_check);

            if (mysqli_stmt_num_rows($stmt_check) > 0) {
                echo "Brukernavnet eksisterer allerede! Prøv et annet.";
            } else {
                // Setter inn en ny bruker i databasen ved hjelp av en forberedt uttalelse
                $insert_user_query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
                $stmt_insert = mysqli_prepare($conn, $insert_user_query);

                if ($stmt_insert === false) {
                    echo "Feil i forberedt uttalelse: " . mysqli_error($conn);
                    exit();
                }

                // Bind parametere til de forberedte uttalelsene
                mysqli_stmt_bind_param($stmt_insert, "sss", $brukernavn, $hashed_password, $rolle);

                if (mysqli_stmt_execute($stmt_insert)) {
                    echo "Registrering vellykket! Du kan nå <a href= Logg.inn.php >logge inn</a>";
                    // Går direkte til logg inn siden etter å ha logget inn
                } else {
                    echo "Registrering feilet. Prøv igjen senere. " . mysqli_stmt_error($stmt_insert);
                }

                mysqli_stmt_close($stmt_insert);
            }

            mysqli_stmt_close($stmt_check);
        }

        // Lukker databaseforbindelsen
        mysqli_close($conn);
    ?>
</form>
    </div>
</main>

</body>
</html>
