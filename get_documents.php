<?php
require_once "database.php";
// Retrieve document list from MongoDB (you need to implement this part)

// Sample data for demonstration
$documents = [
    ["type" => "Research Paper", "description" => "A paper on...", "filename" => "research_paper.pdf"],
    ["type" => "Syllabus", "description" => "Course syllabus", "filename" => "syllabus.docx"],
    // Add more documents as needed
];

echo json_encode($documents);
?>
