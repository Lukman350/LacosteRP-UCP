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
  <div class="box">
    <div class="container">
      <div class="box-header">
        <div class="logo"></div>
        <h3 class="box-title">LC:RP - Login</h3>
      </div>
      <form action="post" id="form-login">
        <div class="box-body">
          <div class="form-group">
            <label for="username">Username or Email Address</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Nick InGame atau Email" required>
          </div>
          <div class="form-group">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
          </div>
        </div>
        <div class="box-footer">
          <div class="button-group">
            <button type="submit" class="btn btn-success" id="submit">Login</button>
            <a href="./register" class="btn btn-primary">Register</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/swal2/sweetalert2.min.js"></script>
  <script src="assets/js/login/script.js"></script>
</body>
</body>
</html>