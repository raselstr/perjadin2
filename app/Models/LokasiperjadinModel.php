<?php

namespace App\Models;

use CodeIgniter\Model;

class LokasiperjadinModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'lokasiperjadins';
    protected $primaryKey       = 'lokasiperjadin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jenisperjadin_id','lokasiperjadin_nama'];

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

    function lokasijenis($jenisperjadin_id)
    {
        $builder = $this->db->table('lokasiperjadins');
        $builder->select('*');
        $builder->where('jenisperjadin_id', $jenisperjadin_id);
        $builder->orderBy('lokasiperjadin_id','ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
