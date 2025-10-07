<?php
session_start();
require_once 'User.php';

$user = new User();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if (empty($username)) $errors[] = "Gebruikersnaam mag niet leeg zijn.";
    if (strlen($password) < 6) $errors[] = "Wachtwoord moet minstens 6 tekens bevatten.";

    if (empty($errors)) {
        $user->username = htmlspecialchars($username);
        $user->setPassword($password);
        $errors = $user->registerUser();
    }

    if (empty($errors)) {
        header("Location: login_form.php");
        exit;
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
  <h1>Registreren</h1>

  <?php if (!empty($errors)): ?>
      <div style="color:red;">
          <?php foreach ($errors as $error) echo "<p>" . htmlspecialchars($error) . "</p>"; ?>
      </div>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br><br>
    <button type="submit">Registreren</button>
  </form>

  <p>Heb je al een account? <a href="login_form.php">Inloggen</a></p>
</body>
</html>
