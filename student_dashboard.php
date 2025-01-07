<?php
// student_dashboard.php: Student Dashboard
session_start();
require 'db.php';

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: student_login.php");
    exit();
}

// Fetch all questions from the database
$stmt = $conn->prepare("SELECT * FROM questions ORDER BY id ASC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="scss.css"> <!-- Assuming the scss.css file is already linked -->
    <style>
        body {
            background: url('img/5.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['student_name']; ?>!</h1>
        <h2>Start the Quiz</h2>
        <form method="post" action="submit_quiz.php">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<div class='question-box'>";
                echo "<div class='question'>" . $row['question'] . "</div>";
                echo "<div class='options'>";
                // Each radio button's value is set to option1, option2, option3, or option4
                for ($i = 1; $i <= 4; $i++) {
                    echo "<label><input type='radio' name='answer[{$row['id']}]' value='option{$i}'> {$row['option' . $i]}</label><br>";
                }
                echo "</div>";
                echo "</div>";
            }
            ?>
            <!-- Submit button placed at the center of the page at the bottom -->
            <div class="submit-container">
                <button type="submit" class="submit-btn">Submit Quiz</button>
            </div>
        </form>

        <!-- Navigation buttons -->
        <div class="nav-links">
            <a href="student_login.php"><button class="nav-btn">Back to Student Login</button></a>
            <a href="index.php"><button class="nav-btn">Back to Index</button></a>
            <a href="logout.php"><button class="nav-btn">Logout</button></a>
        </div>
    </div>
</body>

</html>

<?php
// Free the result set to avoid issues with further queries
$result->free_result();
?>