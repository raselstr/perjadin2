<!-- Info boxes -->
        
<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
      <?php 
        $db = \Config\Database::connect();
        $user = $db->query('SELECT * FROM users WHERE user_active = true');
        $sum = $user->getNumRows();
      ?>

      <div class="info-box-content">
        <span class="info-box-text">User</span>
        <span class="info-box-number"><?= $sum; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-users"></i></span>
      <?php 
        $db = \Config\Database::connect();
        $user = $db->query('SELECT * FROM roles');
        $sum = $user->getNumRows();
      ?>

      <div class="info-box-content">
        <span class="info-box-text">Group</span>
        <span class="info-box-number"><?= $sum; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
      <?php 
        $db = \Config\Database::connect();
        $user = $db->query('SELECT * FROM spts');
        $sum = $user->getNumRows();
      ?>

      <div class="info-box-content">
        <span class="info-box-text">Perjalanan</span>
        <span class="info-box-number"><?= $sum; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
      <?php 
        $db = \Config\Database::connect();
        $user = $db->query('SELECT * FROM users WHERE user_active = true');
        $sum = $user->getNumRows();
      ?>

      <div class="info-box-content">
        <span class="info-box-text">Verifikasi</span>
        <span class="info-box-number"><?= $sum; ?></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- fix for small devices only -->
  <div class="clearfix hidden-md-up"></div>
</div>