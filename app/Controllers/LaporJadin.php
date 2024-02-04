<?php

namespace App\Controllers;

use App\Models\LaporjadinModel;
use App\Models\SptModel;
use CodeIgniter\RESTful\ResourcePresenter;

class LaporJadin extends ResourcePresenter
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
        $model = new LaporjadinModel();
        $session = $this->session->get('idpengguna');

        $query = $model->dataspt($session);
        $data = [
            'title' => 'Laporan Kegiatan Perjalanan Dinas',
            'subtitle' => 'Home',
            'data' => $query,
        ];
        // dd($data);
        return view('laporperjadin/index', $data);

    }

    public function form($id=null)
    {
        $model = new LaporjadinModel();
        $query = $model->datasptid($id);

        $data = [
            'title' => 'Laporanan Perjalanan Dinas',
            'subtitle' => 'Home',
            'data'  => $query,
        ];
        // dd($data);
        return view('laporperjadin/spjlapor', $data);

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

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        $model = new LaporjadinModel();
        $post = $this->request->getPost();
        $save = $model->save($post);
            // dd($model->errors());
            if ($save) {
                return redirect()->to(site_url('laporjadin'))->with('info', 'Data Berhasil di Simpan');
            } else {
                return redirect()->back()->withInput()->with('validation', $model->errors());
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
        //
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
        $model = new LaporjadinModel();
        $query = $model->datasptid($id);

        $nmfoto1 = file_exists(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto1) ? $query[0]->laporjadin_foto1 : null;
        $nmfoto2 = file_exists(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto2) ? $query[0]->laporjadin_foto2 : null;
        $nmfoto3 = file_exists(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto3) ? $query[0]->laporjadin_foto3 : null;


        $hapus = $model->delete($query[0]->laporjadin_id);
        if($hapus) {
            if($nmfoto1 != "") {
                unlink(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto1);
            }
            if($nmfoto2 != "") {
                unlink(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto2);
            }
            if($nmfoto3 != "") {
                unlink(FCPATH . 'image/dokuemtasi/' . $query[0]->laporjadin_foto3);
            }

            // dd($query[0]->laporjadin_id);
            return redirect()->back();
        }
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

    public function verif()
    {
        $model = new LaporjadinModel();
        if ($this->request->isAJAX()) {
            $data = $this->request->getPost();

            $saved = $model->save($data);

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

    public function formupload($id)
    {
        $model = new LaporjadinModel();
        $query = $model->datasptid($id);

        $data = [
            'title' => 'Foto Kegiatan Perjalanan Dinas',
            'subtitle' => 'Home',
            'data' => $query,
        ];
        // dd($data);
        return view('laporperjadin/spjlaporfoto', $data);

    }

    public function upload()
    {
        $validation = \Config\Services::validation();

        $model = new LaporjadinModel();
        $data = $this->request->getPost();

        $foto1 = $this->request->getFile('laporjadin_foto1');
        $foto2 = $this->request->getFile('laporjadin_foto2');
        $foto3 = $this->request->getFile('laporjadin_foto3');

        $oldfoto1 = $this->request->getVar('oldlaporjadin_foto1');
        $oldfoto2 = $this->request->getVar('oldlaporjadin_foto2');
        $oldfoto3 = $this->request->getVar('oldlaporjadin_foto3');
        $idlaporjadin = $this->request->getVar('laporjadin_id');

        
        $valid = $this->validate([
            'laporjadin_foto1' => [
                'rules'     => 'uploaded[laporjadin_foto1]|max_size[laporjadin_foto1,2048]|is_image[laporjadin_foto1]|mime_in[laporjadin_foto1,image/png,image/jpeg,image/jpg,image/gif],max_dims[laporjadin_foto1,4000,3000]',
                'errors'    => [
                    'uploaded'      => 'File harus di upload',
                    'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
                    'is_image'      => 'Data yang diupload Bukan Foto',
                    'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
                    'max_dims'      => 'Lebar dan tinggi Foto terlalu besar',
                ]
            ],
            'laporjadin_foto2' => [
                'rules'     => 'max_size[laporjadin_foto2,2048]|is_image[laporjadin_foto2]|mime_in[laporjadin_foto2,image/png,image/jpeg,image/jpg,image/gif],max_dims[laporjadin_foto2,4000,3000]',
                'errors'    => [
                    'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
                    'is_image'      => 'Data yang diupload Bukan Foto',
                    'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
                    'max_dims'      => 'Lebar dan tinggi Foto terlalu besar',
                ]
            ],
            'laporjadin_foto3' => [
                'rules'     => 'max_size[laporjadin_foto3,2048]|is_image[laporjadin_foto3]|mime_in[laporjadin_foto3,image/png,image/jpeg,image/jpg,image/gif],max_dims[laporjadin_foto3,4000,3000]',
                'errors'    => [
                    'max_size'      => 'Besar file foto yang diupload tidak lebih dari 2 Mb',
                    'is_image'      => 'Data yang diupload Bukan Foto',
                    'mime_in'       => 'Ekstensi File Foto yang diperbolehkan JPG, JPEG dan PNG',
                    'max_dims'      => 'Lebar dan tinggi Foto terlalu besar',
                ]
            ],
        ]);

        
        
        if($foto1->getError() == 4){
            $nama1 = $oldfoto1;
            $data['laporjadin_foto1'] = $nama1;
        } else {
            $nama1 = $foto1->getRandomName();
            $data['laporjadin_foto1'] = $nama1;

        }

        if($foto2->getError() == 4){
            $nama2 = $oldfoto2;
            $data['laporjadin_foto2'] = $nama2;
        } else {
            $nama2 = $foto2->getRandomName();
            $data['laporjadin_foto2'] = $nama2;

        }

        if($foto3->getError() == 4){
            $nama3 = $oldfoto3;
            $data['laporjadin_foto3'] = $nama3;
        } else {
            $nama3 = $foto3->getRandomName();
            $data['laporjadin_foto3'] = $nama3;

        }
        // dd($data);

        if(!$valid) {
            return redirect()->back()->withInput()->with('validation',$validation->getErrors());
        }

        $nmfoto1 = file_exists(FCPATH . 'image/dokuemtasi/' . $oldfoto1) ? $oldfoto1 : null;
        $nmfoto2 = file_exists(FCPATH . 'image/dokuemtasi/' . $oldfoto2) ? $oldfoto2 : null;
        $nmfoto3 = file_exists(FCPATH . 'image/dokuemtasi/' . $oldfoto3) ? $oldfoto3 : null;
        
        // dd($data, $nmfoto1, $nmfoto2, $nmfoto3);
        
        $save = $model->save($data);
        if ($save) {
            if ($data['laporjadin_foto1'] != "" && $data['laporjadin_foto1'] != $oldfoto1) {
                if($nmfoto1 != "") { 
                    $foto1->move(FCPATH . 'image/dokuemtasi', $nama1);
                    unlink(FCPATH . 'image/dokuemtasi/' . $oldfoto1);
                } else {
                    $foto1->move(FCPATH . 'image/dokuemtasi', $nama1);
                }
            }
            if ($data['laporjadin_foto2'] != "" && $data['laporjadin_foto2'] != $oldfoto2) {
                if($nmfoto2 != "") { 
                    $foto2->move(FCPATH . 'image/dokuemtasi', $nama2);
                    unlink(FCPATH . 'image/dokuemtasi/' . $oldfoto2);
                } else {
                    $foto2->move(FCPATH . 'image/dokuemtasi', $nama2);
                }
            }
            if ($data['laporjadin_foto3'] != "" && $data['laporjadin_foto3'] != $oldfoto3) {
                if($nmfoto3 != "") { 
                    $foto3->move(FCPATH . 'image/dokuemtasi', $nama3);
                    unlink(FCPATH . 'image/dokuemtasi/' . $oldfoto3);
                } else {
                    $foto3->move(FCPATH . 'image/dokuemtasi', $nama3);
                }
            }
            
            return redirect()->back()->with('info', 'Data Berhasil di Simpan');
        } 
    }

    
}
