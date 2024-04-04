<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin logg inn</title>
</head>
<body>

<a href="index.php">Tilbake til hovedsiden</a>


<h2>Administrator Logg inn</h2>

<form action="" method="post">
    <label for="username"> Brukernavn:</label><br>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password"> Passord:</label><br>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Logg inn">
    
</form>

<?php
session_start();
include "db.connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM admin_users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Feil brukernavn eller passord.";
       
    }
}
?>
    
</body>
</html>

