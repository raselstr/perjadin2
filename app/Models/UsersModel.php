<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_nama',
        'user_nmlengkap',
        'user_password',
        'user_active',
        'user_roleid',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'user_created_at';
    protected $updatedField  = 'user_updated_at';
    protected $deletedField  = 'user_deleted_at';

    // Validation
    protected $validationRules      = [
        
    ];
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

    function menuactive($id = null)
    {
        $builder = $this->db->table('users as a');
        $builder->select('a.user_active');
        $builder->where('a.user_id', $id);
        $builder->where('a.user_id !=', 5);
        $query = $builder->get();
        return $query->getResultArray();
    }

    function datauser()
    {
        $builder = $this->db->table('users');
        $builder->select('*');
        $builder->join('roles', 'roles.role_id = users.user_roleid');
        $builder->where('users.user_id != 5 OR roles.role_id != 5');
        $query = $builder->get();
        return $query->getResult();
    }

}
