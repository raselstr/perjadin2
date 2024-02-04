<?php

namespace App\Models;

use CodeIgniter\Model;

class UangHarianModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'uangharians';
    protected $primaryKey       = 'uangharian_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'uangharian_idpelaksana',
        'uangharian_sptid',
        'uangharian_tingkatid',
        'uangharian_lokasiid',
        'uangharian_lama',
        'uangharian_perhari',
        'uangharian_jumlah',
        'uangharian_biayatransport',
        'uangharian_jumlahbiayatransport',
        'uangharian_representasi',
        'uangharian_jumlahrepresentasi',
        'uangharian_sewamobil',
        'uangharian_jumlahsewamobil',
        'uangharian_total',
        'uangharian_verif',
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

    public function cariid($id)
    {
        $builder = $this->db->table('uangharians as a');
        $builder->select('*');
        $builder->join('pelaksanas as b', 'b.pelaksana_id = a.uangharian_idpelaksana', 'RIGHT');
        $builder->where('b.pelaksana_id', $id);
        $query = $builder->get();
        $result = $query->getResult();
            
        return $result;
    }
}
