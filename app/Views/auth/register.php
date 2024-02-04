
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perjadin | Halaman Registrasi</title>

  <base href="<?= base_url('templates'); ?>/">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index2.html"><b>Perjadin</b>Keu</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Registrasi Pengguna Baru</p>

      <?php $errors = session()->getFlashdata('validation') ?>

      <form action="<?= site_url('register/create') ?>" method="post">
      <?= csrf_field(); ?>
        <div class="form-group">
          <input type="text" class="form-control <?= isset($errors['user_nama']) ? 'is-invalid' : null ; ?>" placeholder="Nama Lengkap" name="user_nama" value="<?= old('user_nama'); ?>">
          <div class="invalid-feedback">
              <?= isset($errors['user_nama']) ? $errors['user_nama'] : null ; ?>
          </div>
        </div>
        <div class="form-group">
          <input type="text" class="form-control <?= isset($errors['user_email']) ? 'is-invalid' : null ; ?>" placeholder="Email" name="user_email" value="<?= old('user_email'); ?>">
          <div class="invalid-feedback">
              <?= isset($errors['user_email']) ? $errors['user_email'] : null ; ?>
          </div>
        </div>
        <div class="form-group">
          <input type="password" class="form-control <?= isset($errors['user_password']) ? 'is-invalid' : null ; ?>" placeholder="Password" name="user_password" value="<?= old('user_password'); ?>">
          <div class="invalid-feedback">
              <?= isset($errors['user_password']) ? $errors['user_password'] : null ; ?>
          </div>
        </div>
        <div class="form-group">
          <input type="password" class="form-control <?= isset($errors['pass_confirm']) ? 'is-invalid' : null ; ?>" placeholder="Ketik kembali password" name="pass_confirm" value="<?= old('pass_confirm'); ?>">
          <div class="invalid-feedback">
              <?= isset($errors['pass_confirm']) ? $errors['pass_confirm'] : null ; ?>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-0">
            <a href="<?= site_url('login'); ?>" class="btn btn-block">I already have a membership</a>
      </p>

      <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
