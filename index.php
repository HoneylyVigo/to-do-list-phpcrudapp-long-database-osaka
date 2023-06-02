<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Home</title>
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

    <div class="container-task">
        <h2>Task List</h2>

        <?php
        require 'C:\xampp\htdocs\todo_vigo\config\db.php';
        session_start();

        $userID = $_SESSION['user_id'];
        $sql = "SELECT * FROM Tasks WHERE user_id = $userID";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='task'>";
                echo "<h4>" . $row['title'] . "</h4>";
                echo "<p class=com>" . $row['description'] . "</p>";
                echo "<p class=com>Status: " . $row['status'] . "</p>";

                $taskID = $row['task_id'];
                $commentsQuery = "SELECT * FROM comments WHERE task_id = $taskID";
                $commentsResult = mysqli_query($conn, $commentsQuery);

                if ($commentsResult && mysqli_num_rows($commentsResult) > 0) {
                    echo "<h5>Comments:</h5>";
                    while ($commentRow = mysqli_fetch_assoc($commentsResult)) {
                        echo "<p>" . $commentRow['comment_text'] . "</p>";
                    }
                } else {
                    echo "<p>No comments yet.</p>";
                }

                echo "<form method='POST' action='add/add_comment.php'>";
                echo "<input type='hidden' name='task_id' value='" . $row['task_id'] . "'>";
                echo "<textarea class='form-control' name='comment_text' placeholder='Add a comment' required></textarea>";
                echo "<button type='submit' class='btn'>Add Comment</button>";
                echo "</form>";

                echo "<a href='add/edit.php?id=" . $row['task_id'] . "' class='btn'>Edit</a>";
                echo "<a href='add/delete.php?id=" . $row['task_id'] . "' class='btn'>Delete</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No tasks found.</p>";
        }
        ?>
    </div>
</body>

</html>