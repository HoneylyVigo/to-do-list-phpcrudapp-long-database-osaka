<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    $userID = $_SESSION['user_id'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $categories = $_POST['categories'];

    $sql = "INSERT INTO Tasks (title, description, status, user_id) VALUES ('$title', '$description', '$status', $userID)";
    $result = mysqli_query($conn, $sql);

    $taskID = mysqli_insert_id($conn);

    foreach ($categories as $categoryID) {
        $sql = "INSERT INTO Task_Category (task_id, category_id) VALUES ($taskID, $categoryID)";
        $result = mysqli_query($conn, $sql);
    }

    if ($result) {
        header("Location: http://localhost/todo_vigo/index.php");
        exit;
    } else {
        echo "Error adding task: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/add.css?v=1">
    <title>Add Tasks</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#"> Todo List App</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="add.php"><i class="fas fa-plus"></i> Add Tasks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="categories.php"><i class="fas fa-tags"></i> Categories</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar-nav">
                    <a class="nav-link" href="profile.php"><i class="fas fa-user"></i> Profile</a>
                    <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <body>
        <div class="container-task">
            <h2>Add Task</h2>
            <form method="POST" action="">


                <?php
                session_start();
                if (!isset($_SESSION['user_id'])) {
                    echo "<p>You should login first.</p>";
                } else {
                    ?>
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categories">Categories:</label>
                        <select class="form-control" id="categories" name="categories[]" multiple required>
                            <?php
                            $categories = mysqli_query($conn, "SELECT category_id, name FROM categories");
                            while ($row = mysqli_fetch_assoc($categories)) {
                                echo "<option value='" . $row['category_id'] . "'>" . $row['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                    <?php
                }
                ?>
            </form>
        </div>
    </body>

</html>