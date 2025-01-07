<?php
// student_register.php: Student Registration
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Student Registration</h1>
        <form method="post" action="student_register_process.php">
            <input type="text" id="name" name="name" placeholder="Full Name" required><br>
            <input type="text" id="student_id" name="student_id" placeholder="Student ID" required><br>
            <input type="text" id="phone" name="phone" placeholder="Phone Number" required><br>
            <input type="text" id="address" name="address" placeholder="Address" required><br>
            <input type="password" id="password" name="password" placeholder="Password" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

