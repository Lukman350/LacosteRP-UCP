<?php 
session_start();
if (isset($_SESSION["user"])) {
    header("Location: ./dashboard/index");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP - Forgot Page</title>
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
$code = (isset($_GET["c"]) ? $_GET["c"] : '');
if ($page == "pass" && $code) :
?>
  <div class="container">
    <div class="card border-info mx-auto">
      <div class="container">
        <div class="card-header">
          <h3 class="card-title">LC:RP - Reset Password</h3>
        </div>
        <div class="card-body">
          <form method="post" id="reset-password">
            <div class="form-group">
              <label for="newpass">New Password</label>
              <input type="password" name="newpass" id="newpass" class="form-control" placeholder="New Password" required>
            </div>
            <div class="form-group">
              <label for="pwconfirm">Confirm New Password</label>
              <input type="password" name="pwconfirm" id="pwconfirm" class="form-control" placeholder="Confirm new Password" required>
            </div>
            <input type="hidden" name="code" value="<?= $code; ?>">
            <div class="form-group">
              <button type="submit" class="btn btn-success" id="reset-pass">Reset</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php else : ?>
  <div class="container">
    <div class="card border-info mx-auto">
      <div class="container">
        <div class="card-header">
          <h3 class="card-title">LC:RP - Forgot Page</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <button class="btn btn-success btn-lg" type="button" id="btn-pass" data-toggle="modal" data-target="#modal-pass">Lupa Password</button>
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-lg" type="button" id="btn-username" data-toggle="modal" data-target="#modal-username">Lupa Username</button>
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-lg" type="button" id="btn-email" data-toggle="modal" data-target="#modal-email">Lupa Email</button>
          </div>
        </div>
        <div class="card-footer">
          <a href="./login" class="btn btn-primary">Login</a>
          <a href="./register" class="btn btn-secondary">Register</a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Password -->
  <div class="modal fade" id="modal-pass" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LC:RP - Forgot Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="form-forgotpass">
          <div class="modal-body">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnpass">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <!-- Modal Username -->
  <div class="modal fade" id="modal-username" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LC:RP - Forgot Username</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="form-forgotuser">
          <div class="modal-body">
            <div class="form-group">
              <label for="mail">Email</label>
              <input type="email" name="mail" id="mail" class="form-control" placeholder="Email Address" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="btnuser">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Email -->
  <div class="modal fade" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">LC:RP - Forgot Email</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <p>
            Jika Anda lupa email akun Anda lakukan hal dibawah ini:<br>
            <li style="list-style: none;margin-left: 10px;">Jika Anda masih bisa login ke Ingame silahkan gunakan command '/stats' untuk melihat email akun Anda.</li>
            <li style="list-style: none;margin-left: 10px;">Jika Anda sudah tidak bisa Ingame, silahkan kontak salah satu Admin kami. Bisa melalui Discord atau Forum.</li>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php endif; ?>

  <script src="assets/js/jquery/jquery.min.js"></script>
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="assets/js/swal2/sweetalert2.min.js"></script>
  <script src="assets/js/forgot/script.js"></script>
</body>
</html>
