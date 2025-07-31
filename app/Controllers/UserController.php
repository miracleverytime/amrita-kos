<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KamarModel;
use App\Models\SewaModel;
use App\Models\LaporanKeuanganModel;
use App\Models\PindahKamarModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel,
        $kamarModel,
        $pindahModel,
        $sewaModel,
        $laporanModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->kamarModel = new KamarModel;
        $this->pindahModel = new PindahKamarModel;
        $this->sewaModel = new SewaModel;
        $this->laporanModel = new LaporanKeuanganModel;
    }

    public function dashUser()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $kamar = $this->kamarModel->where('id_user', $dataUser)->first();
        $data = [
            'title' => 'Dashboard',
            'user' => $user,
            'kamar' => $kamar,
            'currentPage' => 'dashboard'
        ];

        return view('user/dashboard.php', $data);
    }

    public function pilihKamar()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);

        $minHarga = $this->request->getGet('min_harga');
        $maxHarga = $this->request->getGet('max_harga');
        $fasilitas = $this->request->getGet('fasilitas');
        $status = $this->request->getGet('status');

        $builder = $this->kamarModel;

        if ($minHarga !== null && $minHarga !== '') {
            $builder = $builder->where('harga >=', $minHarga);
        }

        if ($maxHarga !== null && $maxHarga !== '') {
            $builder = $builder->where('harga <=', $maxHarga);
        }

        if ($fasilitas) {
            $builder = $builder->like('fasilitas', $fasilitas);
        }

        if ($status) {
            $builder = $builder->where('status', $status);
        }

        $kamarList = $builder->findAll();

        $data = [
            'title' => 'Pilih Kamar',
            'user' => $user,
            'kamar_list' => $kamarList,
            'currentPage' => 'pilihkamar',
            'filter' => [
                'min_harga' => $minHarga,
                'max_harga' => $maxHarga,
                'fasilitas' => $fasilitas,
                'status' => $status,
            ]
        ];
        return view('user/pilih_kamar.php', $data);
    }

    public function pembayaran()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $data = [
            'title' => 'Pembayaran',
            'user' => $user,
            'currentPage' => 'pembayaran'
        ];
        return view('user/pembayaran.php', $data);
    }

    public function pindahKamar()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $kamarSekarang = $this->kamarModel->where('id_user', $dataUser)->first();
        $kamarTujuan = $this->kamarModel->where('status', 'Tersedia')
            ->where('id_kamar  !=', $kamarSekarang['id_kamar'] ?? 0)
            ->findAll();
        $pengajuanPindah = $this->pindahModel->getPengajuanPindah(session()->get('id_user'));
        $riwayatPindah = $this->pindahModel->getRiwayatPindah($dataUser);
        $data = [
            'title' => 'Pindah Kamar',
            'user' => $user,
            'kamar' => $kamarSekarang,
            'kamarTujuan' => $kamarTujuan,
            'pengajuanPindah' => $pengajuanPindah,
            'riwayatPindah' => $riwayatPindah,
            'currentPage' => 'pindah-kamar'
        ];
        return view('user/pindah_kamar.php', $data);
    }

    public function prosesPindah()
    {
        $dataUser = session()->get('id_user');
        $idKamarBaru = $this->request->getPost('id_kamar_baru');
        $alasan = $this->request->getPost('alasan');
        $keterangan = $this->request->getPost('keterangan');

        $kamarSekarang = $this->kamarModel->where('id_user', $dataUser)->first();

        if (!$idKamarBaru || !$alasan || !$kamarSekarang) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        $this->pindahModel->insert([
            'id_user' => $dataUser,
            'id_kamar_lama' => $kamarSekarang['id_kamar'],
            'id_kamar_baru' => $idKamarBaru,
            'alasan' => $alasan,
            'keterangan' => $keterangan,
            'tanggal_pengajuan' => date('Y-m-d H:i:s'),
            'status' => 'Pending'
        ]);

        return redirect()->to('/user/pindah-kamar')->with('success', 'Permintaan pindah kamar telah diajukan.');
    }


    public function riwayat()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $data = [
            'title' => 'Riwayat',
            'user' => $user,
            'currentPage' => 'history'
        ];
        return view('user/riwayat.php', $data);
    }

    public function profile()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $data = [
            'title' => 'Profile',
            'user' => $user,
            'currentPage' => 'profile'
        ];
        return view('user/profile.php', $data);
    }

    public function updateProfile()
    {
        $request = \Config\Services::request();
        $id = session()->get('id_user');

        $oldData = $this->userModel->find($id);

        $data = [
            'nama'   => trim($request->getPost('nama')),
            'email'  => trim($request->getPost('email')),
            'no_hp'  => trim($request->getPost('no_hp')),
        ];

        // Validasi: semua field wajib diisi
        if (empty($data['nama']) || empty($data['email']) || empty($data['no_hp'])) {
            return redirect()->back()->with('error', 'Field tidak boleh kosong.');
        }


        // Cek jika email sudah digunakan oleh user lain
        if (!empty($data['email'])) {
            $existingEmail = $this->userModel
                ->where('email', $data['email'])
                ->where('id_user !=', $id)
                ->first();

            if ($existingEmail) {
                return redirect()->back()->with('error', 'Email sudah terdaftar oleh pengguna lain.');
            }
        }

        // Cek jika no_hp sudah digunakan oleh user lain
        $existingHP = $this->userModel
            ->where('no_hp', $data['no_hp'])
            ->where('id_user !=', $id)
            ->first();

        if ($existingHP) {
            return redirect()->back()->with('error', 'Nomor HP sudah terdaftar oleh pengguna lain.');
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
        $this->userModel->update($id, $data);
        session()->set($data);

        return redirect()->to('/user/profile')->with('success', 'Data berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $request = \Config\Services::request();
        $id = session()->get('id_user');

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
        $user = $this->userModel->find($id);

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

        $this->userModel->update($id, $data);

        return redirect()->to('/user/profile')->with('successp', 'Password berhasil diubah.');
    }
}
