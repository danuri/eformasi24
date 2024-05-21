<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \Hermawan\DataTables\DataTable;
use App\Models\AlokasiModel;
use App\Models\JabatanModel;
use App\Models\UsulcpnsModel;
use App\Models\UnorModel;
use App\Models\UsersModel;
use Aws\S3\S3Client;

class Cpns extends BaseController
{
    public function index()
    {
        $model = new AlokasiModel;
        // $data['alokasi'] = $model->where('kode_satker',session('kodesatker'))->findAll();
        $data['alokasi'] = $model->getalokasi(session('kodesatker'));
        return view('cpns/index', $data);
    }

    public function getdata()
    {
      $model = new UsulcpnsModel();
      $model->where(['kode_satker'=>session('kodesatker')]);

      $user = new UsersModel;
      $getuser = $user->find(session('idsatker'));

      $now = time();
      $limit = strtotime($getuser->end_cpns);

      if($limit < $now){
        return DataTable::of($model)
        ->add('action', function($row){
            return '';
        })->filter(function ($builder, $request) {

          if ($request->jenis)
              $builder->where('kategori', $request->jenis);

        })->toJson(true);
      }else{
        return DataTable::of($model)
        ->add('action', function($row){
            return '<a href="javascript:;" onclick="deletes(\''.$row->id.'\')" type="button" class="btn btn-sm btn-danger">Delete</a>';
        })->filter(function ($builder, $request) {

          if ($request->jenis)
              $builder->where('kategori', $request->jenis);

        })->toJson(true);
      }
    }

    public function rincian($jenis)
    {
        $alokasimodel = new AlokasiModel;

        $data['alokasis'] = $alokasimodel->getalokasi(session('kodesatker'));

        $model = new AlokasiModel;

        $id = decrypt($jenis);
        $data['alokasi'] = $model->find($id);

        $user = new UsersModel;
        $getuser = $user->find(session('idsatker'));

        $now = time();
        $limit = strtotime($getuser->end_cpns);

        if($limit < $now){
          return view('cpns/preview', $data);
        }else{
          return view('cpns/rincian', $data);
        }
    }

    public function getjenis($id)
    {
      $model = new JabatanModel;
      $jenis = $model->getjenis($id);

      echo '<option value="">Pilih Jenis Jabatan</option>';
      foreach ($jenis as $row) {
        echo '<option value="'.$row->jenis_kode.'">'.$row->jenis.'</option>';
      }
    }

    public function getjabatan($id,$jenjang)
    {
      $model = new JabatanModel;
      $jabatan = $model->getjabatan($id,$jenjang);

      // $data['results'] = $jabatan;

      // return $this->response->setJSON($data);
      echo '<option value="">Pilih Jabatan</option>';
      foreach ($jabatan as $row) {
        echo '<option value="'.$row->jabatan.'">'.$row->jabatan.'</option>';
      }
    }

    public function getterisi($jenis)
    {
      $model = new UsulcpnsModel;
      $input = $model->getcpnsinput($jenis);

      return $this->response->setJSON($input);
    }

    public function getpendidikan()
    {
      $model = new JabatanModel;
      $id = $this->request->getVar('jabatan');
      $jabatan = $model->getpendidikan($id);

      if(session('jenis_pendidikan') == 1){
        $data = ($jabatan->kualifikasi_pendidikan)?$jabatan->kualifikasi_pendidikan:'Belum Tersedia';
      }else{
        $data = ($jabatan->kualifikasi_pendidikan_non_islam)?$jabatan->kualifikasi_pendidikan_non_islam:'Belum Tersedia';
      }
      return $this->response->setJSON($data);
    }

