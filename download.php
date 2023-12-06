<?php
require_once "database.php";
// Handle document download

$filename = $_GET["filename"];
$filepath = "uploads/" . $filename;

// Check if the file exists
if (file_exists($filepath)) {
    // Set the appropriate headers for file download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    readfile($filepath);
} else {
    echo "File not found.";
}
?>
