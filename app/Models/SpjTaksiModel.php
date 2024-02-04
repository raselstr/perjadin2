<?php

namespace App\Models;

use CodeIgniter\Model;

class SpjTaksiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'spjtaksis';
    protected $primaryKey       = 'spjtaksi_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'spjtaksi_pelaksanaid',
        'spjtaksi_jenis',
        'spjtaksi_tgl',
        'spjtaksi_dari',
        'spjtaksi_ke',
        'spjtaksi_harga',
        'spjtaksi_fototiket',
        'spjtaksi_verif',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'spjtaksi_created_at';
    protected $updatedField  = 'spjtaksi_updated_at';
    protected $deletedField  = 'spjtaksi_deleted_at';

    // Validation
    protected $validationRules      = [
        'spjtaksi_pelaksanaid' => 'required',
        'spjtaksi_jenis' => 'required',
        'spjtaksi_tgl' => 'required|valid_date[]',
        'spjtaksi_dari' => 'required',
        'spjtaksi_ke' => 'required',
        'spjtaksi_harga' => 'required',
    ];
    protected $validationMessages   = [
        'spjtaksi_jenis'      => [
            'required' => 'Jenis SPJ Taksi Wajib di Pilih !!!'
        ],
        'spjtaksi_tgl'      => [
            'required' => 'Tanggal Wajib di Pilih !!!',
            'valid_date' => 'Tanggal harus Valid !!'
        ],
        'spjtaksi_dari'      => [
            'required' => 'Keberangkatan Taksi dari Bandahara mana Wajib di Isi !!!'
        ],
        'spjtaksi_ke'      => [
            'required' => 'Tujuan Taksi ke Bandara mana Wajib di Isi !!!'
        ],
        'spjtaksi_harga'      => [
            'required' => 'Harga Tiket Taksi Per Orang Per Tiket Wajib di Isi !!!'
        ],
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



    function pelaksanaall($id)
    {
        // dd($subquery);
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats','pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->join('lokasiperjadins','lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        if($id !== null){
            $builder->where('pegawais.pegawai_nip', $id);
        }
        $builder -> where('spts.spt_verif', 1);
        $builder -> where('spts.spt_jenis', 2);
        $query = $builder->get();
        return $query->getResult();
    }
    
    function taksiidpelaksana($id)
    {
        $builder = $this->db->table('spjtaksis As a');
        $builder -> select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, c.spt_tgl, c.spt_mulai, c.spt_berakhir, c.spt_tempat,d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder -> join('pelaksanas As b', 'b.pelaksana_id = a.spjtaksi_pelaksanaid', 'RIGHT');
        $builder -> join('spts As c', 'c.spt_id = b.spt_id');
        $builder -> join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder -> where('c.spt_verif', 1);
        $builder -> where('b.pelaksana_id', $id);
        $builder -> orderBy('a.spjtaksi_created_at', 'DESC');
        
        $query = $builder -> get();
        $result = $query->getResult();
            

        return $result;
    }
}
