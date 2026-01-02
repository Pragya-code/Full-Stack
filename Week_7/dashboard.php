<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = $_COOKIE['theme'] ?? 'light';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="<?= $theme ?>">

<h2>Welcome, <?= $_SESSION['name'] ?></h2>

<a href="preference.php">Change Theme</a> |
<a href="logout.php">Logout</a>

<p>This is the student dashboard.</p>

</body>
</html>
