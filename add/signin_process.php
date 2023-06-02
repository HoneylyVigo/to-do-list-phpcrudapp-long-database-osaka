<?php
    session_start();

    require 'C:\xampp\htdocs\todo_vigo\config\db.php';
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id']; 
    
        header("Location: http://localhost/todo_vigo/index.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }

    $conn->close();
?>
