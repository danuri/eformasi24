<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Alokasi Formasi Satuan Kerja CPNS T.A 2024</h4>

          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <!-- <li><a href="<?= site_url('cpns/export')?>" class="btn btn-soft-success btn-sm">Download Excel</a></li> -->
            </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
    <table class="table table-nowrap table-striped-columns mb-0" id="satker" style="width:100%">
        <thead class="table-light">
            <tr>
                <th scope="col">Kode</th>
                <th scope="col">Satuan Kerja</th>
                <th scope="col">Alokasi</th>
                <th scope="col">Terisi</th>
                <th scope="col">Belum Terisi</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($satker as $row) {?>
            <tr>
              <td><a href="#" class="fw-semibold"><?= $row->kode_satker?></a></td>
              <td><?= $row->satuan_kerja?></td>
              <td><span class="fw-semibold"><?= $row->alokasi?></span></td>
              <td><?= $row->input?></td>
              <td><?= ($row->alokasi - $row->input)?></td>
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
<?= $this->section('script') ?>
<script type="text/javascript">
  $(document).ready(function() {
    var table = new DataTable('#satker');
  });

</script>
<?= $this->endSection() ?>
