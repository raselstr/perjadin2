<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Kesalahan extends BaseController
{
    public function index()
    {
        $data =[
            'title' => 'Halaman ini bukan Hak Anda !!!!',
            'subtitle' => 'Home',
        ];
        return view('layout/500', $data);
    }
}
