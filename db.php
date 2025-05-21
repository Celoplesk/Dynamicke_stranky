<?php
$servername = "localhost";
$username = "jerabekf";      // nebo tvoje DB jméno
$password = "Jerabek58820$";          // nebo tvoje heslo
$dbname = "jerabekf_cisla";

// Připojení k databázi
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola spojení
if ($conn->connect_error) {
    die("Chyba připojení: " . $conn->connect_error);
}
?>
