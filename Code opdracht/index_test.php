<?php
session_start();

// Check of gebruiker is ingelogd
if (!isset($_SESSION["username"])) {
    header("Location: login_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Welkom</title>
</head>
<body>
    <h1>Welkom, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
    <p>Je bent succesvol ingelogd.</p>
    <a href="logout.php">Uitloggen</a>
</body>
</html>
