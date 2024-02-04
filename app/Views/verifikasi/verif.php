
<?=$this->extend('layout/default');?>

<?=$this->section('stylesheet');?>
   <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

<?=$this->endSection();?>

<?=$this->section('scriptplugin');?>
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
 
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  
  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

 <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/jquery.inputmask.min.js"></script>

<?=$this->endSection();?>

<?=$this->section('content')?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <?=$this->include('layout/contenheader');?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?=$this->include('layout/infobox');?>
      </div>
      <div class="col">
        <div class="card card-primary card-outline">
          <div class="card-header">
              <h5 class="card-title"><?=$title;?></h5>
          </div>
          <div class="card-body">
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
                  <td>Nomor SPT dan SPD</td>
                  <td colspan="3"><?= $data["data"][0]->spt_nomor; ?> <br> <?= $data["data"][0]->sppd_nomor; ?></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Tanggal SPT dan SPD</td>
                  <td colspan="3"><?=date('d F Y', strtotime($data["data"][0]->spt_tgl));?></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Tanggal Berangkat dan Kembali</td>
                  <td colspan="3"><?=date('d F Y', strtotime($data["data"][0]->spt_mulai));?> &nbsp;&nbsp;&nbsp; s.d &nbsp;&nbsp;&nbsp; <?=date('d F Y', strtotime($data["data"][0]->spt_berakhir));?></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Lokasi Perjalanan Dinas</td>
                  <td colspan="3">
                    <?= $data["data"][0]->lokasiperjadin_nama; ?>
                  </td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Tujuan Perjaanan Dinas</td>
                  <td colspan="3"><?= $data["data"][0]->spt_uraian; ?> ke <?= $data["data"][0]->spt_tempat; ?></td>
                </tr>
                <tr>
                  <td rowspan = <?= $data['jumlah'] + 1; ?>>6.</td>
                  <td rowspan = <?= $data['jumlah'] + 1; ?>>Pegawai yang melaksanakan</td>
                </tr>
                <?php $no = 1; 
                  foreach ($data["data"] as $key => $value) : ?>
                <tr>
                  <td style="width: 2%"><?= $no++; ?>.</td>
                  <td><?= $value->pegawai_nama; ?><br>NIP. <?= $value->pegawai_nip; ?></td>
                  <td><a href="<?= site_url('verifikasi/show/'.$value->pelaksana_id); ?>" type="button" class="btn bg-gradient-success float-sm-left" ><i class="fas fa-hand-point-right"> </i> Pertanggungjawaban</a></td>
                </tr>
                <?php endforeach ?>
                
                <tr>
                  <td>7.</td>
                  <td>Laporan Pelaksanaan</td>
                  <td></td>
                  <td></td>
                  <td><a href="<?= site_url('verifikasi/showlapor/'.$value->spt_id); ?>" type="button" class="btn bg-gradient-info float-sm-left" ><i class="fas fa-hand-point-right"> </i> Laporan Pelaksanaan</a></td>
                </tr>
              </tbody>
            </table>
            <?php $errors = session()->getFlashdata('validation')?>
            <form action="<?= site_url('laporjadin/create'); ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group row">
              <a href="<?= site_url('verifikasi'); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i>   Kembali</a>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  



<?=$this->endSection()?>

<?=$this->section('script')?>
  <script>
    $(function () {
      // Summernote
      $('#summernote1').summernote()
      $('#summernote2').summernote()
      $('#summernote3').summernote()
    });
  </script>

  

<?=$this->endSection()?>