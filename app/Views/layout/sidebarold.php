<?php use App\Models\AuthModel;
  $model = new AuthModel();
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
          <?php 
            $db = \Config\Database::connect();
            $menu = $db->query('SELECT * FROM menus WHERE menu_active=1 ORDER BY menu_id ASC');
            $r1 = $menu->getResultArray();
            foreach ($r1 as $key => $m1): 
              $id_menu = $m1['menu_id'];
              $sub = $db->query("SELECT * FROM submenus WHERE submenu_active = 1 AND menu_id = $id_menu ORDER BY submenu_id ASC");
              if($sub->getNumRows() > 0) {
                $r2 = $sub->getResultArray(); ?>
                <li class="nav-item"><a href="<?= site_url($m1['menu_link']) ?>" class="nav-link"><i class="<?= $m1['menu_icon']; ?>"></i><p> <?= $m1['menu_nama']; ?><i class="fas fa-angle-left right"></i></p></a>
                <?php foreach ($r2 as $key => $m2) : ?>
                  <!-- <li class="nav-header">MENUS</li> -->
                    <ul class="nav nav-treeview">
                      <li class="nav-item"><a href="<?= site_url($m2['submenu_link']) ?>" class="nav-link"><i class="<?= $m2['submenu_icon']; ?>"></i><p><?= $m2['submenu_nama']; ?></p></a></li>
                    </ul>
                  
                <?php endforeach;
              } else { ?>
                <li class="nav-item"><a href="<?= site_url($m1['menu_link']) ?>" class="nav-link"><i class="<?= $m1['menu_icon']; ?>"></i><p><?= $m1['menu_nama']; ?></p></a></li>
            <?php }
            endforeach;
          ?>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>