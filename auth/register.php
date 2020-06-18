<?php
session_start();

if(!empty($_SESSION['nama'])) {
  echo '<script>window.location.href = "../";</script>';
}

include '../db/database.php';

if(isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nomorhp = $_POST['nomorhp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password == $password2) {
      
        $cekNamaEmailNomor = mysqli_query($koneksi, "SELECT * FROM users WHERE nama='$nama' OR nomorhp='$nomorhp' OR email='$email'");
        $cekRow = mysqli_num_rows($cekNamaEmailNomor);
        if($cekRow > 0 ) {

          $sudahada = true;

        }else{

          $password3 = md5($password);
          $insertUser = mysqli_query($koneksi, "INSERT INTO users(nama, nomorhp, email, password, pengeluaran) VALUES('$nama','$nomorhp','$email','$password3','0')");
          if($insertUser) {
            $success = true;
          }else{
            $failed = true;
          }
        }  
      }else{
      $Failpassword = true;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Kuotaku</title>

  <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">


  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css"> -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="../assets/img/icon.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">

              <div class="card-header">
                <h4>Register</h4>
              </div>

              <?php if(isset($success)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: black;">&times;</span>
                  </button>
                  <p style="color: black; font-family: sans-serif;">Akun Berhasil Didaftarkan.</p>
                </div>
              </div>

              <?php endif; ?>

              <?php if(isset($failed)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: white;">&times;</span>
                  </button>
                  <p style="color: white; font-family: sans-serif;">Akun Gagal Didaftarkan.</p>
                </div>
              </div>

              <?php endif; ?>

              <?php if(isset($sudahada)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: white;">&times;</span>
                  </button>
                  <p style="color: white; font-family: sans-serif;">Akun Gagal Didaftarkan. Nama/Nomor HP, Email sudah terdaftar.</p>
                </div>
              </div>

              <?php endif; ?>

              <?php if(isset($Failpassword)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: white;">&times;</span>
                  </button>
                  <p style="color: white; font-family: sans-serif;">Password Tidak Sama.</p>
                </div>
              </div>

              <?php endif; ?>

              <div class="card-body">
                <form method="POST" action="">
                  <div class="row">
                    <div class="form-group col-12">
                      <label for="nama">Nama</label>
                      <input id="nama" type="text" class="form-control" name="nama" autofocus required>
                    </div>

                  <div class="form-group col">
                    <label for="nomorhp">Nomor HP</label>
                    <input id="nomorhp" type="number" class="form-control" name="nomorhp" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group col-12">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="row col-12">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required>
                      <div id="pwindicator" class="pwindicator">
                        <div class="bar"></div>
                        <div class="label"></div>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="password2" class="d-block">Ulangi Password</label>
                      <input id="password2" type="password" class="form-control" name="password2" required>
                    </div>
                  </div>

                  <div class="form-group col-12">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                      <label class="custom-control-label" for="agree">Saya Setuju dengan semua <a href="#">syarat dan ketentuan</a>.</label>
                    </div>
                  </div>

                  <div class="form-group col-12">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>

                  <div class="mt-2 text-center">
                    <p>Sudah memiliki akun? <a href="login.php">Login sekarang</a></p>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Aplication is made with <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i> by <a  href="https://instagram.com/zuma.akbar" target="_blank">Zuma Akbar</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/auth-register.js"></script>

</body>
</html>