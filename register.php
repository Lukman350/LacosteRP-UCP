<?php
include_once "db/db.php";
$conn = new Database;
session_start();
if (isset($_SESSION["user"]))
    return header("Location: ./dashboard/index");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP - Registration</title>
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
  
  <?php
  $page = (isset($_GET["page"]) ? $_GET["page"] : '');
  $token = (isset($_GET["t"]) ? $_GET["t"] : '');
//   $mail = (isset($_GET["email"]) ? $_GET["email"] : '');

  // PAGE ACTIVATION
    $query = $conn->db->prepare("SELECT * FROM players WHERE token = '$token' AND aktif = '0'");
    $query->execute();
    if ($query->rowCount() > 0) {
        $sql = $conn->db->prepare("UPDATE players SET aktif = '1' WHERE token = '$token' AND aktif = '0'");
        if ($sql->execute()) {
            $success = '<div class="alert alert-success">Thank you for registering, now your account is active.</div>';
        }
    } else {
        $error = '<div class="alert alert-danger">Invalid token or your account already activated!</div>';
    }

  if ($page == "activation" && $token) :
  ?>
  <div class="container">
    <div class="card border-info mx-auto">
      <div class="container">
        <div class="card-header">
          <h3 class="card-title">LC:RP - Account Activation</h3>
        </div>
        <div class="card-body">
         <?php
         if (isset($success)) {
             echo $success;
         } else {
             echo $error;
         }
         ?>
        </div>
        <div class="card-footer">
          <a href="./login" class="btn btn-primary">Login</a>
        </div>
      </div>
    </div>
  </div>
  <?php else : ?>
  <div class="container">
    <div class="card border-info mx-auto">
      <div class="container">
        <div class="card-header"><h3 class="card-title">LC:RP - Registration</h3></div>
        <div class="card-body">
          <form method="post" id="form-register">
            <div class="form-group">
              <label for="fname">Firstname</label>
              <input type="text" name="fname" id="fname" class="form-control" placeholder="Firstname" required>
            </div>
            <div class="form-group">
              <label for="lname">Lastname</label>
              <input type="text" name="lname" id="lname" class="form-control" placeholder="Lastname" required>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Valid Email Address" required>
            </div>
            <div class="form-group">
              <label for="gender">Gender</label>
              <select name="gender" id="gender" class="form-control" required>
                <option value="1">Male</option>
                <option value="2">Female</option>
              </select>
            </div>
            <div class="form-group">
              <label for="age">Birthdate</label>
              <input type="date" name="age" id="age" class="form-control" placeholder="dd/mm/yyyy" required>
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
              <label for="pass2">Confirm Password</label>
              <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-success" id="submit">Register</button>
            <a href="login" class="btn btn-primary">Login</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/swal2/sweetalert2.min.js"></script>
  <script src="assets/js/register/script.js"></script>
</body>
</html>