<?php
// Homepagina
session_start();
require_once 'User.php';

$user = new User();
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h3>PDO Login en Registratie</h3>
    <hr/>

    <?php if (!$user->isLoggedin()): ?>
        <p>U bent niet ingelogd. Log in om verder te gaan.</p>
        <a href="login_form.php">Login</a>
    <?php else: ?>
        <?php 
            $user->getUser($_SESSION['username']);
        ?>
        <h2>Welkom, <?php $user->showUser(); ?>!</h2>
        <p>Je bent succesvol ingelogd.</p>
        <a href="logout.php">Uitloggen</a>
    <?php endif; ?>

    <br><br>
    <p><a href="register_form.php">Registreren</a></p>
</body>
</html>
