
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

  <!-- SweetAlert2 -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>

 <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/jquery.inputmask.min.js"></script>

  <!-- date-range-picker -->
  <script src="plugins/daterangepicker/daterangepicker.js"></script>

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
            <div class="form-group row">
              <label class="col-sm-2 col-form-label" hidden>Id Pelaksana</label>
              <div class="col">
                <input type="text" class="form-control" name="pelaksana_id" value="<?=$data['data'][0]->pelaksana_id;?>" hidden>
              </div>
              <label class="col-sm-2 col-form-label" hidden>Id SPJ hotel</label>
              <div class="col">
                <input type="text" class="form-control" name="spjhotel_id" value="<?=$data['data'][0]->spjhotel_id;?>" hidden>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Pelaksana</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="pegawai_nama" value="<?=$data['data'][0]->pegawai_nama;?>" disabled>
              </div>
              <label class="col-sm-1 col-form-label text-right">No SPT</label>
              <div class="col-sm-3">
                <input type="text" class="form-control " name="pegawai_nama" value="<?=$data['data'][0]->spt_nomor;?>" disabled>
              </div>
              <label class="col-sm-1 col-form-label text-right">Tanggal SPT</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="spt_tgl" value="<?=date('d F Y', strtotime($data['data'][0]->spt_tgl));?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label ">Tujuan</label>
              <div class="col-sm-3">
                <textarea type="text" class="form-control" name="spt_mulai" disabled><?=$data['data'][0]->spt_tempat;?></textarea>
              </div>
              <label class="col-sm-1 col-form-label text-right">Tanggal Mulai</label>
              <div class="col-sm-2">
                <input type="text" id= "mulai" class="form-control" name="spt_mulai" value="<?=date('d F Y', strtotime($data['data'][0]->spt_mulai));?>" readonly>
              </div>
              <label class="col-sm-2 col-form-label text-right">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" id= "akhir" class="form-control" name="spt_berakhir" value="<?=date('d F Y', strtotime($data['data'][0]->spt_berakhir));?>" readonly>
              </div>
            </div>
            <!-- <div class="form-group row"> -->
              <a href="<?= site_url('spjhotel'); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i> Kembali</a>
              <button type="button" class="btn bg-gradient-primary float-sm-right"  data-idpelaksana="<?=$data['data'][0]->pelaksana_id;?>" class="btn btn-primary"  data-toggle="modal" data-target="#hotelspj"><i class="fas fa-hand-point-right"> </i> Tambah SPJ Hotel</button>
            <!-- </div> -->
            </div>
          </div>

          <div class="card-footer">
            <table id="myTable1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="align-middle text-center">No</th>
                  <th class="align-middle text-center">Aksi</th>
                  <th class="align-middle text-center">Bill</th>
                  <th class="align-middle text-center">Nama Hotel</th>
                  <th class="align-middle text-center">Nomor Kamar</th>
                  <th class="align-middle text-center">Type Kamar</th>
                  <th class="align-middle text-center">Check In</th>
                  <th class="align-middle text-center">Check Out</th>
                  <th class="align-middle text-center">Total Biaya </th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $no = 1;
                    foreach ($data['data'] as $key => $value): ?>
                  <tr>
                    <td class="align-middle text-center"><?=$no++;?></td>
                    <td class="align-middle text-center">
                        <?php if ($value->spjhotel_verif == 0): ?>
                          <?php if($value->spjhotel_id <> null) : ?>
                            <button type="button" class="btn bg-gradient-info btn-xs" data-idhotel="<?=$value->spjhotel_id;?>" data-scanbilllama="<?=$value->spjhotel_bill;?>" data-toggle="modal" data-target="#hotelbill"><i class="fas fa-upload"> </i> <br>Upload Bukti</button>
                            <button type="button" class="btn bg-gradient-warning btn-xs" data-idhotel="<?=$value->spjhotel_id;?>" data-idpelaksana ="<?=$data['data'][0]->pelaksana_id;?>" id="tomboledit" data-toggle="modal" data-target="#hotelspj"><i class="fas fa-pen"> </i> <br>Edit</button>
                            <a href="<?=site_url('spjhotel/remove/' . $value->spjhotel_id)?>" type="button" class="btn bg-gradient-danger btn-xs tombol-hapus" data-idhotel=""><i class="fas fa-trash"> </i> <br>Hapus</a>
                          <?php endif ?>
                        <?php else: ?>
                          <button type="button" class="btn bg-gradient-success btn-xs"></i>Sudah DiVerifikasi</button>
                        <?php endif?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($value->spjhotel_bill != null): ?>
                              <button type="button" class="btn bg-gradient-success btn-xs" data-toggle="modal" data-target="#modalscan" data-scanbill="<?=$value->spjhotel_bill?>"><i class="fas fa-file-pdf"></i><br>Lihat Bill</button>
                      <?php else : ?>
                        <i>Bill hotel belum di upload</i>
                      <?php endif?>
                    </td>
                    <td class="align-middle text-center"><?=$value->spjhotel_nama;?><br><?=$value->spjhotel_id;?></td>
                    <td class="align-middle text-center"><?=$value->spjhotel_nokamar;?></td>
                    <td class="align-middle text-center"><?=$value->spjhotel_typekamar;?></td>
                    <td class="align-middle text-center"><?=$value->spjhotel_checkin == null ? "" : date('d F Y', strtotime($value->spjhotel_checkin));?></td>
                    <td class="align-middle text-center"><?=$value->spjhotel_checkout == null ? "" : date('d F Y', strtotime($value->spjhotel_checkout));?></td>
                    <td class="align-middle text-center"><?=number_format($value->spjhotel_hargatotal,2,',','.');?> </td>

                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Content Wrapper. Contains page content -->
  <!-- Modal SPJ Hotel -->
  <div class="modal fade" id="hotelspj">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">SPJ Hotel</h4>
        </div>
        <form action="<?=site_url('spjhotel/create');?>" method="post" id="formhotel">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id spjhotel</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_id" name="spjhotel_id" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id Pelaksana</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_pelaksanaid" name="spjhotel_pelaksanaid" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nama Hotel</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_nama" name="spjhotel_nama">
                    <div class="invalid-feedback errorspjhotel_nama"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Lokasi Hotel</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_lokasi" name="spjhotel_lokasi">
                    <div class="invalid-feedback errorspjhotel_lokasi"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nomor Kamar</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_nokamar" name="spjhotel_nokamar">
                    <div class="invalid-feedback errorspjhotel_nokamar"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tipe Kamar</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjhotel_typekamar" name="spjhotel_typekamar">
                    <div class="invalid-feedback errorspjhotel_typekamar"></div>
                  </div>
                </div>

                <!-- <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Checkin</label>
                  <div class="col">
                    <input type="date" class="form-control" id="spjhotel_checkin" name="spjhotel_checkin">
                    <div class="invalid-feedback errorspjhotel_checkin"></div>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Checkin</label>
                  <div class="col">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="checkin" name="spjhotel_checkin">
                      <div class="invalid-feedback errorspjhotel_checkin"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Lama menginap (mlm)</label>
                  <div class="col">
                    <input type="number" class="form-control" id="spjhotel_mlm" name="spjhotel_mlm">
                    <div class="invalid-feedback errorspjhotel_mlm"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Checkout</label>
                  <div class="col">
                    <input type="date" class="form-control" id="spjhotel_checkout" name="spjhotel_checkout" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Biaya Per Malam</label>
                  <div class="col">
                    <input type="number" class="form-control" id="spjhotel_hargapermalam" name="spjhotel_hargapermalam">
                    <div class="invalid-feedback errorspjhotel_hargapermalam"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Total Biaya Penginapan</label>
                  <div class="col">
                    <input type="number" class="form-control" id="spjhotel_hargatotal" name="spjhotel_hargatotal" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default batalhotel" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary simpanhotel">Save changes</button>
            </div>
          </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal SPJ Bill -->
  <div class="modal fade" id="hotelbill">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Tiket Hotel</h4>
        </div>
        <form action="<?=site_url('spjhotel/upload');?>" method="post" enctype="multipart/form-data" id="formupload">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" hidden>Id spjhotel</label>
                <div class="col">
                  <input type="text" class="form-control" id="id" name="spjhotel_id" hidden>
                  <input type="text" class="form-control" id="scanbilllama" name="scanbilllama" hidden>
                </div>
              </div>
              
              <div class="form-group row">
                <label for="exampleInputFile" class="col-sm-4 col-form-label">Scan PDF Bill Hotel</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <input class="custom-file-input" type="file" name="spjhotel_bill" id="scanbill">
                      <label class="custom-file-label" for="custom-file-label" id="nama-scan">Pilih Scan Bill Hotel</label>
                      <div class="invalid-feedback errorspjhotel_bill"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default batalupload" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary simpanupload">Simpan</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal Foto -->
    <div class="modal fade" id="modalfoto" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Foto Tiket</h4>
          </div>
          <div class="modal-body">
            <div class="col text-center">
              <p>Nama File : <span id="idmodalfoto"></span></p>
              <div id = "tampilfoto"></div>
            </div>
          </div>
          <div class="modal-footer justify-content-right">
            <button type="button" class="btn btn-danger tutupmodal" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->

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
                        <input class="form-check-input" type="radio" name="spjhotel_verif" value="1" id="cek1">
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

  <!-- Modal Scan Bill -->
    <div class="modal fade" id="modalscan" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Scan Bill</h4>
          </div>
          <div class="modal-body">
            <div class="col text-center">
              <p>Nama File : <span id="idmodalbill"></span></p>
              <div id = "tampilbill"></div>
            </div>
          </div>
          <div class="modal-footer justify-content-right">
            <button type="button" class="btn btn-danger tutupmodal" data-dismiss="modal">Close</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  <!-- /.modal -->

