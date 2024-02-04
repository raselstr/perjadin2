<?php

namespace App\Controllers;

use App\Models\SpjPesawatModel;
use CodeIgniter\RESTful\ResourcePresenter;

class SpjPesawat extends ResourcePresenter
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
        $model = new SpjPesawatModel();
        $session = $this->session->get('idpengguna');
        $spjpesawat = $model->pelaksanaall($session);
        $data = [
            'title'     => 'Pertanggung Jawaban Pesawat',
            'subtitle'  => 'Home',
            'spjpesawat'  => $spjpesawat,
                       
        ];
        // dd($data);
        return view('pesawat/index', $data);
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
        //
    }

        
    public function formspj($id)
    {
        $model = new SpjPesawatModel();
        $pesawatidpelaksana = $model->pesawatidpelaksana($id);
        $data = [
            'title'     => 'Form Tiket Pesawat',
            'subtitle'  => 'Home',
            'data'      => $pesawatidpelaksana,
                    
        ];
        // dd($data);
        return view('pesawat/spjpesawat', $data);
        
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        
        
        $spjpesawat = new SpjPesawatModel();
        $data = $this->request->getPost();
        $checkin = $this->request->getPost('spjpesawat_tgl');
        $data['spjpesawat_tgl'] = date('Y-m-d',strtotime($checkin));
        
        $save = $spjpesawat->save($data);
        if($save){
            $ket = [
                    'error' => false,
                    'message' => 'Data Berhasil',
                ];
            return $this->response->setJSON($ket);
        } else {
            $validationerror = [
                'error'     => true,
                'message'   => $spjpesawat->errors(),
            ];
            return $this->response->setJSON($validationerror);
        };
    }

    public function upload()
    {
        $validation = \Config\Services::validation();
        $spjpesawat = new SpjPesawatModel();
        if($this->request->isAJAX()){
            $data = $this->request->getPost();

            $foto = $this->request->getFile('spjpesawat_fototiket');
            $scan = $this->request->getFile('spjpesawat_bill');
            $idpesawat = $this->request->getVar('spjpesawat_id');

            $fototiketlama  = $this->request->getVar('fototiketlama');
            $scanbilllama   = $this->request->getVar('scanbilllama');
            $valid = $this->validate([
                'spjpesawat_fototiket' => [
                    'rules'     => 'uploaded[spjpesawat_fototiket]|max_size[spjpesawat_fototiket,2048]|is_image[spjpesawat_fototiket]|mime_in[spjpesawat_fototiket,image/png,image/jpeg,image/jpg,image/gif]',
                    'errors'    => [
                        'uploaded'      => 'File harus di upload',
                        'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
                        'is_image'      => 'Data yang diupload Bukan Foto',
                        'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
                    ]
                ],
                'spjpesawat_bill' => [
                    'rules' => 'uploaded[spjpesawat_bill]|ext_in[spjpesawat_bill,pdf]',
                    'errors' => [
                        'uploaded'      => 'File harus di upload',
                        // 'max_size'      => 'Ukuran file PDF melebihi batas maksimum 5MB.',
                        'ext_in'        => 'File yang diunggah bukan merupakan file PDF.',
                    ]
                ],
            ]);

            $lamafoto = file_exists(FCPATH. 'image/pesawat/tiket/'. $fototiketlama);
            $lamabill = file_exists (FCPATH. 'image/pesawat/bill/'.$scanbilllama);
            if($idpesawat == null) {
                $errors = [
                    'errors' => true,
                    'messages' => [
                        'idkosong' =>'Data SPJ Pesawat Belum di Isi, isi terlebih dahulu Klik Tambah SPJ Pesawat !!!!',
                    ],
                ];
                return $this->response->setJSON($errors);
            } else {
            if(!$valid) {

                $errors = [
                        'errors' => true,
                        'messages' => $validation->getErrors(),
                    ];
                return $this->response->setJSON($errors);
                }
            }

            
            
            $namafoto = $foto->getRandomName();
            $data['spjpesawat_fototiket'] = $namafoto;
            
            
            $namascan = $scan->getRandomName();
            $data['spjpesawat_bill'] = $namascan;
            
            
            $save = $spjpesawat->save($data);
            if($save) {
                if($fototiketlama == null){
                    if($lamafoto) {
                        $foto->move(FCPATH . 'image/pesawat/tiket', $namafoto);
                    } 
                } else {
                    if($lamafoto) {
                        $foto->move(FCPATH . 'image/pesawat/tiket', $namafoto);
                        unlink(FCPATH . 'image/pesawat/tiket/' . $fototiketlama);
                    } 
                }
                
                if($scanbilllama == null) {
                    if($lamabill ){
                        $scan->move(FCPATH . 'image/pesawat/bill', $namascan);
                    } 
                } else {
                    if($lamabill ){
                        $scan->move(FCPATH . 'image/pesawat/bill', $namascan);
                        unlink(FCPATH . 'image/pesawat/bill/' . $scanbilllama);
                    } 
                }
                $pesan = [
                        'errors' => false,
                        'messages' => 'Data Berhasil di Upload',
                        'fototiketlama' => $fototiketlama,
                        'scanbilllama' => $scanbilllama,
                        'fototiketbaru' => $namafoto,
                        'scanbaru'  => $namascan,
                        'statusfoto'    => $lamafoto,
                        'statusscan'    => $lamabill,

                    ];
                return $this->response->setJSON($pesan);
            }
        };
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
        $spjpesawat = new SpjPesawatModel();
        $data = $spjpesawat->find($id);
        return $this->response->setJSON($data);
    }

    public function verif()
    {
        $spjpesawat = new SpjPesawatModel();
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();

            $saved = $spjpesawat->save($data);

            if ($saved) {
                $pesan = [
                    'error' => false,
                    'messages' => 'Data berhasil disimpan ke database.'
                ];
            } else {
                $pesan = [
                    'error' => true,
                    'messages' => 'Gagal menyimpan data ke database.'
                ];
            }

            return $this->response->setJSON($pesan);
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
        //
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
        $spjpesawat = new SpjPesawatModel();
        $spjpesawat->delete($id);
        
        // return $this->response->setJSON($pesan);
        return redirect()->back();
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
}
