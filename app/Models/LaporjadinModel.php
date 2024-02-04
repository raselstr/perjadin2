<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporjadinModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'laporjadins';
    protected $primaryKey       = 'laporjadin_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'laporjadin_sptid',
        'laporjadin_nodpa',
        'laporjadin_pembuka',
        'laporjadin_hasil',
        'laporjadin_penutup',
        'laporjadin_foto1',
        'laporjadin_foto2',
        'laporjadin_foto3',
        'laporjadin_verif',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'laporjadin_created_at';
    protected $updatedField  = 'laporjadin_updated_at';
    protected $deletedField  = 'laporjadin_deleted_at';

    // Validation
    protected $validationRules      = [
        'laporjadin_nodpa'      => 'required',
        'laporjadin_pembuka'    => 'required',
        'laporjadin_hasil'      => 'required',
        'laporjadin_penutup'    => 'required',
    ];
    protected $validationMessages   = [
        'laporjadin_nodpa'    => [
            'required'  => 'No DPA Kegiatan harus diisi !!!'],
        'laporjadin_pembuka'    => [
            'required'  => 'Pembuka konsultasi harus diisi !!!'],
        'laporjadin_hasil'      => [
            'required'  => 'Hasil Konsultasi harus diisi !!!'],
        'laporjadin_penutup'    => [
            'required'  => 'Penutup Konsultasi harus diisi'],
    ];
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

    function dataspt($id)
    {
        $builder = $this->db->table('spts');
        $builder->select('spts.*, laporjadins.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('laporjadins', 'laporjadins.laporjadin_sptid = spts.spt_id', 'LEFT');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->join('pelaksanas', 'pelaksanas.spt_id = spts.spt_id', 'LEFT');
        $builder->join('pegawais', 'pegawais.pegawai_id = pelaksanas.pegawai_id', 'LEFT');
        $builder->where('spts.spt_verif',1);
        if($id !== null){
            $builder->where('pegawais.pegawai_nip', $id);
        }
        $builder->groupBy('spts.spt_id');
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    function datasptid($id)
    {
        $builder = $this->db->table('laporjadins');
        $builder->select('laporjadins.*, spts.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('spts', 'spts.spt_id = laporjadins.laporjadin_sptid', 'RIGHT');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif',1);
        $builder->where('spts.spt_id',$id);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        
        return $query->getResult();
    }
    
    
    
}
