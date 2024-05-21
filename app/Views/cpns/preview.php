<?= $this->extend('template') ?>

<?= $this->section('style') ?>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Rincian Formasi CPNS T.A 2024</h4>

          <div class="page-title-right">
              <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item">Jumlah Formasi Terisi <span class="text-danger text-bold" id="terisi">0</span> dari <?= $alokasi->jumlah?></li>
              </ol>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header align-items-center d-flex">
              <h4 class="card-title mb-0 flex-grow-1">Kategori Formasi: <div class="btn-group">
                  <button class="btn btn-light btn-sm" type="button">
                      <?= $alokasi->jenis?>
                  </button>
                  <button type="button" class="btn btn-sm btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </button>
                  <div class="dropdown-menu">
                    <?php foreach ($alokasis as $row) {?>
                      <a class="dropdown-item" href="<?= site_url('cpns/rincian/'.encrypt($row->id))?>"><?= $row->jenis?></a>
                    <?php } ?>
                  </div>
              </div>
              </h4>
              <div class="flex-shrink-0">
                  <button class="btn btn-soft-secondary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Panduan</button>
              </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="cpns" class="display table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Jenis Jabatan</th>
                    <th>Jabatan</th>
                    <th>Sub Jabatan</th>
                    <th>Unit Penempatan</th>
                    <th>Alokasi</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
      </div>
      </div>
    </div>
  </div>
</div>


<!-- right offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Panduan</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p>Penentuan Jabatan berdasarkan kategori Jabatan</p>
        <h5>✔ GURU MADRASAH</h5>
        <p>Jabatan Guru yang akan ditempatkan pada unit MIN, MTsN, MAN. Termasuk MAN Insan Cendikia dan MAN PK</p>
        <h5>✔ GURU MAKN</h5>
        <p>Jabatan Guru yang akan ditempatkan pada unit Madrasah Aliyah Kejuruan Negeri (MAKN).</p>
        <h5>✔ GURU Non Madrasah</h5>
        <p><b>SMA Katolik</b> Jabatan Guru yang akan ditempatkan pada unit SMA Katolik Negeri di 3 lokasi (Sumut, NTT, Papua) </p>
        <p><b>SMT Kristen</b>Jabatan Guru yang akan ditempatkan pada unit SMT Kristen Negeri di 3 lokasi di lingkungan Prov. Papua Barat</p>
        <h5>Penghulu</h5>
        <p>Jabatan Penghulu yang akan ditempatkan pada KUA Kecamatan</p>
        <h5>✔ Penyuluh Agama Islam</h5>
        <p>Jabatan Penyuluh Agama Islam yang akan ditempatkan pada KUA Kecamatan, selain Islam ditem di lingkungan Kantor Wilayah Kementerian Agama</p>
        <h5>✔ Penyuluh Agama Non Islam</h5>
        <p>Jabatan Penyuluh Agama yang akan ditempatkan di lingkungan Kantor Wilayah Kementerian Agama Prov. / Kantor Kementerian Agama Kab/Kota</p>
        <h5>✔ APIP</h5>
        <p>Jabatan Auditor yang akan ditempatkan pada Inspektorat Jenderal dan SPI pada PTKN</p>
        <h5>✔ DIGITAL</h5>
        <p>Jabatan ini dapat diisi oleh Jabatan yang berhubungan langsung dengan proses transformasi digital yang akan ditempatkan pada seluruh Satuan Kerja Kementerian Agama</p>
        <h5>✔ IKN</h5>
        <p>Jabatan ini dapat diisi oleh Jabatan Teknis dan penempatannya pada Unit Eselon I Pusat untuk ditempatkan di IKN</p>
        <h5>✔ PP Terbaik Kaltim</h5>
        <p>Jabatan ini diisi oleh Putra/Putri Terbaik Kalimantan Timur di wilayah Provinsi Kalimantan Timur</p>
        <h5>✔ PP Papua</h5>
        <p>Jabatan ini diisi oleh Putra/Putri Terbaik Papua di wilayah Provinsi Papua.</p>
        <h5>✔ PP Papua Barat</h5>
        <p>Jabatan ini diisi oleh Putra/Putri Papua Terbaik Barat di wilayah Provinsi Papua Barat.</p>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    updatedata();
    // $('#cpns').DataTable({
    var table = new DataTable('#cpns', {
      processing: true,
      serverSide: true,
      ajax: {
        url: '<?= site_url('cpns/getdata')?>',
        method: 'POST',
        data: function (d) {
                d.jenis = '<?= $alokasi->jenis?>';
            }
      },
      columns: [
        {data: 'jenis_jabatan'},
        {data: 'jabatan'},
        {data: 'sub_jabatan'},
        {data: 'unit_nama'},
        {data: 'kebutuhan'},
        {data: 'action', orderable: false},
      ]
    });

    new DataTable("#buttons-datatables",{
      dom:"Bfrtip",
      buttons:["copy","csv","excel","print","pdf","colVis"]
    });

    // $('#jabatan').select2({
    //   ajax: {
    //     url: '<?= site_url('cpns/getjabatan')?>/'+$('#jenis_jabatan').val()+'/'+$('#jenjang').val(),
    //     dataType: 'json'
    //     // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
    //   }
    // });

    $('#penempatan').select2({
      dropdownParent: $('#addModal'),
      ajax: {
        url: '<?= site_url() ?>ajax/searchunor',
        data: function (params) {
          var query = {
            search: params.term,
            type: 'public'
          }

          return query;
        },
        processResults: function (data) {
          return {
            results: data
          };
        },
        processResults: (data, params) => {
            const results = data.map(item => {
              return {
                id: item.id,
                text: item.nama,
              };
            });
            return {
              results: results,
            }
          },
      },
      placeholder: 'Cari Unor',
      minimumInputLength: 5,
    });

  });


  function updatedata() {
    axios.get('<?= site_url('cpns/getterisi/'.$alokasi->jenis)?>')
    .then(function (response) {
      console.log(response.data);

      $('#terisi').html(response.data.kebutuhan);
    });
  }

</script>
<?= $this->endSection() ?>
