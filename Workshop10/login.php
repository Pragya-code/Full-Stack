<?php
require 'session.php';
require 'db.php';

$error = '';

// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (
        empty($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Invalid CSRF token.');
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';

    if (!$email || empty($password)) {
        $error = "Invalid email or password";
    } else {
        $stmt = $pdo->prepare(
            "SELECT id, password FROM users WHERE email = :email"
        );
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        unset($_SESSION['csrf_token']); 
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
        exit;

        } else {
            $error = "Invalid email or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>

<h2>Login</h2>
<p style="color:red;"><?= htmlspecialchars($error) ?></p>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

    Email:<br>
    <input type="text" name="email" required><br><br>

    Password:<br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<a href="signup.php">Go to Signup</a>
</body>
</html>
