<?= $this->extend('template') ?>
<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Rekap Formasi CPNS T.A 2024</h4>



        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card card-animate overflow-hidden">
            <div class="position-absolute start-0" style="z-index: 0;">
                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                    <style>
                        .s0 {
                            opacity: .05;
                            fill: var(--vz-primary)
                        }
                    </style>
                    <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                </svg>
            </div>
            <div class="card-body" style="z-index:1 ;">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Progres Input Formasi</p>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="<?= $input->kebutuhan?>">0</span> dari <?= $total->jumlah?></h4>
                    </div>
                    <div class="flex-shrink-0">
                        <div id="progres" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div><!-- end card body -->
        </div>
        <div class="card">
          <div class="card-body">
                <table class="table table-bordered dt-responsive nowrap table-striped align-middle datatable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Jenis Jabatan</th>
                            <th scope="col">Jabatan</th>
                            <th scope="col">Bezzeting</th>
                            <th scope="col">Ideal</th>
                            <th scope="col">Kebutuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($rekap as $row) {?>
                        <tr>
                          <td><?= $row->jenis_jabatan?></td>
                          <td><?= $row->jabatan?></td>
                          <td><?= $row->bezzeting?></td>
                          <td><?= $row->ideal?></td>
                          <td><?= $row->kebutuhan?></td>
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
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var options = {
          series: [<?= shortdec(($input->kebutuhan / $total->jumlah)*100)?>],
          chart: {
            type: "radialBar",
            height: 105,
            sparkline: {
                enabled: !0
            }
          },
          dataLabels: {
              enabled: !1
          },
          plotOptions: {
            radialBar: {
              hollow: {
                  margin: 0,
                  size: "70%"
              },
              track: {
                  margin: 1
              },
              dataLabels: {
                  show: !0,
                  name: {
                      show: !1
                  },
                  value: {
                      show: !0,
                      fontSize: "16px",
                      fontWeight: 600,
                      offsetY: 8
                  }
              }
          }
        }};

        var chart = new ApexCharts(document.querySelector("#progres"), options);
        chart.render();
  });

</script>
<?= $this->endSection() ?>
