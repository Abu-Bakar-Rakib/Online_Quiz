<?php
// index.php: Home page
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['username'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Check if the student is already logged in (if applicable)
if (isset($_SESSION['student_username'])) {
    header("Location: student_dashboard.php");  // Redirect to student dashboard if logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/1.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            padding: 70px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        h1 {
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Online Quiz System</h1>

        <!-- Display admin login link if not logged in -->
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="admin_login.php"><button>Admin Login</button></a>
        <?php else: ?>
            <a href="admin_dashboard.php"><button>Go to Admin Dashboard</button></a>
        <?php endif; ?>

        <!-- Display student login link if not logged in -->
        <?php if (!isset($_SESSION['student_username'])): ?>
            <a href="student_login.php"><button>Student Login</button></a>
        <?php else: ?>
            <a href="student_dashboard.php"><button>Go to Student Dashboard</button></a>
        <?php endif; ?>
    </div>
</body>

</html>