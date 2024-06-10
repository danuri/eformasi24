<?php

namespace App\Models;

use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table            = 'ref_jabatan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getjenis($jenjang)
    {
      $query = $this->db->query("SELECT jenis,jenis_kode FROM ref_jabatan WHERE jenjang_pendidikan='$jenjang' GROUP BY jenis,jenis_kode");

      return $query->getResult();
    }

    public function getjabatan($jenis,$jenjang)
    {
      $query = $this->db->query("SELECT jabatan FROM ref_jabatan WHERE jenis_kode='$jenis' AND jenjang_pendidikan='$jenjang'");

      return $query->getResult();
    }

    public function getpendidikan($id)
    {
      $query = $this->db->query("SELECT kualifikasi_pendidikan,kualifikasi_pendidikan_non_islam FROM ref_jabatan WHERE jabatan='$id'");

      return $query->getRow();
    }
}
