<?= $this->extend('template') ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Final Usulan Formasi CPNS T.A 2024</h4>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header align-items-center d-flex">
              <h4 class="card-title mb-0 flex-grow-1">Unggah SPTJM</h4>
          </div>
          <div class="card-body">
            <form action="<?= site_url('cpns/final')?>" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nameInput" class="form-label">SPTJM</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="file" class="form-control" id="lampiran" name="lampiran" placeholder="Lampirkan SPTJM">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Unggah</button>
                </div>
            </form>
          </div>
      </div>

      <?php if($user->lampiran_cpns){ ?>
        <div class="alert alert-success" role="alert">
          <strong> Info: </strong> Anda telah mengunggah SPTJM. <a href="https://ropeg.kemenag.go.id:9000/casn2024/eformasi/<?= $user->lampiran_cpns?>" target="_blank">Lihat</a>
        </div>
      <?php }else{ ?>
        <div class="alert alert-danger" role="alert">
          <strong> Info: </strong> Anda belum mengunggah SPTJM.
        </div>
      <?php } ?>

      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
