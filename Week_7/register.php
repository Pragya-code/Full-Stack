<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];

    $hashed = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare(
        "INSERT INTO students (student_id, full_name, password_hash)
         VALUES (?, ?, ?)"
    );
    $stmt->execute([$student_id, $full_name, $hashed]);

    header("Location: login.php");
    exit();
}
?>

<h2>Registration Form</h2>
<form method="POST">
    Student ID: <input type="text" name="student_id" required><br><br>
    Full Name: <input type="text" name="full_name" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Register</button>
</form>
