<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    function datalogin($id,$key)
    {
        $user = $this->db->table('users as a');
        $user->select('a.user_nama, a.user_password, a.user_nmlengkap, null as userid , b.role_nama, b.role_id');
        $user->join('roles as b', 'b.role_id = a.user_roleid');

        $peg = $this->db->table('pegawais as c');
        $peg->select('c.pegawai_nip,"'.password_hash('bkad',PASSWORD_BCRYPT).'"as user_password, c.pegawai_nama, c.pegawai_nip as userid ,"Pelaksana Perjalanan Dinas" as role_nama, "4" as role_id');
        
        $user->unionAll($peg);
        $gabung = $this->db->newQuery()->fromSubquery($user, 'd')
                                        ->select('d.user_nmlengkap, d.userid, d.role_nama, d.role_id, d.user_nama')
                                        ->where('d.user_nama', $id);
                            
        $query = $this->db->newQuery()->fromSubquery($user, 'userpengguna')
                                ->select('userpengguna.user_nama, userpengguna.user_password')
                                ->where('userpengguna.user_nama', $id)
                                ->get();
        $resultquery = $query->getRow();                        

        if($resultquery !== null){
            $hashedPassword = $resultquery->user_password;
            if (password_verify($key, $hashedPassword)) {
                $query = $gabung->get();
                $result = $query->getRowArray();
                // dd($result);
                return $result;
            }
        }
        return null;
    }

    function navmenu($id)
    {

        $builder = $this->db->table('rolemenus as a');
        $builder->select('b.role_id, b.role_nama,
                          d.menu_id, d.menu_nama, d.menu_icon, d.menu_link');
        $builder->join('roles as b', 'b.role_id = a.role_id');
        $builder->join('submenus as c', 'c.submenu_id = a.submenu_id',);
        $builder->join('menus as d', 'd.menu_id = c.menu_id');
        $builder->where('c.submenu_active',1);
        $builder->where('d.menu_active',1);
        if($id !== null){
            $builder->where('b.role_id',$id);
        }
        $builder->groupBy('d.menu_id');
        $builder->orderBy('d.menu_id','ASC');

        $query = $builder->get();

        return $query->getResultArray();
    }
    function navsubmenu($id, $menu)
    {
        $builder = $this->db->table('submenus as a');
        $builder->select('
                b.role_id, 
                d.role_nama, 
                a.menu_id, 
                c.menu_nama, 
                a.submenu_nama, 
                a.submenu_icon, 
                a.submenu_link, 
                a.submenu_active
            ');
        $builder->join('rolemenus AS b', 'a.submenu_id = b.submenu_id');
        $builder->join('menus AS c', 'a.menu_id = c.menu_id');
        $builder->join('roles AS d', 'b.role_id = d.role_id');
        $builder->where('a.submenu_active = 1 AND c.menu_active = 1');
        if($id !== null){
            $builder->where('b.role_id', $id);
        }
        $builder->where('a.menu_id', $menu);
        $builder->groupBy('a.submenu_id');

        $builder->orderBy('a.menu_id', 'ASC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;

    }
}
