<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function dashAdmin()
    {

        $data = [
            'title'  => 'Admin - Dashboard',
            'currentPage' => 'dashboard',
            'nama'  => session()->get('nama')
        ];

        return view('admin/dashboard.php', $data);
    }

    public function penyewa()
    {
        $data = [
            'title'  => 'Admin - Penyewa',
            'currentPage' => 'penyewa'
        ];

        return view('admin/penyewa.php', $data);
    }

    public function kamar()
    {
        $data = [
            'title'  => 'Admin - Kamar',
            'currentPage' => 'kamar'
        ];

        return view('admin/kamar.php', $data);
    }

    public function pembayaran()
    {
        $data = [
            'title'  => 'Admin - Pembayaran',
            'currentPage' => 'pembayaran'
        ];

        return view('admin/pembayaran.php', $data);
    }

    public function laporanKeuangan()
    {
        $data = [
            'title'  => 'Admin - Laporan Keuangan',
            'currentPage' => 'laporan'
        ];

        return view('admin/laporan_keuangan.php', $data);
    }

    public function pengaturanAkun()
    {
        $data = [
            'title'  => 'Admin - Pengaturan Akun',
            'currentPage' => 'pengaturan'
        ];

        return view('admin/pengaturan_akun.php', $data);
    }
}
