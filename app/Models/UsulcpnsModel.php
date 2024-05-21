<?php

namespace App\Models;

use CodeIgniter\Model;

class UsulcpnsModel extends Model
{
    protected $table            = 'usul_cpns';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kategori','kode_satker','jenis_jabatan','jabatan','sub_jabatan','kualifikasi_pendidikan','unit_id','unit_nama','bezzeting','kebutuhan','ideal','created_by'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getrekap()
    {
      $kodesatker = session('kodesatker');
      $query = $this->db->query("SELECT jenis_jabatan,jabatan,SUM(bezzeting) AS bezzeting,SUM(kebutuhan) AS kebutuhan,SUM(ideal) AS ideal FROM usul_cpns WHERE kode_satker='$kodesatker' GROUP BY jenis_jabatan,jabatan");

      return $query->getResult();
    }

    public function getcpnstotal()
    {
      $kodesatker = session('kodesatker');
      $query = $this->db->query("SELECT SUM(jumlah) AS jumlah FROM alokasi_satker WHERE kode_satker='$kodesatker'");

      return $query->getRow();
    }

    public function getcpnsinput($jenis=false)
    {
      $kodesatker = session('kodesatker');
      if($jenis){
        $query = $this->db->query("SELECT SUM(kebutuhan) AS kebutuhan FROM usul_cpns WHERE kode_satker='$kodesatker' AND kategori='$jenis'");
      }else{
        $query = $this->db->query("SELECT SUM(kebutuhan) AS kebutuhan FROM usul_cpns WHERE kode_satker='$kodesatker'");
      }

      return $query->getRow();
    }

    public function getrekapsatker()
    {
      $query = $this->db->query("SELECT a.kode_satker, a.satuan_kerja,
                                (SELECT SUM(jumlah) FROM alokasi_satker WHERE alokasi_satker.kode_satker=a.kode_satker) AS alokasi,
                                (SELECT SUM(kebutuhan) FROM usul_cpns WHERE usul_cpns.kode_satker=a.kode_satker) AS input
                                FROM users a WHERE role='1'");

      return $query->getResult();
    }
}
