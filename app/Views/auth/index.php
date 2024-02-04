
<?= $this->extend('layout/default'); ?>

<?= $this->section('stylesheet'); ?>
   <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Bootstrap Switch Button -->
  <link rel="stylesheet" href="plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch-button.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


<?= $this->endSection(); ?>

<?= $this->section('scriptplugin'); ?>
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Bootstrap Switch Button -->
  <script src="plugins/bootstrap-switch/js/bootstrap-switch-button.min.js"></script>

  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>

<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <?= $this->include('layout/contenheader'); ?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?= $this->include('layout/infobox'); ?>
      </div>
      <div class="col">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <div class="row">
              <div class="col-sm-8">
                <h5 class="card-title"><?= $title; ?></h5>
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn bg-gradient-primary float-sm-right btn-sm" class="btn btn-primary"  data-toggle="modal" data-target="#modalform"><i class="fas fa-hand-point-right"> </i> Tambah User</button>
                </a>
              </div>
            </div>
          </div>
            <div class="card-body row justify-content-center">
              <div class="col">
                  <table id="myTable1" class="table table-bordered table-striped table-sm">
                    <thead>
                      <tr>
                        <th class="align-middle text-center">No</th>
                        <th class="align-middle text-center">Aksi</th>
                        <th class="align-middle text-center">Active</th>
                        <th class="align-middle text-center">Nama Lengkap</th>
                        <th class="align-middle text-center">Username</th>
                        <th class="align-middle text-center">Role</th>
                        <th class="align-middle text-center">Update</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; foreach ($pengguna as $key => $value) : ?>
                      <tr>
                          <td><?= $no++; ?></td>
                          <td>
                            <a href="<?= site_url('user/remove/'.$value->user_id); ?>" type="button" class="btn bg-gradient-danger btn-sm"><i class="fas fa-trash"> </i></a>
                          </td>
                          <td class="align-middle text-center">
                            <input type="checkbox" name="menu_active" value="<?= $value->user_id; ?>" class="status-checkbox" <?= $value->user_active == 1 ? "checked" : null; ?> data-toggle="switchbutton" data-onlabel="Aktif" data-offlabel="Tidak  ." data-onstyle="success" data-offstyle="danger" data-size="sm">
                          </td>
                          <td><?= $value->user_nmlengkap ?></td>
                          <td><?= $value->user_nama; ?></td>
                          <td><?= $value->role_nama; ?></td>
                          <td><?= $value->user_updated_at; ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal SPJ Pesawat -->
  <div class="modal fade" id="modalform">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?= $title; ?></h4>
        </div>
        <form action="<?=site_url('user/create');?>" method="post" id="form">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
                <!-- <div class="form-group row"> -->
                  <!-- <label class="col-sm-4 col-form-label" hidden>User id</label> -->
                  <!-- <div class="col"> -->
                    <input type="text" class="form-control" id="user_id" name="user_id" hidden>
                  <!-- </div> -->
                <!-- </div> -->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" >Username</label>
                  <div class="col">
                    <input type="text" class="form-control" id="user_nama" name="user_nama">
                    <div class="invalid-feedback erroruser_nama"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" >User Password</label>
                  <div class="col">
                    <input type="password" class="form-control" id="user_password" name="user_password">
                    <div class="invalid-feedback erroruser_password"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" >Konfir. Password</label>
                  <div class="col">
                    <input type="password" class="form-control" id="pass_confirm" name="pass_confirm">
                    <div class="invalid-feedback errorpass_confirm"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" >Nama Lengkap</label>
                  <div class="col">
                    <input type="text" class="form-control" id="user_nmlengkap" name="user_nmlengkap">
                    <div class="invalid-feedback erroruser_nmlengkap"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" >Role User</label>
                  <div class="col">
                    <select class="form-control select2" style="width: 100%;" name = "user_roleid" id="user_roleid">
                      <option value="">Pilih Role Menu</option>
                      <?php foreach ($role as $key => $value) : ?>
                        <option value="<?= $value->role_id; ?>"><?= $value->role_nama; ?></option>
                        <?php endforeach ?>
                      </select>
                      <div class="invalid-feedback erroruser_roleid"></div>
                    <!-- <input type="text" class="form-control" id="user_roleid" name="user_roleid"> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default batalbutton" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary simpanbutton">Simpan</button>
            </div>
          </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <script>
    $(function () {
      $("#myTable1").DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
      })
    });
  </script>
  <!-- Script Edit dan SImpan SPJ Tiket Pesawat -->
    <script>
      $(document).ready(function(){
        $('#form').submit(function(e){
          e.preventDefault();
          var data = new FormData(this);
          // console.log(data);

          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: data,
            processData: false,
            contentType: false,
            beforeSend:function(){
                  $('.simpanbutton').attr('disabled', 'disabled');
                  $('.simpanbutton').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpanbutton').removeAttr('disabled');
                  $('.simpanbutton').html('Simpan');
              },
            success: function (response) {
              console.log(response);
              if(response.errors) {
                if(response.messages.user_nama){
                        $('#user_nama').addClass('is-invalid');
                        $('.erroruser_nama').html(response.messages.user_nama);
                    } else {
                        $('#user_nama').removeClass('is-invalid');
                        $('.erroruser_nama').html('');
                }
                if(response.messages.user_password){
                        $('#user_password').addClass('is-invalid');
                        $('.erroruser_password').html(response.messages.user_password);
                    } else {
                        $('#user_password').removeClass('is-invalid');
                        $('.erroruser_password').html('');
                }
                if(response.messages.pass_confirm){
                        $('#pass_confirm').addClass('is-invalid');
                        $('.errorpass_confirm').html(response.messages.pass_confirm);
                    } else {
                        $('#pass_confirm').removeClass('is-invalid');
                        $('.errorpass_confirm').html('');
                }
                if(response.messages.user_roleid){
                        $('#user_roleid').addClass('is-invalid');
                        $('.erroruser_roleid').html(response.messages.user_roleid);
                    } else {
                        $('#user_roleid').removeClass('is-invalid');
                        $('.erroruser_roleid').html('');
                } 
                if(response.messages.user_nmlengkap){
                        $('#user_nmlengkap').addClass('is-invalid');
                        $('.erroruser_nmlengkap').html(response.messages.user_nmlengkap);
                    } else {
                        $('#user_nmlengkap').removeClass('is-invalid');
                        $('.erroruser_nmlengkap').html('');
                } 
              } else {
                console . log(response);
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: response.messages,
                  showConfirmButton: false,
                  timer: 2000
                }).then(function(){
                  $('#form').hide('2000');
                  location.reload();

                });
              }
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error();
            }
          });
        });
        $('.batalbutton').on('click', function () {
          location.reload();
        });
      });


    </script>
  <!-- End Script Edit dan SImpan SPJ Tiket Pesawat -->

   <script>
 
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

  </script>
      
<!-- Togle Aktiv -->
    <script>
      $(document).ready(function () {
        $('input[name="menu_active"]').on('change', function () {
            var checkboxValue = $(this).val();
            var isChecked = $(this).is(':checked');
            
            if (isChecked) {
                console.log(checkboxValue);
                $.ajax({
                  type: "POST",
                  url: "<?= site_url('user/updatetoggle'); ?>",
                  data: {user_id:checkboxValue},
                  // dataType: "dataType",
                  success: function (response) {
                    
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil...',
                      text: 'User Aktif',
                    }).then(function(){
                      location.reload();
                    });
                  },
                  
                });
            } else {
                console.log(checkboxValue);
                $.ajax({
                  type: "POST",
                  url: "<?= site_url('user/updatetoggle'); ?>",
                  data: {user_id:checkboxValue},
                  // dataType: "dataType",
                  success: function (response) {
                    Swal.fire({
                      icon: 'success',
                      title: 'Berhasil...',
                      text: 'User Tidak Aktif',
                    }).then(function(){
                      location.reload();
                    });
                  },
                 
                });
            }
        });
      });
    </script>
  <!--  -->
<?= $this->endSection() ?>