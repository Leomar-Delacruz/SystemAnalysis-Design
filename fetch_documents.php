<?php
require_once "database.php"; // Include your database connection logic here

function fetchDocuments() {
    global $conn;

    // Implement logic to fetch documents from the database
    $result = $conn->query("SELECT * FROM documents");

    if ($result) {
        $documents = $result->fetch_all(MYSQLI_ASSOC);
        return $documents;
    } else {
        // Handle the error appropriately (e.g., log, display an error message)
        echo "Error fetching documents: " . $conn->error;
        return [];
    }
}

function displayDocuments($documents) {
    echo '<ul>';
    foreach ($documents as $document) {
        echo "<li>{$document['filename']} - Type: {$document['type']} - Description: {$document['description']}</li>";
    }
    echo '</ul>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Repository</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to the Document Repository</h1>

    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file">Choose a document to upload:</label>
        <input type="file" name="file" id="file">
        <br>
        <label for="type">Document Type:</label>
        <input type="text" name="type" id="type">
        <br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
        <input type="submit" value="Upload Document">
    </form>

    <hr>

    <h2>Document List</h2>
    
    <?php
    // Fetch and display documents
    $documents = fetchDocuments();
    displayDocuments($documents);
    ?>

    <script src="main.js"></script>
</body>
</html>
