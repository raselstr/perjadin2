<?php

namespace App\Controllers;

use App\Models\SpjHotelModel;
use CodeIgniter\RESTful\ResourcePresenter;



class SpjHotel extends ResourcePresenter
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
        $session = $this->session->get('idpengguna');
        $model = new SpjHotelModel();
        $spjhotel = $model->pelaksanaall($session);
        $data = [
            'title'     => 'Pertanggung Jawaban Hotel',
            'subtitle'  => 'Home',
            'spjhotel'  => $spjhotel,
            'session'   => $session,
                       
        ];
        // dd($data);
        return view('hotel/index', $data);
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
        $model = new SpjHotelModel();
        $hotelidpelaksana = $model->hotelidpelaksana($id);
        $data = [
            'title'     => 'Form Bill Hotel',
            'subtitle'  => 'Home',
            'data'      => $hotelidpelaksana,
                    
        ];
        // dd($data);
        return view('hotel/spjhotel', $data);
        
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        
        
        $spjhotel = new SpjHotelModel();
        $data = $this->request->getPost();
        $checkin = $this->request->getPost('spjhotel_checkin');
        $data['spjhotel_checkin'] = date('Y-m-d',strtotime($checkin));

        
        $save = $spjhotel->save($data);
        if($save){
            $ket = [
                    'error' => false,
                    'message' => 'Data Berhasil disimpan dan Upload Bill Hotel !!',
                ];
            return $this->response->setJSON($ket);
        } else {
            $validationerror = [
                'error'     => true,
                'message'   => $spjhotel->errors(),
            ];
            return $this->response->setJSON($validationerror);
        };
    }

    public function upload()
    {
        $validation = \Config\Services::validation();
        $spjhotel = new SpjHotelModel();
        if($this->request->isAJAX()){
            $data = $this->request->getPost();

            $scan = $this->request->getFile('spjhotel_bill');
            $idhotel = $this->request->getVar('spjhotel_id');

            $scanbilllama   = $this->request->getVar('scanbilllama');
            $valid = $this->validate([
                'spjhotel_bill' => [
                    'rules' => 'uploaded[spjhotel_bill]|ext_in[spjhotel_bill,pdf]',
                    'errors' => [
                        'uploaded'      => 'File harus di upload',
                        // 'max_size'      => 'Ukuran file PDF melebihi batas maksimum 5MB.',
                        'ext_in'        => 'File yang diunggah bukan merupakan file PDF.',
                    ]
                ],
            ]);

            $lamabill = file_exists (FCPATH. 'image/hotel/bill/'.$scanbilllama);
            if($idhotel == null) {
                $errors = [
                    'errors' => true,
                    'messages' => [
                        'idkosong' =>'Data SPJ Hotel Belum di Isi, isi terlebih dahulu Klik Tambah SPJ Hotel !!!!',
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
            
            $namascan = $scan->getRandomName();
            $data['spjhotel_bill'] = $namascan;
            
            
            $save = $spjhotel->save($data);
            if($save) {
                if($scanbilllama == null) {
                    if($lamabill ){
                        $scan->move(FCPATH . 'image/hotel/bill', $namascan);
                    } 
                } else {
                    if($lamabill ){
                        $scan->move(FCPATH . 'image/hotel/bill', $namascan);
                        unlink(FCPATH . 'image/hotel/bill/' . $scanbilllama);
                    } else {
                        $scan->move(FCPATH . 'image/hotel/bill', $namascan);
                    }
                }
                $pesan = [
                        'errors' => false,
                        'messages' => 'Data Berhasil di Upload',
                        'scanbilllama' => $scanbilllama,
                        'scanbaru'  => $namascan,
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
        $spjhotel = new SpjHotelModel();
        $data = $spjhotel->find($id);
        return $this->response->setJSON($data);
    }

    public function verif()
    {
        $spjhotel = new SpjHotelModel();
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();

            $saved = $spjhotel->save($data);

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
        $spjhotel = new SpjHotelModel();
        $spjhotel->delete($id);
        
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
