<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Sidebar extends BaseController
{
    public function index(): string
    {
        $model = new AuthModel();
        $role = session('role_id');
        $menu = $model->navmenu($role);
        // $submenu = $model->navsubmenu($role, $menu['menu_id']);

        $data = [
            'menu' => $menu,
            'submenu' => $model->navsubmenu($role, $menu['menu_id']),
        ];
        // dd($data);
        return view('templates/sidebar', $data);
    }

}
