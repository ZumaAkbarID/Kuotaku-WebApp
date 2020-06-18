<?php
session_start();

include '../db/database.php';

  if(isset($_POST['login']))
    {

      $nomor = $_POST['nomorhp'];
      $password = md5($_POST['password']);

      $Proccess = mysqli_query($koneksi, "SELECT * FROM users WHERE nomorhp='$nomor' AND password='$password'");
      $cek = mysqli_num_rows($Proccess);
      if($cek > 0) 
        {
          foreach($Proccess as $sesi)
          {
            $_SESSION['nama'] = $sesi['nama'];
          }

          $_SESSION['nomorhp'] = $nomor;

          $success = true;

        }else{
          $failed = true;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Kuotaku</title>

  <link rel="shortcut icon" href="../assets/img/icon.png" type="image/x-icon">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <img src="../assets/img/icon.png" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">

            <?php if(isset($success)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: black;">&times;</span>
                  </button>
                  <p style="color: black; font-family: sans-serif;">Login Berhasil. Anda akan di alihkan ke dashboard dalam waktu <div id="waktu"></div> detik.</p>
                </div>
              </div>

              <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

              <script>
                function counter(time, url){
	                var interval = setInterval(function(){
		                $('#waktu').text(time);
		                time = time - 1;
 
		                if(time == 0){
			                clearInterval(interval);
			                window.location = url;
		                }
	                }, 1000);
                }
 
                $(document).ready(function(){
	                counter(5, '../');
                });
              </script>

            <?php endif; ?>

            <?php if(isset($failed)) : ?>

              <div class="p-3 ml-4 mr-4 alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span style="color: white;">&times;</span>
                  </button>
                  <p style="color: white; font-family: sans-serif;">Nomor HP atau Password salah.</p>
                </div>
              </div>

            <?php endif; ?>

            <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">Kuotaku</span></h4>
            <p class="text-muted">Sebelum memulai, Anda harus masuk atau mendaftar jika Anda belum memiliki akun.</p>
            <form method="POST" class="needs-validation" novalidate=""> 
              <div class="form-group">
                <label for="nomorhp">Nomor HP</label>
                <input id="nomorhp" type="number" class="form-control" name="nomorhp" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                  Oh tidak, tampaknya kolom Nomor HP belum kamu isi.
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                <div class="invalid-feedback">
                  Oh tidak, tampaknya kolom Password belum kamu isi.
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me" title="masuk aplikasi tanpa login lagi">Ingat Saya</label>
                </div>
              </div>

              <div class="form-group text-right">
                <a href="forgot-password.php" class="float-left mt-3">
                  Lupa Password?
                </a>
                <button type="submit" name="login" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Masuk
                </button>
              </div>

              <div class="mt-5 text-center">
                Belum memiliki akun? <a href="register.php">Buat akun sekarang</a>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Aplication is made with <i class="fa fa-heart" style="color: red;" aria-hidden="true"></i> by <a  href="https://instagram.com/zuma.akbar" target="_blank">Zuma Akbar</a>
              <div class="mt-2">
                <a href="#">Privacy Policy</a>
                <div class="bullet"></div>
                <a href="#">Terms of Service</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="../assets/img/unsplash/login-bg.jpg">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Morning</h1>
                <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
              </div>
              Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
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

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->

</body>
</html>
