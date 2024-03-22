<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Logg inn</title>
</head>

<div class="container">
    <h2>Logg inn</h2>
    <form action="db.connect.php" method="post">
        <label for="username"> Brukernavn:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Passord:</label><br>
        <input type ="password" id="password" name="password" required><br><br>

        <input type="submit" value="logg.inn">
            </form>

<body>

<?php

include 'db.connect.php';

// sjekker om skjema er sendt inn 

if (($_SERVER["REQUEST_METHOD"] == "POST") 
    // Henter data fra skjemaet
    $username = $_POST['username'];
    $password = $_POST['password'];)

    // utfører en spørring i databasen for å sjekke om brukeren eksisterer

    $sql = "SELECT * FROM Users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    // Sjekker om det finnes en matchende rad i databasen
    if (mysqli_num_rows($result) == 1) {
        // Brukeren er logget inn, du kan utføre videre handlinger som å sette opp en økt (session)
        // Redirect til en annen side, for eksempel en dashbordside
        header("Location: logg_ut.php?login=success");
        exit(); // Sørg for å avslutte skriptet etter en viderekobling
    } else {
        // Brukeren har oppgitt feil brukernavn eller passord
        echo "Feil brukernavn eller passord. Vennligst prøv igjen.";
    }



?
    
</body>
</html>