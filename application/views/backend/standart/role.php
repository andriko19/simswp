<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SIM SWP | Pilih Role</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <!-- <link rel="stylesheet" href="../node_modules/selectric/public/selectric.css"> -->

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
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <img src="<?= BASE_ASSET; ?>/stisla/img/logo.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-danger">
              <div class="card-header"><h2><b>Role</b> <?= get_option('site_name'); ?></h2></div>

              <div class="card-body">

                <div class="form-group">

                  <?php
                    $role=$this->aauth->get_user_groups($this->aauth->get_user()->id);  
                    // log_message('error',var_dump($role));
                    // var_dump($_SESSION);
                    foreach ($role as $rl) { ?>

                      <a href="<?php echo site_url("administrator/dashboard?role=".$rl->id."&rname=".$rl->name)  ?>" target="_blank" class="btn btn-danger btn-lg btn-block"><?php echo $rl->name ?></a><br>

                    <?php 
                  }?>

                  <!-- <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button> -->
                </div>
              </div>
            </div>
            <div class="simple-footer">
              <strong>Copyright &copy; 2020-<?=date('Y'); ?> <a href="#" style="color: #cf4040;"><?= get_option('site_name'); ?></a>.</strong>
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
  <script src="../node_modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="../node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="<?= BASE_ASSET; ?>/stisla/js/scripts.js"></script>
  <script src="<?= BASE_ASSET; ?>/stisla/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?= BASE_ASSET; ?>/stisla/js/page/auth-register.js"></script>
</body>
</html>
