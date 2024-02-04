<?php

namespace App\Controllers;

use App\Database\Migrations\Submenus;
use App\Models\MenusModel;
use App\Models\SubmenusModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Menusub extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $model = new SubmenusModel();
        $menu = new MenusModel();
        $data = [
            'title' => 'Sub Menu',
            'subtitle' => 'Home',
            'submenu'  => $model->kelompokmenu(),
            'menu'     => $menu->findall(),
            // 'tes'  => $model->menuactive('2'),
        ];
        // dd($data);
        return view('menusub/index', $data);

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
            $model = new SubmenusModel();
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
        $model = new SubmenusModel();
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
        $model = new SubmenusModel();
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
        $itemModel = new SubmenusModel();
        $submenu_id = $this->request->getPost('submenu_id');
        $aktif = $itemModel->menuactive($submenu_id);

        
        $status = $aktif[0]['submenu_active'];
        // dd($status);

        // if (!empty($itemIds)) {
        if($status == '1'){
            // $itemModel->where('submenu_id',$itemIds)->set('menu_active',0)->update($itemIds);
            $itemModel->where('submenu_id', $submenu_id)->set(['submenu_active' => 0])->update();
        } else {
            $itemModel->where('submenu_id', $submenu_id)->set(['submenu_active' => 1])->update();
        }
    }

}
