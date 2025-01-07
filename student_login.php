<?php
// student_login.php: Student Login
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];

    // Query database for matching student
    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = ?");
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Debugging: Check user data
        echo "<pre>";
        print_r($user); // This will print the fetched user data from the database
        echo "</pre>";

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store student info in session
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['student_name'] = $user['name'];

            // Redirect to student dashboard
            header("Location: student_dashboard.php");
            exit();
        } else {
            echo "Invalid credentials. Please <a href='student_login.php'>try again</a>.";
        }
    } else {
        echo "Student not found. Please <a href='student_login.php'>try again</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: url('img/7.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Login</h1>
        <form method="post" action="student_login.php">
            <input type="text" id="student_id" name="student_id" placeholder="Student ID" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
        <p class="centered">New User? <a href="student_register.php">Register here</a></p>
        <div class="nav-links">
            <a href="index.php"><button>Back to Index</button></a>
        </div>
    </div>
</body>

</html>