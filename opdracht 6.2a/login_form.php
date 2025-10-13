<?php
// login_form.php
session_start();
require_once 'config.php';
require_once 'User.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors[] = 'Gebruikersnaam mag niet leeg zijn.';
    }
    if ($password === '') {
        $errors[] = 'Wachtwoord mag niet leeg zijn.';
    }

    if (empty($errors)) {
        $user = new User($pdo);

        if ($user->loginUser($username, $password)) {
            session_regenerate_id(true); // Veilig opnieuw sessie-id
            $_SESSION['username'] = $user->username;
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Login mislukt. Controleer je gegevens.';
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
    <h2>Inloggen</h2>

    <?php if (!empty($errors)): ?>
        <ul style="color:red;">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="">
        <label>Gebruikersnaam:</label><br>
        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required><br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Inloggen</button>
    </form>

    <p>Nog geen account? <a href="register_form.php">Registreer hier</a></p>
</body>
</html>
