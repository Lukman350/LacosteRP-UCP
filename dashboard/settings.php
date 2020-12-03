<?php
include_once "../db/db.php";
$conn = new Database;

session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["email"])) {
  header("Location: ../login");
  exit();
}

$data = $conn->fetchPlayer($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP - Dashboard Settings</title>
  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/swal2/sweetalert2.min.css">
  <link rel="stylesheet" href="../assets/css/dashboard/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
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
  <?php include_once "../vendor/navbar.php"; ?>
      <div class="page-content">
        <div class="container">
          <div class="card mx-auto">
            <div class="container">
              <div class="card-header">
                <h3 class="card-title">LC:RP - Settings</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-changepass">Change Password</button>
                </div>
                <div class="form-group">
                  <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#modal-changeemail">Change Email</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Changepass -->
  <div class="modal fade" id="modal-changepass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LC:RP - Change Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="form-changepass">
          <div class="modal-body">
            <div class="form-group">
              <label for="oldpass">Old Password</label>
              <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="Old Password" required>
            </div>
            <div class="form-group">
              <label for="newpass">New Password</label>
              <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password" required>
            </div>
            <div class="form-group">
              <label for="cnewpass">Confirm New Password</label>
              <input type="password" name="cnewpass" id="cnewpass" class="form-control" placeholder="Confirm New Password" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-changepass">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Changeemail -->
  <div class="modal fade" id="modal-changeemail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LC:RP - Change Email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="form-changeemail">
          <div class="modal-body">
            <div class="form-group">
              <label for="oldemail">Old Email</label>
              <input type="email" name="oldemail" id="oldemail" class="form-control" placeholder="Old email" required>
            </div>
            <div class="form-group">
              <label for="newemail">New Email</label>
              <input type="email" name="newemail" id="newemail" class="form-control" placeholder="New email" required>
            </div>
            <div class="form-group">
              <label for="cnewemail">Confirm New Email</label>
              <input type="email" name="cnewemail" id="cnewemail" class="form-control" placeholder="Confirm New email" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btn-changeemail">Change</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/js/jquery/jquery.min.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/swal2/sweetalert2.min.js"></script>
  <script src="../assets/js/dashboard/script.js"></script>
  <script src="../assets/js/settings/script.js"></script>
</body>
</html>