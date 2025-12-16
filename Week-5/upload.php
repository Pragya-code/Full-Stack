<?php

include 'header.php';


function uploadPortfolioFile($file) {
    $targetDir = "uploads/";
    
   
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $fileName = $file['name'];
    $fileTmp = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    
    $allowed = ['pdf', 'jpg', 'jpeg', 'png'];

    
    $newFileName = time() . "_" . str_replace(" ", "_", $fileName);

    
    if (!in_array($fileExt, $allowed)) {
        throw new Exception("Invalid file type. Only PDF, JPG, PNG allowed.");
    }

    if ($fileSize > 2 * 1024 * 1024) { 
        throw new Exception("File size must be less than 2MB.");
    }

    if (!move_uploaded_file($fileTmp, $targetDir . $newFileName)) {
        throw new Exception("Failed to upload file.");
    }

    return $newFileName;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (!isset($_FILES['portfolio'])) {
            throw new Exception("No file selected.");
        }

        $uploadedFile = uploadPortfolioFile($_FILES['portfolio']);
        echo "<p style='color:green;'>File uploaded successfully: $uploadedFile</p>";

    } catch (Exception $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
}
?>


<form method="post" enctype="multipart/form-data">
    <label>Upload File (PDF, JPG, PNG | Max 2MB):</label><br>
    <input type="file" name="portfolio" required><br><br>
    <input type="submit" value="Upload File">
</form>

<?php

include 'footer.php';
?>