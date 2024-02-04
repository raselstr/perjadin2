<?php

namespace App\Controllers;

use App\Models\SpjTaksiModel;
use CodeIgniter\RESTful\ResourcePresenter;

class SpjTaksi extends ResourcePresenter
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
        $model = new SpjTaksiModel();
        $session = $this->session->get('idpengguna');

        $spjtaksi = $model->pelaksanaall($session);
        $data = [
            'title'     => 'Pertanggung Jawaban Taksi/ Angkutan Umum',
            'subtitle'  => 'Home',
            'spjtaksi'  => $spjtaksi,
                       
        ];
        // dd($data);
        return view('taksi/index', $data);
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
        $model = new SpjTaksiModel();
        $taksiidpelaksana = $model->taksiidpelaksana($id);
        $data = [
            'title'     => 'Form Tiket Taksi',
            'subtitle'  => 'Home',
            'data'      => $taksiidpelaksana,
                    
        ];
        // dd($data);
        return view('taksi/spjtaksi', $data);
        
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $spjtaksi = new SpjTaksiModel();
        $data = $this->request->getPost();
        $checkin = $this->request->getPost('spjtaksi_tgl');
        $data['spjtaksi_tgl'] = date('Y-m-d',strtotime($checkin));
        
        $save = $spjtaksi->save($data);
        if($save){
            $ket = [
                    'error' => false,
                    'message' => 'Data Berhasil Simpan',
                ];
            return $this->response->setJSON($ket);
        } else {
            $validationerror = [
                'error'     => true,
                'message'   => $spjtaksi->errors(),
            ];
            return $this->response->setJSON($validationerror);
        };
    }

    public function upload()
    {
        $validation = \Config\Services::validation();
        $spjtaksi = new SpjTaksiModel();
        if($this->request->isAJAX()){
            $data = $this->request->getPost();

            $foto = $this->request->getFile('spjtaksi_fototiket');
            $idtaksi = $this->request->getVar('spjtaksi_id');

            $fototiketlama  = $this->request->getVar('fototiketlama');
            $valid = $this->validate([
                'spjtaksi_fototiket' => [
                    'rules'     => 'uploaded[spjtaksi_fototiket]|max_size[spjtaksi_fototiket,2048]|is_image[spjtaksi_fototiket]|mime_in[spjtaksi_fototiket,image/png,image/jpeg,image/jpg,image/gif]',
                    'errors'    => [
                        'uploaded'      => 'File harus di upload',
                        'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
                        'is_image'      => 'Data yang diupload Bukan Foto',
                        'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
                    ]
                ],
            ]);

            $lamafoto = file_exists(FCPATH. 'image/taksi/tiket/'. $fototiketlama);
            if($idtaksi == null) {
                $errors = [
                    'errors' => true,
                    'messages' => [
                        'idkosong' =>'Data SPJ Taksi Belum di Isi, isi terlebih dahulu Klik Tambah SPJ Taksi !!!!',
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
            $data['spjtaksi_fototiket'] = $namafoto;
            
            $save = $spjtaksi->save($data);
            if($save) {
                if($fototiketlama == null){
                    if($lamafoto) {
                        $foto->move(FCPATH . 'image/taksi/tiket', $namafoto);
                    } 
                } else {
                    if($lamafoto) {
                        $foto->move(FCPATH . 'image/taksi/tiket', $namafoto);
                        unlink(FCPATH . 'image/taksi/tiket/' . $fototiketlama);
                    } else {
                        $foto->move(FCPATH . 'image/taksi/tiket', $namafoto);

                    }
                }
                
                $pesan = [
                        'errors' => false,
                        'messages' => 'Data Berhasil di Upload',
                        'fototiketlama' => $fototiketlama,
                        'fototiketbaru' => $namafoto,
                        'statusfoto'    => $lamafoto,

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
        $spjtaksi = new SpjTaksiModel();
        $data = $spjtaksi->find($id);
        return $this->response->setJSON($data);
    }

    public function verif()
    {
        $spjtaksi = new SpjTaksiModel();
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();

            $saved = $spjtaksi->save($data);

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
        $spjtaksi = new SpjTaksiModel();
        $spjtaksi->delete($id);
        
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
