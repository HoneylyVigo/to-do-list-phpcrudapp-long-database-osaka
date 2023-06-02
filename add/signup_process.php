<?php
session_start();

require 'C:\xampp\htdocs\todo_vigo\config\db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['logged_in'] = true;

    header("Location: http://localhost/todo_vigo/personal_info.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

$conn->close();
?>
