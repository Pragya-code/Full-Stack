<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $skills = implode("|", $skillsArray);
    $line = $name . "," . $email . "," . $skills . PHP_EOL;
    file_put_contents("students.txt", $line, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    $allowedTypes = ["application/pdf", "image/jpeg", "image/png"];

    if (!in_array($file["type"], $allowedTypes)) {
        throw new Exception("Invalid file type");
    }

    if ($file["size"] > 2097152) {
        throw new Exception("File too large");
    }

    if (!is_dir("uploads")) {
        throw new Exception("Upload directory not found");
    }

    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
    $newName = time() . "." . $ext;

    move_uploaded_file($file["tmp_name"], "uploads/" . $newName);
}
