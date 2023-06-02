<?php
require 'C:\xampp\htdocs\todo_vigo\config\db.php';
session_start();

$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM personal_information WHERE user_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$personal_info = mysqli_fetch_assoc($result);

$first_name = $personal_info['first_name'];
$last_name = $personal_info['last_name'];
$quotes = $personal_info['quotes'];
$address = $personal_info['address'];
$phone_number = $personal_info['phone_number'];
$date_of_birth = $personal_info['date_of_birth'];
$profile_picture = $personal_info['profile_picture'];
$social_media_links = $personal_info['social_media_links'];

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/profile.css">
  <title>Profile</title>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fas fa-list"></i> Todo List App</a>
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

  <section class="h-100" style="background-color: #e1ecf4;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-9 col-xl-7">
          <div class="card">
            <div class="rounded-top text-white d-flex flex-row" style="background-color: #f9e8ea; height:200px;">
              <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                <img src="http://localhost/todo_vigo/image/<?php echo $profile_picture; ?>" alt="Profile Picture"
                  class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                  <a href="add/edit_profile.php?id =<?php echo $personal_info['user_id'];?>" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
              style="z-index: 1;">
              Edit profile</a>>
              </div>
              <div class="ms-3" style="margin-top: 130px;">
                <h5 style="color: black;">
                  <?php echo $first_name . ' ' . $last_name; ?>
                </h5>
                <p class="quotes">"
                  <?php echo $quotes; ?>"
                </p>
              </div>
            </div>
            <div class="card-body p-4 text-black" style="background-color: #ece6f7">
              <div class="mb-5" style="background-color: #f9e8ea;">
                <p class="lead fw-normal mb-1">About</p>
                <div class="p-4" style="background-color:  #f9e8ea;">
                  <p class="font-italic mb-1">
                    <?php echo $address; ?>
                  </p>
                  <p class="font-italic mb-1">
                    <?php echo $phone_number; ?>
                  </p>
                  <p class="font-italic mb-0">
                    <?php echo $date_of_birth; ?>
                  </p>
                  <?php
                  $social_media_links_array = explode(',', $social_media_links);
                  foreach ($social_media_links_array as $link) {
                    echo '<a href="' . $link . '">' . $link . '</a><br>';
                  }
                  ?>
                </div>
              </div>
            </div>
            <div style="background-color: #ece6f7">
              <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="lead fw-normal mb-0" style="margin-left: 20px;">Recent photos</p>
              </div>
              <div class="row g-2">
                <div class="col mb-2">
                  <img src="bg_image.jpg" alt="image 1" class="w-100 rounded-3">
                </div>
                <div class="col mb-2">
                  <img src="bg_image.jpg" alt="image 1" class="w-100 rounded-3">
                </div>
              </div>
              <div class="row g-2">
                <div class="col">
                  <img src="bg_image1.jpg" alt="image 1" class="w-100 rounded-3">
                </div>
                <div class="col">
                  <img src="bg_image1.jpg" alt="image 1" class="w-100 rounded-3">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</body>
</html>