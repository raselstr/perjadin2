<?php

namespace App\Models;

use CodeIgniter\Model;

class SubmenusModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'submenus';
    protected $primaryKey       = 'submenu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['menu_id','submenu_nama','submenu_icon','submenu_link', 'submenu_active','role_id'];

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

    function kelompokmenu()
    {
        $builder = $this->db->table('submenus as a');
        $builder->select('*');
        $builder->join('menus as b', 'b.menu_id = a.menu_id');
        $query = $builder->get();
        return $query->getResult();
    }

    function menuactive($id = null)
    {
        $builder = $this->db->table('submenus as a');
        $builder->select('a.submenu_active');
        $builder->where('a.submenu_id', $id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
