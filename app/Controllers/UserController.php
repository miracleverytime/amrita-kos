<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\KamarModel;
use App\Models\SewaModel;
use App\Models\PembayaranModel;
use App\Models\LaporanKeuanganModel;
use App\Models\PindahKamarModel;
use Carbon\Carbon;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel,
        $kamarModel,
        $pindahModel,
        $sewaModel,
        $pembayaranModel,
        $laporanModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->kamarModel = new KamarModel;
        $this->pindahModel = new PindahKamarModel;
        $this->sewaModel = new SewaModel;
        $this->pembayaranModel = new PembayaranModel;
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
        $kamar = $this->kamarModel->where('id_user', $dataUser)->first();

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
            'kamar' => $kamar,
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

    public function pilih($id_kamar)
    {
        $idUser = session()->get('id_user');

        // Cek apakah user sudah punya kamar aktif
        $kamarUser = $this->kamarModel->where('id_user', $idUser)->first();
        if ($kamarUser && $kamarUser['status'] === 'Terisi') {
            return redirect()->back()->with('error', 'Anda sudah memiliki kamar yang aktif. Silakan ajukan pindah kamar jika ingin berganti kamar.');
        }

        // Ambil data kamar berdasarkan ID
        $kamar = $this->kamarModel->find($id_kamar);

        // Proteksi jika kamar tidak ditemukan
        if (!$kamar) {
            return redirect()->back()->with('error', 'Kamar tidak ditemukan.');
        }

        // Arahkan user ke halaman pembayaran dengan ID kamar terpilih
        return redirect()->to('/user/pembayaran?id_kamar=' . $id_kamar);
    }

    public function pembayaran()
    {
        \Carbon\Carbon::setLocale('id');

        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);

        $kamar = $this->kamarModel->where('id_user', $dataUser)->first();

        if (!$kamar && $this->request->getGet('id_kamar')) {
            $kamarId = $this->request->getGet('id_kamar');
            $kamar = $this->kamarModel->find($kamarId);
        }

        $biaya_admin = 5000;
        $total = $kamar ? ((int) ($kamar['harga'] ?? 0) + $biaya_admin) : 0;

        // Generate daftar 6 bulan ke depan
        $periodeTersedia = [];
        $now = Carbon::now();
        for ($i = 0; $i < 6; $i++) {
            $periode = $now->copy()->addMonths($i)->translatedFormat('F Y'); // August 2025
            $periodeTersedia[] = $periode;
        }

        // Ambil periode yang sudah dibayar user
        $periodeSudahDibayar = $this->pembayaranModel
            ->where('id_user', $dataUser)
            ->findAll();
        $periodeTerbayar = array_column($periodeSudahDibayar, 'periode');

        // Filter agar hanya tampil periode yang belum dibayar
        $periodeBelumDibayar = array_diff($periodeTersedia, $periodeTerbayar);

        $data = [
            'title' => 'Pembayaran',
            'user' => $user,
            'kamar' => $kamar,
            'biaya_admin' => $biaya_admin,
            'total' => $total,
            'periode' => $periodeBelumDibayar,
            'currentPage' => 'pembayaran'
        ];

        return view('user/pembayaran.php', $data);
    }

    public function prosesPembayaran()
    {
        helper(['form', 'url']);
        $db = \Config\Database::connect();
        $db->transStart(); // Mulai transaksi

        $idKamar   = $this->request->getPost('id_kamar');
        $periode   = $this->request->getPost('periode');
        $metode    = $this->request->getPost('metode');
        $harga     = $this->request->getPost('harga');
        $total     = $this->request->getPost('total');
        $buktiName = null;

        if ($metode !== 'cash') {
            $bukti = $this->request->getFile('bukti');
            if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
                $buktiName = $bukti->getRandomName();
                $bukti->move('uploads/bukti', $buktiName);
            }
        }

        // Simpan ke tabel pembayaran
        $this->pembayaranModel->insert([
            'id_user'      => session('id_user'),
            'id_kamar'     => $idKamar,
            'periode'      => $periode,
            'metode'       => $metode,
            'harga'        => $harga,
            'total_bayar'  => $total,
            'bukti'        => $buktiName,
            'status'       => 'pending',
            'tanggal'      => date('Y-m-d')
        ]);

        // Update status kamar jika tersedia
        $kamar = $this->kamarModel->find($idKamar);
        if ($kamar && $kamar['status'] === 'Tersedia') {
            $this->kamarModel->update($idKamar, [
                'status'  => 'Terisi',
                'id_user' => session('id_user')
            ]);
        }

        $db->transComplete(); // Commit atau rollback otomatis

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pembayaran.');
        }

        return redirect()->to('/user/pembayaran')->with('success', 'Pembayaran berhasil diajukan.');
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

        // Data user dan kamar
        $user = $this->userModel->find($dataUser);
        $kamar = $this->kamarModel->where('id_user', $dataUser)->first();

        // Ambil riwayat pembayaran dan join ke kamar
        $pembayaran = $this->pembayaranModel
            ->select('pembayaran.*, kamar.no_kamar')
            ->join('kamar', 'kamar.id_kamar = pembayaran.id_kamar')
            ->where('pembayaran.id_user', $dataUser)
            ->orderBy('tanggal_bayar', 'DESC')
            ->findAll();

        // Data summary
        $totalPembayaran = $this->pembayaranModel
            ->where('id_user', $dataUser)
            ->where('status', 'selesai')
            ->selectSum('total_bayar')
            ->get()
            ->getRowArray()['total_bayar'] ?? 0;

        $jumlahSukses = $this->pembayaranModel
            ->where('id_user', $dataUser)
            ->where('status', 'selesai')
            ->countAllResults();

        $jumlahGagal = $this->pembayaranModel
            ->where('id_user', $dataUser)
            ->where('status', 'gagal')
            ->countAllResults();

        // Mulai menghuni
        $sewa = $this->sewaModel->where('id_user', $dataUser)->first();
        $tglMulai = $sewa['tgl_awal'] ?? null;

        $data = [
            'title' => 'Riwayat',
            'user' => $user,
            'kamar' => $kamar,
            'currentPage' => 'history',
            'totalPembayaran' => $totalPembayaran,
            'jumlahSukses' => $jumlahSukses,
            'jumlahGagal' => $jumlahGagal,
            'tglMulai' => $tglMulai,
            'pembayaran' => $pembayaran
        ];

        return view('user/riwayat.php', $data);
    }


    public function profile()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);
        $kamar = $this->kamarModel->where('id_user', $dataUser)->first();
        $data = [
            'title' => 'Profile',
            'user' => $user,
            'kamar' => $kamar,
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