    public function add()
    {
      if (! $this->validate([
          'penempatan' => "required",
          'bezzeting' => "required",
          'kebutuhan' => "required",
          'jabatan' => "required",
        ])) {
            // return redirect()->back()->with('message', 'Harap isi dengan lengkap.');
            echo 'Harap isi dengan lengkap.';
        }

      $unitid = $this->request->getVar('penempatan');
      $unormodel = new UnorModel;
      $unitnama = $unormodel->find($unitid)->nama;
      $ideal = $this->request->getVar('bezzeting') + $this->request->getVar('kebutuhan');

      $jenis_jabatan = strtoupper($this->request->getVar('jenis_jabatan'));
      $param = [
        'kategori' => $this->request->getVar('kategori'),
        'kode_satker' => session('kodesatker'),
        'jenis_jabatan' => $jenis_jabatan,
        'jabatan' => $this->request->getVar('jabatan'),
        'unit_id' => $unitid,
        'unit_nama' => $unitnama,
        'bezzeting' => $this->request->getVar('bezzeting'),
        'kebutuhan' => $this->request->getVar('kebutuhan'),
        'ideal' => $ideal,
        'created_by' => session('nip'),
      ];

      if($this->request->getVar('kategori') == 'DOSEN'){
        $param['kualifikasi_pendidikan'] = json_encode($this->request->getVar('pendidikan'));
        $param['sub_jabatan'] = $this->request->getVar('sub_jabatan');
      }

      $model = new UsulcpnsModel;
      $model->insert($param);

      echo 'ok';
    }

    public function delete($id)
    {
      $model = new UsulcpnsModel;
      $model->delete($id);

      echo 'ok';
    }

    public function rekap()
    {
      $model = new UsulcpnsModel;
      $data['total'] = $model->getcpnstotal();
      $data['input'] = $model->getcpnsinput();
      $data['rekap'] = $model->getrekap();

      return view('cpns/rekap',$data);
    }

    public function export()
    {
      $model = new UsulcpnsModel;
      $usul = $model->where(['kode_satker'=>session('kodesatker')])->findAll();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->setCellValue('A1', 'JENIS JABATAN');
      $sheet->setCellValue('B1', 'JABATAN');
      $sheet->setCellValue('C1', 'SUB JABATAN');
      $sheet->setCellValue('D1', 'UNIT PENEMPATAN ID');
      $sheet->setCellValue('E1', 'UNIT PENEMPATAN NAMA');
      $sheet->setCellValue('F1', 'BEZZETING');
      $sheet->setCellValue('G1', 'JUMLAH IDEAL');
      $sheet->setCellValue('H1', 'KEBUTUHAN');

      $i = 2;
      foreach ($usul as $row) {
        $sheet->setCellValue('A'.$i, $row->jenis_jabatan);
        $sheet->setCellValue('B'.$i, $row->jabatan);
        $sheet->setCellValue('C'.$i, $row->sub_jabatan);
        $sheet->setCellValue('D'.$i, $row->unit_id);
        $sheet->setCellValue('E'.$i, $row->unit_nama);
        $sheet->setCellValue('F'.$i, $row->bezzeting);
        $sheet->setCellValue('G'.$i, $row->ideal);
        $sheet->setCellValue('H'.$i, $row->kebutuhan);
        $i++;
      }

      $writer = new Xlsx($spreadsheet);
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Data_usulcpns_'.session('kodesatker').'.xlsx"');
      $writer->save('php://output');
      exit();
    }

    public function final()
    {
        $validationRule = [
          'lampiran' => [
              'label' => 'Lampiran',
              'rules' => 'uploaded[lampiran]'
                  . '|ext_in[lampiran,pdf,PDF]'
          ],
      ];

    if (! $this->validate($validationRule)) {
          session()->setFlashdata('message', $this->validator->getErrors()['lampiran']);
          return redirect()->back();
    }

    $file_name = $_FILES['lampiran']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    $file_name = 'sptjm.cpppk.'.session('kodesatker').'.'.$ext;
    $temp_file_location = $_FILES['lampiran']['tmp_name'];

    $s3 = new S3Client([
      'region'  => 'us-east-1',
      'endpoint' => 'https://docu.kemenag.go.id:9000/',
      'use_path_style_endpoint' => true,
      'version' => 'latest',
      'credentials' => [
        'key'    => "118ZEXFCFS0ICPCOLIEJ",
        'secret' => "9xR+TBkYyzw13guLqN7TLvxhfuOHSW++g7NCEdgP",
      ],
      'http'    => [
          'verify' => false
      ]
    ]);

    $result = $s3->putObject([
      'Bucket' => 'sscasn',
      'Key'    => '2024/eformasi/'.$file_name,
      'SourceFile' => $temp_file_location,
      'ContentType' => 'application/pdf'
    ]);

    $up = new UserModel;
      $data = [
        'lampiran_pppk' => $file_name
      ];

    $update = $up->where(['kode_satker_parent'=>session('kodesatker')])->set($data)->update();

    session()->setFlashdata('message', 'Dokumen telah diunggah');
    return redirect()->back();
    }
}
