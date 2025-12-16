<?php
require "header.php";

if (!file_exists("students.txt")) {
    echo "No students found";
    require "footer.php";
    exit;
}

$lines = file("students.txt");

foreach ($lines as $line) {
    list($name, $email, $skills) = explode(",", trim($line));
    $skillsArray = explode("|", $skills);

    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Skills: ";
    print_r($skillsArray);
    echo "<hr>";
}

require "footer.php";
