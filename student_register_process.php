<?php
// student_register_process.php: Process Student Registration
require 'db.php';

$name = $_POST['name'];
$student_id = $_POST['student_id'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO students (name, student_id, phone, address, password) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $student_id, $phone, $address, $password);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="scss.css"> <!-- Assuming scss.css is already linked -->
    <style>
        /* Custom styles for this page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 400px;
        }
        h1 {
            color: #4CAF50;
        }
        .message {
            margin: 20px 0;
            color: #333;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registration Successful!</h1>
        <div class="message">
            <p>Thank you for registering! Your account has been created successfully.</p>
            <p><a href="student_login.php" class="btn">Login here</a></p>
        </div>
    </div>
</body>
</html>
