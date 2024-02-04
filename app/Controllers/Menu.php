<?php

namespace App\Controllers;

use App\Models\MenusModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Menu extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $model = new MenusModel();
        $data = [
            'title' => 'Menu',
            'subtitle' => 'Home',
            'menu'  => $model->findAll(),
            // 'tes'  => $model->menuactive('2'),
        ];
        // dd($data);
        return view('menu/index', $data);

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
        if($this->request->isAJAX()){
            $model = new MenusModel();
            $data = $this->request->getPost();
            
            $save = $model->save($data);
            if($save){
                $ket = [
                        'error' => false,
                        'message' => 'Data Berhasil',
                    ];
                return $this->response->setJSON($ket);
            } else {
                $validationerror = [
                    'error'     => true,
                    'message'   => $model->errors(),
                ];
                return $this->response->setJSON($validationerror);
            };
        } else {
            '<p> Anda tidak berhak mengisi ini</p>';
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
        $model = new MenusModel();
        $data = $model->find($id);
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
        $model = new MenusModel();
        $model->delete($id);
        
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

    public function updatetoggle()
    {
        $itemModel = new MenusModel();
        $menu_id = $this->request->getPost('menu_id');
        $aktif = $itemModel->menuactive($menu_id);
        
        $status = $aktif[0]['menu_active'];
        // dd($status);

        // if (!empty($itemIds)) {
        if($status == '1'){
            // $itemModel->where('menu_id',$itemIds)->set('menu_active',0)->update($itemIds);
            $itemModel->where('menu_id', $menu_id)->set(['menu_active' => 0])->update();
        } else {
            $itemModel->where('menu_id', $menu_id)->set(['menu_active' => 1])->update();
        }
    }

}
