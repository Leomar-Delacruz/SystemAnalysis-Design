<?php
require_once "database.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password FROM login WHERE username = ?');

    if (!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param('s', $enteredUsername);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found
        $user = $result->fetch_assoc();

        // Compare passwords directly (less secure)
        if ($enteredPassword === $user['password']) {
            // Login successful
            session_start();
            $_SESSION['id'] = $user['id'];
            header('Location: index.html'); 
            exit();
        } else {
            // Password incorrect
            echo 'Entered Password: ' . $enteredPassword . '<br>';
            echo 'Stored Password from Database: ' . $user['password'] . '<br>';
            echo 'Invalid username or password.';
        }
    } else {
        // User not found
        echo 'Invalid username or password.';
    }

    $stmt->close();  // Close the statement after use
}
?>
