<?php
require_once "database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, the file already exists.";
        $uploadOk = 0;
    }

    // Check file size (you can modify this value)
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats (you can modify this list)
    if ($imageFileType !== "pdf" && $imageFileType !== "doc" && $imageFileType !== "docx") {
        echo "Sorry, only PDF, DOC, and DOCX files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk === 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Move the file to the target directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            // Save document details to MySQL database
            saveDocumentDetails($conn, $_FILES["file"]["name"], $_POST["type"], $_POST["description"]);

            echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

function saveDocumentDetails($conn, $filename, $type, $description) {
    $stmt = $conn->prepare("INSERT INTO documents (filename, type, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $filename, $type, $description);

    if ($stmt->execute()) {
        // Document details saved successfully
    } else {
        // Error handling if the insertion fails
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
