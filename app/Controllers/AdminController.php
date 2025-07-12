<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function dashAdmin()
    {
        return view('admin/dashboard.php');
    }

    public function penyewa()
    {
        return view('admin/penyewa.php');
    }

    public function kamar()
    {
        return view('admin/kamar.php');
    }

    public function pembayaran()
    {
        return view('admin/pembayaran.php');
    }

    public function laporanKeuangan()
    {
        return view('admin/laporan_keuangan.php');
    }

    public function pengaturanAkun()
    {
        return view('admin/pengaturan_akun.php');
    }
}
