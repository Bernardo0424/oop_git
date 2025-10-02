<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h2>Welkom, <?php echo htmlspecialchars($_SESSION['user']); ?> 🎉</h2>
<p>Je bent succesvol ingelogd!</p>
<a href="logout.php">Uitloggen</a>
</body>
</html>
