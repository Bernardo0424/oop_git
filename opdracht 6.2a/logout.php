<?php
session_start();

// Alle sessie data verwijderen
$_SESSION = [];
session_unset();
session_destroy();

// Redirect terug naar login
header("Location: login_form.php");
exit;
