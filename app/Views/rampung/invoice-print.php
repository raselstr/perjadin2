<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Invoice Print</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="callout callout-info">
                <div class="row">
                  <div class="col-8">
                    <h5><i class="fas fa-info"></i> Perhitungan Rampung:</h5>
                    Perhitungan Rampung seluruh bukti pengeluaran biaya Perjalanan Dinas
                  </div>
                </div>
              </div>


              <!-- Main content -->
              <div class="invoice p-3 mb-3">
                <!-- title row -->
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <i class="fas fa-globe"></i> BADAN KEUANGAN DAN ASET DAERAH KABUPATEN ASAHAN.
                      <small class="float-right">Date: </small>
                    </h4>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- info row -->
                <?php foreach ($data as $key => $value) : ?>
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                      <strong>GUSLAN HARAHAP</strong><br>
                      NIP. 198101992000011001<br>
                      Jabatan : BENDAHARA PENGELUARAN<br>    
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    Kepada
                    <address>
                      <strong><?= $value->pegawai_nama; ?></strong><br>
                      NIP. <?= $value->pegawai_nip; ?><br>
                      Jabatan : <?= $value->pegawai_jabatan; ?><br>
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 invoice-col">
                    <b>Lampiran SPD Nomor : <?= $value->sppd_nomor; ?></b><br>
                    <br>
                    <b>Tanggal SPD : </b><?=date('d F Y', strtotime($value->spt_nomor));?><br>
                  </div>
                  <!-- /.col -->
                </div>
                <?php endforeach ?>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width:3%">No</th>
                          <th colspan="3" class="align-middle text-center">Rincian</th>
                          <th class="align-middle text-center">Jumlah</th>
                          <th class="align-middle text-center">Subtotal</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1; foreach ($all as $key => $value) : ?>
                        <tr>
                          <td rowspan="6"><?= $no++; ?></td>
                          <td style="width:30%" rowspan="6"><i><?= $value->pegawai_nama; ?><br>NIP. <?= $value->pegawai_nip; ?></i></td>
                          <td colspan="2">Uang Harian</td>
                          <td class="align-middle text-right">99.000.000,00</td>
                          <td class="align-top text-right" rowspan="6"><strong>99.000.000,00</strong></td>
                        </tr>
                        <tr>
                          <td style="width:15%" rowspan="2">Biaya Trasportasi</td>
                          <td>Pesawat</td>
                          <td class="align-middle text-right">1.500.000,00</td>
                        </tr>
                        <tr>
                          <td>Taksi</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="2">Biaya Penginapan</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="2">Uang Representasi</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td colspan="2">Sewa Kendaraan</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-6">
                    <p class="lead">Metode Pembayaran :</p>
                    <img src="dist/img/credit/visa.png" alt="Visa">
                    <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="dist/img/credit/american-express.png" alt="American Express">
                    <img src="dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                      Semua bukti telah diperiksa dan diverifikasi kemudian dinyatakan sah,
                      Total perhitungan rampung telah dibuktikan dengan dokumen pembayaran asli
                      sebagai pertanggungjawaban Perjalanan Dinas.
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-6">
                    <p class="lead">Dikeluarkan Tanggal 2/22/2014</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <th style="width:50%">Total Keselruhan :</th>
                          <td class="align-middle text-right"><strong>99.000.000,00</strong></td>
                        </tr>
                        <tr>
                          <th></th>
                          <td></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    <a href="pembayaran.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                      Payment
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                      <i class="fas fa-download"></i> Generate PDF
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
