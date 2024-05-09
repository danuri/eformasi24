<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Rincian Formasi CPNS T.A 2024</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li><a href="<?= site_url('cpns/export')?>" class="btn btn-soft-success btn-sm">Download Excel</a></li>
            </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive table-card">
    <table class="table table-nowrap table-striped-columns mb-0">
        <thead class="table-light">
            <tr>
                <th scope="col">Kategori Jabatan</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Terisi</th>
                <th scope="col">Belum Terisi</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($alokasi as $row) {?>
            <tr>
              <td><a href="<?= site_url('cpns/rincian/'.encrypt($row->id))?>" class="fw-semibold"><?= $row->jenis?></a></td>
              <td><span class="fw-semibold"><?= $row->jumlah?></span></td>
              <td><?= $row->kebutuhan?></td>
              <td><?= ($row->jumlah - $row->kebutuhan)?></td>
            </tr>
          <?php } ?>
        </tbody>
    </table>
</div>

          </div>
      </div>

      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
