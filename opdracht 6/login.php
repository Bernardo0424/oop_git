<?php
session_start();
require_once "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "❌ Wachtwoord onjuist!";
        }
    } else {
        $error = "❌ Gebruiker niet gevonden!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Inloggen</h2>
<?php if (!empty($_GET['registered'])) echo "<p style='color:green;'>✅ Registratie gelukt, je kan nu inloggen!</p>"; ?>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>
<a href="register.php">Nog geen account? Registreren</a>
</body>
</html>
