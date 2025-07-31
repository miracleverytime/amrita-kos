<?php

namespace App\Models;

use CodeIgniter\Model;

class PindahKamarModel extends Model
{
    protected $table            = 'pindah_kamar';
    protected $primaryKey       = 'id_pindah';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_user', 'id_kamar_lama', 'id_kamar_baru', 'alasan', 'keterangan', 'status'];

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

    public function getRiwayatPindah($idUser)
    {
        return $this->select('pindah_kamar.*, kamar.no_kamar')
            ->join('kamar', 'kamar.id_kamar = pindah_kamar.id_kamar_baru')
            ->where('pindah_kamar.id_user', $idUser)
            ->orderBy('pindah_kamar.created_at', 'DESC')
            ->findAll();
    }
    public function getPengajuanPindah($idUser)
    {
        return $this->select('pindah_kamar.*, kamar.no_kamar')
            ->join('kamar', 'kamar.id_kamar = pindah_kamar.id_kamar_baru')
            ->where('pindah_kamar.id_user', $idUser)
            ->orderBy('pindah_kamar.created_at', 'DESC')
            ->first();
    }
}
