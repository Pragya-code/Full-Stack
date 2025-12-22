<?php
include 'db.php';

$id = $_GET['id'];

// ✅ SECURE QUERY (PART 4)
$sql = "DELETE FROM students WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
?>
