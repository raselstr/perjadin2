<?= $this->extend('layout/default'); ?>


<?= $this->section('stylesheet'); ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection(); ?>



<?= $this->section('scriptplugin'); ?>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  
 <!-- InputMask -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/inputmask/jquery.inputmask.min.js"></script>

  <!-- date-range-picker -->
  <script src="plugins/daterangepicker/daterangepicker.js"></script>

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
        <div class="row">
          <!-- /.col-md-6 -->
          <div class="col">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title"><?= $title; ?></h3>
                  </div>
                  
                  <?php $errors = session()->getFlashdata('validation') ?>
                  <form action="<?= site_url('spt/create') ?>" method="post" enctype="multipart/form-data"  class="form-horizontal">
                    <?= csrf_field() ?>
                    <div class="card-body row">
                      <div class="col">
                        <div class="form-group row">
                          <label for="spt_nomor" class="col-sm-4 col-form-label" hidden>Tahun</label>
                          <div class="col">
                            <input type="text" name="spt_tahun" placeholder="Tahun" id="spt_tahun" hidden>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_pjb_tugas" class="col-sm-4 col-form-label">Pejabat Pemberi Tugas</label>
                          <div class="col">
                            <select name="spt_pjb_tugas" id="spt_pjb_tugas" class="form-control <?= isset($errors['spt_pjb_tugas']) ? 'is-invalid' : null ; ?>">
                              <option value="">Pilih Pejabat yang berwenang ...!</option>
                              <?php foreach ($pejabat as $key => $value) { ?>
                                <option value="<?= $value->pejabat_id ?>" <?= old('spt_pjb_tugas') == $value->pejabat_id ? 'selected':null?>><?= $value->pejabat_id; ?></option>
                              <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['spt_pjb_tugas']) ? $errors['spt_pjb_tugas'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_jenis" class="col-sm-4 col-form-label">Jenis Perjalanan Dinas</label>
                          <div class="col">
                            <select name="spt_jenis" id="spt_jenis" class="form-control <?= isset($errors['spt_jenis']) ? 'is-invalid' : null ; ?>" >
                              <option value="">Pilih Jenis Perjalanan Dinas</option>
                              <?php foreach ($jenis as $key => $value) { ?>
                                <option value="<?= $value->jenisperjadin_id; ?>"<?= old('spt_jenis') ==  $value->jenisperjadin_id ? 'selected':null?>><?= $value->jenisperjadin_nama; ?></option>
                              <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['spt_jenis']) ? $errors['spt_jenis'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_acara" class="col-sm-4 col-form-label">Jenis Acara yang dihadiri</label>
                          <div class="col">
                            <select name="spt_acara" id="spt_acara" class="form-control <?= isset($errors['spt_acara']) ? 'is-invalid' : null ; ?>" >
                              <option value="">Pilih Jenis Acara yang dihadiri</option>
                              <?php foreach ($acara as $value => $label) { ?>
                                <option value="<?= $value ?>"<?= old('spt_acara') ==  $value ? 'selected':null?>><?= $label; ?></option>
                              <?php } ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= isset($errors['spt_acara']) ? $errors['spt_acara'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_dasar" class="col-sm-4 col-form-label">Dasar Perjalanan Dinas</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_dasar']) ? 'is-invalid' : null ; ?>" type="text" name="spt_dasar" placeholder="Dasar Perjalanan Dinas" id="spt_dasar" value="<?= old('spt_dasar') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_dasar']) ? $errors['spt_dasar'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_uraian" class="col-sm-4 col-form-label">Maksud Perjalanan Dinas</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_uraian']) ? 'is-invalid' : null ; ?>" type="text" name="spt_uraian" placeholder="Maksud Perjalanan Dinas" id="spt_uraian" value="<?= old('spt_uraian') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_uraian']) ? $errors['spt_uraian'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <!-- <div class="form-group row">
                          <label for="spt_mulai" class="col-sm-4 col-form-label">Tanggal Mulai Perjalanan Dinas</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_mulai']) ? 'is-invalid' : null ; ?>" type="date" name="spt_mulai" placeholder="Tanggal Mulai Perjalanan Dinas" id="spt_mulai" value="<?= old('spt_mulai') ?>">
                            <div class="invalid-feedback">
                              <?= isset($errors['spt_mulai']) ? $errors['spt_mulai'] : null ; ?>
                            </div>
                          </div>
                        </div> -->
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Tanggal Mulai Perjalanan Dinas</label>
                          <div class="col">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                              <input type="text" class="form-control float-right <?= isset($errors['spt_mulai']) ? 'is-invalid' : null ; ?>" id="spt_mulai" name="spt_mulai">
                              <div class="invalid-feedback">
                                <?= isset($errors['spt_mulai']) ? $errors['spt_mulai'] : null ; ?>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_lama" class="col-sm-4 col-form-label">Lama Perjalanan Dinas</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_lama']) ? 'is-invalid' : null ; ?>" type="number" name="spt_lama" placeholder="Lama Perjalanan Dinas" id="spt_lama" value="<?= old('spt_lama') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_lama']) ? $errors['spt_lama'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="spt_berakhir" class="col-sm-4 col-form-label">Tanggal Berakhir Perjalanan Dinas</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_berakhir']) ? 'is-invalid' : null ; ?>" type="date" name="spt_berakhir" placeholder="Tanggal Berakhir Perjalanan Dinas" id="spt_berakhir" value="<?= old('spt_berakhir') ?>" readonly>
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_berakhir']) ? $errors['spt_berakhir'] : null ; ?>
                              </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="spt_tempat" class="col-sm-4 col-form-label">Tempat Tujuan Perjadin</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['spt_tempat']) ? 'is-invalid' : null ; ?>" type="text" name="spt_tempat" placeholder="Tempat Tujuan Misal : Badan/Dinas/Kementerian beserta Alamatnya" id="spt_tempat" value="<?= old('spt_tempat') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_tempat']) ? $errors['spt_tempat'] : null ; ?>
                              </div>
                          </div>
                        </div>

                        <!--  input teks tempat tujuan -->
                        <div class="form-group row">
                          <label for="spt_tujuan" id = "spt_tujuanlabel" class="col-sm-4 col-form-label">Lokasi Tujuan Perjalanan Dinas</label>
                          <div class="col">
                            <select name="spt_tujuan" id="spt_tujuan" class="form-control <?= isset($errors['spt_tujuan']) ? 'is-invalid' : null ; ?>">

                            </select>
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_tujuan']) ? $errors['spt_tujuan'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        

                        <div class="form-group row">
                          <label for="spt_transport" class="col-sm-4 col-form-label">Transportasi Perjalanan Dinas</label>
                          <div class="col">
                            <select name="spt_transport" id="spt_transport" class="form-control <?= isset($errors['spt_transport']) ? 'is-invalid' : null ; ?>">
                              <option value="">Pilih Jenis Transportasi</option>
                              <option value="Mobil Dinas"<?= old('spt_transport') == "Mobil Dinas" ? 'selected':null?>>Mobil Dinas</option>
                              <option value="Angkutan Umum Darat"<?= old('spt_transport') == "Angkutan Umum Darat" ? 'selected':null?>>Angkutan Umum Darat</option>
                              <option value="Pesawat Udara"<?= old('spt_transport') == "Pesawat Udara" ? 'selected':null?>>Pesawat Udara</option>
                            </select>
                              <div class="invalid-feedback">
                                  <?= isset($errors['spt_transport']) ? $errors['spt_transport'] : null ; ?>
                              </div>
                          </div>
                        </div>
                      </div>
                    </div>              
                    <div class="card-footer">
                      <a href="<?= site_url('spt'); ?>" class="btn btn-default">Kembali</a>
                      <button type="submit" class="btn btn-primary float-right">Simpan</button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  </div>
    <!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script'); ?>

<script>
    // Date range picker
    $(function() {
      $('#spt_mulai').daterangepicker({
        autoUpdateInput: true,
        locale: {
          format: 'DD MMMM YYYY'
        },
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2023,
        maxYear: parseInt(moment().format('YYYY'),10),
        
      });
      // Menangani perubahan tanggal
        $('#spt_mulai').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD MMMM YYYY'));
        });
      
    });
  </script>

  <script>
  $(document).ready(function() {
    function myFunction() {
      var jh = $("#spt_lama").val();
      var tglmulai = $("#spt_mulai").val();
      var hari = jh * 24 * 60 * 60 * 1000;

      var hariakhir = new Date(new Date(tglmulai).getTime() + (hari) - 1);
      $("#spt_berakhir").val(hariakhir.toISOString().slice(0, 10));
    }

    const tahun = new Date();
    var thnini = tahun.getFullYear();
    $("#spt_tahun").val(thnini);

    // Panggil myFunction() saat nilai #spt_lama atau #spt_mulai berubah
    $("#spt_lama, #spt_mulai").change(function() {
      myFunction();
    });
  });
  </script>
    

  <script>
 
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

  </script>

  <script>
    function dataJenisperjadin() {
      $('#spt_jenis').change(function(e){
        $.ajax({
          type: "post",
          url: "<?= site_url('spt/getdatalokasi'); ?>",
          data: {
            'spt_jenis' : $(this).val()
          },
          dataType: "json",
          success: function (response) {
            if(response.data){
              $('#spt_tujuan').html(response.data);
              $('#spt_tujuan').select2();
            }
          },
        });
      });
    }

    $(document).ready(function(){
      dataJenisperjadin();
    });
  </script>

   
<?= $this->endSection(); ?>
