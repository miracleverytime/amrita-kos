<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\UserModel;
use App\Models\KamarModel;
use App\Models\PindahKamarModel;
use App\Models\PembayaranModel;
use App\Models\LaporanKeuanganModel;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    protected $adminModel,
        $userModel,
        $kamarModel,
        $pembayaranModel,
        $pindahModel,
        $laporanModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel;
        $this->userModel = new UserModel;
        $this->kamarModel = new KamarModel;
        $this->pembayaranModel = new PembayaranModel;
        $this->pindahModel = new PindahKamarModel;
        $this->laporanModel = new LaporanKeuanganModel;
    }

    public function dashAdmin()
    {
        $dataAdmin = session()->get('id_admin');
        $admin = $this->adminModel->find($dataAdmin);
        $totalPenghuni = $this->userModel->countAllResults();
        $kamarTersedia = $this->kamarModel
            ->where('status', 'Tersedia')
            ->countAllResults();
        $pendingPindah = $this->pindahModel
            ->where('status', 'Pending')
            ->countAllResults();
        $data = [
            'title'  => 'Admin - Dashboard',
            'currentPage' => 'dashboard',
            'kamarTersedia' => $kamarTersedia,
            'totalPenghuni' => $totalPenghuni,
            'pengajuanPindah' => $pendingPindah,
            'admin' => $admin,
        ];

        return view('admin/dashboard.php', $data);
    }

    public function penyewa()
    {
        $request = \Config\Services::request();

        // Ambil parameter filter
        $status = $request->getGet('status');
        $kamar = $request->getGet('kamar');
        $tanggalMasuk = $request->getGet('tanggal_masuk');

        // Query dasar
        $query = $this->userModel
            ->select('user.*, kamar.no_kamar, kamar.status AS status_kamar')
            ->join('kamar', 'kamar.id_user = user.id_user', 'left');

        // Tambahkan filter jika ada
        if ($status) {
            $query->where('user.status', $status);
        }

        if ($kamar) {
            $query->where('kamar.no_kamar', $kamar);
        }

        if ($tanggalMasuk) {
            $query->where('user.tanggal_masuk', $tanggalMasuk);
        }

        // Pagination
        $perPage = 10;
        $penyewa = $query->paginate($perPage);
        $pager = $this->userModel->pager;

        // Tambahkan status pembayaran terakhir (opsional)
        foreach ($penyewa as &$p) {
            $lastPayment = $this->pembayaranModel
                ->where('id_user', $p['id_user'])
                ->orderBy('tanggal_bayar', 'DESC')
                ->first();

            $p['status_pembayaran'] = $lastPayment['status'] ?? 'Belum Ada';

            // Jika user belum memiliki kamar, set kolom kamar ke '-'
            if (empty($p['no_kamar'])) {
                $p['no_kamar'] = '-';
                $p['status_kamar'] = '-';
            }
        }

        $data = [
            'title'       => 'Admin - Penyewa',
            'currentPage' => 'penyewa',
            'penyewa'     => $penyewa,
            'pager'       => $pager
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
            'title'  => 'Admin - Pembayasan',
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
        $dataAdmin = session()->get('id_admin');
        $admin = $this->adminModel->find($dataAdmin);
        $data = [
            'title'  => 'Admin - Pengaturan Akun',
            'admin' => $admin,
            'currentPage' => 'pengaturan'
        ];

        return view('admin/pengaturan_akun.php', $data);
    }

    public function updateProfile()
    {
        $request = \Config\Services::request();
        $id = session()->get('id_admin');

        $oldData = $this->adminModel->find($id);

        $data = [
            'nama'   => trim($request->getPost('nama')),
            'email'  => trim($request->getPost('email')),
        ];

        // Validasi: semua field wajib diisi
        if (empty($data['nama']) || empty($data['email'])) {
            return redirect()->back()->with('error', 'Field tidak boleh kosong.');
        }


        // Cek jika email sudah digunakan oleh user lain
        if (!empty($data['email'])) {
            $existingEmail = $this->adminModel
                ->where('email', $data['email'])
                ->where('id_admin !=', $id)
                ->first();

            if ($existingEmail) {
                return redirect()->back()->with('error', 'Email sudah terdaftar oleh pengguna lain.');
            }
        }

        // Cek apakah ada perubahan data
        $isDifferent = false;
        foreach ($data as $key => $value) {
            if ($oldData[$key] != $value) {
                $isDifferent = true;
                break;
            }
        }

        if (!$isDifferent) {
            return redirect()->back()->with('error', 'Tidak ada data yang diperbarui.');
        }

        // Simpan perubahan
        $this->adminModel->update($id, $data);
        session()->set($data);

        return redirect()->to('/admin/pengaturan-akun')->with('success', 'Data berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $request = \Config\Services::request();
        $id = session()->get('id_admin');

        $oldPassword = $request->getPost('old_password');
        $newPassword = $request->getPost('new_password');
        $confirmPassword = $request->getPost('confirm_password');

        // Validasi input tidak boleh kosong
        if (empty($oldPassword) || empty($newPassword) || empty($confirmPassword)) {
            return redirect()->back()->with('errorp', 'Semua field password harus diisi.');
        }

        // Validasi panjang minimal password baru
        if (strlen($newPassword) < 8) {
            return redirect()->back()->with('errorp', 'Password baru minimal harus 8 karakter.');
        }

        // Ambil data user dari database
        $user = $this->adminModel->find($id);

        // Cek password lama
        if (!password_verify($oldPassword, $user['password'])) {
            return redirect()->back()->with('errorp', 'Password lama salah.');
        }

        // Cek konfirmasi password
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('errorp', 'Konfirmasi password tidak cocok.');
        }

        // Simpan password baru
        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ];

        $this->adminModel->update($id, $data);

        return redirect()->to('admin/pengaturan-akun')->with('successp', 'Password berhasil diubah.');
    }
}
