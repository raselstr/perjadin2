<?php

namespace App\Models;

use CodeIgniter\Model;

class SpjhotelModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'spjhotels';
    protected $primaryKey       = 'hotel_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'hotel_pelaksanaid',
        'hotel_nama',
        'hotel_nokamar',
        'hotel_typekamar',
        'hotel_checkin',
        'hotel_checkout',
        'hotel_permlm',
        'hotel_totalharga',
        'hotel_foto',
        'hotel_bill',
        'hotel_verif',
        
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'hotel_created_at';
    protected $updatedField  = 'hotel_updated_at';
    protected $deletedField  = 'hotel_deleted_at';

    // Validation
    protected $validationRules      = [
        'hotel_nama'        => 'required',
        'hotel_nokamar'     => 'required|numeric',
        'hotel_typekamar'   => 'required',
        'hotel_checkin'     => 'required|valid_date[]',
        'hotel_checkout'    => 'required|valid_date[]',
        'hotel_permlm'      => 'required',
        'hotel_foto'        => 'max_size[hotel_foto,2048]|is_image[hotel_foto]|mime_in[hotel_foto,image/png,image/jpeg,image/jpg]',
        'hotel_bill'        => 'max_size[hotel_bill,5024]|ext_in[hotel_bill,pdf]',
    ];
    protected $validationMessages   = [
        'hotel_nama'        => [
            'required'      => 'Nama Hotel Wajib diisi !',
        ],
        'hotel_nokamar'     => [
            'required'      => 'Nomor Kamar Hotel Wajib diisi !',
            'numeric'       => 'Masukkan angka tanpa tanda pemisah ribuan',
        ],
        'hotel_typekamar'   => [
            'required'      => 'Type Kamar Hotel Wajib diisi !',
        ],
        'hotel_checkin'     => [
            'required'      => 'Tanggal Checkin Wajib diisi !',
            'valid_date'    => 'Format Tanggal harus d/m/Y'
        ],
        'hotel_checkout'    => [
            'required'      => 'Tanggal Checkout Wajib diisi !',
            'valid_date'    => 'Format Tanggal harus d/m/Y'
        ],
        'hotel_permlm' => [
            'required'      => 'Harga Per Malam Wajib diisi !',
            'numeric'       => 'Masukkan angka tanpa tanda pemisah ribuan',
        ],
        'hotel_foto'        => [
            'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
            'is_image'      => 'Data yang diupload Bukan Foto',
            'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
        ],
        'hotel_bill'        => [
            'max_size'      => 'Ukuran file PDF melebihi batas maksimum 2MB.',
            'ext_in'        => 'File yang diunggah bukan merupakan file PDF.',
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


    function spjhotel() 
    {
        $builder = $this->db->table('spjhotels As a');
        $builder -> select('a.*, b.pelaksana_id, c.spt_id, c.spt_nomor, d.pegawai_nama, d.pegawai_nip,d.pegawai_id, c.spt_uraian');
        $builder -> join('pelaksanas As b','b.pelaksana_id = a.hotel_pelaksanaid','RIGHT');
        $builder -> join('spts As c','c.spt_id = b.spt_id');
        $builder -> join('pegawais As d','d.pegawai_id = b.pegawai_id');
        $builder -> where('c.spt_verif = 1');
        $query = $builder -> get();
        return $query->getResult();
    }

}

