<?php
require_once 'User.php';
session_start();

$user = new User();
$errors = [];

if (isset($_POST['register-btn'])) {
    $username = trim($_POST['username'] ?? "");
    $password = $_POST['password'] ?? "";

    $user->username = htmlspecialchars($username);
    $user->setPassword($password);

    if (empty($username)) {
        $errors[] = "Gebruikersnaam mag niet leeg zijn.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Wachtwoord moet minstens 6 tekens bevatten.";
    }

    if (empty($errors)) {
        $errors = $user->registerUser();
    }

    if (empty($errors)) {
        // ✅ Veilige redirect na registratie
        header("Location: login_form.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Test knop</title>
</head>
<body>
  <h1>Test formulier</h1>

  <?php if (!empty($errors)): ?>
      <div style="color:red;">
          <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
      </div>
  <?php endif; ?>

  <form method="post">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br><br>
    <button type="submit" name="register-btn">Registreren</button>
  </form>
</body>
</html>
