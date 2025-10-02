<?php
session_start();
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit;
    } else {
        echo "❌ Fout: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Registreren</title></head>
<body>
<h2>Registreren</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br>
    <button type="submit">Account maken</button>
</form>
<a href="login.php">Heb je al een account? Inloggen</a>
</body>
</html>
