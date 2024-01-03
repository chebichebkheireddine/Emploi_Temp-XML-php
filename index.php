<?php 
include("Include/Hader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Hello Page</title>
  <!-- Bootstrap CSS CDN link -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Your custom styles -->
  <style>
    /* Set the body and HTML to occupy full height */
    html,
    body {
      height: 100%;
      margin: 0;
    }
    /* Set the image to cover the entire screen */
    .fullscreen-bg {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      overflow: hidden;
      z-index: -1;
    }
    .fullscreen-bg img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    /* Center content in the middle of the screen */
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>
<body>
  <!-- Bootstrap image component -->
  <div class="fullscreen-bg">
    <img src="img/home_work.jpg" class="img-fluid" alt="Home Work">
  </div>

  <!-- Bootstrap JS and Popper.js CDN links (required for some Bootstrap components) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
