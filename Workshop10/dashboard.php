<?php
require 'session.php';
require 'db.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Logout
if (
    isset($_POST['logout']) &&
    isset($_POST['csrf_token']) &&
    hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}

$user_email = '';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare(
        "SELECT email FROM users WHERE id = :id"
    );
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user) {
        $user_email = $user['email'];
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>

<h1>Welcome</h1>

<?php if ($user_email): ?>
    <p>Logged in as: <?= htmlspecialchars($user_email) ?></p>

    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button type="submit" name="logout">Logout</button>
    </form>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>

</body>
</html>
