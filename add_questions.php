<?php
// add_questions.php: Handle adding new questions to the database
session_start();
require 'db.php';

// Ensure the admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    // Insert the new question into the database
    $stmt = $conn->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correct_option);
    $stmt->execute();

    // Redirect to the admin dashboard after adding the question
    header("Location: admin_dashboard.php");
    exit();
}
?>
