<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\RawSql;
use ReturnTypeWillChange;

class RampungModel extends Model
{
    function rampungdataspt()
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

    function rampungall($id)
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
        $result = $query->getResult();
        return $result;
    }
    function rampungutama($id)
    {
        $builder = $this->db->table('pelaksanas');
        $builder->select('pelaksanas.*, spts.*, pegawais.*, pejabats.pejabat_nama, lokasiperjadins.lokasiperjadin_nama');
        $builder->join('spts', 'spts.spt_id = pelaksanas.spt_id');
        $builder->join('pegawais', 'pegawais.pegawai_id = pelaksanas.pegawai_id');
        $builder->join('pejabats', 'pejabats.pejabat_id = spts.spt_pjb_tugas');
        $builder->join('lokasiperjadins', 'lokasiperjadins.lokasiperjadin_id = spts.spt_tujuan');
        $builder->where('spts.spt_verif',1);
        $builder->where('pelaksanas.pelaksana_utama',1);
        $builder->where('spts.spt_id',$id);
        $builder->orderBy('spts.created_at', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    
    function rampunghotel($id = null)
    {
        // 
        $builder = $this->db->table('spjhotels As a');
        $builder->select('a.*');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjhotel_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('a.spjhotel_pelaksanaid', $id);
        $builder->where('a.spjhotel_verif', 1);
        $builder->orderBy('a.spjhotel_created_at', 'ASC');

        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    function rampungpesawat($id)
    {
        $builder = $this->db->table('spjpesawats As a');
        $builder->select('a.*');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjpesawat_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('a.spjpesawat_pelaksanaid', $id);
        $builder->where('a.spjpesawat_verif', 1);
        $builder->orderBy('a.spjpesawat_created_at', 'ASC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }
    function rampungtaksi($id)
    {
        $builder = $this->db->table('spjtaksis As a');
        $builder->select('a.*');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.spjtaksi_pelaksanaid', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('a.spjtaksi_pelaksanaid', $id);
        $builder->where('a.spjtaksi_verif', 1);
        $builder->orderBy('a.spjtaksi_created_at', 'ASC');

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }

    function rampungharian($id)
    {
        $builder = $this->db->table('uangharians As a');
        $builder->select('a.*');
        $builder->join('pelaksanas As b', 'b.pelaksana_id = a.uangharian_idpelaksana', 'RIGHT');
        $builder->join('spts As c', 'c.spt_id = b.spt_id');
        $builder->join('pegawais As d', 'd.pegawai_id = b.pegawai_id');
        $builder->where('c.spt_verif', 1);
        $builder->where('a.uangharian_idpelaksana', $id);
        $builder->where('a.uangharian_verif', 1);

        $query = $builder->get();
        $result = $query->getResult();

        return $result;
    }

    function rampungperbup($id, $key)
    {
        $sql = 'd.perbup_tingkatid = c.pegawai_tingkat AND d.perbup_lokasiid = a.spt_tujuan ';
        $builder = $this->db->table('spts as a');
        $builder->select(
            'a.spt_id, 
            a.spt_tahun, 
            a.spt_nomor, 
            a.sppd_nomor, 
            a.spt_lama, 
            a.spt_tgl, 
            a.spt_acara, 
            c.pegawai_nama, 
            c.pegawai_nip, 
            c.pegawai_jabatan, 
            b.pelaksana_id, 
            d.*'
        );
        $builder->join('pelaksanas AS b', 'b.spt_id = a.spt_id');
        $builder->join('pegawais AS c', 'c.pegawai_id = b.pegawai_id');
        $builder->join('perbups AS d', new RawSql($sql));

        $builder->where('a.spt_verif', 1);
        $builder->where('a.spt_id', $id);
        $builder->where('b.pelaksana_id', $key);
        $builder->orderBy('a.created_at', 'DESC');
        $query = $builder->get();

        return $query->getResult();
    }


    function rampungperpelaksana($idspt, $idpelaksana)
    {
        $sqhotel = $this->db->table('spjhotels as e')
                    ->select('a.spt_id, a.pelaksana_id, e.spjhotel_id, e.spjhotel_hargatotal ')
                    ->join('pelaksanas as a', 'a.pelaksana_id = e.spjhotel_pelaksanaid')
                    ->where('a.spt_id',$idspt)
                    ->where('e.spjhotel_verif','1');
        $sqtaksi = $this->db->table('spjtaksis as f')
                    ->select('a.spt_id, a.pelaksana_id, f.spjtaksi_id, f.spjtaksi_harga' )
                    ->join('pelaksanas as a', 'a.pelaksana_id = f.spjtaksi_pelaksanaid')
                    ->where('a.spt_id',$idspt)
                    ->where('f.spjtaksi_verif','1');
        $sqpesawat = $this->db->table('spjpesawats as g')
                    ->select('a.spt_id, a.pelaksana_id, g.spjpesawat_id, g.spjpesawat_harga')
                    ->join('pelaksanas as a', 'a.pelaksana_id = g.spjpesawat_pelaksanaid')
                    ->where('a.spt_id',$idspt)
                    ->where('g.spjpesawat_verif','1');
        $sqharian = $this->db->table('uangharians as h')
                    ->select('a.spt_id, a.pelaksana_id, h.uangharian_id, h.uangharian_jumlah')
                    ->join('pelaksanas as a', 'a.pelaksana_id = h.uangharian_idpelaksana')
                    ->where('a.spt_id',$idspt)
                    ->where('h.uangharian_verif','1');
        $sqtrans = $this->db->table('uangharians as h')
                    ->select('a.spt_id, a.pelaksana_id, h.uangharian_id, h.uangharian_jumlahbiayatransport')
                    ->join('pelaksanas as a', 'a.pelaksana_id = h.uangharian_idpelaksana')
                    ->where('a.spt_id',$idspt)
                    ->where('h.uangharian_verif','1');
        $sqrep = $this->db->table('uangharians as h')
                    ->select('a.spt_id, a.pelaksana_id, h.uangharian_id, h.uangharian_jumlahrepresentasi')
                    ->join('pelaksanas as a', 'a.pelaksana_id = h.uangharian_idpelaksana')
                    ->where('a.spt_id',$idspt)
                    ->where('h.uangharian_verif','1');
        $sqsewa = $this->db->table('uangharians as h')
                    ->select('a.spt_id, a.pelaksana_id, h.uangharian_id, h.uangharian_jumlahsewamobil')
                    ->join('pelaksanas as a', 'a.pelaksana_id = h.uangharian_idpelaksana')
                    ->where('a.spt_id',$idspt)
                    ->where('h.uangharian_verif','1');
       
        $sqhotel->unionAll($sqtaksi, 'Taksi');
        $sqhotel->unionAll($sqpesawat, 'Pesawat');
        $sqhotel->unionAll($sqharian, 'harian');
        $sqhotel->unionAll($sqtrans, 'transport');
        $sqhotel->unionAll($sqrep, 'representasi');
        $sqhotel->unionAll($sqsewa, 'sewa');

        $builder = $this->db->newQuery()->fromSubquery($sqhotel, 'Rekap')
                            ->groupStart()
                                ->where('Rekap.pelaksana_id',$idpelaksana)
                                ->selectSum('Rekap.spjhotel_hargatotal','subtotal')
                                    // ->orGroupStart()
                                    // ->where('Rekap.pelaksana_id',$idpelaksana)
                                    // ->selectSum('Rekap.spjhotel_hargatotal','subtotal')
                                    // ->groupEnd()
                            ->groupEnd()
                            ->get();
        
        // $query = $sqhotel->get();

       $data = $builder->getResult();

       
        return $data;

       }







    
}
