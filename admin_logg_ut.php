<?php
session_start();

// Sjekker om brukeren er logget inn 
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Logger ut brukeren
    $_SESSION = array(); // Tømmer alle sesjonsvariabler
    session_destroy(); // Fjerner selve sesjonen når brukeren logger ut
    header("Location: logg.inn.php"); // Omdirigerer brukeren til logg inn-siden
    exit(); 
} else {
    // Hvis brukeren ikke er logget inn, går den tilbake til logg inn-siden 
    header("Location: logg.inn.php");
    exit();
}
?>
