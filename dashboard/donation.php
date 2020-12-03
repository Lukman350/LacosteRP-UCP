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
  <title>LC:RP - Dashboard Donation</title>
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
          <h4><b>Giftcode Request</b></h4>
          <table class="table table-def table-condensed table-striped table-bordered table-hover">
            <thead>
              <tr><th>ID</th><th>Package</th><th>Proof</th><th>Status</th></tr>
            </thead>
            <tbody>
              <?php 
              $email = $_SESSION["email"];
              $query = $conn->db->prepare("SELECT * FROM vouchers WHERE email = '$email'");
              $query->execute();
              if ($query->rowCount() > 0) :
                while($data = $query->fetch(PDO::FETCH_ASSOC)) :
              ?>
              <tr>
                <td><?= $data["id"]; ?></td>
                <td><?php if ($data["vip"] == 1) echo "Reguler"; elseif ($data["vip"] == 2) echo "Premium"; elseif ($data["vip"] == 3) echo "VIP Player"; elseif ($data["gold"] != 0) echo "Gold (".$data["gold"].")"; ?></td>
                <td><?= $data["bukti"]; ?></td>
                <td><?php if ($data["status"] == 0) echo "<span class='badge badge-warning'>Pending</span>"; elseif($data["status"] == 1 || $data["status"] == 3) echo "<span class'badge bg-success'>Accepted</span>"; elseif ($data["status"] == 2) echo "<span class='badge badge-danger'>Denied</span>"; ?></td>
              </tr>
              <?php endwhile;
              else : ?>
              <tr><td colspan="4"><b style="color:red">Kamu belum pernah merequest!</b></td></tr>
              <?php endif; ?>
            </tbody>
            <tfoot>
              <tr><td colspan="4"><button class="btn btn-success" id="btn-req" type="button" data-toggle="modal" data-target="#modal-req">Request</button></td></tr>
            </tfoot>
          </table>

          <h4><b>Giftcodes</b></h4>
          <table class="table table-def table-condensed table-striped table-hover table-bordered">
            <thead>
              <tr><th>ID #</th><th>Package</th><th>Duration</th><th>Giftcode</th><th>Status</th></tr>
            </thead>
            <tbody>
              <?php
              $mail = $_SESSION["email"];
              $sql = $conn->db->prepare("SELECT * FROM vouchers WHERE email = '$mail' AND status = 1");
              $sql->execute();
              if ($sql->rowCount() > 0) :
                while($gData = $sql->fetch(PDO::FETCH_ASSOC)) :
              ?>
              <tr>
                <td><?= $gData["id"]; ?></td>
                <td><?php if ($gData["vip"] == 1) echo "Reguler"; elseif ($gData["vip"] == 2) echo "Premium"; elseif ($gData["vip"] == 3) echo "VIP Player"; elseif ($gData["gold"] != 0) echo "Gold (".$gData["gold"].")"; ?></td>
                <td><?php if ($gData["duration"] != 0) echo $gData["duration"]." Days"; ?></td>
                <td><?= $gData["code"]; ?></td>
                <td><?php if ($gData["status"] == 1 && $gData["claim"] == 0) echo "<span class'badge bg-success'>Not claimed</span>"; elseif ($gData["claim"] == 1) echo "<span class='badge badge-warning'>Claimed by ". $gData["donature"] ."</span>"; ?></td>
              </tr>
              <?php endwhile;
              else : ?>
              <tr><td colspan="5"><b style="color: red">Kamu belum memiliki giftcode!</b></td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Modal Request -->
  <div class="modal fade" id="modal-req" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Request Giftcode</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" id="form-req">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nama Pengirim (Asli)</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Nama Pengirim (Nama Asli)" required>
            </div>
            <div class="form-group">
              <label for="type">Vip Type</label>
              <select name="type" id="type" class="custom-select">
                <option selected>Pilih ...</option>
                <option value="1">Regular (Rp 50.000 / bulan)</option>
                <option value="2">Premium (Rp 70.000 / bulan)</option>
                <option value="3">VIP Player (Rp 100.000 / bulan)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="gold">Gold</label>
              <select name="gold" id="gold" class="custom-select">
                <option selected>Pilih ...</option>
                <option value="250">250 Gold (Rp 15.000)</option>
                <option value="525">525 Gold (Rp 25.000)</option>
                <option value="1125">1125 Gold (Rp 50.000)</option>
                <option value="2250">2250 Gold (Rp 100.000)</option>
              </select>
            </div>
            <div class="form-group">
              <label for="time">Durasi</label>
              <select name="time" id="time" class="custom-select">
                <option selected>Pilih ...</option>
                <option value="30">1 Bulan</option>
                <option value="90">3 Bulan</option>
                <option value="180">6 Bulan</option>
              </select>
            </div>
            <label for="money">Jumlah Uang</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Rp</span>
              </div>
              <input type="number" class="form-control" name="money" id="money" placeholder="Jumlah uang yang dikirimkan" required>
            </div>
            <div class="form-group">
              <label for="payment">Payment</label>
              <select name="payment" id="payment" class="custom-select" required>
                <option value="1">Gopay (081291124836) A/N Lukman</option>
                <option value="2">DANA (082163996965) A/N Leonardo</option>
                <option value="3">Gopay (081382675074) A/N Leonardo</option>
              </select>
            </div>
            <div class="form-group">
              <label for="proof">Bukti Transfer</label>
              <input type="url" name="proof" id="proof" class="form-control" placeholder="http://example.com/example.jpg" required>
            </div>
            <div class="form-group">
              <label for="note">Catatan</label>
              <textarea name="note" id="note" class="form-control" placeholder="Kalo ga perlu gausah diisi ya..."></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  
  <script src="../assets/js/jquery/jquery.min.js"></script>
  <script src="../assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/swal2/sweetalert2.min.js"></script>
  <script src="../assets/js/dashboard/script.js"></script>
  <script src="../assets/js/donation/script.js"></script>
</body>
</html>