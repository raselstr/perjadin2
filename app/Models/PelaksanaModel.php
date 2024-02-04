<?php

namespace App\Models;

use CodeIgniter\Model;

class PelaksanaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelaksanas';
    protected $primaryKey       = 'pelaksana_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['spt_id','pegawai_id','pelaksana_utama'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        // 'pelaksana_id'  => 'permit_empty',
        // 'spt_id'      => 'permit_empty',
        // 'pegawai_id'  => 'is_unique[pelaksanas.pegawai_id,spt_id,{spt_id}]',
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

    function datapelaksanaall($id=null)
    {
        // dd($subquery);
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats','pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->join('lokasiperjadins','lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('pelaksanas.spt_id',$id);
        $builder->orderBy('pangkats.pangkat_id', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }
    function datapelaksana($id=null)
    {   
        $subquery = $this->db->table('pejabats')->select('pejabats.pejabat_nip');
                    $subquery->where('pejabats.pejabat_id','Kaban');
        // dd($subquery);
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats','pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->join('lokasiperjadins','lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');

        $builder->where('pelaksanas.spt_id',$id);
        $builder->where('pegawais.pegawai_nip !=',$subquery);

        $builder->orderBy('pangkats.pangkat_id', 'DESC');
        $query = $builder->get();
        $result = [
            'data' => $query->getResult(),
            'jumlah' => $query->getNumRows(),
        ];
        return $result;
    }
    
    function pelaksanastatus($id=null)
    {
        $builder = $this->db->table('pelaksanas');
        $builder->select('pelaksanas.pelaksana_utama');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->where('pelaksanas.pelaksana_id',$id);
        $query = $builder->get();
        return $query->getResultArray();
    }

    function caripengikut($id)
    {
        $array = ['pelaksanas.spt_id' => $id, 'pelaksanas.pelaksana_utama' => 0];
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        // $builder->selectCount('pelaksanas.pelaksana_utama');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->where($array);
        $query = $builder->get();
        return $query->getNumRows();
    }
    function cariutama($id)
    {
        $array = ['pelaksanas.spt_id' => $id, 'pelaksanas.pelaksana_utama' => 1];
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        // $builder->selectCount('pelaksanas.pelaksana_utama');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->where($array);
        $query = $builder->get();
        return $query->getNumRows();
    }

    function pelaksanautama ($id)
    {
        $array = ['pelaksanas.spt_id' => $id, 'pelaksanas.pelaksana_utama' => 1];
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->where($array);
        $query = $builder->get();
        return $query->getResult();
    }
    function pelaksanapengikut ($id)
    {
        $array = ['pelaksanas.spt_id' => $id, 'pelaksanas.pelaksana_utama' => 0];
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->where($array);
        $query = $builder->get();
        return $query->getResult();
    }

    public function angkaKeHuruf($angka)
    {
        $units = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan','Sepuluh'];
        $teens = ['', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];
        $tens = ['', 'Sepuluh', 'Dua Puluh', 'Tiga Puluh', 'Empat Puluh', 'Lima Puluh', 'Enam Puluh', 'Tujuh Puluh', 'Delapan Puluh', 'Sembilan Puluh'];

        $result = '';

        if ($angka == 0) {
            $result = 'Nol';
        } elseif ($angka <= 10) {
            $result = $units[$angka];
        } elseif ($angka < 20) {
            $result = $teens[$angka - 10];
        } elseif ($angka < 100) {
            $puluh = ($angka % 100 - $angka % 10) / 10;
            $satuan = $angka % 10;
            $result = $tens[$puluh];
            if ($satuan > 0) {
                $result .= ' ' . $units[$satuan];
            }
        } elseif ($angka < 1000) {
            $ratus = ($angka % 1000 - $angka % 100) / 100;
            $puluh = ($angka % 100 - $angka % 10) / 10;
            $satuan = $angka % 10;
            $result = $units[$ratus] . ' Ratus ';
            if ($puluh == 1 && $satuan > 0) {
                $result .= $teens[$satuan];
            } else {
                $result .= $tens[$puluh];
                if ($satuan > 0) {
                    $result .= ' ' . $units[$satuan];
                }
            }
        }

        return $result;
    }

    function kabanpelaksana($id=null)
    {
        $subquery = $this->db->table('pejabats')->select('pejabats.pejabat_nip')->where('pejabats.pejabat_id','Kaban');
        // dd($subquery);
        $builder = $this->db->table('pelaksanas');
        $builder->select('*');
        $builder->join('spts','spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais','pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats','pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('pangkats','pangkats.pangkat_id = pegawais.pangkat_id');
        $builder->join('lokasiperjadins','lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        
        $builder->where('pelaksanas.spt_id',$id);
        $builder->where('pegawais.pegawai_nip =',$subquery);
        $query = $builder->get();
        return $query->getResult();
    }

    
}

