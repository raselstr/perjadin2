<?php use App\Models\VerifModel; 
  $model = new VerifModel();
?>


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
                    <th rowspan="2" class="align-middle text-center">SPT - SPD - Tujuan Perjalanan Dinas</th>
                    <th colspan="5" class="align-middle text-center">Validasi Pertanggung Jawaban</th>
                  </tr>
                  <tr>
                    <th class="align-middle text-center">Hotel</th>
                    <th class="align-middle text-center">Pesawat PP</th>
                    <th class="align-middle text-center">Taksi PP</th>
                    <th class="align-middle text-center">Pelaksanaan</th>
                    <th class="align-middle text-center">Uang Harian</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1;
                    foreach ($data as $key => $value) { ?>
                      <tr>
                        <td class="align-middle text-center"><?= $no++ ?></td>
                        <td class="align-middle text-center">
                          <a href="<?= site_url('verifikasi/form/'.$value->spt_id); ?>" type="button" class="btn bg-secondary" title="Input Laporan Hasil"><i class="fas fa-newspaper"></i>  </a>
                        </td>
                        <td class="align-middle">
                          No. SPT : <?= $value->spt_nomor ?><br>
                          No. SPD : <?= $value->sppd_nomor ?><br>
                          Tanggal : <?= date('d F Y',strtotime($value->spt_tgl)) ?><br>
                          Uraian : <?= $value->spt_uraian ?>
                        </td>
                        <td class="align-middle">
                          <?php 
                            $qrhotelall = $model->verifdatahotel($value->spt_id);
                            $qrhotelval = $model->verifdatahotelval($value->spt_id);
                            ?>
                              <button type="button" class="btn btn-block btn-outline-danger btn-xs" >Total : <?= $qrhotelall; ?></button>
                              <button type="button" class="btn btn-block btn-outline-success btn-xs">Validasi : <?= $qrhotelval; ?></button>
                        </td>
                        <td class="align-middle text-center">
                          <?php
                            $qrpesawatall = $model->verifdatapesawat($value->spt_id);
                            $qrpesawatval = $model->verifdatapesawatval($value->spt_id);
                            ?>
                              <button type="button" class="btn btn-block btn-outline-danger btn-xs" >Total : <?=$qrpesawatall;?></button>
                              <button type="button" class="btn btn-block btn-outline-success btn-xs">Validasi : <?=$qrpesawatval;?></button>
                        </td>
                        <td class="align-middle">
                          <?php
                            $qrtaksiall = $model->verifdatataksi($value->spt_id);
                            $qrtaksival = $model->verifdatataksival($value->spt_id);
                            ?>
                              <button type="button" class="btn btn-block btn-outline-danger btn-xs" >Total : <?=$qrtaksiall;?></button>
                              <button type="button" class="btn btn-block btn-outline-success btn-xs">Validasi : <?=$qrtaksival;?></button>
                        </td>
                        <td class="align-middle text-center">
                          <?php
                            $qrlaporall = $model->verifdatalapor($value->spt_id);
                            $qrlaporval = $model->verifdatalaporval($value->spt_id);
                          ?>
                            <button type="button" class="btn btn-block btn-outline-danger btn-xs" >Total : <?=$qrlaporall;?></button>
                            <button type="button" class="btn btn-block btn-outline-success btn-xs">Validasi : <?=$qrlaporval;?></button>

                        </td>
                        <td></td>
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