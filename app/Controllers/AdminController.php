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

        // Pembayaran terbaru (5 terakhir)
        $pembayaranTerbaru = $this->pembayaranModel
            ->select('pembayaran.*, user.nama AS nama_user, kamar.no_kamar')
            ->join('user', 'user.id_user = pembayaran.id_user', 'left')
            ->join('kamar', 'kamar.id_kamar = pembayaran.id_kamar', 'left')
            ->orderBy('tanggal_bayar', 'DESC')
            ->findAll(5);

        // Riwayat pindah kamar (5 terakhir)
        $riwayatPindah = $this->pindahModel
            ->select('pindah_kamar.*, user.nama AS nama_user, kl.no_kamar AS no_kamar_lama, kb.no_kamar AS no_kamar_baru')
            ->join('user', 'user.id_user = pindah_kamar.id_user', 'left')
            ->join('kamar kl', 'kl.id_kamar = pindah_kamar.id_kamar_lama', 'left')
            ->join('kamar kb', 'kb.id_kamar = pindah_kamar.id_kamar_baru', 'left')
            ->orderBy('pindah_kamar.created_at', 'DESC')
            ->findAll(5);
        $data = [
            'title'  => 'Admin - Dashboard',
            'currentPage' => 'dashboard',
            'kamarTersedia' => $kamarTersedia,
            'totalPenghuni' => $totalPenghuni,
            'pengajuanPindah' => $pendingPindah,
            'admin' => $admin,
            'pembayaranTerbaru' => $pembayaranTerbaru,
            'riwayatPindah' => $riwayatPindah,
        ];

        return view('admin/dashboard.php', $data);
    }

    public function penyewa()
    {
        $request = \Config\Services::request();

        // Ambil semua kamar
        $kamarList = $this->kamarModel->findAll();

        // Ambil parameter filter
        $status = $request->getGet('status');
        $kamar  = $request->getGet('kamar');
        $tanggalMasuk = $request->getGet('tanggal_masuk');

        // Query dasar
        $query = $this->userModel
            ->select('user.*, kamar.id_kamar, kamar.no_kamar, kamar.status AS status_kamar')
            ->join('kamar', 'kamar.id_user = user.id_user', 'left');

        // Tambahkan filter jika ada
        if (!empty($status)) {
            $query->where('user.status', $status);
        }

        if (!empty($kamar)) {
            $query->where('kamar.id_kamar', $kamar); // pakai id_kamar untuk konsistensi
        }

        if (!empty($tanggalMasuk)) {
            $query->where('user.tanggal_masuk', $tanggalMasuk);
        }

        // Pagination
        $perPage = 10;
        $penyewa = $query->paginate($perPage);
        $pager   = $this->userModel->pager;

        // Tambahkan status pembayaran terakhir
        foreach ($penyewa as &$p) {
            $lastPayment = $this->pembayaranModel
                ->where('id_user', $p['id_user'])
                ->orderBy('tanggal_bayar', 'DESC')
                ->first();

            $p['status_pembayaran'] = $lastPayment['status'] ?? 'Belum Ada';

            if (empty($p['no_kamar'])) {
                $p['no_kamar']   = '-';
                $p['status_kamar'] = '-';
            }
        }

        $data = [
            'title'       => 'Admin - Penyewa',
            'currentPage' => 'penyewa',
            'penyewa'     => $penyewa,
            'kamarList'   => $kamarList,
            'pager'       => $pager,
        ];

        return view('admin/penyewa.php', $data);
    }

    public function kamar()
    {
        $request = \Config\Services::request();

        $status = strtolower((string) $request->getGet('status'));
        $q = trim((string) $request->getGet('q'));
        $pkPerPageReq = (int) $request->getGet('pk_per_page');
        $allowedPerPage = [10, 25, 50];
        $perPagePk = in_array($pkPerPageReq, $allowedPerPage, true) ? $pkPerPageReq : 10;
        $dataAdmin = session()->get('id_admin');
        $admin = $this->adminModel->find($dataAdmin);

        $builder = $this->kamarModel
            ->select('kamar.*, user.nama AS nama_user, user.tanggal_masuk')
            ->join('user', 'user.id_user = kamar.id_user', 'left');

        if ($status !== '') {
            // Status di DB disimpan kapital awal: Tersedia, Terisi, Maintenance
            $builder->where('kamar.status', ucfirst($status));
        }

        if ($q !== '') {
            $builder->groupStart()
                ->like('kamar.no_kamar', $q)
                ->orLike('kamar.fasilitas', $q)
                ->orLike('user.nama', $q)
                ->groupEnd();
        }

        $kamarList = $builder->orderBy('kamar.no_kamar', 'ASC')->findAll();

        // Ambil daftar pengajuan pindah kamar (paginate)
        $pindahKamar = $this->pindahModel
            ->select('pindah_kamar.*, user.nama AS nama_user, kl.no_kamar AS kamar_asal, kb.no_kamar AS kamar_tujuan, pindah_kamar.created_at AS tanggal_pengajuan')
            ->join('user', 'user.id_user = pindah_kamar.id_user', 'left')
            ->join('kamar kl', 'kl.id_kamar = pindah_kamar.id_kamar_lama', 'left')
            ->join('kamar kb', 'kb.id_kamar = pindah_kamar.id_kamar_baru', 'left')
            ->orderBy('pindah_kamar.created_at', 'DESC')
            ->paginate($perPagePk, 'pindah_kamar');

        $data = [
            'title'       => 'Admin - Kamar',
            'currentPage' => 'kamar',
            'admin'       => $admin,
            'kamarList'   => $kamarList,
            'filters'     => [
                'status' => $status,
                'q'      => $q,
            ],
            'pindahKamar' => $pindahKamar,
            'pagerPk'     => $this->pindahModel->pager,
            'pkPerPage'   => $perPagePk,
            'pkPerPageAllowed' => $allowedPerPage,
        ];

        return view('admin/kamar.php', $data);
    }

    public function approvePindahKamar($id)
    {
        $id = (int) $id;
        $req = \Config\Services::request();
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Metode tidak diizinkan.');
        }

        $row = $this->pindahModel->find($id);
        if (!$row) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $statusVal = strtolower((string) ($row['status'] ?? ''));
        if (!in_array($statusVal, ['pending', 'menunggu'], true)) {
            return redirect()->back()->with('error', 'Pengajuan sudah diproses.');
        }

        $idUser = (int) ($row['id_user'] ?? 0);
        $idKamarLama = (int) ($row['id_kamar_lama'] ?? 0);
        $idKamarBaru = (int) ($row['id_kamar_baru'] ?? 0);

        $db = \Config\Database::connect();
        $db->transStart();

        $kamarLama = $idKamarLama ? $this->kamarModel->find($idKamarLama) : null;
        $kamarBaru = $idKamarBaru ? $this->kamarModel->find($idKamarBaru) : null;

        if (!$kamarBaru) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Kamar tujuan tidak ditemukan.');
        }

        $kamarBaruStatus = strtolower((string) ($kamarBaru['status'] ?? ''));
        $kamarBaruUser = (int) ($kamarBaru['id_user'] ?? 0);
        if ($kamarBaruStatus === 'terisi' && $kamarBaruUser !== $idUser) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Kamar tujuan tidak tersedia.');
        }

        // Update kamar lama -> tersedia jika memang dihuni user bersangkutan
        if ($kamarLama) {
            $kamarLamaUser = (int) ($kamarLama['id_user'] ?? 0);
            $updateLama = ['status' => 'Tersedia'];
            if ($kamarLamaUser === $idUser) {
                $updateLama['id_user'] = null;
            }
            $this->kamarModel->update($idKamarLama, $updateLama);
        }

        // Update kamar baru -> terisi oleh user
        $this->kamarModel->update($idKamarBaru, [
            'status'  => 'Terisi',
            'id_user' => $idUser,
        ]);

        // Update status pengajuan
        $this->pindahModel->update($id, ['status' => 'Disetujui']);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses persetujuan pindah kamar.');
        }

        return redirect()->back()->with('success', 'Pengajuan pindah kamar disetujui.');
    }

    public function rejectPindahKamar($id)
    {
        $id = (int) $id;
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Metode tidak diizinkan.');
        }

        $row = $this->pindahModel->find($id);
        if (!$row) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan.');
        }

        $statusVal = strtolower((string) ($row['status'] ?? ''));
        if (!in_array($statusVal, ['pending', 'menunggu'], true)) {
            return redirect()->back()->with('error', 'Pengajuan sudah diproses.');
        }

        $this->pindahModel->update($id, ['status' => 'Ditolak']);
        return redirect()->back()->with('success', 'Pengajuan pindah kamar ditolak.');
    }

    public function pembayaran()
    {
        $request = \Config\Services::request();

        // Ambil parameter filter
        $status = $request->getGet('status');
        $metode = $request->getGet('metode');
        $periode = $request->getGet('periode');
        $search = $request->getGet('search');

        // Query dasar
        $query = $this->pembayaranModel
            ->select('pembayaran.*, user.nama AS nama_user, user.email AS email_user, kamar.no_kamar')
            ->join('user', 'user.id_user = pembayaran.id_user', 'left')
            ->join('kamar', 'kamar.id_kamar = pembayaran.id_kamar', 'left');

        // Tambahkan filter jika ada
        if (!empty($status)) {
            $query->where('pembayaran.status', $status);
        }

        if (!empty($metode)) {
            $query->where('pembayaran.metode', $metode);
        }

        if (!empty($periode)) {
            $query->where('pembayaran.periode', $periode);
        }

        if (!empty($search)) {
            $query->groupStart()
                ->like('user.nama', $search)
                ->orLike('user.email', $search)
                ->orLike('kamar.no_kamar', $search)
                ->groupEnd();
        }

        // Pagination
        $perPage = 10;
        $pembayaran = $query->orderBy('pembayaran.tanggal_bayar', 'DESC')
            ->paginate($perPage, 'pembayaran');
        $pager = $this->pembayaranModel->pager;

        // Ambil data periode unik untuk dropdown filter
        $periodeList = $this->pembayaranModel
            ->select('periode')
            ->distinct()
            ->where('periode IS NOT NULL')
            ->orderBy('periode', 'DESC')
            ->findAll();

        $data = [
            'title'  => 'Admin - Pembayaran',
            'currentPage' => 'pembayaran',
            'pembayaran' => $pembayaran,
            'pager' => $pager,
            'periodeList' => $periodeList,
            'filters' => [
                'status' => $status,
                'metode' => $metode,
                'periode' => $periode,
                'search' => $search
            ]
        ];

        return view('admin/pembayaran.php', $data);
    }

    public function updateStatusPembayaran()
    {
        $request = \Config\Services::request();
        $id = (int) $request->getPost('id_pembayaran');
        $statusBaru = strtolower(trim((string) $request->getPost('status')));

        if (!$id || !in_array($statusBaru, ['selesai', 'gagal', 'pending'], true)) {
            return redirect()->back()->with('error', 'Data tidak valid.');
        }

        $pembayaran = $this->pembayaranModel->find($id);
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
        }

        $updateData = ['status' => $statusBaru];
        if ($statusBaru === 'selesai' && empty($pembayaran['tanggal_bayar'])) {
            $updateData['tanggal_bayar'] = date('Y-m-d H:i:s');
        }

        $this->pembayaranModel->update($id, $updateData);

        // Jika pembayaran diset "selesai": tandai kamar sebagai terisi oleh user terkait
        if ($statusBaru === 'selesai') {
            $idKamar = (int) ($pembayaran['id_kamar'] ?? 0);
            $idUserPembayar = (int) ($pembayaran['id_user'] ?? 0);
            if ($idKamar > 0 && $idUserPembayar > 0) {
                $kamar = $this->kamarModel->find($idKamar);
                if ($kamar) {
                    $updateKamar = ['status' => 'Terisi'];
                    $currentUserInRoom = $kamar['id_user'] ?? null;
                    if (empty($currentUserInRoom) || (int) $currentUserInRoom === $idUserPembayar) {
                        $updateKamar['id_user'] = $idUserPembayar;
                    }
                    $this->kamarModel->update($idKamar, $updateKamar);
                }
            }
        }

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function detailPembayaran($id)
    {
        $pembayaran = $this->pembayaranModel
            ->select('pembayaran.*, user.nama AS nama_user, user.email AS email_user, user.telepon, kamar.no_kamar')
            ->join('user', 'user.id_user = pembayaran.id_user', 'left')
            ->join('kamar', 'kamar.id_kamar = pembayaran.id_kamar', 'left')
            ->find($id);

        if (!$pembayaran) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data pembayaran tidak ditemukan'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $pembayaran
        ]);
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

    // ======================
    // KAMAR: CREATE, UPDATE & DELETE
    // ======================
    public function storeKamar()
    {
        $request = \Config\Services::request();

        $noKamar = trim((string) $request->getPost('no_kamar'));
        $harga = (int) $request->getPost('harga');
        $status = trim((string) $request->getPost('status'));
        $fasilitasArr = (array) $request->getPost('fasilitas');
        $fasilitasArr = array_filter(array_map('trim', $fasilitasArr));
        $fasilitas = implode(', ', $fasilitasArr);

        if ($noKamar === '' || $harga <= 0 || $status === '') {
            return redirect()->back()->with('error', 'Input tidak valid / tidak lengkap.');
        }

        // Cek duplikasi nomor kamar
        $exist = $this->kamarModel->where('no_kamar', $noKamar)->first();
        if ($exist) {
            return redirect()->back()->with('error', 'Nomor kamar sudah terdaftar.');
        }

        $statusAllowed = ['Tersedia', 'Terisi', 'Maintenance'];
        $statusUc = ucfirst(strtolower($status));
        if (!in_array($statusUc, $statusAllowed, true)) {
            return redirect()->back()->with('error', 'Status tidak dikenali.');
        }

        $dataInsert = [
            'no_kamar'  => $noKamar,
            'harga'     => $harga,
            'status'    => $statusUc,
            'fasilitas' => $fasilitas,
        ];

        // Upload gambar (opsional)
        $file = $request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extAllowed = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower($file->getExtension());
            if (!in_array($ext, $extAllowed, true)) {
                return redirect()->back()->with('error', 'Format gambar tidak didukung.');
            }
            $uploadDir = FCPATH . 'uploads/kamar';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0775, true);
            }
            $newName = $file->getRandomName();
            if ($file->move($uploadDir, $newName)) {
                $dataInsert['gambar'] = $newName;
            }
        }

        if (!$this->kamarModel->insert($dataInsert)) {
            return redirect()->back()->with('error', 'Gagal menambah kamar.');
        }

        return redirect()->to(base_url('admin/kamar'))->with('success', 'Kamar baru berhasil ditambahkan.');
    }
    public function updateKamar($id)
    {
        $id = (int) $id;
        $request = \Config\Services::request();
        $kamar = $this->kamarModel->find($id);
        if (!$kamar) {
            return redirect()->back()->with('error', 'Data kamar tidak ditemukan.');
        }

        $noKamar = trim((string) $request->getPost('no_kamar'));
        $harga = (int) $request->getPost('harga');
        $status = trim((string) $request->getPost('status'));
        $fasilitasArr = (array) $request->getPost('fasilitas');
        $fasilitasArr = array_filter(array_map('trim', $fasilitasArr));
        $fasilitas = implode(', ', $fasilitasArr);

        if ($noKamar === '' || $harga <= 0 || $status === '') {
            return redirect()->back()->with('error', 'Input tidak valid / tidak lengkap.');
        }

        // Normalisasi status (Pastikan kapital awal agar konsisten dengan yang lain)
        $statusAllowed = ['Tersedia', 'Terisi', 'Maintenance'];
        $statusUc = ucfirst(strtolower($status));
        if (!in_array($statusUc, $statusAllowed, true)) {
            return redirect()->back()->with('error', 'Status tidak dikenali.');
        }

        $dataUpdate = [
            'no_kamar'  => $noKamar,
            'harga'     => $harga,
            'status'    => $statusUc,
            'fasilitas' => $fasilitas,
        ];

        // Handle upload gambar (opsional)
        $file = $request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $extAllowed = ['jpg', 'jpeg', 'png', 'webp'];
            $ext = strtolower($file->getExtension());
            if (!in_array($ext, $extAllowed, true)) {
                return redirect()->back()->with('error', 'Format gambar tidak didukung.');
            }

            $uploadDir = FCPATH . 'uploads/kamar';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0775, true);
            }
            $newName = $file->getRandomName();
            if ($file->move($uploadDir, $newName)) {
                // Hapus gambar lama jika ada
                if (!empty($kamar['gambar'])) {
                    $oldPath = $uploadDir . '/' . $kamar['gambar'];
                    if (is_file($oldPath)) {
                        @unlink($oldPath);
                    }
                }
                $dataUpdate['gambar'] = $newName;
            }
        }

        $this->kamarModel->update($id, $dataUpdate);
        return redirect()->back()->with('success', 'Kamar berhasil diperbarui.');
    }

    public function deleteKamar($id)
    {
        // Hanya izinkan metode POST (konfirmasi via SweetAlert sebelum kirim POST)
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Metode tidak diizinkan.');
        }

        $id = (int) $id;
        $kamar = $this->kamarModel->find($id);
        if (!$kamar) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Data kamar tidak ditemukan.']);
            }
            return redirect()->back()->with('error', 'Data kamar tidak ditemukan.');
        }

        // Hapus file gambar jika ada
        if (!empty($kamar['gambar'])) {
            $path = FCPATH . 'uploads/kamar/' . $kamar['gambar'];
            if (is_file($path)) {
                @unlink($path);
            }
        }

        $this->kamarModel->delete($id);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Kamar berhasil dihapus.']);
        }

        return redirect()->back()->with('success', 'Kamar berhasil dihapus.');
    }
}
