<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("theme", $_POST['theme'], time() + 86400 * 30);
    header("Location: dashboard.php");
    exit();
}
?>

<h2>Select Theme</h2>
<form method="POST">
    <select name="theme">
        <option value="light">Light Mode</option>
        <option value="dark">Dark Mode</option>
    </select><br><br>
    <button type="submit">Save</button>
</form>
