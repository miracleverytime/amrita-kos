<?= $this->extend('layout/TemplateUser') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <h1 class="page-title">Dashboard</h1>

        <!-- Status Overview -->
        <div class="status-grid">
            <div class="status-card">
                <div class="status-value">A101</div>
                <div class="status-label">Kamar Saat Ini</div>
            </div>
            <div class="status-card">
                <div class="status-value">Rp 1.200.000</div>
                <div class="status-label">Sewa Bulanan</div>
            </div>
            <div class="status-card">
                <div class="status-value">15 Hari</div>
                <div class="status-label">Masa Berlaku</div>
            </div>
            <div class="status-card">
                <div class="status-value">Aktif</div>
                <div class="status-label">Status Kos</div>
            </div>
        </div>

        <!-- Main Dashboard -->
        <div class="dashboard-grid">
            <!-- Pembayaran Sewa -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #e8f5e8; color: #27ae60;">💳</div>
                    <div>
                        <div class="card-title">Pembayaran Sewa</div>
                        <div class="card-subtitle">Bayar sewa kos bulanan</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Pembayaran sewa bulan ini jatuh tempo pada 25 Januari 2025</p>
                <a href="pembayaran.html" class="btn btn-success">Bayar Sekarang</a>
            </div>

            <!-- Pilih Kamar -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #e8f4fd; color: #3498db;">🏠</div>
                    <div>
                        <div class="card-title">Pilih Kamar</div>
                        <div class="card-subtitle">Lihat kamar yang tersedia</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Pilih kamar yang sesuai dengan kebutuhan dan budget Anda</p>
                <a href="pilih-kamar.html" class="btn btn-primary">Lihat Kamar</a>
            </div>

            <!-- Pindah Kamar -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #fff3cd; color: #f39c12;">📦</div>
                    <div>
                        <div class="card-title">Pindah Kamar</div>
                        <div class="card-subtitle">Ajukan perpindahan kamar</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Ajukan perpindahan ke kamar yang lebih sesuai</p>
                <a href="pindah-kamar.html" class="btn btn-warning">Ajukan Pindah</a>
            </div>

            <!-- Riwayat Pembayaran -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #f8f9fa; color: #6c757d;">📊</div>
                    <div>
                        <div class="card-title">Riwayat Pembayaran</div>
                        <div class="card-subtitle">Lihat history pembayaran</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Pantau semua transaksi pembayaran sewa kos Anda</p>
                <a href="riwayat-pembayaran.html" class="btn btn-outline">Lihat Riwayat</a>
            </div>

            <!-- Keluhan & Saran -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #fce4ec; color: #e91e63;">💬</div>
                    <div>
                        <div class="card-title">Keluhan & Saran</div>
                        <div class="card-subtitle">Sampaikan masukan Anda</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Laporkan masalah atau berikan saran untuk perbaikan</p>
                <a href="keluhan.html" class="btn btn-outline">Kirim Keluhan</a>
            </div>

            <!-- Profil -->
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #e3f2fd; color: #2196f3;">👤</div>
                    <div>
                        <div class="card-title">Profil Saya</div>
                        <div class="card-subtitle">Kelola informasi pribadi</div>
                    </div>
                </div>
                <p style="color: #6c757d; margin-bottom: 1.5rem;">Update data pribadi dan pengaturan akun</p>
                <a href="profil.html" class="btn btn-outline">Edit Profil</a>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>