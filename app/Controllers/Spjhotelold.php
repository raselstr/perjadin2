<?php

namespace App\Controllers;

use App\Models\SpjhotelModel;
use CodeIgniter\RESTful\ResourcePresenter;

use function PHPUnit\Framework\isNull;

class Spjhotel extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $model = new SpjhotelModel();
        $spjhotel = $model->spjhotel();
        $data = [
            'title'     => 'Pertanggung Jawaban Hotel',
            'subtitle'  => 'Home',
            'spjhotel'  => $spjhotel,
        ];
        // dd($spjhotel);
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
        
       
    }

    /**
     * Present a view to present a new single resource object
     *
     * @return mixed
     */
    public function new()
    {
        //  $data = [
        //     'title'     => 'Tambah Pertanggung Jawaban Hotel',
        //     'subtitle'  => 'Home',
        // ];
        // dd($data);
        // return view('hotel/modalform');
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return mixed
     */
    public function create()
    {
        
        if($this->request->isAJAX()){
            
            $spjhotel = new SpjhotelModel();
            $data = $this->request->getPost();
            
            $foto = $this->request->getFile('hotel_foto');
            $scan = $this->request->getFile('hotel_bill');

            $hotel_fotolama = $this->request->getVar('hotel_fotolama');
            $hotel_billlama = $this->request->getVar('hotel_billlama');
            $hotel_id = $this->request->getVar('hotel_id');

            if($foto->getError() == 4){ //4 => tidak ada mengupload foto
                $data['hotel_foto'] = $hotel_fotolama;
            } else {
                $namafoto = $foto->getRandomName();
                $data['hotel_foto'] = $namafoto;
                
            }
            if($scan->getError() == 4){ //4 => tidak ada mengupload foto
                $data['hotel_bill'] = $hotel_billlama;
            } else {
                $namascan = $scan->getRandomName();
                $data['hotel_bill'] = $namascan;
            }

            
            $myfilefoto = file_exists(FCPATH. 'image/hotel/'. $hotel_fotolama);
            $myfilebill = file_exists (FCPATH. 'image/hotelbill/'.$hotel_billlama);
            
            // dd($data);
            
            
            $save = $spjhotel->save($data);
            
            if ($save) {
                if($hotel_id == null) {
                    if($data['hotel_foto'] !== $hotel_fotolama) {
                        $foto->move(FCPATH . 'image/hotel', $namafoto);
                    }
                    if($data['hotel_bill'] !== $hotel_billlama) {
                        $scan->move(FCPATH . 'image/hotelbill', $namascan);
                    }
                } else {
                    if($data['hotel_foto'] !== $hotel_fotolama) {
                        if($myfilefoto == true) {
                            $foto->move(FCPATH . 'image/hotel', $namafoto);
                            unlink(FCPATH . 'image/hotel/' . $hotel_fotolama);
                        } else {
                            $foto->move(FCPATH . 'image/hotel', $namafoto);
                        }
                    }
                    if($data['hotel_bill'] !== $hotel_billlama) {
                        if($myfilebill == true) {
                            $scan->move(FCPATH . 'image/hotelbill', $namascan);
                            unlink(FCPATH . 'image/hotelbill/' . $hotel_billlama);
                        } else {
                            $scan->move(FCPATH . 'image/hotelbill', $namascan);
                        }
                    }
                }
                $ket = [
                    'error' => false,
                    'message' => 'Data Berhasil',
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
        $spjhotel = new SpjhotelModel();
        $data = $spjhotel->find($id);
        return $this->response->setJSON($data);
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
        //
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
