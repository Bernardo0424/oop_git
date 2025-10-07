<?php
// Functie: programma login OOP 
// Auteur: Studentnaam

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
    <h3>PDO Login and Registration</h3>
    <hr/>

    <h3>Welkom op de HOME-pagina!</h3>
    <br />

    <?php
    // Check login session
    if (!$user->isLoggedin()) {
        echo "U bent niet ingelogd. Log in om verder te gaan.<br><br>";
        echo '<a href="login_form.php">Login</a>';
    } else {
        // select userdata from database
        $user->getUser($_SESSION['username'] ?? $user->username);

        // Print userdata
        echo "<h2>Het spel kan beginnen</h2>";
        echo "Je bent ingelogd met:<br/>";
        $user->showUser();
        echo "<br><br>";
        echo '<a href="logout.php">Logout</a>';
    }
	
// Simpele homepage

echo "<p><a href='register_form.php'>Register</a></p>";
?>

    
</body>
</html>
