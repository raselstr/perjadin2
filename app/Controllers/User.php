<?php

namespace App\Controllers;

use App\Models\RolesModel;
use App\Models\UsersModel;
use CodeIgniter\RESTful\ResourcePresenter;

class User extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        $model = new UsersModel();
        $modelrole = new RolesModel();
        

        $data = [
            'title'     => 'User',
            'subtitle'  => 'Home',
            'pengguna'  => $model->datauser(),
            'role'      => $modelrole->dataroleuser(),
            // 'aktif'     =>$model->menuactive(2)
        ];
        // dd($data);
        return view('auth/index', $data);
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
        $validation = \Config\Services::validation();
        $UsersModel = new UsersModel();
        
        if($this->request->isAJAX()){
            $data = $this->request->getPost();
            $valid = $this->validate([
                'user_nama' => [
                    'rules' => 'required|alpha_numeric_space|is_unique[users.user_nama]',
                    'errors' => [
                        'required'              => 'Nama tidak Boleh Kosong',
                        'alpha_numeric_space'   => 'Tanpa menggunakan spesial karakter',
                        'is_unique'             => 'Nama User sudah digunakan, Harap ganti dengan yang lain !!!!'
                    ]
                ],
                'user_password' => [
                    'rules' => 'required|min_length[3]|max_length[20]',
                    'errors' => [
                        'required'              => 'Password tidak boleh kosong',
                        'min_length'            => '{field} minimal {param} karakter',
                        'max_length'            => 'Panjang {field} tidak boleh melebihi {param}',
                        ]
                ],
                'pass_confirm' => [
                    'rules' => 'required_with[user_password]|matches[user_password]',
                    'errors' => [
                        'required_with'         => 'Kompirmasi {field} harus diisi',
                        'matches'               => 'Password Tidak sama dengan {param}',
                        ]
                ],
                'user_roleid' => [
                    'rules' => 'required',
                    'errors' => [
                        'required'              => 'Role Belum dipilih' ,
                    ]
                ],
                'user_nmlengkap' => [
                    'rules' => 'required',
                    'errors' => [
                        'required'              => 'Nama Lengkap Harus diisi Belum dipilih' ,
                    ]
                ],
            ]);

            if(!$valid) {
                $errors = [
                        'errors' => true,
                        'messages' => $validation->getErrors(),
                    ];
                return $this->response->setJSON($errors);
            }

            $data['user_password'] =  password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT);
            $save = $UsersModel->save($data);
            if($save){
                $errors = [
                        'errors' => false,
                        'messages' => 'Data User Berhasil di simpan !',
                        // 'data' => $data,
                    ];
                return $this->response->setJSON($errors);
            }
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
        $model = new UsersModel();
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
        $itemModel = new UsersModel();
        $user_id = $this->request->getPost('user_id');
        $aktif = $itemModel->menuactive($user_id);
        
        $status = $aktif[0]['user_active'];
        

        // if (!empty($itemIds)) {
        if($status == 1){
            // $itemModel->where('user_id',$itemIds)->set('menu_active',0)->update($itemIds);
            $itemModel->where('user_id', $user_id)->set(['user_active' => 0])->update();
        } else {
            $itemModel->where('user_id', $user_id)->set(['user_active' => 1])->update();
        }
    }
}
