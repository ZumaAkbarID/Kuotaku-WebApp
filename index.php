<?php 
session_start();

  if(empty($_SESSION['nama'])){
    echo '<script>window.location.href = "auth/login.php";</script>';
  }

  include 'db/database.php';

  $nama = @$_SESSION['nama'];
  $size = @$_POST['size'];
  $harga = @$_POST['harga'];
  $tanggal = date("Y-m-d");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard &mdash; Kuotaku</title>

  <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css"> -->
  <!-- <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css"> -->
  <!-- <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css"> -->
  <!-- <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css"> -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <script src="assets/js/Chart.js"></script>
</head>

<body>

  <?php include 'include/navbar-side.php'; ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-title">
                    Statistik
                  </div>
                  <div class="card-stats-items">
                    <div class="card-stats-item">
                      <div class="card-stats-item-count">
                        <?php
                          $cekUser = mysqli_query($koneksi, "SELECT * FROM users");
                          echo mysqli_num_rows($cekUser);
                        ?>
                      </div>
                      <div class="card-stats-item-label">Total User</div>
                    </div>
                    <div class="card-stats-item">
                      <div class="card-stats-item-count" data-toggle="tooltip" title="catatan kamu">
                        <?php 
                          $cekMyCat = mysqli_query($koneksi, "SELECT * FROM data_catatan WHERE nama='$nama'");
                          $totCAT = mysqli_num_rows($cekMyCat);
                          echo $totCAT;
                          mysqli_query($koneksi, "UPDATE users SET totCat='$totCAT' WHERE nama='$nama'");
                        ?>
                      </div>
                      <div class="card-stats-item-label" data-toggle="tooltip" title="catatan kamu">Catatan Kamu</div>
                    </div>
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Catatan Keseluruhan</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      $cekAllCat = mysqli_query($koneksi, "SELECT * FROM data_catatan");
                      echo mysqli_num_rows($cekAllCat);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="balance-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4 data-toggle="tooltip" title="Dihitung Total Keseluruhan">Pengeluaran Keluarga Sebulan</h4>
                  </div>
                  <div data-toggle="tooltip" title="Dihitung Total Keseluruhan" class="card-body">
                    <?php 
                      $hitungUangKeluar = mysqli_query($koneksi, "SELECT harga FROM data_catatan");
                      foreach($hitungUangKeluar as $UK)
                        {
                          $ukel[] = $UK['harga'];
                        }
                        echo "Rp.".array_sum($ukel);
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-chart">
                  <canvas id="sales-chart" height="80"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="far fa-money-bill-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4 data-toggle="tooltip" title="Dihitung mulai tanggal 1">Pengeluaran Anda Sebulan</h4>
                  </div>
                  <div data-toggle="tooltip" title="Dihitung mulai tanggal 1" class="card-body">
                    <?php 
                      $hitungUangKeluarMy = mysqli_query($koneksi, "SELECT harga FROM data_catatan WHERE nama='$nama'");
                      foreach($hitungUangKeluarMy as $UKM)
                        {
                          $ukelMy[] = $UKM['harga'];
                        }
                        $Boros = @array_sum($ukelMy);
                        echo "Rp.".$Boros;
                        mysqli_query($koneksi, "UPDATE users SET pengeluaran='$Boros' WHERE nama='$nama'");
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4 mb-2">
              <button style="width: 100%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalSaveData">Catat Pembelian</button>
            </div>
            <div class="col-4 mb-2">
              <button style="width: 100%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAktifitas">Aktivitas Anda</button>
            </div>
            <div class="col-4 mb-2">
              <button style="width: 100%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAktifitas">Aktivitas Anda</button>
            </div>
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4>Statistik Semua Pengguna</h4>
                </div>
                <div class="card-body">
                  <canvas id="Statistik" height="158"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4>Top 5 Pengguna</h4>
                </div>
                  <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                      <tr class="text-center">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Pengeluaran</th>
                        <th>Catatan</th>
                      </tr>
                      <?php 
                        $numb = 1;
                        $cekUSS = mysqli_query($koneksi, "SELECT * FROM users ORDER BY pengeluaran DESC");
                        while($u = mysqli_fetch_array($cekUSS))
                          { ?>
                            <tr>
                              <td class="text-center"><?= $numb ?></td>
                              <td class="text-center"><?= $u['nama']; ?></td>
                              <td>Rp.<?= $u['pengeluaran']; ?></td>
                              <td class="text-center"><?= $u['totCat']; ?></td>
                            </tr>
                        <?php $numb++; ?>
                      <?php } ?>
                    </table>
                  </div>
                <div class="card-footer pt-3 d-flex justify-content-center">
                  <div class="budget-price justify-content-center">
                    <div class="budget-price-square bg-primary" data-width="20"></div>
                    <div class="budget-price-label">Dihitung Berdasarkan Pengeluaran</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include 'include/footer.php'; ?>
      
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <!-- <script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script> -->
  <!-- <script src="../node_modules/chart.js/dist/Chart.min.js"></script> -->
  <!-- <script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script> -->
  <!-- <script src="../node_modules/summernote/dist/summernote-bs4.js"></script> -->
  <!-- <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>

  <!-- Zuma JS -->
  <!-- Modal -->
  <div class="modal fade" id="modalSaveData" tabindex="-1" role="dialog" aria-labelledby="Titlemodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Titlemodal">Catat pengeluaranmu untuk kuota.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card">
          <form class="needs-validation" method="POST" action="" novalidate="">
            <div class="card-header">
              <h4>CATAT</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" class="form-control" value="<?= $nama; ?>">
              </div>
              <div class="form-group">
                <label>Berapa GB?</label>
                <input type="number" class="form-control" required name="size">
                <div class="invalid-feedback">
                  Aku tanya, berapa GB?
                </div>
              </div>
              <div class="form-group mb-0">
                <label>Berapa Harganya</label>
                <input type="number" class="form-control" required="" data-toggle="tooltip" title="Masukkan tanpa titik ataupun koma" name="harga">
                <div class="invalid-feedback">
                  Beritahu aku agar aku dapat menyimpannya.
                </div>
              </div>
            </div>
            <div class="card-footer text-right">
              <button class="btn btn-primary" name="simpan">Simpan</button>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalLogout" tabindex="-1" role="dialog" aria-labelledby="Titlemodal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Titlemodal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-header">
          Yakin Logout?
        </div>
        <div class="card-footer text-right">
          <a href="auth/logout.php" class="btn btn-primary">Yakin</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">SUCCESS</h5>
        <a type="button" class="close" href="index.php" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body">
        Data Berhasil Disimpan
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-secondary" href="index.php">Close</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFailed" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">FAILED:(</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data Gagal Disimpan
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php

  if(isset($_POST['simpan']))
    {
      $inputData = mysqli_query($koneksi, "INSERT INTO data_catatan(nama,size,harga,tanggal) VALUES('$nama','$size','$harga','$tanggal')");
      if($inputData){
        echo '<script>$("#modalSuccess").modal("show");</script>';
      }else{
        echo '<script>$("#modalFailed").modal("show");</script>';
      }
    }
  ?>

