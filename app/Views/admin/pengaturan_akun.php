<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Pengaturan Akun</h1>
                <p>Kelola profil dan pengaturan akun administrator</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-primary" id="saveAllBtn">
                    <i class="fas fa-save"></i> Simpan Semua
                </button>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <div class="row">
            <!-- Profile Section -->
            <div class="col-md-4">
                <div class="content-card">
                    <div class="card-header">
                        <h4>Foto Profil</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="profile-avatar-container">
                            <div class="profile-avatar">
                                <img src="https://via.placeholder.com/120x120" alt="Profile" id="profileImage">
                            </div>
                            <div class="avatar-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                        <h5 class="mt-3">John Administrator</h5>
                        <p class="text-muted">admin@kosapp.com</p>
                        <button class="btn btn-outline-primary btn-sm mt-2">
                            <i class="fas fa-upload"></i> Upload Foto
                        </button>
                        <button class="btn btn-outline-danger btn-sm mt-2">
                            <i class="fas fa-trash"></i> Hapus Foto
                        </button>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Statistik Akun</h4>
                    </div>
                    <div class="card-body">
                        <div class="stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Bergabung Sejak</span>
                                <span class="stat-value">15 Januari 2024</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Login Terakhir</span>
                                <span class="stat-value">15 Juli 2025, 14:30</span>
                            </div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="stat-info">
                                <span class="stat-label">Status Akun</span>
                                <span class="stat-value">
                                    <span class="badge bg-success">Aktif</span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="col-md-8">
                <!-- Personal Information -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Informasi Pribadi</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Depan</label>
                                        <input type="text" class="form-control" value="John" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Belakang</label>
                                        <input type="text" class="form-control" value="Administrator" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="admin@kosapp.com" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input type="tel" class="form-control" value="081234567890" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" value="1990-01-15">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <select class="form-select">
                                            <option value="L" selected>Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Masukkan alamat lengkap...">Jl. Contoh Alamat No. 123, Jakarta Pusat, DKI Jakarta</textarea>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Keamanan Akun</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Ubah Password</h6>
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" required>
                                    </div>
                                    <button type="button" class="btn btn-warning">
                                        <i class="fas fa-key"></i> Ubah Password
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <h6>Keamanan Tambahan</h6>
                                <div class="security-options">
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Two-Factor Authentication</h6>
                                            <p class="text-muted">Tambahkan lapisan keamanan ekstra</p>
                                        </div>
                                        <div class="security-action">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="twoFA">
                                                <label class="form-check-label" for="twoFA">Aktifkan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Login Notifications</h6>
                                            <p class="text-muted">Notifikasi saat login dari perangkat baru</p>
                                        </div>
                                        <div class="security-action">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="loginNotif" checked>
                                                <label class="form-check-label" for="loginNotif">Aktifkan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h6>Session Timeout</h6>
                                            <p class="text-muted">Logout otomatis setelah tidak aktif</p>
                                        </div>
                                        <div class="security-action">
                                            <select class="form-select form-select-sm">
                                                <option value="30">30 menit</option>
                                                <option value="60" selected>1 jam</option>
                                                <option value="120">2 jam</option>
                                                <option value="240">4 jam</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Pengaturan Notifikasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Notifikasi Email</h6>
                                <div class="notification-options">
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="emailPayment" checked>
                                            <label class="form-check-label" for="emailPayment">
                                                Pembayaran Baru
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="emailTenant" checked>
                                            <label class="form-check-label" for="emailTenant">
                                                Penyewa Baru
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="emailOverdue">
                                            <label class="form-check-label" for="emailOverdue">
                                                Pembayaran Terlambat
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="emailExpiry" checked>
                                            <label class="form-check-label" for="emailExpiry">
                                                Kontrak Akan Berakhir
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Notifikasi Push</h6>
                                <div class="notification-options">
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pushPayment" checked>
                                            <label class="form-check-label" for="pushPayment">
                                                Pembayaran Baru
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pushTenant">
                                            <label class="form-check-label" for="pushTenant">
                                                Penyewa Baru
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pushOverdue" checked>
                                            <label class="form-check-label" for="pushOverdue">
                                                Pembayaran Terlambat
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pushExpiry">
                                            <label class="form-check-label" for="pushExpiry">
                                                Kontrak Akan Berakhir
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Preferences -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Preferensi Sistem</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Bahasa</label>
                                    <select class="form-select">
                                        <option value="id" selected>Bahasa Indonesia</option>
                                        <option value="en">English</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Zona Waktu</label>
                                    <select class="form-select">
                                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Format Tanggal</label>
                                    <select class="form-select">
                                        <option value="dd/mm/yyyy" selected>DD/MM/YYYY</option>
                                        <option value="mm/dd/yyyy">MM/DD/YYYY</option>
                                        <option value="yyyy-mm-dd">YYYY-MM-DD</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Format Mata Uang</label>
                                    <select class="form-select">
                                        <option value="idr" selected>Rupiah (Rp)</option>
                                        <option value="usd">Dollar ($)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tema Tampilan</label>
                                    <select class="form-select">
                                        <option value="light" selected>Terang</option>
                                        <option value="dark">Gelap</option>
                                        <option value="auto">Otomatis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Items per Halaman</label>
                                    <select class="form-select">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Log -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Aktivitas Terakhir</h4>
                        <button class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-history"></i> Lihat Semua
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="activity-log">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Login ke sistem</h6>
                                    <p class="text-muted">15 Juli 2025, 14:30 WIB</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Menambah penyewa baru</h6>
                                    <p class="text-muted">15 Juli 2025, 10:15 WIB</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-edit"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Mengubah data kamar A101</h6>
                                    <p class="text-muted">14 Juli 2025, 16:45 WIB</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Konfirmasi pembayaran</h6>
                                    <p class="text-muted">14 Juli 2025, 09:20 WIB</p>
                                </div>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-cog"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Mengubah pengaturan notifikasi</h6>
                                    <p class="text-muted">13 Juli 2025, 13:30 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #e9ecef;
        position: relative;
    }

    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50%;
        cursor: pointer;
    }

    .avatar-overlay i {
        color: white;
        font-size: 1.5rem;
    }

    .profile-avatar-container:hover .avatar-overlay {
        opacity: 1;
    }

    .stat-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-icon-sm {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .stat-icon-sm i {
        color: white;
        font-size: 1rem;
    }

    .stat-info {
        flex: 1;
    }

    .stat-label {
        display: block;
        font-size: 0.875rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .security-options {
        padding: 1rem 0;
    }

    .security-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .security-item:last-child {
        border-bottom: none;
    }

    .security-info h6 {
        margin: 0 0 0.25rem 0;
        color: #2c3e50;
    }

    .security-info p {
        margin: 0;
        font-size: 0.875rem;
    }

    .notification-options {
        padding: 1rem 0;
    }

    .notification-item {
        margin-bottom: 0.75rem;
    }

    .notification-item:last-child {
        margin-bottom: 0;
    }

    .activity-log {
        padding: 1rem 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .activity-icon i {
        color: #6c757d;
        font-size: 1rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-content h6 {
        margin: 0 0 0.25rem 0;
        color: #2c3e50;
        font-size: 0.875rem;
    }

    .activity-content p {
        margin: 0;
        font-size: 0.75rem;
    }

    .content-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
    }

    .card-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h4 {
        margin: 0;
        color: #2c3e50;
    }

    .card-body {
        padding: 1.5rem;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .security-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
<?= $this->endSection() ?>