<?=$this->endSection()?>

<?=$this->section('script')?>

  <script>
    // Date range picker
    $(function() {
      $('#checkin').daterangepicker({
        autoUpdateInput: false,
        locale: {
          format: 'DD MMMM YYYY'
        },
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2023,
        maxYear: parseInt(moment().format('YYYY'),10),
        minDate: moment($('#mulai').val(), 'DD MMMM YYYY'),  // Gunakan moment.js untuk mem-parse tanggal dengan format yang benar
        maxDate: moment($('#akhir').val(), 'DD MMMM YYYY').add(2, 'days'),
      });
      // Menangani perubahan tanggal
        $('#checkin').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD MMMM YYYY'));
        });
      
    });
  </script>

  <!-- Script Tampilan Tabel -->
    <script>
      $(function () {
        $("#myTable1").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
          "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        })
      });
    </script>
  <!-- End Script Tampilan Tabel -->

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

  <!-- Script Modal Tampilakan Foto Tiket -->
    <script>
      $(document).ready(function(){

        $('[data-target="#modalfoto"]').on('click', function(e) {
          e.preventDefault();
            var namafoto = $(this).data('fototiket');
            var imageUrl = "<?=base_url('image/hotel/tiket/')?>" + namafoto
            $('#idmodalfoto').text(namafoto);
            // console.log(namafoto);
            var linkhotel = $('<img>').attr({
              'src': imageUrl,
              'alt': 'Deskripsi Gambar',
              'width': '100%',
              'height': '200'
            });

          $('#tampilfoto').html(linkhotel);
        });

        $('.tutupmodal').on('click', function(){
          location.reload();
        });
      });
    </script>
  <!-- End Script Modal Tampilakan Foto Tiket -->

  <!-- Script Modal Tampilkan Hasil Scan PDF -->
    <script>
      $(document).ready(function(){

        $('[data-target="#modalscan"]').on('click', function(e) {
          e.preventDefault();
            var namabill = $(this).data('scanbill');
            var imageUrl = "<?=base_url('image/hotel/bill/')?>" + namabill
            $('#idmodalbill').text(namabill);
            // console.log(namafoto);
            var linkbill = $('<iframe>').attr({
              'src': imageUrl,
              'title': 'Deskripsi bill',
              'width': '100%',
              'height': '200',
              'style' : 'border:none;'
            });

          $('#tampilbill').html(linkbill);
        });

        $('.tutupmodal').on('click', function(){
          location.reload();
        });
      });
    </script>
  <!-- End Script Modal Tampilkan Hasil Scan PDF -->

  <!-- Script Edit dan SImpan SPJ Tiket Hotel -->
    <script>
      $(document).ready(function(){
        $('[data-target="#hotelspj"]').click (function() {
          var idpelaksana = $(this).data('idpelaksana');
          $('#spjhotel_pelaksanaid').val(idpelaksana);

          var idhotel = $(this).data('idhotel');
          $('#spjhotel_id').val(idhotel);

          if(idhotel == null){
            $('#spjhotel_nama').val('');
            $('#spjhotel_lokasi').val('');
            $('#spjhotel_nokamar').val('');
            $('#spjhotel_typekamar').val('');
            $('#spjhotel_checkin').val('');
            $('#spjhotel_mlm').val('');
            $('#spjhotel_hargapermalam').val('');
            $('#spjhotel_ke').val('');
            $('#spjhotel_harga').val('');
            $('#hotelspj').show();

          } else {
            $.ajax({
              type: "get",
              url: "<?=site_url('spjhotel/edit/');?>" + idhotel,
              // data: "data",
              dataType: "json",
              success: function (response) {
                console.log(response);
                $('#spjhotel_nama').val(response.spjhotel_nama);
                $('#spjhotel_lokasi').val(response.spjhotel_lokasi);
                $('#spjhotel_nokamar').val(response.spjhotel_nokamar);
                $('#spjhotel_typekamar').val(response.spjhotel_typekamar);
                $('#spjhotel_checkin').val(response.spjhotel_checkin);
                $('#spjhotel_mlm').val(response.spjhotel_mlm);
                $('#spjhotel_hargapermalam').val(response.spjhotel_hargapermalam);
                $('#spjhotel_ke').val(response.spjhotel_ke);
                $('#spjhotel_harga').val(response.spjhotel_harga);
                $('#hotelspj').show();
              }
            });
          }
        });

        $('#formhotel').submit(function(e){
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
                  $('.simpanhotel').attr('disabled', 'disabled');
                  $('.simpanhotel').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpanhotel').removeAttr('disabled');
                  $('.simpanhotel').html('Simpan');
              },
            success: function (response) {
              console.log(response);
              if(response.error) {
                if(response.message.spjhotel_nama){
                        $('#spjhotel_nama').addClass('is-invalid');
                        $('.errorspjhotel_nama').html(response.message.spjhotel_nama);
                    } else {
                        $('#spjhotel_nama').removeClass('is-invalid');
                        $('.errorspjhotel_nama').html('');
                }
                if(response.message.spjhotel_lokasi){
                        $('#spjhotel_lokasi').addClass('is-invalid');
                        $('.errorspjhotel_lokasi').html(response.message.spjhotel_lokasi);
                    } else {
                        $('#spjhotel_lokasi').removeClass('is-invalid');
                        $('.errorspjhotel_lokasi').html('');
                }
                if(response.message.spjhotel_nokamar){
                        $('#spjhotel_nokamar').addClass('is-invalid');
                        $('.errorspjhotel_nokamar').html(response.message.spjhotel_nokamar);
                    } else {
                        $('#spjhotel_nokamar').removeClass('is-invalid');
                        $('.errorspjhotel_nokamar').html('');
                }
                if(response.message.spjhotel_typekamar){
                        $('#spjhotel_typekamar').addClass('is-invalid');
                        $('.errorspjhotel_typekamar').html(response.message.spjhotel_typekamar);
                    } else {
                        $('#spjhotel_typekamar').removeClass('is-invalid');
                        $('.errorspjhotel_typekamar').html('');
                }
                if(response.message.spjhotel_checkin){
                        $('#spjhotel_checkin').addClass('is-invalid');
                        $('.errorspjhotel_checkin').html(response.message.spjhotel_checkin);
                    } else {
                        $('#spjhotel_checkin').removeClass('is-invalid');
                        $('.errorspjhotel_checkin').html('');
                }
                if(response.message.spjhotel_mlm){
                        $('#spjhotel_mlm').addClass('is-invalid');
                        $('.errorspjhotel_mlm').html(response.message.spjhotel_mlm);
                    } else {
                        $('#spjhotel_mlm').removeClass('is-invalid');
                        $('.errorspjhotel_mlm').html('');
                }
                if(response.message.spjhotel_hargapermalam){
                        $('#spjhotel_hargapermalam').addClass('is-invalid');
                        $('.errorspjhotel_hargapermalam').html(response.message.spjhotel_hargapermalam);
                    } else {
                        $('#spjhotel_hargapermalam').removeClass('is-invalid');
                        $('.errorspjhotel_hargapermalam').html('');
                }
              } else {
                console.log(response);
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: response.message,
                  showConfirmButton: false,
                  timer: 2000
                }).then(function(){
                  $('#hotelspj').hide('2000');
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
        $('.batalhotel').on('click', function () {
          location.reload();
        });
      });


    </script>
  <!-- End Script Edit dan SImpan SPJ Tiket Hotel -->

  <!-- Script Upload Tiket dan Bill -->
    <script>
      $(document).ready(function(){
        $('[data-target="#hotelbill"]').click (function() {
          var idhotel = $(this).data('idhotel')
          var fototiketlama = $(this).data('fototiketlama')
          var scanbilllama = $(this).data('scanbilllama')
          $('#id').val(idhotel)
          $('#fototiketlama').val(fototiketlama)
          $('#scanbilllama').val(scanbilllama)

        });
        $('#fototiket').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            console.log('Nama file:', fileName);
            $('#nama-foto').text(fileName);
        });
        $('#scanbill').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            console.log('Nama file:', fileName);
            $('#nama-scan').text(fileName);
        });
        $('#formupload').submit(function(e){
          e.preventDefault();
          var dataupload = new FormData(this);

          $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: dataupload,
            processData: false,
            contentType: false,
            beforeSend:function(){
                  $('.simpanhotel').attr('disabled', 'disabled');
                  $('.simpanhotel').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpanhotel').removeAttr('disabled');
                  $('.simpanhotel').html('Simpan');
              },
            success: function (response) {
              console.log(response);
                if(response.errors) {
                  if(response.messages.idkosong){
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: response.messages.idkosong,
                      showConfirmButton: true,
                      // timer: 2000
                    }).then(function(){
                      $('#hotelbill').hide('2000');
                      location.reload();

                    });
                  } else {
                    
                    if(response.messages.spjhotel_bill){
                            $('#scanbill').addClass('is-invalid');
                            $('.errorspjhotel_bill').html(response.messages.spjhotel_bill);
                        } else {
                            $('#scanbill').removeClass('is-invalid');
                            $('.errorspjhotel_bill').html('');
                    }

                  }
                } else {
                  console.log(response);
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: response.messages,
                    showConfirmButton: false,
                    timer: 2000
                  }).then(function(){
                    $('#hotelbill').hide('2000');
                    location.reload();

                  });
                };
            },
            error: function(xhr, status, error) {
                // Tangani kesalahan jika terjadi
                console.error();
            }
          });
        });
        $('.batalupload').on('click', function () {
          location.reload();
        });
      });
    </script>
  <!-- End Script Upload Tiket dan Bill -->

  <!-- Script Validasi Tiket Hotel -->
    <script>
      $(document).ready(function(){
        $('[data-target="#modalverif"]').click (function() {
          var idpes = $(this).data('idpes');
          $('#spjpes_id').val(idpes);
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

  <!-- Tanggal Check Out Otomatis -->
    <script>
      $(document).ready(function() {
        function myFunction() {
          var jh = $("#spjhotel_mlm").val();
          var tglmulai = $("#checkin").val();
          var hari = jh * 24 * 60 * 60 * 1000;
          
          var hariakhir = new Date(new Date(tglmulai).getTime() + (hari) - 1);
          $("#spjhotel_checkout").val(hariakhir.toISOString().slice(0, 10));

          var harga = $('#spjhotel_hargapermalam').val();
          var totalharga = harga * jh;
          $('#spjhotel_hargatotal').val(totalharga);
        }
        // Panggil myFunction() saat nilai #spt_lama atau #spt_mulai berubah
        $("#checkin, #spjhotel_mlm, #spjhotel_hargapermalam").change(function() {
          myFunction();
        });
      });
    </script>
  <!-- End Tanggal Check Out Otomatis -->

  
<?=$this->endSection()?>