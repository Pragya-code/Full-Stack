<?php
// db.php
// Database connection using MySQLi

$servername = "localhost";  //  server name
$username = "root";         //  MySQL username
$password = "";             //  MySQL password (empty if none)
$dbname = "school_db";      //  database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to MySQL database!";
}
?>