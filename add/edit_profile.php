<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';
session_start();

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM personal_information WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$personal_info = mysqli_fetch_assoc($result);

if (!$personal_info) {
    header("Location: http://localhost/todo_vigo/profile.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form inputs
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $date_of_birth = $_POST['date_of_birth'];
    $social_media_links = $_POST['social_media_links'];
    $quotes = $_POST['quotes'];

    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = $_FILES['profile_picture']['name'];
        $target_dir = "C:/xampp/htdocs/todo_vigo/image/";
        $target_file = $target_dir . basename($_FILES['profile_picture']['name']);

        $existing_profile_picture = $personal_info['profile_picture'];
        $existing_file = $target_dir . $existing_profile_picture;
        if (file_exists($existing_file)) {
            unlink($existing_file);
        }

        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file);

        $sql = "UPDATE personal_information SET profile_picture = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $profile_picture, $user_id);
        mysqli_stmt_execute($stmt);
    }

    $sql = "UPDATE personal_information SET first_name = ?, last_name = ?, address = ?, phone_number = ?, date_of_birth = ?, social_media_links = ?, quotes = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssssi', $first_name, $last_name, $address, $phone_number, $date_of_birth, $social_media_links, $quotes, $user_id);
    mysqli_stmt_execute($stmt);

    header("Location: http://localhost/todo_vigo/profile.php");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/edit_profile.css?v=2">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Personal Information</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name"
                        value="<?php echo $personal_info['first_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name"
                        value="<?php echo $personal_info['last_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="<?php echo $personal_info['address']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="<?php echo $personal_info['phone_number']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                        value="<?php echo $personal_info['date_of_birth']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture URL</label>
                    <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="quotes" class="form-label">Quotes</label>
                    <input type="text" class="form-control" id="quotes" name="quotes"
                        value="<?php echo $personal_info['quotes']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="social_media_links" class="form-label">Social Media Links</label>
                    <textarea class="form-control" id="social_media_links" name="social_media_links"
                        rows="3"><?php echo $personal_info['social_media_links']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Confirm</button>
                <a href="profile.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </div>
</body>

</html>