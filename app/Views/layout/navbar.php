
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <div class="user-block ">
                <span class="username"><a href="<?= site_url('/'); ?>"><?= session('nama') ?></a></span>
                <span class="description"><?= session('role') ?></span>
        </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <div class="user-panel ">
            <div class="image "><img src="dist/img/user2-160x160.jpg" class="img-circle img-bordered-sm" alt="User Image"></div>
          </div>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">Informasi dan Data Profil</span>
            <!-- <div class="dropdown-divider"></div> -->
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Profil
              <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
            </a>
            <a href="<?= site_url('logout'); ?>" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> Logout
              <!-- <span class="float-right text-muted text-sm">3 mins</span> -->
            </a>
          </div>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>


  </nav>
