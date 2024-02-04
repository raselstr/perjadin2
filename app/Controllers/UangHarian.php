<?php

namespace App\Controllers;

use App\Models\SpjHotelModel;
use App\Models\UangHarianModel;
use CodeIgniter\RESTful\ResourcePresenter;

class UangHarian extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        //
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
        
        
        $uangharian = new UangHarianModel();
        $data = $this->request->getPost();
        
        $uangharian->save($data);
        return redirect()->back()->with('Info','Data Berhasil disimpan');
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
