<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function dashUser()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Dashboard'
        ];
        return view('user/dashboard.php', $data);
    }
}
