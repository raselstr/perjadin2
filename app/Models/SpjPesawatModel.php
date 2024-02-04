<?php

namespace App\Models;

use CodeIgniter\Model;

class SpjPesawatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'spjpesawats';
    protected $primaryKey       = 'spjpesawat_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'spjpesawat_pelaksanaid',
        'spjpesawat_jenis',
        'spjpesawat_maskapai',
        'spjpesawat_notiket',
        'spjpesawat_kdboking',
        'spjpesawat_tgl',
        'spjpesawat_dari',
        'spjpesawat_ke',
        'spjpesawat_harga',
        'spjpesawat_fototiket',
        'spjpesawat_bill',
        'spjpesawat_verif',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'spjpesawat_created_at';
    protected $updatedField  = 'spjpesawat_updated_at';
    protected $deletedField  = 'spjpesawat_deleted_at';

    // Validation
    protected $validationRules      = [
        'spjpesawat_pelaksanaid' => 'required',
        'spjpesawat_jenis' => 'required',
        'spjpesawat_maskapai' => 'required',
        'spjpesawat_notiket' => 'required',
        'spjpesawat_kdboking' => 'required',
        'spjpesawat_tgl' => 'required|valid_date[]',
        'spjpesawat_dari' => 'required',
        'spjpesawat_ke' => 'required',
        'spjpesawat_harga' => 'required',
    ];
    protected $validationMessages   = [
        'spjpesawat_jenis'      => [
            'required' => 'Jenis SPJ Pesawat Wajib di Pilih !!!'
        ],
        'spjpesawat_maskapai'      => [
            'required' => 'Maskapai Pesawat Wajib di Isi !!!'
        ],
        'spjpesawat_notiket'      => [
            'required' => 'Nomor Tiket Pesawat Wajib di Isi !!!'
        ],
        'spjpesawat_kdboking'      => [
            'required' => 'Kode Boking Pesawat Wajib di Isi !!!'
        ],
        'spjpesawat_tgl'      => [
            'required' => 'Tanggal Wajib di Pilih !!!',
            'valid_date' => 'Tanggal harus Valid !!'
        ],
        'spjpesawat_dari'      => [
            'required' => 'Keberangkatan Pesawat dari Bandahara mana Wajib di Isi !!!'
        ],
        'spjpesawat_ke'      => [
            'required' => 'Tujuan Pesawat ke Bandara mana Wajib di Isi !!!'
        ],
        'spjpesawat_harga'      => [
            'required' => 'Harga Tiket Pesawat Per Orang Per Tiket Wajib di Isi !!!'
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
    
    function pesawatidpelaksana($id)
    {
        $builder = $this->db->table('spjpesawats As a');
        $builder -> select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, c.spt_tgl, c.spt_mulai, c.spt_berakhir, c.spt_tempat,d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder -> join('pelaksanas As b', 'b.pelaksana_id = a.spjpesawat_pelaksanaid', 'RIGHT');
        $builder -> join('spts As c', 'c.spt_id = b.spt_id');
        $builder -> join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder -> where('c.spt_verif', 1);
        $builder -> where('b.pelaksana_id', $id);
        $builder -> orderBy('a.spjpesawat_created_at', 'DESC');
        
        $query = $builder -> get();
        $result = $query->getResult();
            

        return $result;
    }
}
