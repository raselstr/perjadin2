<?php

namespace App\Models;

use CodeIgniter\Model;

class RolemenusModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rolemenus';
    protected $primaryKey       = 'rolemenu_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['role_id','menu_id','submenu_id','lihat','tambah','ubah','hapus'];

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

    function datarole($id = null)
    {
        $builder = $this->db->table('rolemenus');
        $builder->select('*');
        $builder->join('roles', 'roles.role_id = rolemenus.role_id');
        $builder->join('submenus', 'submenus.submenu_id = rolemenus.submenu_id');
        if($id <> null){
            $builder->where('rolemenus.role_id', $id);
        };
        $builder->orderBy('submenus.submenu_id','ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    function datarolefilter($id,  $key)
    {
        $filterrole = $this->db->table('rolemenus');
        $filterrole->select('submenus.submenu_link');
        $filterrole->join('roles', 'roles.role_id = rolemenus.role_id');
        $filterrole->join('submenus', 'submenus.submenu_id = rolemenus.submenu_id');
        if($id <> null){
            $filterrole->where('rolemenus.role_id', $id);
        };
        $filterrole->where('submenus.submenu_link', $key);
        $query = $filterrole->get();
        return $query->getRowArray();
    }
}
