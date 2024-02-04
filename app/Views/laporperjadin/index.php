
<?= $this->extend('layout/default'); ?>

<?= $this->section('stylesheet'); ?>
   <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

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
      <div class="flash-data" data-flashdata="<?= session()->getflashdata('info'); ?>"></div>
      <div class="col">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <div class="row">
              <h5 class="card-title"><?= $title; ?></h5>
            </div>
          </div>
          <div class="card-body">
            <div class="card-body">
              <table id="myTable1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th rowspan="2" class="align-middle text-center">No</th>
                    <th rowspan="2" class="align-middle text-center">Aksi</th>
                    <th rowspan="2" class="align-middle text-center">Pejabat Pemberi Tugas</th>
                    <th colspan="3" class="align-middle text-center">Data Perjalanan Dinas</th>
                    <th rowspan="2" class="align-middle text-center">Nomor SPT, <br>SPD</th>
                    <th rowspan="2" class="align-middle text-center">Tanggal SPT/ SPPD</th>
                  </tr>
                  <tr>
                    <th class="align-middle text-center">Uraian Perjalanan</th>
                    <th class="align-middle text-center">Lama Perjalanan</th>
                    <th class="align-middle text-center">Tempat Tujuan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    foreach ($data as $key => $value) { ?>
                      <tr>
                        <td class="align-middle text-center"><?= $no++ ?></td>
                        <td class="align-middle text-center">
                          <?php
                            $db = \Config\Database::connect();
                            $user = $db->query('SELECT * FROM laporjadins WHERE laporjadins.laporjadin_sptid ='. $value->spt_id);
                            $sum = $user->getNumRows();
                          ?>
                          <?php if($sum == 0) : ?>
                            <a href="<?= site_url('laporjadin/form/'.$value->spt_id); ?>" type="button" class="btn bg-secondary" title="Input Laporan Hasil"><i class="fas fa-newspaper"></i>  </a>
                          <?php else : ?>
                            <?php if($value->laporjadin_verif == 0) : ?>
                              <a href="<?= site_url('laporjadin/form/'.$value->spt_id); ?>" type="button" class="btn bg-primary" title="Edit Laporan Hasil"><i class="fas fa-edit"></i> </a>
                              <a href="<?= site_url('laporjadin/remove/'.$value->spt_id); ?>" type="button" class="btn bg-danger tombol-hapus" title="Hapus Laporan Hasil"><i class="fas fa-trash"></i> </a>
                              <a href="<?= site_url('laporjadin/formupload/'.$value->spt_id); ?>" type="button" class="btn bg-warning" title=" Upload Foto "><i class="fas fa-camera"></i></a>
                              <?php else : ?>  
                                <a href="<?= site_url('laporjadin/formupload/'.$value->spt_id); ?>" type="button" class="btn bg-warning" title=" Upload Foto "><i class="fas fa-camera"></i></a>
                              <?php endif ?>
                            <?php endif ?>
                        </td>
                        <td class="align-middle"><?= $value->spt_pjb_tugas ?></td>
                        <td class="align-middle"><?= $value->spt_uraian ?></td>
                        <td class="align-middle text-center"><?= $value->spt_lama ?></td>
                        <td class="align-middle"><?= $value->lokasiperjadin_nama ?></td>
                        <td class="align-middle text-center"><?= $value->spt_nomor ?><br><?= $value->sppd_nomor ?><br></td>
                        <td class="align-middle text-center"><?= date('d F Y',strtotime($value->spt_tgl)) ?></td>
                      </tr>
                    <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

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
  <script>
    const flashData = $('.flash-data').data('flashdata');
    if(flashData){
      Swal.fire({
        position: "center",
        icon: "success",
        title: flashData,
        showConfirmButton: false,
        timer: 2000
      });
    }
  </script>

  <!-- Script Hapus -->
    <script>
      $('.tombol-hapus').on('click', function(e){
        e.preventDefault();

        const href = $(this).attr('href');

        Swal.fire({
          title: "Apakah Anda yakin",
          text: "data akan dihapus permanen",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Hapus Data",
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        });
      });

    </script>
  <!-- End Script Hapus -->
<?= $this->endSection() ?>