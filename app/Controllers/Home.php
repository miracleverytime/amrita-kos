<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (session()->get('isLogin')) {
            session()->destroy();
        }
        return view('auth/login.php');
    }
}
