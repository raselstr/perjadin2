
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
                <input type="text" class="form-control" name="pelaksana_id" value="<?=$data[0]->pelaksana_id;?>" hidden>
              </div>
              <label class="col-sm-2 col-form-label" hidden>Id SPJ taksi</label>
              <div class="col">
                <input type="text" class="form-control" name="spjtaksi_id" value="<?=$data[0]->spjtaksi_id;?>" hidden>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nama Pelaksana</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="pegawai_nama" value="<?=$data[0]->pegawai_nama;?>" disabled>
              </div>
              <label class="col-sm-1 col-form-label text-right">No SPT</label>
              <div class="col-sm-3">
                <input type="text" class="form-control " name="pegawai_nama" value="<?=$data[0]->spt_nomor;?>" disabled>
              </div>
              <label class="col-sm-1 col-form-label text-right">Tanggal SPT</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="spt_tgl" value="<?=date('d F Y', strtotime($data[0]->spt_tgl));?>" disabled>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label ">Tujuan</label>
              <div class="col-sm-3">
                <textarea type="text" class="form-control" name="spt_mulai" disabled><?=$data[0]->spt_tempat;?></textarea>
              </div>
              <label class="col-sm-1 col-form-label text-right">Tanggal Mulai</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="spt_mulai"  id="spt_mulai"value="<?=date('d F Y', strtotime($data[0]->spt_mulai));?>" disabled>
              </div>
              <label class="col-sm-2 col-form-label text-right">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="spt_berakhir" id="spt_berakhir" value="<?=date('d F Y', strtotime($data[0]->spt_berakhir));?>" disabled>
              </div>
            </div>
            <!-- <div class="form-group row"> -->
              <a href="<?= site_url('spjtaksi'); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i> Kembali</a>
              <button type="button" class="btn bg-gradient-primary float-sm-right"  data-idpelaksana="<?=$data[0]->pelaksana_id;?>" class="btn btn-primary"  data-toggle="modal" data-target="#taksispj"><i class="fas fa-hand-point-right"> </i> Tambah SPJ Taksi</button>
            <!-- </div> -->
            </div>
          </div>

          <div class="card-footer">
            <table id="myTable1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="align-middle text-center">No</th>
                  <th class="align-middle text-center">Aksi</th>
                  <th class="align-middle text-center">Foto Tiket</th>
                  <th class="align-middle text-center">Jenis</th>
                  <th class="align-middle text-center">Tanggal</th>
                  <th class="align-middle text-center">Dari </th>
                  <th class="align-middle text-center">Ke </th>
                  <th class="align-middle text-center">Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $no = 1;
                    foreach ($data as $key => $value): ?>
                  <tr>
                    <td class="align-middle text-center"><?=$no++;?></td>
                    <td class="align-middle text-center">
                      <?php if ($value->spjtaksi_verif == 0): ?>
                        <?php if($value->spjtaksi_id <> null) : ?>
                          <button type="button" class="btn bg-gradient-info btn-xs" data-idtaksi="<?=$value->spjtaksi_id;?>" data-fototiketlama = "<?=$value->spjtaksi_fototiket;?>"  data-toggle="modal" data-target="#taksibill"><i class="fas fa-upload"> </i> <br>Upload Bukti</button>
                          <button type="button" class="btn bg-gradient-warning btn-xs" data-idtaksi="<?=$value->spjtaksi_id;?>" data-idpelaksana ="<?=$data[0]->pelaksana_id;?>" id="tomboledit" data-toggle="modal" data-target="#taksispj"><i class="fas fa-pen"> </i> <br>Edit</button>
                          <a href="<?=site_url('spjtaksi/remove/' . $value->spjtaksi_id)?>" type="button" class="btn bg-gradient-danger btn-xs tombol-hapus" data-idtaksi=""><i class="fas fa-trash"> </i> <br>Hapus</a>
                        <?php endif ?>
                      <?php else: ?>
                        <button type="button" class="btn bg-gradient-success btn-xs" ><i class="fas fa-check"> </i> <br>Disetujui</button>
                      <?php endif?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($value->spjtaksi_fototiket != null): ?>
                        <button type="button" class="btn bg-gradient-success btn-xs" data-toggle="modal" data-target="#modalfoto" data-fototiket="<?=$value->spjtaksi_fototiket?>"><i class="fas fa-image"></i><br>Tiket </button>
                      <?php else : ?>
                        <i>Foto Tiket belum di upload</i>
                      <?php endif?>
                    </td>
                    <td class="align-middle text-center"><?=$value->spjtaksi_jenis;?><br><?=$value->spjtaksi_id;?></td>
                    <td class="align-middle text-center"><?=$value->spjtaksi_tgl == null ? "" : date('d F Y', strtotime($value->spjtaksi_tgl));?></td>
                    <td class="align-middle text-center"><?=$value->spjtaksi_dari;?> </td>
                    <td class="align-middle text-center"><?=$value->spjtaksi_ke;?> </td>
                    <td class="align-middle text-center"><?=number_format($value->spjtaksi_harga,2,',','.');?></td>

                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal SPJ Taksi -->
  <div class="modal fade" id="taksispj">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">SPJ Taksi</h4>
        </div>
        <form action="<?=site_url('spjtaksi/create');?>" method="post" id="formtaksi">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id spjtaksi</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjtaksi_id" name="spjtaksi_id" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id Pelaksana</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjtaksi_pelaksanaid" name="spjtaksi_pelaksanaid" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jenis SPJ Taksi</label>
                  <div class="col">
                    <select class="form-control" style="width: 100%;" id="spjtaksi_jenis" name="spjtaksi_jenis">
                      <option value="">Pilih Jenis Tiket ...</option>
                      <option value="Berangkat">Berangkat</option>
                      <option value="Kembali">Kembali</option>
                    </select>
                    <div class="invalid-feedback errorspjtaksi_jenis"></div>
                  </div>
                </div>
                <!-- <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Taksi</label>
                  <div class="col">
                    <input type="date" class="form-control" id="spjtaksi_tgl" name="spjtaksi_tgl">
                    <div class="invalid-feedback errorspjtaksi_tgl"></div>
                  </div>
                </div> -->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Berangkat</label>
                  <div class="col">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" class="form-control float-right" id="spjtaksi_tgl" name="spjtaksi_tgl">
                      <div class="invalid-feedback errorspjtaksi_tgl"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Dari</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjtaksi_dari" name="spjtaksi_dari">
                    <div class="invalid-feedback errorspjtaksi_dari"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Ke</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjtaksi_ke" name="spjtaksi_ke">
                    <div class="invalid-feedback errorspjtaksi_ke"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Harga/Tiket/Orang</label>
                  <div class="col">
                    <input type="number" class="form-control" id="spjtaksi_harga" name="spjtaksi_harga">
                    <div class="invalid-feedback errorspjtaksi_harga"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default bataltaksi" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary simpantaksi">Save changes</button>
            </div>
          </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal SPJ Bill -->
  <div class="modal fade" id="taksibill">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Tiket Taksi</h4>
        </div>
        <form action="<?=site_url('spjtaksi/upload');?>" method="post" enctype="multipart/form-data" id="formupload">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" hidden>Id spjtaksi</label>
                <div class="col">
                  <input type="text" class="form-control" id="id" name="spjtaksi_id" hidden>
                  <input type="text" class="form-control" id="fototiketlama" name="fototiketlama" hidden>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-sm-4 col-form-label">Foto Tiket</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <input class="custom-file-input" type="file" name="spjtaksi_fototiket" id="fototiket">
                    <label class="custom-file-label" for="custom-file-label" id="nama-foto">Pilih Foto</label>
                    <div class="invalid-feedback errorspjtaksi_fototiket"></div>
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
          <form action="<?= site_url('spjtaksi/verif'); ?>" method="post" id="formverif">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjpes_id" name="spjtaksi_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjtaksi_verif" value="1" id="cek1">
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

    <script>
      // Date range picker
      $(function() {
        $('#spjtaksi_tgl').daterangepicker({
          autoUpdateInput: false,
          locale: {
            format: 'DD MMMM YYYY'
          },
          singleDatePicker: true,
          showDropdowns: true,
          minYear: 2023,
          maxYear: parseInt(moment().format('YYYY'),10),
          minDate: moment($('#spt_mulai').val(), 'DD MMMM YYYY'),  // Gunakan moment.js untuk mem-parse tanggal dengan format yang benar
          maxDate: moment($('#spt_berakhir').val(), 'DD MMMM YYYY').add(2, 'days'),
        });
        // Menangani perubahan tanggal
          $('#spjtaksi_tgl').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD MMMM YYYY'));
          });
        
      });
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

