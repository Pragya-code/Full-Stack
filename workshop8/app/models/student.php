<?php
class Student
{
    private $conn;

    public function __construct($dbConnection)
    {
        $this->conn = $dbConnection;
    }

    // Get all students
    public function all()
    {
        $result = $this->conn->query("SELECT * FROM students ORDER BY id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Find single student by ID
    public function find($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Create new student
    public function create($name, $email, $course)
    {
        $stmt = $this->conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $course);
        return $stmt->execute();
    }

    // Update student
    public function update($id, $name, $email, $course)
    {
        $stmt = $this->conn->prepare("UPDATE students SET name = ?, email = ?, course = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $course, $id);
        return $stmt->execute();
    }

    // Delete student
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>