<?php

namespace App\Controllers;

use App\Models\RolemenusModel;
use App\Models\RolesModel;
use App\Models\SubmenusModel;
use CodeIgniter\RESTful\ResourcePresenter;

class RoleMenu extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $model = new RolemenusModel();
        $submenu = new SubmenusModel();
        $role = new RolesModel();
        $data = [
            'title' => 'Role Menu',
            'subtitle' => 'Home',
            'rolemenu'  => $model->datarole(),
            'submenu'   => $submenu->findAll(),
            'role'      => $role->findAll(),
        ];
        // dd($data);
        return view('rolemenu/index', $data);
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
        $model = new RolemenusModel();
        $submenu = new SubmenusModel();
        $role = new RolesModel();
        $data = [
            'title' => 'Role Menu',
            'subtitle' => 'Home',
            'rolemenu'  => $model->datarole($id),
            'submenu'   => $submenu->findAll(),
            'role'      => $role->find($id),
        ];
        // dd($data);
        return view('rolemenu/index', $data);


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
            $model = new RolemenusModel();
            $data = $this->request->getPost();
            $roleid = $this->request->getPost('role_id');
            $submenus = $this->request->getPost('submenu_id');
            foreach ($submenus as $key => $value) {
                $data['role_id'] = $roleid;
                $data['submenu_id'] = $value;
                $model->save($data);
            }

                $ket = [
                        'error' => false,
                        'message' => 'Data Berhasil',
                        
                    ];
                return $this->response->setJSON($ket);
        //     };
        // } else {
        //     '<p> Anda tidak berhak mengisi ini</p>';
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
        $model = new RolemenusModel();
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
        $model = new RolemenusModel();
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
}
