<?php
// submit_quiz.php: Process Quiz Submission
session_start();
require 'db.php';

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

// Create the `scores` table if it does not exist
$conn->query("
    CREATE TABLE IF NOT EXISTS scores (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        student_id VARCHAR(50) NOT NULL,
        score INT(11) NOT NULL,
        total_questions INT(11) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
");

// Fetch the student's submitted answers
$answers = $_POST['answer'];

// Initialize score
$score = 0;

// Iterate through the answers and compare them with the correct answers in the database
foreach ($answers as $question_id => $submitted_answer) {
    // Fetch the correct answer from the database
    $stmt = $conn->prepare("SELECT correct_option FROM questions WHERE id = ?");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $stmt->bind_result($correct_answer);
    $stmt->fetch();
    $stmt->close();

    // Compare submitted answer with correct answer
    if ($submitted_answer == $correct_answer) {
        $score++;
    }
}

// Calculate the total number of questions
$total_questions = count($answers);

// Save the score to the `scores` table
$student_id = $_SESSION['student_id'];
$stmt = $conn->prepare("INSERT INTO scores (student_id, score, total_questions) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $student_id, $score, $total_questions);
$stmt->execute();
$stmt->close();

// Determine the result message
if ($score == $total_questions) {
    $result_message = "Perfect score! You got $score out of $total_questions.";
} else {
    $result_message = "You got $score out of $total_questions. Better luck next time!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="scss.css">
    <style>
        body {
            background: url('img/10.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Quiz Results</h1>
        <h2><?php echo $result_message; ?></h2>

        <div class="nav-links">
            <a href="student_dashboard.php"><button class="nav-btn">Back to Dashboard</button></a>

            <a href="index.php"><button class="nav-btn">Back to Index</button></a>
        </div>
    </div>
</body>

</html>