<?php
include 'db.php';

$sql = "INSERT INTO books VALUES (
    NULL,
    '$_POST[title]',
    '$_POST[author]',
    '$_POST[category]',
    '$_POST[quantity]'
)";

mysqli_query($conn, $sql);
header("Location: index.php");
?>
