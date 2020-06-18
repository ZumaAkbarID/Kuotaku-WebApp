<?php 
  if(isset($_POST['cari'])) {
    $key = $_POST['key'];
    $MasukKey = mysqli_query($koneksi, "INSERT INTO search_enggine(nama, keyword, kategori) VALUES('$nama','$key','histori')");
  }
?>
<div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto" method="POST" action="">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" name="key" autocomplete="off">
            <button class="btn" type="submit" name="cari"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <div class="search-result">
              <div class="search-header">
                Histori
              </div>

              <?php 

                $histori = mysqli_query($koneksi, "SELECT * FROM search_enggine WHERE nama='$nama' AND kategori='histori' ORDER BY id DESC");

                foreach($histori as $hst) :

              ?>

                <div class="search-item">
                  <a href="404.html"><?= @$hst['keyword']; ?></a>
                  <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                </div>

                <?php endforeach; ?>

              <div class="search-header">
                Zuma Akbar
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Kuotaku
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Responsive & Clean Design
                </a>
              </div>
              <div class="search-item">
                <a href="https://github.com/ZumaAkbarID">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fab fa-github"></i>
                  </div>
                  ZumaAkbar On Github
                </a>
              </div>
            </div>
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Pesan
                <div class="float-right">
                  <a href="send-chat.php">Kirim Pesan</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">

                  <?php 

                  $pesan = mysqli_query($koneksi, "SELECT * FROM pesan WHERE nama='$nama' OR nama='All' AND baca='0' ORDER BY id DESC");

                  foreach($pesan as $psn) :

                  ?>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-avatar">
                    <img alt="image" src="assets/img/avatar/avatar-<?= rand(1,5); ?>.png" class="rounded-circle">
                    <div class="is-online"></div>
                  </div>
                  <div class="dropdown-item-desc">
                    <b><?= $psn['dari']; ?></b>
                    <p><?= $psn['chat']; ?></p>
                    <div class="time"> Pada 
                      <?= 
                        $psn['dattim'];
                      ?>
                    </div>
                  </div>
                </a>

                  <?php endforeach; ?>

              </div>
              <div class="dropdown-footer text-center">
                <p class="text-small" href="">ZumaAkbar <i class="fas fa-chevron-right"></i></p>
              </div>
            </div>
          </li>
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hai, <?= $nama; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Kuotaku</div>
              <a href="" class="dropdown-item has-icon" data-toggle="modal" data-target="#modalAktifitas">
                <i class="fas fa-bolt"></i> Activities
              </a>
              <div class="dropdown-divider"></div>
              <a href="" data-toggle="modal" data-target="#modalLogout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.php">Kuotaku</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.php">Kk</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link active" href="index.php">Dashboard</a></li>
                  <li><a class="nav-link disabled" href="">Simple Dashboard (Soon)</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-map-marker-alt"></i> <span>Google Maps</span></a>
                <ul class="dropdown-menu">
                  <li><a href="google-maps.php">Kuotaku On Maps</a></li>
                </ul>
              </li>
              <li><a class="nav-link" href="credits.php"><i class="fas fa-pencil-ruler"></i> <span>Credits</span></a></li>
              <li><a class="nav-link" href="https://docs.google.com/uc?export=download&id=1xLMJm0TQkcVcWIqB3x7vDlngH3fztv6p"><i class="fas fa-download"></i> <span>Download Aplikasi</span></a></li>
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://github.com/ZumaAkbarID" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fab fa-github"></i> ZumaAkbar
              </a>
            </div>
        </aside>
      </div>