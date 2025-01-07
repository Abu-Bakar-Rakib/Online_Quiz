<?php
// admin_login.php: Admin Login
session_start();
require 'db.php';

// Check if the admin is already logged in
if (isset($_SESSION['username'])) {
    header("Location: admin_dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the admin
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Check if the plain text password matches
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Invalid credentials. Please <a href='admin_login.php'>try again</a>.</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>User not found. Please <a href='admin_login.php'>try again</a>.</p>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('img/3.jpg') no-repeat center center fixed;
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
        <h1>Admin Login</h1>
        <form method="post" action="admin_login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit">Login</button>
        </form>


    </div>
</body>

</html>