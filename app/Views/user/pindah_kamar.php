<?= $this->extend('layout/TemplateUser') ?>

<?= $this->section('content') ?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header */
    header {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
    }

    .logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .nav-menu {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-link {
        text-decoration: none;
        color: #6c757d;
        font-weight: 500;
        transition: color 0.3s;
    }

    .nav-link:hover,
    .nav-link.active {
        color: #2c3e50;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: #6c757d;
    }

    .logout-btn {
        background: #dc3545;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-size: 0.9rem;
        transition: background 0.3s;
    }

    .logout-btn:hover {
        background: #c82333;
    }

    /* Main Content */
    main {
        padding: 2rem 0;
    }

    .page-title {
        font-size: 2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .move-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }

    .card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #2c3e50;
    }

    .form-input {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3498db;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        font-size: 1rem;
        background: white;
        cursor: pointer;
    }

    .btn {
        display: inline-block;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 500;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 0.95rem;
    }

    .btn-warning {
        background: #f39c12;
        color: white;
        width: 100%;
    }

    .btn-warning:hover {
        background: #d68910;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #6c757d;
        color: #6c757d;
    }

    .btn-outline:hover {
        background: #6c757d;
        color: white;
    }

    .current-room {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .room-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .room-number {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
    }

    .room-price {
        font-size: 1.1rem;
        color: #27ae60;
        font-weight: 600;
    }

    .room-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .feature-tag {
        background: #e9ecef;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-label {
        color: #6c757d;
        font-weight: 500;
    }

    .info-value {
        font-weight: 600;
        color: #2c3e50;
    }

    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }

    .alert-info {
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        color: #0c5460;
    }

    .alert-warning {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-menu {
            display: none;
        }

        .move-grid {
            grid-template-columns: 1fr;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

<main>
    <div class="container">
        <h1 class="page-title">Ajukan Pindah Kamar</h1>

        <?php if (!empty($kamar)) : ?>
            <div class="alert alert-info">
                <strong>Informasi:</strong> Pengajuan pindah kamar akan diproses dalam 2-3 hari kerja. Pastikan semua pembayaran sewa sudah lunas sebelum mengajukan pindah kamar.
            </div>
            <div class="move-grid">
                <!-- Move Request Form -->
                <div class="card">
                    <h2 class="card-title">Form Pindah Kamar</h2>

                    <div class="current-room">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">Kamar Saat Ini</h3>
                        <div class="room-info">
                            <div class="room-number">Kamar <?= $kamar['no_kamar'] ?></div>
                            <div class="room-price">Rp <?= number_format($kamar['harga'], 0, ',', '.') ?>/bulan</div>
                        </div>
                        <div class="room-features">
                            <?php foreach (explode(',', $kamar['fasilitas']) as $fasilitas) : ?>
                                <span class="feature-tag"><?= trim($fasilitas) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <form>
                        <div class="form-group">
                            <label class="form-label">Kamar Tujuan</label>
                            <select name="kamar_tujuan" class="form-select" required>
                                <option value="">Pilih kamar tujuan</option>
                                <?php foreach ($kamarTujuan as $k) : ?>
                                    <option value="<?= $k['id_kamar'] ?>">
                                        Kamar <?= $k['no_kamar'] ?> - Rp <?= number_format($k['harga'], 0, ',', '.') ?>/bulan
                                        (<?= implode(', ', array_map('trim', explode(',', $k['fasilitas']))) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tanggal Pindah yang Diinginkan</label>
                            <input type="date" class="form-input" min="2025-01-20">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alasan Pindah Kamar</label>
                            <select class="form-select">
                                <option value="">Pilih alasan</option>
                                <option value="budget">Menyesuaikan budget</option>
                                <option value="facilities">Kebutuhan fasilitas yang berbeda</option>
                                <option value="location">Lokasi yang lebih strategis</option>
                                <option value="maintenance">Masalah teknis di kamar saat ini</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Keterangan Detail</label>
                            <textarea class="form-input form-textarea" placeholder="Jelaskan secara detail alasan Anda ingin pindah kamar..."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nomor Telepon (untuk konfirmasi)</label>
                            <input type="tel" class="form-input" placeholder="08123456789">
                        </div>

                        <div class="alert alert-warning">
                            <strong>Perhatian:</strong> Setelah pengajuan disetujui, Anda akan dikenakan biaya administrasi pindah kamar sebesar Rp 50.000.
                        </div>

                        <button type="submit" class="btn btn-warning">Ajukan Pindah Kamar</button>
                    </form>
                </div>

                <!-- Move Request Info -->
                <div class="card">
                    <h2 class="card-title">Informasi Pindah Kamar</h2>

                    <div class="info-item">
                        <span class="info-label">Biaya Admin</span>
                        <span class="info-value">Rp 50.000</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Waktu Proses</span>
                        <span class="info-value">2-3 hari kerja</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Status Pembayaran</span>
                        <span class="info-value">Lunas</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Masa Kontrak</span>
                        <span class="info-value"><?= $kamar['kontrak'] ?? '(Belum ada)' ?></span>
                    </div>

                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">Syarat & Ketentuan</h3>
                        <ul style="color: #6c757d; line-height: 1.6; padding-left: 1.5rem;">
                            <li>Pembayaran sewa bulan berjalan harus lunas</li>
                            <li>Tidak ada tunggakan pembayaran</li>
                            <li>Kamar tujuan harus tersedia</li>
                            <li>Pindah kamar hanya bisa dilakukan maksimal 2 kali dalam 1 tahun</li>
                            <li>Kerusakan di kamar lama akan dipotong dari deposit</li>
                        </ul>
                    </div>

                    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline" style="margin-top: 2rem;">Kembali ke Dashboard</a>
                </div>
            </div>
        <?php else : ?>
            <div class="alert alert-info">
                <strong>Belum ada data kamar aktif saat ini.</strong><br>
                Silakan hubungi admin jika data kamar tidak muncul.
            </div>
        <?php endif; ?>

    </div>
</main>
<?= $this->endSection() ?>