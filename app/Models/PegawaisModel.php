<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pegawais';
    protected $primaryKey       = 'pegawai_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['pegawai_nip','pegawai_nama','pegawai_jabatan','eselon_id','pangkat_id','pegawai_tingkat','pegawai_foto'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'pegawai_id'        => 'permit_empty|is_natural_no_zero',
        'pegawai_nip'       => 'required|max_length[18]|min_length[9]|numeric|is_unique[pegawais.pegawai_nip,pegawai_id,{pegawai_id}]',
        'pegawai_nama'      => 'required|max_length[100]|min_length[3]',
        'pegawai_jabatan'   => 'required|max_length[100]|min_length[4]',
        'eselon_id'         => 'required',
        'pangkat_id'        => 'required',
        'pegawai_tingkat'   => 'required',
        'pegawai_foto'      => 'max_size[pegawai_foto,10048]|is_image[pegawai_foto]|mime_in[pegawai_foto,image/png,image/jpeg,image/jpg]',
    ];
    protected $validationMessages   = [
        'pegawai_nip' => [
            'required'              => 'NIP Wajib diisi',
            'is_unique'             => 'NIP sudah digunakan',
            'max_length'            => 'NIP Maximal 18 Karekter',
            'min_length'            => 'NIP Minimal 9 karekter',
            'numeric'               => 'NIP Harus berisikan angka tanpa spesial karakter dan spasi',
        ],
        'pegawai_nama' => [
            'required'              => 'Nama Wajib diisi',
            'min_length'            => 'Nama Minimal 3 Karakter',
        ],
        'pegawai_jabatan' => [
            'required'              => 'Jabatan Wajib diisi',
            'max_length'            => 'Jabatan Maksimal 50 Karakter',
            'min_length'            => 'Jabatan Minimal 5 Karakter',
        ],
        'eselon_id' => [
            'required'              => 'Eselon Wajib dipilih sesuai daftar',
        ],
        'pangkat_id' => [
            'required'              => 'Pangkat Wajib dipilih sesuai daftar',
        ],
        'pegawai_tingkat' => [
            'required'              => 'Tingkat SPPD Wajib dipilih sesuai daftar',
        ],
        'pegawai_foto' => [
            'uploaded'              => 'Pilih Foto yang akan diupload',
            'max_size'              => 'Ukuran File Foto maksimal 10048 Kbyte',
            'is_image'              => 'File bukan merupakan Foto/ Gambar',
            'mime_in'               => 'Harus File gambar',

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


    function getpegawaiAll()
    {
        $builder = $this->db->table('pegawais');
        $builder->select('*');
        $builder->join('eselons','eselons.eselon_id = pegawais.eselon_id');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $query = $builder->get();
        return $query->getResult();
    }

    function getpegawai($id=null)
    {
        $builder = $this->db->table('pegawais');
        $builder->select('*');
        $builder->join('eselons','eselons.eselon_id = pegawais.eselon_id');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->where('pegawais.pegawai_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
