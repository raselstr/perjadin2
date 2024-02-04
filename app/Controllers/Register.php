<?php

namespace App\Controllers;


use App\Models\UsersModel;
use CodeIgniter\RESTful\ResourcePresenter;

class Register extends ResourcePresenter
{
    /**
     * Present a view of resource objects
     *
     * @return mixed
     */
    public function index()
    {
        return view('auth/register');
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
        $UsersModel = new UsersModel();
        // register OK
        if (!$this->validate([
            'user_nama' => [
                'rules' => 'required|alpha_numeric_space|is_unique[users.user_nama]',
                'errors' => [
                    'required'              => 'Nama tidak Boleh Kosong',
                    'alpha_numeric_space'   => 'Tanpa menggunakan spesial karakter',
                ]
            ],
            'user_email' => [
                'rules' => 'required|valid_email|is_unique[users.user_email]',
                'errors' => [
                    'required'              => 'Email harus diisi dengan format email menggunakan @',
                    'valid_email'           => 'Email tidak Valid',
                    'is_unique'             => 'Maaf. Email sudah digunakan. Silahkan gunakan email lainnya.',
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
        ])) {
        return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        
        $UsersModel->save([
            'user_nama'     => $this->request->getPost('user_nama'),
            'user_email'    => $this->request->getPost('user_email'),
            'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
            
        ]);
        return redirect()->to(site_url('login'))->with('success','User Berhasil dibuat');
    // -----------------------------------------ok---------------------------------------------

      
        // // Bisa tp tidak bisa menyimpan ke DB penyebabnya Password_hash------------------------------------------
        // $validationErrors = $this->validate($userModel->getValidationRules(),$userModel->getValidationMessages());

        // if (!$validationErrors) {
        //     return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        // }
        // // $data = $this->request->getPost();  
        
        // $userModel->save([
        //     'user_nama'     => $this->request->getPost('user_nama'),
        //     'user_email'    => $this->request->getPost('user_email'),
        //     // 'user_password' => $this->request->getPost('user_password'),
        //     'user_password' => password_hash($this->request->getVar('user_password'), PASSWORD_BCRYPT),
        // ]);
        // // $userModel->save($data);
        // // dd($data);

        // return redirect()->to(site_url('login'))->with('success', 'User Berhasil dibuat');
        
        // // --------------------------------akhir--------------------------------------------------------

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
