<?php 
include_once "../db/db.php";
$conn = new Database;

session_start();
if (!isset($_SESSION["user"]) && !isset($_SESSION["email"])) {
    header("Location: ../login");
    exit();
} elseif (!isset($_SESSION["admin"])) {
  header("Locarion: ./index");
  exit();
}
$data = $conn->fetchPlayer($_SESSION["user"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LC:RP Dashboard Admin</title>
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
          <?php 
          $players = $conn->db->prepare("SELECT * FROM players");
          $players->execute();
          $vehicles = $conn->db->prepare("SELECT * FROM vehicle");
          $vehicles->execute();
          $doors = $conn->db->prepare("SELECT * FROM doors");
          $doors->execute();
          $family = $conn->db->prepare("SELECT * FROM familys");
          $family->execute();
          $bisnis = $conn->db->prepare("SELECT * FROM bisnis");
          $bisnis->execute();
          $houses = $conn->db->prepare("SELECT * FROM houses");
          $houses->execute();
          $gates = $conn->db->prepare("SELECT * FROM gates");
          $gates->execute();
          ?>
          <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-4">
              <table class="table table-def table-hover table-striped table-condensed table-bordered" style="height: 100%;">
                <thead>
                  <tr><th colspan="2"><h3><b>Property Statistics</b></h3></th></tr>
                </thead>
                <tbody>
                  <tr><td>Players</td><td><?= $players->rowCount(); ?></td></tr>
                  <tr><td>Vehicles</td><td><?= $vehicles->rowCount(); ?></td></tr>
                  <tr><td>Doors</td><td><?= $doors->rowCount(); ?></td></tr>
                  <tr><td>Businesses</td><td><?= $bisnis->rowCount(); ?></td></tr>
                  <tr><td>Houses</td><td><?= $houses->rowCount(); ?></td></tr>
                  <tr><td>Gates</td><td><?= $gates->rowCount(); ?></td></tr>
                  <tr><td>Families</td><td><?= $family->rowCount(); ?></td></tr>
                </tbody>
              </table>
            </div>
            <?php 
            $q = $conn->db->prepare("SELECT * FROM server");
            $q->execute();
            $d = $q->fetch(PDO::FETCH_ASSOC);
            setlocale(LC_MONETARY, 'en_US');
            ?>
            <br>
            <div class="col-sm-12 col-md-4 col-lg-4">
              <table class="table table-def table-hover table-striped table-condensed table-bordered" style="height: 100%;">
                <thead>
                  <tr><th colspan="2"><h3><b>Server Statistics</b></h3></th></tr>
                </thead>
                <tbody>
                  <tr><td>Server Money</td><td>$<?= number_format($d["servermoney"]); ?></td></tr>
                  <tr><td>Material Stock</td><td><?= $d["material"]; ?></td></tr>
                  <tr><td>Component Stock</td><td><?= $d["component"]; ?></td></tr>
                  <tr><td>Gasoil</td><td><?= $d["gasoil"]; ?></td></tr>
                  <tr><td>Product</td><td><?= $d["product"]; ?></td></tr>
                  <tr><td>Apotek</td><td><?= $d["apotek"]; ?></td></tr>
                  <tr><td>Food</td><td><?= $d["food"]; ?></td></tr>
                </tbody>
              </table>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
              <table class="table table-def table-hover table-striped table-condensed table-bordered" style="height: 100%;">
                <thead>
                  <tr>
                    <th>ID #</th>
                    <th>Sender</th>
                    <th>Package</th>
                    <th>Payment</th>
                    <th>Money Sent</th>
                    <th>Proof</th>
                    <th>Note</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $vouc = $conn->db->prepare("SELECT * FROM vouchers WHERE status = 0");
                    $vouc->execute();
                    if ($vouc->rowCount() > 0) :
                      while($v = $vouc->fetch(PDO::FETCH_ASSOC)) :
                  ?>
                  <tr><td><?= $v["id"]; ?></td><td><?= $v["sender"]; ?></td><td><?php if ($v["vip"] == 1) echo "Reguler"; elseif ($v["vip"] == 2) echo "Premium"; elseif ($v["vip"] == 3) echo "VIP Player"; elseif ($v["gold"] != 0) echo "Gold (".$v["gold"].")"; ?></td><td><?php if ($v["payment"] == 1) echo "Gopay (081291124836) A/N Lukman"; elseif ($v["payment"] == 2) echo "DANA (082163996965) A/N Leonardo"; elseif ($v["payment"] == 3) echo "Gopay (081382675074) A/N Leonardo"; ?></td><td>Rp <?= number_format($v["nominal"]); ?></td><td><?= $v["bukti"]; ?></td><td><?= $v["note"]; ?></td><td><button class="btn btn-success" type="button" id="btn-accept" data-id="<?= $v['id']; ?>">Accept</button><button class="btn btn-danger" id="btn-denied" data-id="<?= $v["id"]; ?>">Denied</button></td></tr>
                  <?php endwhile;
                  else : ?>
                  <tr><td colspan="8"><b style="color:red">Belum ada yang merequest giftcode!</b></td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
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
  <script src="../assets/js/admin/script.js"></script>
</body>
</html>