<?php
$host = "localhost";
$user = "root";  // standaard bij XAMPP
$pass = "";      // leeg wachtwoord
$dbname = "loginsysteem";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connectie mislukt: " . $conn->connect_error);
}
?>