<!-- Script Modal Tampilakan Foto Tiket -->
  <script>
    $(document).ready(function(){

       $('[data-target="#modalfoto"]').on('click', function(e) {
        e.preventDefault();
          var namafoto = $(this).data('fototiket');
          var imageUrl = "<?=base_url('image/taksi/tiket/')?>" + namafoto
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

<!-- Script Edit dan SImpan SPJ Tiket Taksi -->
  <script>
    $(document).ready(function(){
      $('[data-target="#taksispj"]').click (function() {
        var idpelaksana = $(this).data('idpelaksana');
        $('#spjtaksi_pelaksanaid').val(idpelaksana);

        var idtaksi = $(this).data('idtaksi');
        $('#spjtaksi_id').val(idtaksi);

        if(idtaksi == null){
          $('#spjtaksi_jenis').val('');
          $('#spjtaksi_tgl').val('');
          $('#spjtaksi_dari').val('');
          $('#spjtaksi_ke').val('');
          $('#spjtaksi_harga').val('');
          $('#taksispj').show();

        } else {
          $.ajax({
            type: "get",
            url: "<?=site_url('spjtaksi/edit/');?>" + idtaksi,
            // data: "data",
            dataType: "json",
            success: function (response) {
              console.log(response);
              $('#spjtaksi_jenis').val(response.spjtaksi_jenis);
              $('#spjtaksi_tgl').val(response.spjtaksi_tgl);
              $('#spjtaksi_dari').val(response.spjtaksi_dari);
              $('#spjtaksi_ke').val(response.spjtaksi_ke);
              $('#spjtaksi_harga').val(response.spjtaksi_harga);
              $('#taksispj').show();
            }
          });
        }
      });

      $('#formtaksi').submit(function(e){
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
                $('.simpantaksi').attr('disabled', 'disabled');
                $('.simpantaksi').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function(){
                $('.simpantaksi').removeAttr('disabled');
                $('.simpantaksi').html('Simpan');
            },
          success: function (response) {
            console.log(response);
            if(response.error) {
              if(response.message.spjtaksi_jenis){
                      $('#spjtaksi_jenis').addClass('is-invalid');
                      $('.errorspjtaksi_jenis').html(response.message.spjtaksi_jenis);
                  } else {
                      $('#spjtaksi_jenis').removeClass('is-invalid');
                      $('.errorspjtaksi_jenis').html('');
              }
              if(response.message.spjtaksi_tgl){
                      $('#spjtaksi_tgl').addClass('is-invalid');
                      $('.errorspjtaksi_tgl').html(response.message.spjtaksi_tgl);
                  } else {
                      $('#spjtaksi_tgl').removeClass('is-invalid');
                      $('.errorspjtaksi_tgl').html('');
              }
              if(response.message.spjtaksi_dari){
                      $('#spjtaksi_dari').addClass('is-invalid');
                      $('.errorspjtaksi_dari').html(response.message.spjtaksi_dari);
                  } else {
                      $('#spjtaksi_dari').removeClass('is-invalid');
                      $('.errorspjtaksi_dari').html('');
              }
              if(response.message.spjtaksi_ke){
                      $('#spjtaksi_ke').addClass('is-invalid');
                      $('.errorspjtaksi_ke').html(response.message.spjtaksi_ke);
                  } else {
                      $('#spjtaksi_ke').removeClass('is-invalid');
                      $('.errorspjtaksi_ke').html('');
              }
              if(response.message.spjtaksi_harga){
                      $('#spjtaksi_harga').addClass('is-invalid');
                      $('.errorspjtaksi_harga').html(response.message.spjtaksi_harga);
                  } else {
                      $('#spjtaksi_harga').removeClass('is-invalid');
                      $('.errorspjtaksi_harga').html('');
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
                $('#taksispj').hide('2000');
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
      $('.bataltaksi').on('click', function () {
        location.reload();
      });
    });


  </script>
<!-- End Script Edit dan SImpan SPJ Tiket Taksi -->

  <!-- Script Upload Tiket dan Bill -->
    <script>
      $(document).ready(function(){
        $('[data-target="#taksibill"]').click (function() {
          var idtaksi = $(this).data('idtaksi')
          var fototiketlama = $(this).data('fototiketlama')
          $('#id').val(idtaksi)
          $('#fototiketlama').val(fototiketlama)

        });
        $('#fototiket').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            console.log('Nama file:', fileName);
            $('#nama-foto').text(fileName);
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
                  $('.simpantaksi').attr('disabled', 'disabled');
                  $('.simpantaksi').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpantaksi').removeAttr('disabled');
                  $('.simpantaksi').html('Simpan');
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
                      $('#taksibill').hide('2000');
                      location.reload();

                    });
                  } else {
                    if(response.messages.spjtaksi_fototiket){
                            $('#fototiket').addClass('is-invalid');
                            $('.errorspjtaksi_fototiket').html(response.messages.spjtaksi_fototiket);
                        } else {
                            $('#fototiket').removeClass('is-invalid');
                            $('.errorspjtaksi_fototiket').html('');
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
                    $('#taksibill').hide('2000');
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

   <!-- Script Validasi Tiket Taksi -->
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
  <!-- End Script Validasi Tiket Taksi -->

<?=$this->endSection()?>