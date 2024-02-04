
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
                  <th style="width: 70%">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Nomor SPT dan SPD</td>
                  <td><?= $data[0]->spt_nomor; ?> <br> <?= $data[0]->sppd_nomor; ?></td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>Tanggal SPT dan SPD</td>
                  <td><?=date('d F Y', strtotime($data[0]->spt_tgl));?></td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Tanggal Berangkat dan Kembali</td>
                  <td><?=date('d F Y', strtotime($data[0]->spt_mulai));?> &nbsp;&nbsp;&nbsp; s.d &nbsp;&nbsp;&nbsp; <?=date('d F Y', strtotime($data[0]->spt_berakhir));?></td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Lokasi Perjalanan Dinas</td>
                  <td>
                    <?= $data[0]->lokasiperjadin_nama; ?>
                  </td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Tujuan Perjaanan Dinas</td>
                  <td><?= $data[0]->spt_uraian; ?> ke <?= $data[0]->spt_tempat; ?></td>
                </tr>
                <tr>
                  <td></td><td></td><td></td>
                </tr>
              </tbody>
            </table>
            <?php $errors = session()->getFlashdata('validation')?>

            <div class="error"></div>

            <form action="<?= site_url('laporjadin/create'); ?>" method="post">
            <?= csrf_field() ?>
            <!-- <div class="form-group row"> -->
              <a href="<?= site_url('laporjadin'); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i>   Kembali</a>
              <button type="submit" class="btn bg-gradient-primary float-sm-right"  class="btn btn-primary" ><i class="fas fa-save"> </i>   Simpan Laporan</button>
              <!-- </div> -->
            </div>
            <div class="card-footer">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" hidden >Id Laporjadin</label>
                <div class="col">
                  <input type="text" class="form-control" name="laporjadin_id" value="<?= $data[0]->laporjadin_id; ?>" hidden>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" hidden>Id Pelaksana</label>
                <div class="col">
                  <input type="text" class="form-control" name="laporjadin_sptid" value="<?= $data[0]->spt_id; ?>" hidden>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Dasar No. DPA Kegiatan</label>
                  <div class="col">
                    <input type="text" class="form-control <?= isset($errors['laporjadin_nodpa']) ? 'is-invalid' : null ; ?>" name="laporjadin_nodpa" value="<?= ($data[0]->laporjadin_id == null) ? old('laporjadin_nodpa') : $data[0]->laporjadin_nodpa ?>" >
                      <div class="invalid-feedback">
                          <?= isset($errors['laporjadin_nodpa']) ? $errors['laporjadin_nodpa'] : null ; ?>
                      </div>
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Pembukaan</label>
                  <div class="col">
                    <textarea id="summernote1" name="laporjadin_pembuka" class="form-control <?= isset($errors['laporjadin_pembuka']) ? 'is-invalid' : null ; ?>"><?= ($data[0]->laporjadin_id == null) ? old('laporjadin_pembuka') : $data[0]->laporjadin_pembuka ?></textarea>
                      <div class="invalid-feedback">
                          <?= isset($errors['laporjadin_pembuka']) ? $errors['laporjadin_pembuka'] : null ; ?>
                      </div>
                    <p class="text-primary">
                      Ketik <u>Pejabat yang ditemui  </u> <em>saat Konsultasi beserta jabatannya</em>  <strong>pada teks area di atas Tulisan ini</strong>
                      <br>
                      <i>Seret garis 3 ditengah bawah kotak di atas ini untuk memperbesar area ketik</i></p>
                  </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Hasil Konsultasi</label>
                  <div class="col">
                    <textarea id="summernote2" name="laporjadin_hasil" class="form-control <?= isset($errors['laporjadin_hasil']) ? 'is-invalid' : null ; ?>"><?= ($data[0]->laporjadin_id == null) ? old('laporjadin_hasil') : $data[0]->laporjadin_hasil ?></textarea>
                      <div class="invalid-feedback">
                            <?= isset($errors['laporjadin_hasil']) ? $errors['laporjadin_hasil'] : null ; ?>
                      </div>
                    <p class="text-primary">
                      Ketik <em>Resume </em> <u> Hasil Konsultasi</u> <strong> pada Teks Area di atas Tulisan ini</strong>
                      <br>
                      <i>Seret garis 3 ditengah bawah kotak di atas ini untuk memperbesar area ketik</i></p>
                  </div>
              </div>
              
              <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Penutup</label>
                  <div class="col">
                    <textarea id="summernote3" name="laporjadin_penutup" class="form-control <?= isset($errors['laporjadin_penutup']) ? 'is-invalid' : null ; ?>"><?= ($data[0]->laporjadin_id == null) ? old('laporjadin_penutup') : $data[0]->laporjadin_penutup ?></textarea>
                      <div class="invalid-feedback">
                        <?= isset($errors['laporjadin_penutup']) ? $errors['laporjadin_penutup'] : null ; ?>
                      </div>
                    <p class="text-primary">
                      Ketik <em>Kata </em> <u> Penutup dari Hasil Konsultasi</u> <strong> pada Teks Area di atas Tulisan ini</strong>
                      <br>
                      <i>Seret garis 3 ditengah bawah kotak di atas ini untuk memperbesar area ketik</i></p>
                  </div>
              </div>
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