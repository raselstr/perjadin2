
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
              <label class="col-sm-2 col-form-label" hidden>Id SPJ pesawat</label>
              <div class="col">
                <input type="text" class="form-control" name="spjpesawat_id" value="<?=$data[0]->spjpesawat_id;?>" hidden>
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
                <input type="text" class="form-control" name="spt_mulai" id="spt_mulai"value="<?=date('d F Y', strtotime($data[0]->spt_mulai));?>" disabled>
              </div>
              <label class="col-sm-2 col-form-label text-right">Tanggal Selesai</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="spt_berakhir" id="spt_berakhir" value="<?=date('d F Y', strtotime($data[0]->spt_berakhir));?>" disabled>
              </div>
            </div>
            <!-- <div class="form-group row"> -->
              <a href="<?= site_url('spjpesawat'); ?>" type="button" class="btn bg-gradient-warning float-sm-left" ><i class="fas fa-hand-point-left"> </i> Kembali</a>
              <button type="button" class="btn bg-gradient-primary float-sm-right"  data-idpelaksana="<?=$data[0]->pelaksana_id;?>" class="btn btn-primary"  data-toggle="modal" data-target="#pesawatspj"><i class="fas fa-hand-point-right"> </i> Tambah SPJ Pesawat</button>
            <!-- </div> -->
            </div>
          </div>

          <div class="card-footer">
            <table id="myTable1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="align-middle text-center">No</th>
                  <th class="align-middle text-center">Aksi</th>
                  <th class="align-middle text-center">Boarding<br>Bill</th>
                  <th class="align-middle text-center">Jenis</th>
                  <th class="align-middle text-center">Maskapai</th>
                  <th class="align-middle text-center">Nomor Tiket</th>
                  <th class="align-middle text-center">Kode Boking</th>
                  <th class="align-middle text-center">Tanggal</th>
                  <th class="align-middle text-center">Dari Bandara </th>
                  <th class="align-middle text-center">Ke Bandara </th>
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
                      <?php if ($value->spjpesawat_verif == 0): ?>
                        <?php if($value->spjpesawat_id <> null) : ?>
                          <button type="button" class="btn bg-gradient-info btn-xs" data-idpesawat="<?=$value->spjpesawat_id;?>" data-fototiketlama = "<?=$value->spjpesawat_fototiket;?>" data-scanbilllama="<?=$value->spjpesawat_bill;?>" data-toggle="modal" data-target="#pesawatbill"><i class="fas fa-upload"> </i> <br>Upload Bukti</button>
                          <button type="button" class="btn bg-gradient-warning btn-xs" data-idpesawat="<?=$value->spjpesawat_id;?>" data-idpelaksana ="<?=$data[0]->pelaksana_id;?>" id="tomboledit" data-toggle="modal" data-target="#pesawatspj"><i class="fas fa-pen"> </i> <br>Edit</button>
                          <a href="<?=site_url('spjpesawat/remove/' . $value->spjpesawat_id)?>" type="button" class="btn bg-gradient-danger btn-xs tombol-hapus" data-idpesawat=""><i class="fas fa-trash"> </i> <br>Hapus</a>
                        <?php endif?>
                      <?php else: ?>
                          <button type="button" class="btn bg-gradient-success btn-xs" ><i class="fas fa-check"> </i> <br>Disetujui</button>
                      <?php endif?>
                    </td>
                    <td class="align-middle text-center">
                      <?php if ($value->spjpesawat_bill != null && $value->spjpesawat_fototiket != null): ?>
                        <button type="button" class="btn bg-gradient-success btn-xs" data-toggle="modal" data-target="#modalfoto" data-fototiket="<?=$value->spjpesawat_fototiket?>"><i class="fas fa-image"></i><br>Tiket </button>
                        <button type="button" class="btn bg-gradient-success btn-xs" data-toggle="modal" data-target="#modalscan" data-scanbill="<?=$value->spjpesawat_bill?>"><i class="fas fa-file-pdf"></i><br>Bill</button>
                      <?php else : ?>
                        <i>Foto Tiket dan Bill hotel belum di upload</i>
                      <?php endif?>  
                     </td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_jenis;?><br><?=$value->spjpesawat_id;?></td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_maskapai;?></td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_notiket;?></td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_kdboking;?></td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_tgl == null ? "" : date('d F Y', strtotime($value->spjpesawat_tgl));?></td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_dari;?> </td>
                    <td class="align-middle text-center"><?=$value->spjpesawat_ke;?> </td>
                    <td class="align-middle text-center"><?=number_format($value->spjpesawat_harga,2,',','.');?></td>

                  </tr>
                <?php endforeach?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal SPJ Pesawat -->
  <div class="modal fade" id="pesawatspj">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">SPJ Pesawat</h4>
        </div>
        <form action="<?=site_url('spjpesawat/create');?>" method="post" id="formpesawat">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id spjpesawat</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_id" name="spjpesawat_id" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label" hidden>Id Pelaksana</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_pelaksanaid" name="spjpesawat_pelaksanaid" hidden>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Jenis SPJ Pesawat</label>
                  <div class="col">
                    <select class="form-control" style="width: 100%;" id="spjpesawat_jenis" name="spjpesawat_jenis">
                      <option value="">Pilih Jenis Tiket ...</option>
                      <option value="Berangkat">Berangkat</option>
                      <option value="Kembali">Kembali</option>
                    </select>
                    <div class="invalid-feedback errorspjpesawat_jenis"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Maskapai</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_maskapai" name="spjpesawat_maskapai">
                    <div class="invalid-feedback errorspjpesawat_maskapai"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Nomor Tiket</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_notiket" name="spjpesawat_notiket">
                    <div class="invalid-feedback errorspjpesawat_notiket"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Kode Boking</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_kdboking" name="spjpesawat_kdboking">
                    <div class="invalid-feedback errorspjpesawat_kdboking"></div>
                  </div>
                </div>

                <!-- <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Tanggal Pesawat</label>
                  <div class="col">
                    <input type="date" class="form-control" id="spjpesawat_tgl" name="spjpesawat_tgl">
                    <div class="invalid-feedback errorspjpesawat_tgl"></div>
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
                      <input type="text" class="form-control float-right" id="spjpesawat_tgl" name="spjpesawat_tgl">
                      <div class="invalid-feedback errorspjpesawat_tgl"></div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Dari</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_dari" name="spjpesawat_dari">
                    <div class="invalid-feedback errorspjpesawat_dari"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Ke</label>
                  <div class="col">
                    <input type="text" class="form-control" id="spjpesawat_ke" name="spjpesawat_ke">
                    <div class="invalid-feedback errorspjpesawat_ke"></div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Harga/Tiket/Orang</label>
                  <div class="col">
                    <input type="number" class="form-control" id="spjpesawat_harga" name="spjpesawat_harga">
                    <div class="invalid-feedback errorspjpesawat_harga"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="reset" class="btn btn-default batalpesawat" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary simpanpesawat">Save changes</button>
            </div>
          </div>
        </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal SPJ Bill -->
  <div class="modal fade" id="pesawatbill">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Tiket Pesawat</h4>
        </div>
        <form action="<?=site_url('spjpesawat/upload');?>" method="post" enctype="multipart/form-data" id="formupload">
          <?=csrf_field();?>
          <div class="modal-body">
            <div class="card-body">
              <!-- <p>One fine body&hellip;</p> membuat lambang titik titik-->
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" hidden>Id spjpesawat</label>
                <div class="col">
                  <input type="text" class="form-control" id="id" name="spjpesawat_id" hidden>
                  <input type="text" class="form-control" id="fototiketlama" name="fototiketlama" hidden>
                  <input type="text" class="form-control" id="scanbilllama" name="scanbilllama" hidden>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-sm-4 col-form-label">Foto Tiket</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <input class="custom-file-input" type="file" name="spjpesawat_fototiket" id="fototiket">
                    <label class="custom-file-label" for="custom-file-label" id="nama-foto">Pilih Foto</label>
                    <div class="invalid-feedback errorspjpesawat_fototiket"></div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputFile" class="col-sm-4 col-form-label">Scan PDF Bill Pesawat</label>
                <div class="col-sm-8">
                  <div class="input-group">
                    <input class="custom-file-input" type="file" name="spjpesawat_bill" id="scanbill">
                      <label class="custom-file-label" for="custom-file-label" id="nama-scan">Pilih Scan Bill Pesawat</label>
                      <div class="invalid-feedback errorspjpesawat_bill"></div>
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
          <form action="<?= site_url('spjpesawat/verif'); ?>" method="post" id="formverif">
            <?php csrf_field() ?>
              <div class="modal-body">
                <div class="text-center">
                  <div class="form-group">
                    <div class="row">
                      <input type="text" class="form-control" id="spjpes_id" name="spjpesawat_id" hidden>
                      <div class="col-6 form-check">
                        <input class="form-check-input" type="radio" name="spjpesawat_verif" value="1" id="cek1">
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
      $('#spjpesawat_tgl').daterangepicker({
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
        $('#spjpesawat_tgl').on('apply.daterangepicker', function(ev, picker) {
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
          var imageUrl = "<?=base_url('image/pesawat/tiket/')?>" + namafoto
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
            var imageUrl = "<?=base_url('image/pesawat/bill/')?>" + namabill
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

  <!-- Script Edit dan SImpan SPJ Tiket Pesawat -->
    <script>
      $(document).ready(function(){
        $('[data-target="#pesawatspj"]').click (function() {
          var idpelaksana = $(this).data('idpelaksana');
          $('#spjpesawat_pelaksanaid').val(idpelaksana);

          var idpesawat = $(this).data('idpesawat');
          $('#spjpesawat_id').val(idpesawat);

          if(idpesawat == null){
            $('#spjpesawat_jenis').val('');
            $('#spjpesawat_maskapai').val('');
            $('#spjpesawat_notiket').val('');
            $('#spjpesawat_kdboking').val('');
            $('#spjpesawat_tgl').val('');
            $('#spjpesawat_dari').val('');
            $('#spjpesawat_ke').val('');
            $('#spjpesawat_harga').val('');
            $('#pesawatspj').show();

          } else {
            $.ajax({
              type: "get",
              url: "<?=site_url('spjpesawat/edit/');?>" + idpesawat,
              // data: "data",
              dataType: "json",
              success: function (response) {
                console.log(response);
                $('#spjpesawat_jenis').val(response.spjpesawat_jenis);
                $('#spjpesawat_maskapai').val(response.spjpesawat_maskapai);
                $('#spjpesawat_notiket').val(response.spjpesawat_notiket);
                $('#spjpesawat_kdboking').val(response.spjpesawat_kdboking);
                $('#spjpesawat_tgl').val(response.spjpesawat_tgl);
                $('#spjpesawat_dari').val(response.spjpesawat_dari);
                $('#spjpesawat_ke').val(response.spjpesawat_ke);
                $('#spjpesawat_harga').val(response.spjpesawat_harga);
                $('#pesawatspj').show();
              }
            });
          }
        });

        $('#formpesawat').submit(function(e){
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
                  $('.simpanpesawat').attr('disabled', 'disabled');
                  $('.simpanpesawat').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpanpesawat').removeAttr('disabled');
                  $('.simpanpesawat').html('Simpan');
              },
            success: function (response) {
              console.log(response);
              if(response.error) {
                if(response.message.spjpesawat_jenis){
                        $('#spjpesawat_jenis').addClass('is-invalid');
                        $('.errorspjpesawat_jenis').html(response.message.spjpesawat_jenis);
                    } else {
                        $('#spjpesawat_jenis').removeClass('is-invalid');
                        $('.errorspjpesawat_jenis').html('');
                }
                if(response.message.spjpesawat_maskapai){
                        $('#spjpesawat_maskapai').addClass('is-invalid');
                        $('.errorspjpesawat_maskapai').html(response.message.spjpesawat_maskapai);
                    } else {
                        $('#spjpesawat_maskapai').removeClass('is-invalid');
                        $('.errorspjpesawat_maskapai').html('');
                }
                if(response.message.spjpesawat_notiket){
                        $('#spjpesawat_notiket').addClass('is-invalid');
                        $('.errorspjpesawat_notiket').html(response.message.spjpesawat_notiket);
                    } else {
                        $('#spjpesawat_notiket').removeClass('is-invalid');
                        $('.errorspjpesawat_notiket').html('');
                }
                if(response.message.spjpesawat_kdboking){
                        $('#spjpesawat_kdboking').addClass('is-invalid');
                        $('.errorspjpesawat_kdboking').html(response.message.spjpesawat_kdboking);
                    } else {
                        $('#spjpesawat_kdboking').removeClass('is-invalid');
                        $('.errorspjpesawat_kdboking').html('');
                }
                if(response.message.spjpesawat_tgl){
                        $('#spjpesawat_tgl').addClass('is-invalid');
                        $('.errorspjpesawat_tgl').html(response.message.spjpesawat_tgl);
                    } else {
                        $('#spjpesawat_tgl').removeClass('is-invalid');
                        $('.errorspjpesawat_tgl').html('');
                }
                if(response.message.spjpesawat_dari){
                        $('#spjpesawat_dari').addClass('is-invalid');
                        $('.errorspjpesawat_dari').html(response.message.spjpesawat_dari);
                    } else {
                        $('#spjpesawat_dari').removeClass('is-invalid');
                        $('.errorspjpesawat_dari').html('');
                }
                if(response.message.spjpesawat_ke){
                        $('#spjpesawat_ke').addClass('is-invalid');
                        $('.errorspjpesawat_ke').html(response.message.spjpesawat_ke);
                    } else {
                        $('#spjpesawat_ke').removeClass('is-invalid');
                        $('.errorspjpesawat_ke').html('');
                }
                if(response.message.spjpesawat_harga){
                        $('#spjpesawat_harga').addClass('is-invalid');
                        $('.errorspjpesawat_harga').html(response.message.spjpesawat_harga);
                    } else {
                        $('#spjpesawat_harga').removeClass('is-invalid');
                        $('.errorspjpesawat_harga').html('');
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
                  $('#pesawatspj').hide('2000');
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
        $('.batalpesawat').on('click', function () {
          location.reload();
        });
      });


    </script>
  <!-- End Script Edit dan SImpan SPJ Tiket Pesawat -->

  <!-- Script Upload Tiket dan Bill -->
    <script>
      $(document).ready(function(){
        $('[data-target="#pesawatbill"]').click (function() {
          var idpesawat = $(this).data('idpesawat')
          var fototiketlama = $(this).data('fototiketlama')
          var scanbilllama = $(this).data('scanbilllama')
          $('#id').val(idpesawat)
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
                  $('.simpanpesawat').attr('disabled', 'disabled');
                  $('.simpanpesawat').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function(){
                  $('.simpanpesawat').removeAttr('disabled');
                  $('.simpanpesawat').html('Simpan');
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
                      $('#pesawatbill').hide('2000');
                      location.reload();

                    });
                  } else {
                    if(response.messages.spjpesawat_fototiket){
                            $('#fototiket').addClass('is-invalid');
                            $('.errorspjpesawat_fototiket').html(response.messages.spjpesawat_fototiket);
                        } else {
                            $('#fototiket').removeClass('is-invalid');
                            $('.errorspjpesawat_fototiket').html('');
                    }
                    if(response.messages.spjpesawat_bill){
                            $('#scanbill').addClass('is-invalid');
                            $('.errorspjpesawat_bill').html(response.messages.spjpesawat_bill);
                        } else {
                            $('#scanbill').removeClass('is-invalid');
                            $('.errorspjpesawat_bill').html('');
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
                    $('#pesawatbill').hide('2000');
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

  <!-- Script Validasi Tiket Pesawat -->
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
  <!-- End Script Validasi Tiket Pesawat -->

<?=$this->endSection()?>