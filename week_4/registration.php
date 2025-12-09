<?php
$name = $email = "";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name)) {
        $errors['name'] = "Name is required.";
    }

    if (empty($email)) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 8) {
        $errors['password'] = "Password must be at least 8 characters long.";
    } elseif (!preg_match("/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/", $password)) {
        $errors['password'] = "Password must contain both letters and numbers.";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

  
    $usersFile = 'users.json';
    if (file_exists($usersFile)) {
        $usersData = file_get_contents($usersFile);
        $users = json_decode($usersData, true);

        if (is_array($users)) {
            foreach ($users as $user) {
                if ($user['email'] === $email) {
                    $errors['email'] = "This email is already registered.";
                    break;
                }
            }
        }
    }


    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $newUser = [
            "name" => $name,
            "email" => $email,
            "password" => $hashedPassword,
            "registered_at" => date('Y-m-d H:i:s')
        ];

       
        if (file_exists($usersFile) && is_readable($usersFile)) {
            $usersData = file_get_contents($usersFile);
            $users = json_decode($usersData, true);

            if (!is_array($users)) {
                $users = [];
            }
        } else {
            $users = [];
        }

        $users[] = $newUser;

        if (file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT))) {
            $success = "Registration successful! Welcome, " . htmlspecialchars($name) . "!";
            

            $name = $email = "";
        } else {
            $errors['file'] = "Error saving user data. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; background: #f4f4f4; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #333; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 5px; box-sizing: border-box;
        }
        button { margin-top: 20px; padding: 12px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error { color: red; font-size: 0.9em; }
        .success { color: green; background: #d4edda; padding: 15px; border-radius: 5px; margin: 20px 0; text-align: center; }
        .info { color: #666; font-size: 0.9em; margin-top: 20px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Registration Form</h2>

    <?php if ($success): ?>
        <div class="success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($name); ?>" required>
        <?php if (isset($errors['name'])): ?>
            <span class="error"><?php echo $errors['name']; ?></span>
        <?php endif; ?>

        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <?php if (isset($errors['email'])): ?>
            <span class="error"><?php echo $errors['email']; ?></span>
        <?php endif; ?>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <?php if (isset($errors['password'])): ?>
            <span class="error"><?php echo $errors['password']; ?></span>
        <?php endif; ?>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <?php if (isset($errors['confirm_password'])): ?>
            <span class="error"><?php echo $errors['confirm_password']; ?></span>
        <?php endif; ?>

        <?php if (isset($errors['file'])): ?>
            <div class="error"><?php echo $errors['file']; ?></div>
        <?php endif; ?>

        <button type="submit">Register</button>
    </form>

    <div class="info">
        <p><strong>Password requirements:</strong></p>
        <ul>
            <li>At least 8 characters long</li>
            <li>Must contain both letters and numbers</li>
        </ul>
    </div>
</div>

</body>
</html>