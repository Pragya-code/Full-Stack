<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>
    <style>
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #000; padding: 8px; }
    </style>
</head>
<body>

<h2>Add Student</h2>
<form method="POST">
    Name: <input type="text" name="name" required>
    Email: <input type="email" name="email" required>
    Course: <input type="text" name="course" required>
    <button type="submit" name="add">Add</button>
</form>

<?php
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    mysqli_query($conn, "INSERT INTO students VALUES (NULL,'$name','$email','$course')");
}
?>

<h2>Student List</h2>
<table>
<tr>
    <th>ID</th><th>Name</th><th>Email</th><th>Course</th><th>Actions</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['course']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Edit</a> |
            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a>
        </td>
    </tr>";
}
?>
</table>

</body>
</html>
