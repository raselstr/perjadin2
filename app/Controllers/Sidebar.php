<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Sidebar extends BaseController
{
    public function index(): string
    {
        $model = new AuthModel();
        $role = session('role_id');

        $data = [
            'navmenu' => $model->navmenu($role),
            // 'subnavmenu' =>$model->navsubmenu($role, )
        ];
        // dd($data);
        return view('templates/sidebar', $data);
    }

}
