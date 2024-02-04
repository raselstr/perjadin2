<?php

namespace App\Controllers;

use App\Models\JenisperjadinModel;
use App\Models\LokasiperjadinModel;
use App\Models\PegawaisModel;
use App\Models\PejabatModel;
use App\Models\PelaksanaModel;
use App\Models\SptModel;
use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\IncomingRequest;

/**
 * @property IncomingRequest $request
 */

class Spt extends ResourcePresenter
{
    protected $session;
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */

    public function __construct()
    {
        // Load session helper
        helper('session');

        // Mendapatkan instance dari session
        $this->session = \Config\Services::session();
    }

    
    public function index()
    {
        helper('date');
        $session = $this->session->get('idpengguna');

        $spt = new SptModel();
        $sptpelaksana = $spt->pelaksanaspt($session);        
        $data = [
            'title'     => 'Perintah Tugas',
            'subtitle'  => 'Home',
            'spt'       => $sptpelaksana,
            'session'   => $session,
            // 'pejabat'   => $penugas->findAll(),
        ];
        // dd($data);
        return view('spt/index', $data);
    }

    /**
     * Present a view to present a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        $lokasiperjadin = new LokasiperjadinModel();
        $jenisperjadin  = new JenisperjadinModel();
        $pejabat        = new PejabatModel();
        $acara          = new SptModel();
        $data = [
            'title'     => 'Surat Perintah Tugas',
            'subtitle'  => 'Home',
            'lokasi'    => $lokasiperjadin->findAll(),
            'jenis'     => $jenisperjadin->findAll(),
            'pejabat'   => $pejabat->findAll(),
            'acara'     => $acara->getOptions(),
        ];
        // dd($data);
        return view('spt/tambahspt', $data);
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $spt = new SptModel();
        $data = $this->request->getPost();
        $sptmulai = $this->request->getPost('spt_mulai');
        $data['spt_mulai'] = date('Y-m-d',strtotime($sptmulai));
        // dd($data);

        $save = $spt->save($data);
        // dd($spt->errors());
        if ($save){
            return redirect()->to(site_url('spt'))->with('info','Data Berhasil di Simpan');
        } else {
            return redirect()->back()->withInput()->with('validation', $spt->errors());
        }
    }

    /**
     * Present a view to edit the properties of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        helper('date');
        $spt = new SptModel();
        $lokasiperjadin = new LokasiperjadinModel();
        $jenisperjadin  = new JenisperjadinModel();
        $pejabat        = new PejabatModel();

        $dataspt = $spt->find($id);
        if(is_object($dataspt)){
            $data = [
                'title'     => 'Edit Tambah Pegawai',
                'subtitle'  => 'Home',
                'spt'       => $dataspt,
                'lokasi'    => $lokasiperjadin->findAll(),
                'jenis'     => $jenisperjadin->findAll(),
                'pejabat'   => $pejabat->findAll(),
                'acara'     => $spt->getOptions(),
            ];
        //    dd($data);
            return view('spt/editspt', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
       
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function update($id = null)
    {
        
    }

     

    /**
     * Present a view to confirm the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function remove($id = null)
    {
        $spt = new SptModel();
        
        // $dataspt = $spt->find($id);
        $spt->delete($id);
        return redirect()->to(site_url('spt'))->with('info','Data Berhasil di Hapus');
    }

    /**
     * Process the deletion of a specific resource object
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    public function pelaksana($id = null)
    {
        $spt = new SptModel();
        $pelaksana = new PegawaisModel();
        $pegpelaksana = new PelaksanaModel();
        $dataspt = $spt->find($id);
        $data = [
            'title'     => 'Tambah Pelaksana Perjalanan Dinas',
            'subtitle'  => 'Home',
            'spt'       => $dataspt,
            'peg'       => $pelaksana->orderBy('pegawais.pegawai_id')->findAll(),
            'pelks'     => $pegpelaksana->datapelaksanaall($id),
            
            ];

        // dd($data);    
        return view('spt/pelaksanaspt', $data);
        

    }

    // Membuat Select Option Dinamis / Select option bertingkat
    public function getdatalokasi()
    {
        $idlokasi = new LokasiperjadinModel();

        if($this->request->isAJAX()){
            $idjenis = $this->request->getVar('spt_jenis');
            $idtempat = $idlokasi->lokasijenis($idjenis);
            $isidata ="";
            foreach ($idtempat as $key => $value) :
               $isidata .='<option value="'.$value['lokasiperjadin_id'].'">'.$value['lokasiperjadin_nama'].'</option>';
            endforeach;
            $msg = [
                'data' => $isidata,
            ];
            echo json_encode($msg);
        }
    }

    public function verif()
    {
        
        helper('date');
        $session = $this->session->get('idpengguna');
        $spt = new SptModel();
        $penugas = new PejabatModel();
        $dataspt = $spt->pelaksanaspt($session);
        $data = [
            'title'     => 'Verifikasi Surat Perintah Tugas',
            'subtitle'  => 'Home',
            'spt'       => $dataspt,
            'pejabat'   => $penugas->findAll(),
        ];
        // dd($data);
        return view('spt/verif', $data);
    }

    public function simpanverif ()
    {
        $validation = \Config\Services::validation();
        // $tgl_mulai = $spt->valid_tanggalspt($id);
        $valid = $this->validate([
            'spt_id'        => [
                'rules'     => 'permit_empty|is_natural_no_zero'
            ],
            'spt_nomor' => [
                'rules' => 'required|is_unique[spts.spt_nomor,spt_id,{spt_id}]',
                'errors' => [
                    'required'  => 'Nomor SPT Wajib diisi ! ',
                    'is_unique' => 'Nomor sudah digunakan, Harap masukkan nomor lain !',
                ]
            ],
            'sppd_nomor' => [
                'rules' => 'required|is_unique[spts.sppd_nomor,spt_id,{spt_id}]',
                'errors' => [
                    'required'  => 'Nomor SPD Wajib diisi ! ',
                    'is_unique' => 'Nomor sudah digunakan, Harap masukkan nomor lain !',
                ]
            ],
           
            'spt_tgl' => [
                'rules' => 'required',
                'errors' => [
                    'required'  => 'Tanggal SPT Wajib diisi ! ',
                ]
            ],

        ]);
        $tglmulai = strtotime($this->request->getVar('spt_mulai'));
        $tglspt = strtotime($this->request->getVar('spt_tgl'));
        

        if(!$valid) {
            if($tglspt > $tglmulai) {
                $errors = [
                    'error' => true,
                    'spt_tgl' => $tglspt,
                    'spt_mulai' => $tglmulai,
                    'messages' => 'Tanggal SPT melebihi dari Tanggal Mulai Perjalanan, Harap diganti!',
                ];
                return $this->response->setJSON($errors);
            } 
                $errors = [
                    'error' => true,
                    'messages' => $validation->getErrors(),
                ];
                return $this->response->setJSON($errors);
            
        } else {
                $spt = new SptModel();
           
                $data = $this->request->getPost();
                $spttgl = $this->request->getPost('spt_tgl');
                $data['spt_tgl'] = date('Y-m-d', strtotime($spttgl));
                $spt->save($data);
                $responsesuccess = [
                    'success'   => true,
                    'messages'   => 'Data Berhasil disimpan'
                ];
                return $this->response->setJSON($responsesuccess);
            }
        
            // return redirect()->back();
        
            // $errors = $this->validator->getErrors();
            
            
            // return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        
           

        
    }
}
