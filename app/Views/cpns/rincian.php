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
                  <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                      Tambah Formasi
                  </button>
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

<div id="addModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Tambah Formasi : <?= $alokasi->jenis?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
              <form action="">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nameInput" class="form-label">Jenjang Pendidikan</label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-select" name="jenjang" id="jenjang">
                          <option value="">Pilih Jenjang Pendidikan</option>
                          <option value="sma">SLTA/Sederajat</option>
                          <option value="d3">D-III</option>
                          <option value="s1">S-1/D-4</option>
                          <option value="s2">S-2</option>
                          <option value="S3">S-3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="nameInput" class="form-label">Jenis Jabatan</label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-select" name="jenis_jabatan" id="jenis_jabatan">
                          <option value="">Pilih Jenis Jabatan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="websiteUrl" class="form-label">Jabatan</label>
                    </div>
                    <div class="col-lg-9">
                      <select class="form-select" name="jabatan" id="jabatan">
                      </select>
                    </div>
                </div>
                <?php if($alokasi->jenis == 'DOSEN'){ ?>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="websiteUrl" class="form-label">Pendidikan</label>
                    </div>
                    <div class="col-lg-9">
                      <select class="form-select" name="pendidikan[]" id="pendidikandosen" multiple="multiple">
                      </select>
                    </div>
                </div>
                <?php }else{ ?>
                  <div class="row mb-3">
                    <div class="col-lg-3">
                      <label for="websiteUrl" class="form-label">Pendidikan</label>
                    </div>
                    <div class="col-lg-9">
                      <textarea name="pendidikan" id="pendidikan" class="form-control" rows="3" disabled></textarea>
                    </div>
                  </div>
                <?php } ?>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="timeInput" class="form-label">Unit Penempatan</label>
                    </div>
                    <div class="col-lg-9">
                      <select class="form-select" name="penempatan" id="penempatan">
                      </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="dateInput" class="form-label">Bezzeting/Jumlah Existing pada Jabatan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="bezzeting" id="bezzeting">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="dateInput" class="form-label">Kebutuhan</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="kebutuhan" id="kebutuhan">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="dateInput" class="form-label">Jumlah Ideal Pegawai</label>
                    </div>
                    <div class="col-lg-9">
                        <input type="number" class="form-control" name="ideal" id="ideal" disabled>
                    </div>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

    $('#simpan').on('click',function(event) {
      loaderin();
      axios.post('<?= site_url('cpns/add')?>', {
        kategori: '<?= $alokasi->jenis?>',
        jenis_jabatan: $('#jenis_jabatan').val(),
        jabatan: $('#jabatan').val(),
        penempatan: $('#penempatan').val(),
        <?php if($alokasi->jenis == 'DOSEN'){ ?>
          pendidikan: $('#pendidikandosen').val(),
        <?php } ?>
        bezzeting: $('#bezzeting').val(),
        kebutuhan: $('#kebutuhan').val()
      })
      .then(function (response) {
        loaderout();
        alert('Data telah disimpan');
        table.ajax.reload(null, false);
        updatedata();
        $('#addModal').modal('hide');
      })
      .catch(function (error) {
        loaderout();
        console.log(error);
      });
    });

  });

  $('#jenjang').on('change', function(event) {
    $('#jenis_jabatan').load('<?= site_url('cpns/getjenis')?>/'+$('#jenjang').val());
  });

  $('#jenis_jabatan').on('change', function(event) {
    $('#jabatan').load('<?= site_url('cpns/getjabatan')?>/'+$('#jenis_jabatan').val()+'/'+$('#jenjang').val());

    $('#jabatan').select2({
        dropdownParent: $('#addModal')
    });
  });

  $('#pendidikandosen').select2({
    ajax: {
      url: '<?= site_url() ?>ajax/searchpendidikan',
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
              id: item.nama,
              text: item.nama,
            };
          });
          return {
            results: results,
          }
        },
    },
    placeholder: 'Cari Pendidikan',
    minimumInputLength: 5,
  });

  $('#jabatan').on('change', function(event) {
    // $('#pendidikan').load('<?= site_url('cpns/getpendidikan')?>/'+$('#jabatan').val());

    axios.post('<?= site_url('cpns/getpendidikan')?>', {
      jabatan: $('#jabatan').val()
    })
    .then(function (response) {

      $('#pendidikan').val(response.data);
    });
  });

  $('#bezzeting').on('keyup',function(event) {
    var bezz = $('#bezzeting').val();
    var keb = $('#kebutuhan').val();
    var ideal = parseInt(bezz) + parseInt(keb);
    $('#ideal').val(ideal);
  });

  $('#kebutuhan').on('keyup',function(event) {
    var bezz = $('#bezzeting').val();
    var keb = $('#kebutuhan').val();
    var ideal = parseInt(bezz) + parseInt(keb);
    $('#ideal').val(ideal);
  });

  function updatedata() {
    axios.get('<?= site_url('cpns/getterisi/'.$alokasi->jenis)?>')
    .then(function (response) {
      console.log(response.data);

      $('#terisi').html(response.data.kebutuhan);
    });
  }

  function deletes(id) {
    axios.get('<?= site_url('cpns/delete')?>/'+id)
    .then(function (response) {
      table.ajax.reload(null, false);
      updatedata();
    });
  }

  // function simpan() {
  //   loaderin();
  //
  //   axios.post('<?= site_url('cpns/add')?>', {
  //     jenis_jabatan: $('#jenis_jabatan').val(),
  //     jabatan: $('#jabatan').val(),
  //     penempatan: $('#penempatan').val(),
  //     bezzeting: $('#bezzeting').val(),
  //     kebutuhan: $('#kebutuhan').val()
  //   })
  //   .then(function (response) {
  //     loaderout();
  //     alert('ok');
  //     table.ajax.reload(null, false);
  //   })
  //   .catch(function (error) {
  //     loaderout();
  //     console.log(error);
  //   });
  // }

</script>
<?= $this->endSection() ?>
