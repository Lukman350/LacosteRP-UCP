<?php
include_once "../db/db.php";
$conn = new Database;

session_start();
$data = $conn->fetchPlayer($_SESSION["user"]);
if (!isset($_SESSION["user"]) && !isset($_SESSION["email"])) {
    header("Location: ../login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP - Dashboard Index</title>
  <link rel="stylesheet" href="../assets/css/bootstrap/bootstrap.min.css">
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
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <?php include_once "../vendor/query.php"; ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <h4><b>Character Information:</b></h4> <hr>
              <div class="scrollable-table">
              <table class="table table-def table-condensed table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th colspan="2"><b><?= $_SESSION["user"]; ?></b></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Gender</td>
                    <td><?= ($data["gender"] == 1 ? "Male" : "Female"); ?></td>
                  </tr>
                  <tr>
                    <td>Level</td>
                    <td><?= $data["level"]; ?></td>
                  </tr>
                  <tr>
                    <td>Money</td>
                    <td>$<?= number_format($data["money"]); ?></td>
                  </tr>
                  <tr>
                    <td>Bank Money</td>
                    <td>$<?= number_format($data["bmoney"]); ?></td>
                  </tr>
                  <tr>
                    <td>Gold</td>
                    <td><?= $data["gold"]; ?></td>
                  </tr>
                  <tr>
                    <td>Play Time</td>
                    <td><?= $data["hours"]; ?> hours, <?= $data["minutes"]; ?> minutes, <?= $data["seconds"]; ?> seconds</td>
                  </tr>
                  <tr>
                    <td>Warning</td>
                    <td><?= $data["warn"]; ?> / 20</td>
                  </tr>
                  <tr>
                    <td>Health</td>
                    <td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: <?= $data["health"]; ?>%;" aria-valuenow="<?= $data["health"]; ?>" aria-valuemin="0" aria-valuemax="100"><?= $data["health"]; ?></div></div></td>
                  </tr>
                  <tr>
                    <td>Armour</td>
                    <td><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: <?= $data["armour"]; ?>%;" aria-valuenow="<?= $data["armour"]; ?>" aria-valuemin="0" aria-valuemax="100"><?= $data["armour"]; ?></div></div></td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="../assets/js/jquery/jquery.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="../assets/js/swal2/sweetalert2.min.js"></script>
<script src="../assets/js/dashboard/script.js"></script>
</body>
</html>