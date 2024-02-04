<?php use App\Models\AuthModel;
  $model = new AuthModel();
  $role = session('role_id');
?> 
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PERJADIN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item"><a href="<?= site_url("/") ?>" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a></li>
          <?php $menu = $model->navmenu($role);?>

          <?php foreach ($menu as $key => $value) : ?>
            <li class="nav-item"><a href="<?= site_url($value['menu_link']) ?>" class="nav-link"><i class="<?= $value['menu_icon']; ?>"></i><p> <?= $value['menu_nama'] ?><i class="fas fa-angle-left right"></i></p></a>
            <?php $menuid = $value['menu_id'] ?>
            <?php $submenu = $model->navsubmenu($role,$menuid); ?>
            <?php foreach ($submenu as $key => $sub) : ?>
              <ul class="nav nav-treeview">
                <li class="nav-item"><a href="<?= site_url($sub->submenu_link) ?>" class="nav-link"><i class="<?= $sub->submenu_icon; ?>"></i><p><?= $sub->submenu_nama; ?></p></a></li>
              </ul>
            <?php endforeach ?>
            <?php endforeach ?>
            </li>
        </ul>
      </nav>
    </div>
  </aside>      
          
          