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
            'title' => 'Dashboard',
            'currentPage' => 'dashboard'
        ];
        return view('user/dashboard.php', $data);
    }

    public function pilihKamar()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Pilih Kamar',
            'currentPage' => 'pilihkamar'
        ];
        return view('user/pilih_kamar.php', $data);
    }

    public function pembayaran()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Pembayaran',
            'currentPage' => 'pembayaran'
        ];
        return view('user/pembayaran.php', $data);
    }

    public function pindahKamar()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Dashboard',
            'currentPage' => 'pindah-kamar'
        ];
        return view('user/pindah_kamar.php', $data);
    }

    public function riwayat()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Riwayat',
            'currentPage' => 'history'
        ];
        return view('user/riwayat.php', $data);
    }

    public function profile()
    {
        $data = [
            'nama' => session()->get('nama'),
            'title' => 'Profile',
            'currentPage' => 'profile'
        ];
        return view('user/profile.php', $data);
    }
}
