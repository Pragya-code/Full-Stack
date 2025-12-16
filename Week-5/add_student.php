<?php
require "header.php";
require "functions.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skillsInput = $_POST["skills"];

        if (empty($name) || empty($email) || empty($skillsInput)) {
            throw new Exception("All fields required");
        }

        if (!validateEmail($email)) {
            throw new Exception("Invalid email");
        }

        $skillsArray = cleanSkills($skillsInput);
        saveStudent($name, $email, $skillsArray);

        echo "Student saved successfully";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<form method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Skills (comma-separated): <input type="text" name="skills"><br><br>
    <button type="submit">Save</button>
</form>

<?php echo $error; ?>

<?php require "footer.php"; ?>
