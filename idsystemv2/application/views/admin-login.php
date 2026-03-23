<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('assets/admin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet"
    type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('assets/admin/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
  <style>
  .bg-login-custom {
    background: url("<?= base_url('assets/images/system/login-image-2.jpg'); ?>");
    background-position: center;
    background-size: cover;
  }
  </style>

</head>

<body class="bg-gray-200">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-10">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"> ID System </h1>
                  </div>
                  <?= validation_errors(); ?>
                  <?= form_open('admin/login', 'class="user"'); ?>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-user" id="username"
                      aria-describedby="usernameHelp" placeholder="Username" name="username" required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password"
                      name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                  <?= form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script type="text/javascript" src="<?= base_url('assets/admin/vendor/jquery/jquery.js');?>"></script>
  <script type="text/javascript" src="<?= base_url('assets/admin/vendor/bootstrap/js/bootstrap.js');?>"></script>

  <!-- Core plugin JavaScript-->
  <script type="text/javascript" src="<?= base_url('assets/admin/vendor/jquery-easing/jquery.easing.js');?>"></script>

  <!-- Custom scripts for all pages-->
  <script type="text/javascript" src="<?= base_url('assets/admin/js/sb-admin-2.js');?>"></script>

</body>

</html>