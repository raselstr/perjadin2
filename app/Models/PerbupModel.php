<?php

namespace App\Models;

use CodeIgniter\Model;

class PerbupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'perbups';
    protected $primaryKey       = 'perbup_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'perbup_tingkatid',
        'perbup_lokasiid',
        'perbup_kota',
        'perbup_hotel',
        'perbup_uh',
        'perbup_uhdiklat',
        'perbup_uhrapat_fullboad',
        'perbup_uhrapat_fullday',
        'perbup_uhrapat_residencedlmkota',
        'perbup_taksi_transportdarat',
        'perbup_representasi',
        'perbup_sewakendaraan',
    ];

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
}
