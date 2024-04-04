<?php
session_start();
include "db.connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Slett bruker fra Users-tabellen
    $sql_users = "DELETE FROM Users WHERE user_id=$id";
    $result_users = mysqli_query($conn, $sql_users);

    // Slett sak fra tickets-tabellen
    $sql_tickets = "DELETE FROM tickets WHERE ticket_id=$id";
    $result_tickets = mysqli_query($conn, $sql_tickets);

    if ($result_users && $result_tickets) {
        echo "Sletting fullført";
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Feil ved sletting.";
    }
} else {
    echo "Ugyldig forespørsel.";
}
?>
