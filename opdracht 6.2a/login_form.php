<?php
require_once 'User.php';
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = new User();
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    // Validatie
    if (empty($username)) {
        $errors[] = "Gebruikersnaam mag niet leeg zijn.";
    }
    if (empty($password)) {
        $errors[] = "Wachtwoord mag niet leeg zijn.";
    }

    if (empty($errors)) {
        // Gebruik loginUser met plain password
        if ($user->loginUser($username, $password)) {
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

    <?php if (!empty($errors)): ?>
        <ul style="color:red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Wachtwoord:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Login">
    </form>

    <br>
    <!-- 👇 Voeg deze regel toe -->
    <p>Nog geen account? <a href="register_form.php">Registreer hier</a></p>
</body>
</html>
