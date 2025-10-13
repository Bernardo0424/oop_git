<?php
// register_form.php
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
    if (strlen($password) < 6) {
        $errors[] = 'Wachtwoord moet minstens 6 tekens bevatten.';
    }

    if (empty($errors)) {
        $user = new User($pdo);
        $result = $user->registerUser($username, $password);

        if (empty($result)) {
            // Registratie geslaagd → stuur naar login pagina
            header('Location: login_form.php');
            exit;
        } else {
            $errors = array_merge($errors, $result);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren</title>
</head>
<body>
    <h2>Account Registreren</h2>

    <?php if (!empty($errors)): ?>
        <div style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <label>Gebruikersnaam:</label><br>
        <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required><br><br>

        <label>Wachtwoord:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Registreren</button>
    </form>

    <p>Heb je al een account? <a href="login_form.php">Log hier in</a></p>
</body>
</html>
