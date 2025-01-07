<?php
// edit_question.php: Edit a question
session_start();
require 'db.php';

// Ensure the admin is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch the current question details if 'id' is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $question = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update question details
    $question_text = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correct_option = $_POST['correct_option'];

    $stmt = $conn->prepare("UPDATE questions SET question = ?, option1 = ?, option2 = ?, option3 = ?, option4 = ?, correct_option = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $question_text, $option1, $option2, $option3, $option4, $correct_option, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Question</title>
</head>
<body>
    <h1>Edit Question</h1>
    <form method="post" action="edit_question.php?id=<?= $question['id'] ?>">
        <textarea name="question" required><?= $question['question'] ?></textarea><br>
        <input type="text" name="option1" value="<?= $question['option1'] ?>" required><br>
        <input type="text" name="option2" value="<?= $question['option2'] ?>" required><br>
        <input type="text" name="option3" value="<?= $question['option3'] ?>" required><br>
        <input type="text" name="option4" value="<?= $question['option4'] ?>" required><br>
        <select name="correct_option" required>
            <option value="option1" <?= $question['correct_option'] == 'option1' ? 'selected' : '' ?>>Option 1</option>
            <option value="option2" <?= $question['correct_option'] == 'option2' ? 'selected' : '' ?>>Option 2</option>
            <option value="option3" <?= $question['correct_option'] == 'option3' ? 'selected' : '' ?>>Option 3</option>
            <option value="option4" <?= $question['correct_option'] == 'option4' ? 'selected' : '' ?>>Option 4</option>
        </select><br>
        <button type="submit">Update Question</button>
    </form>
</body>
</html>
