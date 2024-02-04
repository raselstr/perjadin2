
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
        <div class="card card-primary card-tabs">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              <?= $title; ?>
            </h3>
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
                  <td></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Laporan Pelaksanaan</a>
              </li>
          </ul>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th style="width: 20px">#</th>
                        <th>Uraian</th>
                        <th style="width: 80%">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; foreach ($perjadin as $key => $value) : ?>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Laporan Pembuka</td>
                          <td><?= $value->laporjadin_pembuka; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Laporan Konsultasi</td>
                          <td><?= $value->laporjadin_hasil; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Laporan Penutup</td>
                          <td><?= $value->laporjadin_penutup; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Validasi</td>
                          <td>
                            <?php if($value->laporjadin_verif == 0) : ?>
                              <button type="button" class="btn bg-gradient-warning " data-toggle="modal" data-target="#modalverif" data-idlapor="<?=$value->laporjadin_id;?>"><i class="fas fa-times"> </i> Bukti Belum di Verifikasi </button>
                            <?php else : ?>
                              <button type="button" class="btn bg-gradient-success " data-toggle="modal" data-target="#modalverif" data-idlapor="<?=$value->laporjadin_id;?>"><i class="fas fa-check"> </i> Bukti sudah di Verifikasi </button>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Dokumentasi</td>
                          <td>
                            <div class="card-body">
                              <div class="row mt-4">
                                <div class="col-sm-4">
                                  <div class="position-relative">
                                    <img src="<?= base_url('image/dokuemtasi/'.$value->laporjadin_foto1) ?>" alt="Photo 1" class="img-fluid">
                                    <div class="ribbon-wrapper ribbon-xl">
                                      <div class="ribbon bg-warning text-lg">
                                        Dokumentasi 1
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="position-relative">
                                    <img src="<?= base_url('image/dokuemtasi/'.$value->laporjadin_foto2) ?>" alt="Photo 2" class="img-fluid">
                                    <div class="ribbon-wrapper ribbon-xl">
                                      <div class="ribbon bg-warning text-lg">
                                        Dokumentasi 2
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="position-relative" style="min-height: 180px;">
                                    <img src="<?= base_url('image/dokuemtasi/'.$value->laporjadin_foto3) ?>" alt="Photo 3" class="img-fluid">
                                    <div class="ribbon-wrapper ribbon-xl">
                                      <div class="ribbon bg-warning text-lg">
                                        Dokumentasi 3
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="<?= site_url('verifikasi/form/'.$value->spt_id); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i>   Kembali</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal verif -->
    <div class="modal fade" id="modalverif" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Verifikasi</h4>
          </div>
          <form action="<?= site_url('laporjadin/verif'); ?>" method="post" id="formverif">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjpes_id" name="laporjadin_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="laporjadin_verif" value="1" id="cek1" checked>
                        <label class="form-check-label">Disetujui</label>
                      </div>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="laporjadin_verif" value="0" id="cek0">
                        <label class="form-check-label">Ditolak</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-danger saveverif">Kirim</button>
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->
  

<?=$this->endSection()?>

<?=$this->section('script')?>
  <!-- Script Validasi Tiket Hotel -->
    <script>
      $(document).ready(function(){
        $('[data-target="#modalverif"]').click (function() {
          var idlapor = $(this).data('idlapor');
          $('#spjpes_id').val(idlapor);
        });

        $('#formverif').submit(function(e){
          e.preventDefault();
          var dataverif = new FormData(this);
          
          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: dataverif,
            processData: false,
            contentType: false,
            beforeSend:function(){
                  $('.saveverif').attr('disabled', 'disabled');
                  $('.saveverif').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.savenverif').removeAttr('disabled');
                  $('.saveverif').html('Simpan');
              },
              
            success: function (response) {
              console.log(response);
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.messages,
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function(){
                    $('#modalverif').hide('2000');
                    location.reload();

                  });
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
          });
        });
      });
        

    </script>
  <!-- End Script Validasi Tiket Hotel -->
<?=$this->endSection()?>