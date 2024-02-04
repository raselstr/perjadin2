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
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-8">
                    <h5 class="m-0"><?= $title; ?></h5>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="card-body row">
                  <div class="col-4 text-center d-flex align-items-center justify-content-center">
                    <div class="">
                      <img src="<?= base_url('image/pegawai/'.$peg[0]['pegawai_foto']) ?>" class="img-thumbnail" id="img-preview" width="60%">
                    </div>
                  </div>
                  <div class="col-8 ">
                    <div class="container">
                      <table class="table table-borderless">
                        <!-- <thead>
                          <tr>
                            <th scope="col">NIP</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                          </tr>
                        </thead> -->
                        <tbody>
                          <tr>
                            <th scope="row">NIP</th>
                            <td><?= $peg[0]['pegawai_nip']; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Nama</th>
                            <td><?= $peg[0]['pegawai_nama']; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Jabatan</th>
                            <td><?= $peg[0]['pegawai_jabatan']; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Eselon</th>
                            <td><?= $peg[0]['eselon_nama']; ?></td>
                          </tr>
                          <tr>
                            <th scope="row">Pangkat</th>
                            <td><?= $peg[0]['pangkat_nama'] ?> - <?= $peg[0]['pangkat_gol'] ?></td>
                          </tr>
                          
                          <!-- <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                          </tr> -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="<?= site_url('pegawai'); ?>" type="button" class="btn btn-primary btn-block"><i class="fa fa-backward"></i>  Kembali</a>
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

