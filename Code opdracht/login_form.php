<?php
require_once "classes/User.php";

session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $user->username = $_POST["username"] ?? "";
    $user->setPassword($_POST["password"] ?? "");

    // Validatie uitvoeren
    $errors = $user->validateLogin();

    if (empty($errors)) {
        // Simpele login (later kan dit met DB)
        if ($user->loginUser()) {
            $_SESSION["username"] = $user->username;
            header("Location: index_test.php");
            exit;
        } else {
            $errors[] = "Login mislukt. Controleer je gegevens.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    if (!empty($errors)) {
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
    ?>

    <form method="post" action="">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" name="username" id="username"><br><br>

        <label for="password">Wachtwoord:</label><br>
        <input type="password" name="password" id="password"><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
