<?php
include 'db.php';

$id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // ✅ SECURE QUERY (PART 4)
    $sql = "UPDATE students SET name=?, email=?, course=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $course, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Edit Student</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?php echo $row['course']; ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>

</body>
</html>
