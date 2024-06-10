<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\JabatanModel;
use App\Models\PendidikanModel;
use App\Models\UsulcpnsModel;

class Api extends BaseController
{
    public function index()
    {
        //
    }

    public function setpendidikan($jabatan,$agama)
    {
      $model = new JabatanModel;
      $pend = new PendidikanModel;

      $jab = $model->where('jabatan',$jabatan)->first();

      if($agama == 0){
        $jabs = explode(" / ",$jab->kualifikasi_pendidikan);
      }else if($agama == 1){
        $jabs = explode(" / ",$jab->kualifikasi_pendidikan_1);
      }else if($agama == 2){
        $jabs = explode(" / ",$jab->kualifikasi_pendidikan_2);
      }else if($agama == 3){
        $jabs = explode(" / ",$jab->kualifikasi_pendidikan_3);
      }

      $data = [];
      for ($i=0; $i < count($jabs); $i++) {
        $j = $i+1;

        $pendidikan = $pend->where('nama',$jabs[$i])->first();

        $data[] = [
          'idx' => $j,
          'id' => null,
          'usul_sotk_id' => 'd9f13001-ad65-412e-a129-d744b40acba8',
          'usul_sotk_detail_id' => 'xxx',
          'instansi_id' => 'A5EB03E23BFBF6A0E040640A040252AD',
          'pendidikan_id' => $pendidikan->id,
          'nama_pendidikan' => null,
          'tingkat_pendidikan_id' => $pendidikan->tingkat_pendidikan_id,
          'input_mode' => FALSE,
          'is_saved' => FALSE,
        ];
      }

      // return $this->response->setJSON($data);
      return json_encode($data);
    }

    public function setpendidikanbyid($id)
    {
      $model = new UsulcpnsModel;
      $pend = new PendidikanModel;

      $usul = $model->find($id);

      $pends = explode(" / ",$usul->kualifikasi_pendidikan);


      $data = [];
      for ($i=0; $i < count($pends); $i++) {
        $j = $i+1;

        $pendidikan = $pend->where('nama',$pends[$i])->first();

        $data[] = [
          'idx' => $j,
          'id' => null,
          'usul_sotk_id' => 'd9f13001-ad65-412e-a129-d744b40acba8',
          'usul_sotk_detail_id' => 'xxx',
          'instansi_id' => 'A5EB03E23BFBF6A0E040640A040252AD',
          'pendidikan_id' => $pendidikan->id,
          'nama_pendidikan' => null,
          'tingkat_pendidikan_id' => $pendidikan->tingkat_pendidikan_id,
          'input_mode' => FALSE,
          'is_saved' => FALSE,
        ];
      }

      // return $this->response->setJSON($data);
      return json_encode($data);
    }

    public function updatebyid()
    {
      $model = new UsulcpnsModel;

      $dosen = $model->where(['jabatan'=>'Pranata Laboratorium Pendidikan Ahli Pertama','kualdik_json'=>null])->findAll();

      foreach ($dosen as $row) {
        $json = $this->setpendidikanbyid($row->id);

        $update = $model->update($row->id,['kualdik_json'=>$json]);

        echo $row->id;
      }
    }
}