<script>
		var ctx = document.getElementById("Statistik").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: ["Hari ini", "Kemarin", "7 Hari", "1 Bulan"],
				datasets: [{
					label: '',
					data: [
          <?php 
          $Thariini = date("Y-m-d");
					$Hariini = mysqli_query($koneksi, "SELECT * FROM data_catatan WHERE tanggal='$Thariini'");
					echo mysqli_num_rows($Hariini);
					?>, 
          <?php
          $now = strtotime(date("Y-m-d"));
          $Tkemarin = date('Y-m-d', strtotime('-1 day', $now));
					$Kmarin = mysqli_query($koneksi,"SELECT * FROM data_catatan WHERE tanggal='$Tkemarin'");
					echo mysqli_num_rows($Kmarin);
					?>, 
					<?php 
          $now = strtotime(date("Y-m-d"));
          $t7hr = date('Y-m-d', strtotime('-1 week', $now));
					$T7hr = mysqli_query($koneksi,"SELECT * FROM data_catatan WHERE (tanggal BETWEEN $t7hr AND $now)");
					echo mysqli_num_rows($T7hr);
					?>, 
					<?php 
          $now = strtotime(date("Y-m-d"));
          $T1bln = date('Y-m-d', strtotime('-1 mounth', $now));
					$Tbln = mysqli_query($koneksi,"SELECT * FROM data_catatan WHERE (tanggal BETWEEN $T1bln AND $now)");
					echo mysqli_num_rows($Tbln);
					?>
					],
					backgroundColor: [
					'rgba(255, 99, 132, 0)',
					'rgba(54, 162, 235, 0)',
					'rgba(255, 206, 86, 0)',
					'rgba(255, 206, 86, 0)'
					],
					borderColor: [
					'rgb(103,119,239)',
					'rgb(240,81,73)',
					'rgb(0,0,0)',
					'rgba(75, 192, 192, 1)'
					],
					borderWidth: 5
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
  </script>
  
<!-- Modal -->
<div class="modal fade" id="modalAktifitas" tabindex="-1" role="dialog" aria-labelledby="AktifitasTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AktifitasTitle">Aktifitas Anda</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-12">
          <div class="activities">

            <?php 
              $actv = mysqli_query($koneksi, "SELECT * FROM data_catatan WHERE nama='$nama' ORDER BY id DESC"); 
              $qsa = mysqli_num_rows($actv);
              if($qsa>0){  
            ?>
              <?php
                while($y = mysqli_fetch_array($actv)) {
              ?>

              <!-- ACT -->
                    <div class="activity">
                      <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-sign-out-alt"></i>
                      </div>
                      <div class="activity-detail">
                        <div class="mb-2">
                          <span class="text-job"><?= $y['tanggal']; ?></span>
                          <span class="bullet"></span>
                          <a class="text-job" href="#">Pengeluaran</a>
                          <div class="float-right dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                            <div class="dropdown-menu">
                              <div class="dropdown-title">Detail</div>
                              <a href="" class="dropdown-item has-icon"><i class="fas fa-info"></i> Tidak ada detail</a>
                              <div class="dropdown-divider"></div>
                              <a href="https://github.com/ZumaAkbarID" class="dropdown-item has-icon text-dark"><i class="fab fa-github"></i> ZumaAkbar</a>
                            </div>
                          </div>
                        </div>
                        <p>Rp.<?= $y['harga']; ?></p>
                      </div>
                    </div>
                    <!-- end -->
                <?php } ?>
              <?php }else { ?>
                <!-- ACT -->
                    <div class="activity">
                      <div class="activity-icon bg-primary text-white shadow-primary">
                        <i class="fas fa-sign-out-alt"></i>
                      </div>
                      <div class="activity-detail">
                        <div class="mb-2">
                          <span class="text-job"></span>
                          <span class="bullet"></span>
                          <a class="text-job" href="#">Pengeluaran</a>
                          <div class="float-right dropdown">
                            <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                            <div class="dropdown-menu">
                              <div class="dropdown-title">Detail</div>
                              <a href="" class="dropdown-item has-icon"><i class="fas fa-info"></i> Tidak ada detail</a>
                              <div class="dropdown-divider"></div>
                              <a href="https://github.com/ZumaAkbarID" class="dropdown-item has-icon text-dark"><i class="fab fa-github"></i> ZumaAkbar</a>
                            </div>
                          </div>
                        </div>
                        <p>Rp.0</p>
                      </div>
                    </div>
                    <!-- end -->
              <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>
