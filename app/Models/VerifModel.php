<?php

namespace App\Models;

use CodeIgniter\Model;

class VerifModel extends Model
{
    function verifdataspt()
    {
        $builder = $this->db->table('spts');
        $builder->select('spts.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif',1);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        
        return $query->getResult();
    }
    function verifjlh($id)
    {
        $builder = $this->db->table('spts as a');
        $builder->select('a.spt_id, COUNT(b.pelaksana_id)');
        $builder->join('pelaksanas AS b', 'a.spt_id = b.spt_id');
        $builder->where('spts.spt_verif',1);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        
        return $query->getResult();
    }

    function verifdatasptid($id)
    {
        $builder = $this->db->table('pelaksanas');
        $builder->select('pelaksanas.*, spts.*, pegawais.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('spts', 'spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais', 'pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif',1);
        $builder->where('spts.spt_id',$id);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        $result = [
            'data' => $query->getResult(),
            'jumlah' =>$query->getNumRows(),
        ];
        return $result;
    }
    

    function verifdatapelaksana($id = null)
    {
        $builder = $this->db->table('pelaksanas');
        $builder->select('pelaksanas.*, spts.*, pegawais.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_id, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('spts', 'spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais', 'pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif',1);
        $builder->where('pelaksanas.pelaksana_id',$id);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        $result = [
            'data' => $query->getResult(),
            'jumlah' =>$query->getNumRows(),
        ];
        return $result;
    }

    function verifhotel($id = null)
    {
        $builder = $this->db->table('spjhotels As a');
        $builder->select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, c.spt_tgl, c.spt_mulai, c.spt_berakhir, c.spt_tempat,d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjhotel_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        if ($id !== null){
            $builder->where('b.pelaksana_id', $id);
        }
        $builder->orderBy('a.spjhotel_created_at', 'DESC');

        $query = $builder->get();
        $result = [
            'data' => $query->getResult(),
            'nilai' => $query->getNumRows(),
        ];
        return $result;
    }

    function verifpesawat($id)
    {
        $builder = $this->db->table('spjpesawats As a');
        $builder->select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, c.spt_tgl, c.spt_mulai, c.spt_berakhir, c.spt_tempat,d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjpesawat_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('b.pelaksana_id', $id);
        $builder->orderBy('a.spjpesawat_created_at', 'DESC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }
    function veriftaksi($id)
    {
        $builder = $this->db->table('spjtaksis As a');
        $builder->select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, c.spt_tgl, c.spt_mulai, c.spt_berakhir, c.spt_tempat,d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjtaksi_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('b.pelaksana_id', $id);
        $builder->orderBy('a.spjtaksi_created_at', 'DESC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }

    function verifjadin($id)
    {
        $builder = $this->db->table('laporjadins');
        $builder->select('laporjadins.*, spts.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('spts', 'spts.spt_id = laporjadins.laporjadin_sptid', 'RIGHT');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif', 1);
        $builder->where('spts.spt_id', $id);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult();
    }


    function verifdatahotel($id)
    {
        $group = $this->db->table('spjhotels as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjhotel_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('c.spt_id', $id);
        
        $sum = $group->get();
        return $sum->getNumRows();
        
    }

    function verifdatahotelval($id)
    {
        $group = $this->db->table('spjhotels as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjhotel_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('a.spjhotel_verif', 1);
        $group->where('c.spt_id', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }

    function verifdatapesawat($id)
    {
        $group = $this->db->table('spjpesawats as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjpesawat_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('c.spt_id', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }

    function verifdatapesawatval($id)
    {
        $group = $this->db->table('spjpesawats as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjpesawat_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('a.spjpesawat_verif', 1);
        $group->where('c.spt_id', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }

    function verifdatataksi($id)
    {
        $group = $this->db->table('spjtaksis as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjtaksi_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('c.spt_id', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }

    function verifdatataksival($id)
    {
        $group = $this->db->table('spjtaksis as a');
        $group->join('pelaksanas As b', 'b.pelaksana_id = a.spjtaksi_pelaksanaid', 'RIGHT');
        $group->join('spts As c', 'c.spt_id = b.spt_id');
        $group->where('c.spt_verif', 1);
        $group->where('a.spjtaksi_verif', 1);
        $group->where('c.spt_id', $id);
        $sum = $group->get();
        return $sum->getNumRows();
    }

    function verifdatalapor($id)
    {
        $group = $this->db->table('laporjadins as a');
        $group->join('spts As c', 'c.spt_id = a.laporjadin_sptid');
        $group->where('c.spt_verif', 1);
        $group->where('a.laporjadin_sptid', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }

    function verifdatalaporval($id)
    {
        $group = $this->db->table('laporjadins as a');
        $group->join('spts As c', 'c.spt_id = a.laporjadin_sptid');
        $group->where('c.spt_verif', 1);
        $group->where('a.laporjadin_verif', 1);
        $group->where('a.laporjadin_sptid', $id);
        $sum = $group->get();
        return $sum->getNumRows();

    }




    
}
