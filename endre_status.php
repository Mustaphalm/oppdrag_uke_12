<?php
session_start();
include "db.connect.php";

// Sjekk om id og status er satt og ikke tomme
if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['status']) && !empty($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Oppdater status for billetten med gitt id ved hjelp av forberedt uttalelse
    $sql = "UPDATE tickets SET status=? WHERE ticket_id=?";
    
    // Bruk av forberedt uttalelse for å beskytte mot SQL-injeksjon
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "si", $status, $id);
    
    // Utfør spørringen og sjekk resultatet
    if(mysqli_stmt_execute($stmt)) {
        echo "Statusen er oppdatert.";
    } else {
        echo "Feil: " . mysqli_error($conn);
    }

    // Lukk forberedt uttalelse
    mysqli_stmt_close($stmt);
} else {
    echo "Ugyldig forespørsel.";
}

// Lukk tilkoblingen til databasen
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Oppdater Status</title>
</head>

<h2>Oppdater Status</h2>

<a href="admin_dashboard.php"> tilbake til dashboardet</a>



<a href="index.php">Tilbake til hovedsiden</a>



</html>
<body>

