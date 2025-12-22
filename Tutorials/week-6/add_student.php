<?php
include 'db.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // ✅ SECURE QUERY (PART 4)
    $sql = "INSERT INTO students (name, email, course) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $course);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Course: <input type="text" name="course" required><br><br>
    <button type="submit" name="submit">Add Student</button>
</form>

</body>
</html>
