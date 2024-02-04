<?= $this->extend('layout/default'); ?>

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
                  <form action="<?= site_url('pegawai/create') ?>" method="post" enctype="multipart/form-data"  class="form-horizontal">
                    <?= csrf_field() ?>
                    <div class="card-body row">
                      <div class="col-8">
                        <div class="form-group row">
                          <label for="pegawai_nip" class="col-sm-3 col-form-label">NIP</label>
                          <div class="col">
                            <input type="text" maxlength="18" class="form-control <?= isset($errors['pegawai_nip']) ? 'is-invalid' : null ; ?>"  name="pegawai_nip" placeholder="Nip" id="pegawai_nip" value="<?= old('pegawai_nip') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['pegawai_nip']) ? $errors['pegawai_nip'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="pegawai_nama" class="col-sm-3 col-form-label">Nama</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['pegawai_nama']) ? 'is-invalid' : null ; ?>" type="text" name="pegawai_nama" placeholder="Nama Pegawai" id="pegawai_nama" value="<?= old('pegawai_nama') ?>">
                            <div class="invalid-feedback">
                                <?= isset($errors['pegawai_nama']) ? $errors['pegawai_nama'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="pegawai_jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                          <div class="col">
                            <input class="form-control <?= isset($errors['pegawai_jabatan']) ? 'is-invalid' : null ; ?>" type="text" name="pegawai_jabatan" placeholder="Jabatan Pegawai" id="pegawai_jabatan" value="<?= old('pegawai_jabatan') ?>">
                              <div class="invalid-feedback">
                                  <?= isset($errors['pegawai_jabatan']) ? $errors['pegawai_jabatan'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleSelectBorder" class="col-sm-3 col-form-label">Eselon</label>
                          <div class="col">
                            <select class="form-control <?= isset($errors['eselon_id']) ? 'is-invalid' : null ; ?>" name="eselon_id" placeholder="Eselon" id="eselon_id" value="<?= old('eselon_id') ?>">
                              <option value="" hidden></option>
                              <?php foreach($eselon as $key => $value) : ?>
                                <option value="<?= $value->eselon_id; ?>"><?= $value->eselon_nama; ?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                  <?= isset($errors['eselon_id']) ? $errors['eselon_id'] : null ; ?>
                              </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleSelectBorder" class="col-sm-3 col-form-label">Pangkat/Golongan</label>
                          <div class="col">
                            <select class="form-control <?= isset($errors['pangkat_id']) ? 'is-invalid' : null ; ?>" name="pangkat_id" placeholder="Pengkat" id="pangkat_id" value="<?= old('pangkat_id') ?>">
                              <option value="" hidden></option>
                              <?php foreach($pangkat as $key => $value) : ?>
                                <option value="<?= $value->pangkat_id ?> <?= old('pangkat_id') ; ?>"><?= $value->pangkat_nama; ?> - (<?= $value->pangkat_gol; ?>)</option>
                              <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                  <?= isset($errors['pangkat_id']) ? $errors['pangkat_id'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleSelectBorder" class="col-sm-3 col-form-label">Tingkat Pembiayaan</label>
                          <div class="col">
                            <select class="form-control <?= isset($errors['pegawai_tingkat']) ? 'is-invalid' : null ; ?>" name="pegawai_tingkat" placeholder="Pengkat" id="pegawai_tingkat" value="<?= old('pegawai_tingkat') ?>">
                              <option value="" hidden></option>
                              <?php foreach($tingkat as $key => $value) : ?>
                                <option value="<?= $value->tingkat_id ?> <?= old('pegawai_tingkat') ; ?>"><?= $value->tingkat_nama; ?></option>
                              <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                  <?= isset($errors['pegawai_tingkat']) ? $errors['pegawai_tingkat'] : null ; ?>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="exampleInputFile" class="col-sm-3 col-form-label">File Foto</label>
                          <div class="col">
                            <div class="input-group">
                              <!-- <div class="custom-file"> -->
                                <!-- <input class="form-control" type="file" name="pegawai_foto" id="pegawai_foto"> -->
                                <input class="custom-file-input <?= isset($errors['pegawai_foto']) ? 'is-invalid' : null ; ?>" type="file" name="pegawai_foto" id="foto" value="<?= old('pegawai_foto') ?>" onchange="PreviewImage()">
                                <label class="custom-file-label" for="custom-file-label" id="nama-foto">Pilih Foto</label>
                                <div class="invalid-feedback">
                                  <?= isset($errors['pegawai_foto']) ? $errors['pegawai_foto'] : null ; ?>
                                </div>
                              <!-- </div> -->
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4 text-center d-flex align-items-center justify-content-center">
                        <div class="">
                          <img src="/image/pegawai/_default.png" class="img-thumbnail" id="img-preview" width="60%">
                        </div>
                      </div>
                    </div>              
                    <div class="card-footer">
                      <a href="<?= site_url('pegawai'); ?>" class="btn btn-default">Kembali</a>
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

<?= $this->section('script') ?>
  <script>
    function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("foto").files[0]);

    const labelsampul = document.getElementById('nama-foto');
    labelsampul.textContent = document.getElementById("foto").files[0].name;

    oFReader.onload = function (oFREvent)
    {
        document.getElementById("img-preview").src = oFREvent.target.result;
      };
    };
  </script>
<?= $this->endSection() ?>
    

