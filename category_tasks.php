<?php
$categoryID = $_GET['category_id'];

require 'C:\xampp\htdocs\todo_vigo\config\db.php';

$sql = "SELECT t.*, u.username 
        FROM tasks t
        INNER JOIN task_category tc ON t.task_id = tc.task_id
        INNER JOIN users u ON t.user_id = u.user_id
        WHERE tc.category_id = " . $categoryID;

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='task'>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>Status: " . $row['status'] . "</p>";
        echo "<p>Created by: " . $row['username'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No tasks found for this category.</p>";
}
?>