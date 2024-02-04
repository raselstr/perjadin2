<?= $this->extend('layout/default'); ?>


<?= $this->section('stylesheet'); ?>
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!-- Bootstrap Switch Button -->
  <link rel="stylesheet" href="plugins/bootstrap-switch/css/bootstrap3/bootstrap-switch-button.min.css">
<?= $this->endSection(); ?>



<?= $this->section('scriptplugin'); ?>
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Toastr -->
  <script src="plugins/toastr/toastr.min.js"></script>

  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>

  <!-- Bootstrap Switch Button -->
  <script src="plugins/bootstrap-switch/js/bootstrap-switch-button.min.js"></script>
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
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                    <a href="<?= site_url('spt'); ?>" class="btn btn-danger float-right">Kembali</a>
                  </div>
                   
                    <div class="card-body row justify-content-center">
                      <div class="col-8">
                        <div class="form-group row">
                          <div class="col">
                            <input type="text" name="spt_id" placeholder="Tahun" id="spt_id" value="<?= $spt->spt_id ?>" hidden>
                          </div>
                        </div>
                        <table class="table">
                          <thead>
                            <tr>
                              <th style="width: 20px">#</th>
                              <th>Uraian</th>
                              <th style="width: 70%" colspan="3">Keterangan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1.</td>
                              <td>Pejabat Pemberi Tugas</td>
                              <td><?= $spt->spt_pjb_tugas ?></td>
                            </tr>
                            <tr>
                              <td>2.</td>
                              <td>Maksud Perjalanan Dinas</td>
                              <td><?= $spt->spt_uraian ?></td>
                            </tr>
                            <tr>
                              <td>3.</td>
                              <td>Lama Perjalanan Dinas</td>
                              <td>
                                <?= $spt->spt_lama ?> hari &nbsp;&nbsp;(<?= date('d F Y', strtotime($spt->spt_mulai))?> &nbsp;&nbsp;&nbsp; s.d &nbsp;&nbsp;&nbsp; <?= date('d F Y',strtotime($spt->spt_berakhir)) ?>)
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>              
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-6">
                          <!-- <button type="submit" class="btn btn-primary float-right">Simpan</button> -->
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                            <i class="nav-icon fas fa-users"> </i> Tambah Pegawai pelaksana Perjalanan Dinas
                          </button>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="card card-info ">
                  <div class="card-header">
                    <h5 class="m-0">Pegawai yang melaksanakan Perjalanan Dinas</h5>
                    
                  </div>
                  <div class="card-body row justify-content-center">
                    <div class="col-10">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <td class="align-middle text-center">Aksi</td>
                            <td class="align-middle text-center">Nama</td>
                            <td class="align-middle text-center">NIP</td>
                            <td class="align-middle text-center">Utama/Pengikut</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($pelks as $key => $value) { ?>
                            <tr>
                              <td class="align-middle text-center"><a href="<?= site_url('pelaksana/remove/'.$value->pelaksana_id); ?>" class="btn btn-icon btn-sm btn-danger tombol-hapus"><i class="fas fa-trash-alt"></i></a></td>
                              <td><?= $value->pegawai_nama; ?></td>
                              <td class="align-middle text-center"><?= $value->pegawai_nip; ?></td>
                              <td class="align-middle text-center">
                                <input type="checkbox" name="pelaksana_id" value="<?= $value->pelaksana_id; ?>" class="status-checkbox" <?= $value->pelaksana_utama == 1 ? "checked" : null; ?> data-toggle="switchbutton" data-onlabel="Utama" data-offlabel="Pengikut  ." data-onstyle="success" data-offstyle="danger" data-size="sm">
                              </td>
                            </tr>
                          <?php } ?>
                          </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="card-footer">
                    <a href="<?= site_url('spt'); ?>" class="btn btn-danger float-right">Kembali</a>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
<!-- /.content -->
<!-- Modal -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?= $title; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= site_url('pelaksana/create'); ?>" method="post" id="form">
          <?= csrf_field() ?>
            <div class="modal-body">
              <div class="form-group">
                <input class="form-control"  name = "spt_id" type="text" value="<?= $spt->spt_id ?>" hidden>
              </div>
              <div class="form-group">
                <label>Pilih Nama Pegawai</label>
                <select class="form-control select2" style="width: 100%;" name="pegawai_id" id="pegawai_id">
                  <option value="">Pilih Pegawai ...</option>
                  <?php foreach($peg as $key => $value) : ?>
                    <option value="<?= $value->pegawai_id; ?>"><?= $value->pegawai_nama; ?>   (<?= $value->pegawai_nip; ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary tbltambah">Tambah Pegawai</button>
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?= $this->endSection() ?>

<?= $this->section('script'); ?>
  <script>
 
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

  </script>
  
<?= $this->endSection(); ?>
    

<?= $this->section('script'); ?>
  <script>
    $(document).ready(function () {
      $('input[name="pelaksana_id"]').on('change', function () {
          var checkboxValue = $(this).val();
          var isChecked = $(this).is(':checked');
          
          if (isChecked) {
              console.log(checkboxValue);
              $.ajax({
                type: "POST",
                url: "<?= site_url('pelaksana/updatetoggle'); ?>",
                data: {item_ids:checkboxValue},
                // dataType: "dataType",
                success: function (response) {
                  
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil...',
                    text: 'Pegawai ini sebagai Utama yang ditugaskan dalam Perjalanan Dinas',
                  });
                  // location.reload();
                },
                error: function (error) {
                    // Handle error, if any
                    console . error(error);
                }
              });
          } else {
              console.log(checkboxValue);
              $.ajax({
                type: "POST",
                url: "<?= site_url('pelaksana/updatetoggle'); ?>",
                data: {item_ids:checkboxValue},
                // dataType: "dataType",
                success: function (response) {
                  Swal.fire({
                    icon: 'success',
                    title: 'Berhasil...',
                    text: 'Pegawai ini sebagai Pengikut yang ditugaskan dalam Perjalanan Dinas',
                  });
                  // location.reload();
                  // alert('Status item berhasil diubah');
                },
                error: function (error) {
                    // Handle error, if any
                    console . error(error);
                }
              });
          }
      });
    });
  </script>

  <!-- Script Edit dan SImpan SPJ Tiket Taksi -->
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
                $('.tbltambah').attr('disabled', 'disabled');
                $('.tbltambah').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function(){
                $('.tbltambah').removeAttr('disabled');
                $('.tbltambah').html('Simpan');
            },
          success: function (response) {
            console.log(response);
              Swal.fire({
                position: "center",
                icon: "success",
                title: response.message,
                showConfirmButton: false,
                timer: 2000
              }).then(function(){
                $('#form').hide('2000');
                location.reload();

              });
            },
          error: function(xhr, status, error) {
              // Tangani kesalahan jika terjadi
              console.error();
          }
        });
      });
    });


  </script>
<!-- End Script Edit dan SImpan SPJ Tiket Taksi -->


<?= $this->endSection(); ?>