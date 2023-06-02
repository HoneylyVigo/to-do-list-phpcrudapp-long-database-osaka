<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';

if (!empty($_GET['id'])) {
    $taskID = $_GET['id'];

    $sql = "SELECT * FROM Tasks WHERE task_id = $taskID";
    $result = mysqli_query($conn, $sql);
    $task = mysqli_fetch_assoc($result);

    if ($task) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $status = $_POST['status'];

            $sql = "UPDATE Tasks SET title = '$title', description = '$description', status = '$status' WHERE task_id = $taskID";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: http://localhost/todo_vigo/index.php");
                exit;
            } else {
                echo "Error updating task: " . mysqli_error($conn);
            }
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="css/edit.css?v=2">
            <title>Edit Task</title>
        </head>

        <body>
            <div class="container">
                <h2>Edit Task</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo $task['title']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description"
                            required><?php echo $task['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending" <?php if ($task['status'] == 'Pending')
                                echo 'selected'; ?>>Pending</option>
                            <option value="In Progress" <?php if ($task['status'] == 'In Progress')
                                echo 'selected'; ?>>In
                                Progress</option>
                            <option value="Completed" <?php if ($task['status'] == 'Completed')
                                echo 'selected'; ?>>Completed
                            </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Update Task</button>
                </form>
            </div>
        </body>

        <?php
    } else {
        echo "Task not found.";
    }
} else {
    echo "Invalid task ID.";
}
?>

</html>