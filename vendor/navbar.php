
  <div class="page">
    <div class="page-header">
      <div class="page-brand">LC:RP - UCP</div>
      <button id="nav-toggler" class="btn btn-outline-dark btn-lg nav-btn"><i class="fas fa-bars"></i></button>
    </div>
    <div class="page-body">
      <div class="page-nav" id="navigation">
        <div class="user-profile">
          <div class="profile">
            <p><?= $data["username"]; ?></p>
            <img src="../bigskins/<?= $data["skin"]; ?>.png" alt="<?= $data["username"]; ?>">
          </div>
        </div>
        <?php if ($data["admin"] >= 5) : ?>
        <a class="nav-items" href="./index">
          <div class="nav-icons"><i class="fas fa-home"></i></div>
          <div class="nav-name">Home</div>
        </a>
        <a class="nav-items" href="./donation">
          <div class="nav-icons"><i class="fas fa-dollar-sign"></i></div>
          <div class="nav-name">Donation</div>
        </a>
        <a class="nav-items" href="./settings">
          <div class="nav-icons"><i class="fas fa-tools"></i></div>
          <div class="nav-name">Settings</div>
        </a>
        <a href="./admin" class="nav-items">
          <div class="nav-icons"><i class="fas fa-user"></i></div>
          <div class="nav-name">Admin</div>
        </a>
        <a class="nav-items" href="./logout">
          <div class="nav-icons"><i class="fas fa-sign-out-alt"></i></div>
          <div class="nav-name">Logout</div>
        </a>
        <?php else : ?>
        <a class="nav-items" href="./index">
          <div class="nav-icons"><i class="fas fa-home"></i></div>
          <div class="nav-name">Home</div>
        </a>
        <a class="nav-items" href="./donation">
          <div class="nav-icons"><i class="fas fa-dollar-sign"></i></div>
          <div class="nav-name">Donation</div>
        </a>
        <a class="nav-items" href="./settings">
          <div class="nav-icons"><i class="fas fa-tools"></i></div>
          <div class="nav-name">Settings</div>
        </a>
        <a class="nav-items" href="./logout">
          <div class="nav-icons"><i class="fas fa-sign-out-alt"></i></div>
          <div class="nav-name">Logout</div>
        </a>
        <?php endif; ?>
        <div class="page-copyright">
          Copyright &copy; Lacoste Roleplay 2020.<br>Developed by <a href="https://instagram.com/lukmaan.24" target="_blank">Lukman</a> &bull; <a href="https://forum.lacosteroleplay.com/forum/47-bug-report/?do=add" target="_blank">Report Bug</a>.
        </div>
      </div>