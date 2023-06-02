<?php
include 'C:\xampp\htdocs\todo_vigo\config\db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $quotes = $_POST['quotes'];
    $social_media_links = $_POST['social_media_links'];

    session_start();
    $user_id = $_SESSION["user_id"];

    $profile_picture = $_FILES['profile_picture']['name'];
    $target_dir = "C:/xampp/htdocs/todo_vigo/image/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

    $query = "INSERT INTO personal_information (first_name, last_name, address, phone_number, date_of_birth, profile_picture, quotes, social_media_links, user_id)
              VALUES ('$first_name', '$last_name', '$address', '$phone_number', '$date_of_birth', '$profile_picture', ' $quotes', '$social_media_links', '$user_id')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location:  http://localhost/todo_vigo/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>