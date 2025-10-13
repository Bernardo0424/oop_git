<?php
// index.php - Homepagina
session_start();
require_once 'config.php';
require_once 'User.php';

$user = new User($pdo);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .card { padding: 15px; border: 1px solid #ccc; border-radius: 8px; max-width: 500px; }
    </style>
</head>
<body>
    <h1>PDO Login & Registratie</h1>
    <hr>

    <div class="card">
        <?php if (!$user->isLoggedin()): ?>
            <p>U bent niet ingelogd.</p>
            <p><a href="login_form.php">Inloggen</a> | <a href="register_form.php">Registreren</a></p>
        <?php else: ?>
            <?php $user->getUser($_SESSION['username']); ?>
            <h2>Welkom, <?= htmlspecialchars($user->username) ?>!</h2>
            <p>Je bent succesvol ingelogd.</p>
            <a href="logout.php">Uitloggen</a>
        <?php endif; ?>
    </div>
</body>
</html>
