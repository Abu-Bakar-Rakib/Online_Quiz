<?php
// admin_dashboard.php: Admin Dashboard to manage questions
session_start();
require 'db.php';

// Ensure the admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: url('img/2.jpg') no-repeat center center fixed;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome, Admin</h1>

        <!-- Button to view student scores -->
        </div>

        <!-- Form to Add New Question -->
        <h2>Add New Question</h2>
        <form method="post" action="add_questions.php">
            <textarea name="question" placeholder="Enter Question" required></textarea><br>
            <input type="text" name="option1" placeholder="Option 1" required><br>
            <input type="text" name="option2" placeholder="Option 2" required><br>
            <input type="text" name="option3" placeholder="Option 3" required><br>
            <input type="text" name="option4" placeholder="Option 4" required><br>
            <select name="correct_option" required>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select><br>
            <button type="submit">Add Question</button>
        </form>

        <!-- Navigation Links -->
        <div class="nav-links">
            <a href="logout.php"><button>Logout</button></a>
        </div>

        <!-- Display Existing Questions -->
        <h2>Existing Questions</h2>
        <table>
            <tr>
                <th>Question</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th>Correct Option</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['question'] ?></td>
                                        <td><?= $row['option1'] ?></td>
                                        <td><?= $row['option2'] ?></td>
                                        <td><?= $row['option3'] ?></td>
                                        <td><?= $row['option4'] ?></td>
                                        <td><?= $row['correct_option'] ?></td>
                                        <td>
                                            <!-- Update and Delete buttons -->
                                            <a href="edit_question.php?id=<?= $row['id'] ?>"><button>Update</button></a>
                                            <a href="delete_question.php?id=<?= $row['id'] ?>"><button>Delete</button></a>
                                        </td>
                                    </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>

</html>

<?php
// Free the result set to avoid issues with further queries
$result->free_result();
?>