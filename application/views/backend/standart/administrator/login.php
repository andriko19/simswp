<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIM SWP | Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css"> -->

  <!-- Favicons -->
  <link href="<?= BASE_ASSET; ?>/stisla/img/favicon.png" rel="icon">
  <link href="<?= BASE_ASSET; ?>/stisla/img/favicon.png" rel="apple-touch-icon">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/stisla/css/style.css">
  <link rel="stylesheet" href="<?= BASE_ASSET; ?>/stisla/css/components.css">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-3">
            <div style="text-align: center;">
              <img src="<?= BASE_ASSET; ?>/stisla/img/logo.png" alt="logo" width="90" class="shadow-light rounded-circle mb-5 mt-2">
            </div>
            <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold"><?= site_name(); ?></span></h4>
            <p class="text-muted" style="font-size: 20px;">Unggul Berbasis Pendidikan Budi Pekerti</p>

            <!-- <p class="login-box-msg"><?= cclang('sign_to_start_your_session'); ?></p> -->
            <?php if(isset($error) AND !empty($error)): ?>
                 <div class="callout callout-error"  style="color:#C82626">
                      <h4><?= cclang('error'); ?>!</h4>
                      <p><?= $error; ?></p>
                    </div>
            <?php endif; ?>
            <?php
            $message = $this->session->flashdata('f_message'); 
            $type = $this->session->flashdata('f_type'); 
            if ($message):
            ?>
           <div class="callout callout-<?= $type; ?>"  style="color:#C82626">
                <p><?= $message; ?></p>
              </div>
            <?php endif; ?>
             <?= form_open('', [
                'name'    => 'form_login', 
                'id'      => 'form_login', 
                'method'  => 'POST'
              ]); ?>

              <div class="form-group <?= form_error('username') ? 'has-error' :''; ?>">
                <label for="email">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
                <div class="invalid-feedback">
                  Please fill in your Username
                </div>
              </div>

              <div class="form-group <?= form_error('password') ? 'has-error' :''; ?>">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password"  placeholder="Password" tabindex="2" required>
                <div class="invalid-feedback">
                  please fill in your password
                </div>
              </div>

              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                  <label class="custom-control-label" for="remember-me">Remember Me</label>
                </div>
              </div>

              <div class="form-group text-right">
                <a href="" class="float-left mt-3" style="color: #cf4040;">
                  Forgot Password?
                </a>
                <button type="submit" class="btn btn-danger btn-lg btn-icon icon-right" tabindex="4">
                  <?= cclang('sign_in'); ?>
                </button>
              </div>
            <?= form_close(); ?>


            <div class="text-center mt-5 text-small">
              <strong>Copyright &copy; 2020-<?=date('Y'); ?> <a href="#" style="color: #cf4040;"><?= get_option('site_name'); ?></a>.</strong> <!-- Made with 💙 by Stisla -->
              <div class="mt-2">
                <!-- <a href="#">Privacy Policy</a> -->
                <div class="bullet"></div>
                <!-- <a href="#">Terms of Service</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-50 background-walk-y position-relative overlay-gradient-bottom">
          <!-- <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">Gedung F.</h1>
                <h5 class="font-weight-normal text-muted-transparent">Sekolah Wijaya Putra</h5>
              </div>
              <a class="text-light bb" target="_blank" href="https://goo.gl/maps/kW6esNc8oAzEpzDk9">Jalan Raya Benowo 1-3, Surabaya, Jawa Timur - Indonesia</a>
            </div>
          </div> -->
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?= BASE_ASSET; ?>/stisla/img/swp.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="<?= BASE_ASSET; ?>/stisla/img/swp1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="<?= BASE_ASSET; ?>/stisla/img/swp2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>
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
  <script src="<?= BASE_ASSET; ?>/stisla/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?= BASE_ASSET; ?>/stisla/js/scripts.js"></script>
  <script src="<?= BASE_ASSET; ?>/stisla/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
