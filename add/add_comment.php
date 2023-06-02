<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskID = $_POST['task_id'];
    $commentText = $_POST['comment_text'];
    $userID = $_SESSION['user_id'];

    $sql = "INSERT INTO comments (task_id, user_id, comment_text) VALUES ($taskID, $userID, '$commentText')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: http://localhost/todo_vigo/index.php");
        exit;
    } else {
        echo "Error adding comment: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
    exit;
}
?>