<?php use App\Models\AuthModel;
  $model = new AuthModel();
  $role = session('role_id');
?> 

<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= site_url('/'); ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <?php $menu = $model->navmenu($role);?>
      <li class="nav-item">
        <?php foreach ($menu as $key => $value) : ?>
        <a class="nav-link collapsed" data-bs-target="#<?= $value['menu_nama']; ?>" data-bs-toggle="collapse" href="#">
          <i class="<?= $value['menu_icon']; ?>"></i><span><?= $value['menu_nama']; ?></span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="<?= $value['menu_nama']; ?>" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <?php $menuid = $value['menu_id'] ?>
            <?php $submenu = $model->navsubmenu($role,$menuid); ?>
            <?php foreach ($submenu as $key => $sub) : ?>
          <li>
            <a href="<?= site_url($sub->submenu_link) ?>">
              <i class="bi bi-circle"></i><span><?= $sub->submenu_nama; ?></span>
            </a>
          </li>
          <?php endforeach ?>
        </ul>
        <?php endforeach ?>
      </li><!-- End Components Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->
