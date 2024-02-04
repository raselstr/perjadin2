<?php use App\Models\RampungModel;
use SebastianBergmann\Invoker\Invoker;

  $model = new RampungModel();
  
?>

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
            <table class="table table-sm">
              <thead>
                <tr>
                  <th style="width: 20px"></th>
                  <th>Uraian</th>
                  <th style="width: 70%" colspan="3">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1.</td>
                  <td>Nomor SPT dan SPD</td>
                  <td colspan="3"><?= $data["data"][0]->spt_nomor; ?> &nbsp;&nbsp;&nbsp; dan &nbsp;&nbsp;&nbsp; <?= $data["data"][0]->sppd_nomor; ?></td>
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
                  <td>Nama : <?= $value->pegawai_nama; ?>.,&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NIP. <?= $value->pegawai_nip; ?>
                    <br>Jabatan : <?= $value->pegawai_jabatan; ?>
                  </td>
                </tr>
                <tr>
                  <td></td>
                </tr>
                <?php endforeach ?>
              </tbody>
            </table>
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Hotel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Pesawat</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Taksi</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-harian-tab" data-toggle="pill" href="#custom-tabs-one-harian" role="tab" aria-controls="custom-tabs-one-harian" aria-selected="false">Uang Harian</a>
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
                      <?php $no = 1; foreach ($hotel['data'] as $key => $value) : ?>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Nama Hotel</td>
                          <td><?= $value->spjhotel_nama; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Lokasi</td>
                          <td><?= $value->spjhotel_lokasi; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Nomor Kamar</td>
                          <td><?= $value->spjhotel_nokamar; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Tipe Kamar</td>
                          <td><?= $value->spjhotel_typekamar; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Cin & Cout</td>
                          <td><?= date('d F Y', strtotime($value->spjhotel_checkin)); ?> &nbsp;&nbsp;&nbsp;&nbsp; s.d &nbsp;&nbsp;&nbsp;&nbsp; <?= date('d F Y', strtotime($value->spjhotel_checkout)); ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Harga Per Malam</td>
                          <td><?= $value->spjhotel_hargapermalam; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Harga Total</td>
                          <td><?= $value->spjhotel_hargatotal; ?></td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Validasi</td>
                          <td>
                            <?php if($value->spjhotel_verif == 0) : ?>
                              <button type="button" class="btn bg-gradient-warning " data-toggle="modal" data-target="#modalverif" data-idhotel="<?=$value->spjhotel_id;?>"><i class="fas fa-times"> </i> Bukti Hotel Belum di Verifikasi </button>
                            <?php else : ?>
                              <button type="button" class="btn bg-gradient-success " data-toggle="modal" data-target="#modalverif" data-idhotel="<?=$value->spjhotel_id;?>"><i class="fas fa-check"> </i> Bukti Hotel sudah di Verifikasi </button>
                            <?php endif ?>
                          </td>
                        </tr>
                        <tr>
                          <td><?= $no++; ?>.</td>
                          <td>Bill</td>
                          <td>
                            <iframe src="<?= base_url('image/hotel/bill/' . $value->spjhotel_bill)?>" width="100%" height="600" style="border:1px solid #666;"></iframe>
                          </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                  <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 20px">#</th>
                          <th>Uraian</th>
                          <th style="width: 80%">Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach ($pesawat as $key => $value) : ?>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Maskapai</td>
                            <td><?= $value->spjpesawat_maskapai; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Jenis</td>
                            <td><?= $value->spjpesawat_jenis; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Kode Boking <?= $value->spjpesawat_jenis; ?></td>
                            <td><?= $value->spjpesawat_kdboking; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Tujuan </td>
                            <td><?= $value->spjpesawat_ke; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Tanggal <?= $value->spjpesawat_jenis; ?></td>
                            <td><?= date('d F Y', strtotime($value->spjpesawat_tgl)); ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Harga Tiket Per Orang</td>
                            <td><?= $value->spjpesawat_harga; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Validasi</td>
                            <td>
                              <?php if($value->spjpesawat_verif == 0) : ?>
                                <button type="button" class="btn bg-gradient-warning " data-toggle="modal" data-target="#modalverifpesawat" data-idpes="<?=$value->spjpesawat_id;?>"><i class="fas fa-times"> </i> Bukti Pesawat Belum di Verifikasi </button>
                              <?php else : ?>
                                <button type="button" class="btn bg-gradient-success " data-toggle="modal" data-target="#modalverifpesawat" data-idpes="<?=$value->spjpesawat_id;?>"><i class="fas fa-check"> </i> Bukti Pesawat sudah di Verifikasi </button>
                              <?php endif ?>
                            </td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Boarding Tiket <?= $value->spjpesawat_jenis; ?></td>
                            <td>
                              <img src="<?= base_url('image/pesawat/tiket/' . $value->spjpesawat_fototiket)?>" width="100%" height="200" style="border:1px solid #666;">
                            </td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Bill <?= $value->spjpesawat_jenis; ?></td>
                            <td>
                              <iframe src="<?= base_url('image/pesawat/bill/' . $value->spjpesawat_bill)?>" width="100%" height="400" style="border:1px solid #666;"></iframe>
                            </td>
                          </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                  <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 20px">#</th>
                          <th>Uraian</th>
                          <th style="width: 80%">Keterangan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach ($taksi as $key => $value) : ?>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Jenis</td>
                            <td><?= $value->spjtaksi_jenis; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Tujuan dari </td>
                            <td><?= $value->spjtaksi_dari; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Ke </td>
                            <td><?= $value->spjtaksi_ke; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Tanggal <?= $value->spjtaksi_jenis; ?></td>
                            <td><?= date('d F Y', strtotime($value->spjtaksi_tgl)); ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Harga Tiket Per Orang</td>
                            <td><?= $value->spjtaksi_harga; ?></td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Validasi</td>
                            <td>
                              <?php if($value->spjtaksi_verif == 0) : ?>
                                <button type="button" class="btn bg-gradient-warning " data-toggle="modal" data-target="#modalveriftaksi" data-idtaksi="<?=$value->spjtaksi_id;?>"><i class="fas fa-times"> </i> Bukti Taksi Belum di Verifikasi </button>
                              <?php else : ?>
                                <button type="button" class="btn bg-gradient-success " data-toggle="modal" data-target="#modalveriftaksi" data-idtaksi="<?=$value->spjtaksi_id;?>"><i class="fas fa-check"> </i> Bukti Taksi sudah di Verifikasi </button>
                              <?php endif ?>
                            </td>
                          </tr>
                          <tr>
                            <td><?= $no++; ?>.</td>
                            <td>Tiket <?= $value->spjtaksi_jenis; ?></td>
                            <td>
                              <img src="<?= base_url('image/taksi/tiket/' . $value->spjtaksi_fototiket)?>" width="100%" height="200" style="border:1px solid #666;">
                            </td>
                          </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-harian" role="tabpanel" aria-labelledby="custom-tabs-one-harian-tab">
                  
                  <?php foreach ($data['data'] as $key => $value) : ?>
                    <?php $qrperbup = $model->rampungperbup($value->spt_id, $value->lokasiperjadin_id);?>
                      <form action="<?=site_url('uangharian/create');?>" method="post" id="formharian">
                        <?=csrf_field();?>
                            <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
                            <!-- <div class="form-group row"> -->
                              <!-- <label class="col-sm-4 col-form-label" hidden >Id Uang Harian</label>
                              <div class="col"> -->
                                <input type="text" class="form-control" id="uangharian_id" name="uangharian_id" value="<?= $uh[0]->uangharian_id ?>" hidden>
                              <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="form-group row"> -->
                              <!-- <label class="col-sm-4 col-form-label" hidden>Id Pelaksana</label> -->
                              <!-- <div class="col"> -->
                                <input type="text" class="form-control" id="uangharian_idpelaksana" name="uangharian_idpelaksana" value = <?= $value->pelaksana_id; ?> hidden>
                              <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="form-group row"> -->
                              <!-- <label class="col-sm-4 col-form-label" hidden >Id SPT</label hidden> -->
                              <!-- <div class="col"> -->
                                <input type="text" class="form-control" id="uangharian_sptid" name="uangharian_sptid" value = <?= $value->spt_id; ?> hidden>
                              <!-- </div> -->
                            <!-- </div> -->
                            <!-- <div class="form-group row"> -->
                              <!-- <label class="col-sm-4 col-form-label" hidden>Id Tingkat SPPD</label> -->
                              <!-- <div class="col"> -->
                                <input type="text" class="form-control" id="uangharian_tingkatid" name="uangharian_tingkatid" value = <?= $value->pegawai_tingkat; ?> hidden>
                                <input type="text" class="form-control" id="uangharian_verif" name="uangharian_verif" value = "1"  hidden>
                              <!-- </div> -->
                            <!-- </div> -->
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" hidden>Id Lokasi</label>
                              <div class="col">
                                <input type="text" class="form-control" id="uangharian_lokasiid" name="uangharian_lokasiid" value = <?= $value->lokasiperjadin_id ?> hidden>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" >Id Lama Perjalanan</label>
                              <div class="col">
                                <input type="text" class="form-control" id="uangharian_lama" name="uangharian_lama" value = <?= $value->spt_lama ?>  readonly>
                              </div>
                            </div>
                            <?php $qrperbup = $model->rampungperbup($value->spt_id, $value->pelaksana_id);?>
                            <?php foreach ($qrperbup as $key => $harian): ?>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label">Uang Harian Perhari</label>
                              <div class="col-sm-2">
                                  <?php if($harian->spt_acara == 1 ) {
                                        $harian = $harian->perbup_uhdiklat ;
                                      } elseif ($harian->spt_acara == 2){
                                        $harian = $harian->perbup_uhrapat_fullboad ;
                                      } elseif ($harian->spt_acara == 3){
                                        $harian = $harian->perbup_uhrapat_fullday ;
                                      } elseif ($harian->spt_acara == 4){
                                        $harian = $harian->perbup_uhrapat_residencedlmkota ;
                                      } else {
                                        $harian = $harian->perbup_uh ;
                                  }?>

                                <input type="text" class="form-control" id="uangharian_perhari" name="uangharian_perhari" value = <?= $harian ?> readonly>
                              </div>
                              <label class="col-sm-2 col-form-label align-middle text-right">Jumlah</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="uangharian_jumlah" name="uangharian_jumlah" value = <?= intval($value->spt_lama)*intval($harian) ?>  readonly>
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" >Biaya Transport</label>
                              <div class="col">
                                <?php if($value->spt_jenis == 1 ) {
                                  foreach ($qrperbup as $key => $transport) {
                                    $transfort = $transport->perbup_taksi_transportdarat;
                                    }
                                  } else {
                                    foreach ($qrperbup as $key => $transport) {
                                    $transfort = 0;
                                    }
                                  }?>
                                <input type="text" class="form-control" id="uangharian_biayatransport" name="uangharian_biayatransport" value = <?= $transfort ?> readonly>
                              </div>
                              <label class="col-sm-2 col-form-label align-middle text-right">Jumlah</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="uangharian_jumlahbiayatransport" name="uangharian_jumlahbiayatransport" value = <?= intval($value->spt_lama)*intval($transfort) ?> readonly >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" >Uang Representasi</label>
                              <div class="col">
                                <?php
                                  foreach ($qrperbup as $key => $representasi) {
                                    $representasi = $representasi->perbup_representasi;
                                    }                                 
                                ?>
                                <input type="text" class="form-control" id="uangharian_representasi" name="uangharian_representasi" value = <?= $representasi ?> readonly>
                              </div>
                              <label class="col-sm-2 col-form-label align-middle text-right">Jumlah</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="uangharian_jumlahrepresentasi" name="uangharian_jumlahrepresentasi" value = <?= intval($value->spt_lama)*intval($representasi) ?> readonly  >
                              </div>
                            </div>
                            <div class="form-group row">
                              <label class="col-sm-4 col-form-label" >Sewa Mobil Per 8 Jam</label>
                              <div class="col">
                                <?php
                                  foreach ($qrperbup as $key => $sewa) {
                                    $sewa = $sewa->perbup_sewakendaraan;
                                    }                                 
                                ?>
                                <input type="text" class="form-control" id="uangharian_sewamobil" name="uangharian_sewamobil" value = <?= $sewa ?> readonly>
                              </div>
                              <label class="col-sm-2 col-form-label align-middle text-right">Jumlah</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="uangharian_jumlahsewamobil" name="uangharian_jumlahsewamobil" value = <?= intval($value->spt_lama)*intval($sewa) ?>  readonly>
                              </div>
                            </div>
                            <?php endforeach ?>
                            <div class="row">
                              <div class="col">
                                <?php if($uh[0]->uangharian_verif == null) : ?>
                                  <button type="submit" class="btn bg-gradient-danger float-right">Belum di Verifikasi</button>
                                  <?php else : ?>
                                    <button type="submit" class="btn bg-gradient-primary float-right">Sudah di Verifikasi</button>
                                  <?php endif ?>
                              </div>
                            </div>
                          </div>
                      </form>
                  <?php endforeach ?>
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
          <form action="<?= site_url('spjhotel/verif'); ?>" method="post" id="formverif">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjpes_id" name="spjhotel_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjhotel_verif" value="1" id="cek1" checked>
                        <label class="form-check-label">Disetujui</label>
                      </div>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjhotel_verif" value="0" id="cek0">
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
  <!-- Modal verif Pesawat -->
    <div class="modal fade" id="modalveriftaksi" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Verifikasi</h4>
          </div>
          <form action="<?= site_url('spjtaksi/verif'); ?>" method="post" id="formveriftaksi">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjtaksi_id" name="spjtaksi_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjtaksi_verif" value="1" id="cek1" checked>
                        <label class="form-check-label">Disetujui</label>
                      </div>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjtaksi_verif" value="0" id="cek0">
                        <label class="form-check-label">Ditolak</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-danger saveveriftaksi">Kirim</button>
              </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->
  <!-- Modal verif taksi -->
    <div class="modal fade" id="modalverifpesawat" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Verifikasi</h4>
          </div>
          <form action="<?= site_url('spjpesawat/verif'); ?>" method="post" id="formverifpesawat">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjpesawat_id" name="spjpesawat_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjpesawat_verif" value="1" id="cek1" checked>
                        <label class="form-check-label">Disetujui</label>
                      </div>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjpesawat_verif" value="0" id="cek0">
                        <label class="form-check-label">Ditolak</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-right">
                <button type="submit" class="btn btn-danger saveverifpesawat">Kirim</button>
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
          var idhotel = $(this).data('idhotel');
          $('#spjpes_id').val(idhotel);
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

  <!-- Script Validasi Tiket Pesawat -->
    <script>
      $(document).ready(function(){
        $('[data-target="#modalverifpesawat"]').click (function() {
          var idpes = $(this).data('idpes');
          $('#spjpesawat_id').val(idpes);
        });

        $('#formverifpesawat').submit(function(e){
          e.preventDefault();
          var dataverif = new FormData(this);
          
          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: dataverif,
            processData: false,
            contentType: false,
            beforeSend:function(){
                  $('.saveverifpesawat').attr('disabled', 'disabled');
                  $('.saveverifpesawat').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.saveverifpesawat').removeAttr('disabled');
                  $('.saveverifpesawat').html('Simpan');
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
                    $('#modalverifpesawat').hide('2000');
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
  <!-- End Script Validasi Tiket Pesawat -->

  <!-- Script Validasi Tiket Taksi -->
    <script>
      $(document).ready(function(){
        $('[data-target="#modalveriftaksi"]').click (function() {
          var idtaksi = $(this).data('idtaksi');
          $('#spjtaksi_id').val(idtaksi);
        });

        $('#formveriftaksi').submit(function(e){
          e.preventDefault();
          var dataverif = new FormData(this);
          
          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: dataverif,
            processData: false,
            contentType: false,
            beforeSend:function(){
                  $('.saveveriftaksi').attr('disabled', 'disabled');
                  $('.saveveriftaksi').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.savenveriftaksi').removeAttr('disabled');
                  $('.saveveriftaksi').html('Simpan');
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
                    $('#modalveriftaksi').hide('2000');
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
  <!-- End Script Validasi Tiket taksi -->

  
<?=$this->endSection()?>