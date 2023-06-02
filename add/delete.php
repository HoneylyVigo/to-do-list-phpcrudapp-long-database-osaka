<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';

if (!empty($_GET['id'])) {
    $taskID = $_GET['id'];

    $sql = "DELETE FROM Tasks WHERE task_id = $taskID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: http://localhost/todo_vigo/index.php");
        exit;
    } else {
        echo "Error deleting task: " . mysqli_error($conn);
    }
} else {
    echo "Invalid task ID.";
}
?>