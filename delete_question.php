<?php
// delete_question.php: Delete question from database
session_start();
require 'db.php';

// Ensure the admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// Get the question ID from the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirect back to the admin dashboard
    header("Location: admin_dashboard.php");
    exit();
} else {
    echo "Invalid request!";
}
?>
