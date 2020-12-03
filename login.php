<?php
session_start();
if (isset($_POST["user"]))
    return header("Location: ./dashboard/index");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP - Login</title>
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/swal2/sweetalert2.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-V4K593FW9L"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-V4K593FW9L');
  </script>
</head>
<body>
  <div class="container">
    <div class="card border-info mx-auto">
      <div class="container">
        <div class="card-header">
          <h3 class="card-title">LC:RP - Login</h3>
        </div>
        <div class="card-body">
          <form method="post" id="form-login">
            <div class="form-group">
              <label for="username">Username or Email Address</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Nick Ingame atau Email" required>
              <a href="./forgot">Lupa username?</a>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
              <a href="./forgot">Lupa password?</a>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">Login</button>
              <a href="./register" class="btn btn-primary">Register</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/swal2/sweetalert2.min.js"></script>
  <script src="assets/js/login/script.js"></script>
</body>
</body>
</html>