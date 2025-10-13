<?php
// logout.php
session_start();
require_once 'config.php';
require_once 'User.php';

$user = new User($pdo);
$user->logout();

// Redirect naar loginpagina
header('Location: login_form.php');
exit;
