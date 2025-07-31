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
            <?php if (session()->getFlashdata('error')): ?>
                <div class="error-message">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="success-message">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>
            <?php if ($pengajuanPindah && $pengajuanPindah['status'] === 'Pending') : ?>
                <!-- Tampilkan hanya tabel riwayat jika status masih Pending -->
                <div class="card">
                    <h2 class="card-title">Status Pengajuan Pindah</h2>
                    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Tanggal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Kamar Tujuan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Alasan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Keterangan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">
                                    <?= date('d M Y', strtotime($pengajuanPindah['created_at'])) ?>
                                </td>
                                <td style="padding: 1rem; color: #495057;">
                                    <?= esc($pengajuanPindah['id_kamar_baru']) ?>
                                </td>
                                <td style="padding: 1rem; color: #495057;">
                                    <?= esc($pengajuanPindah['alasan']) ?>
                                </td>
                                <td style="padding: 1rem; color: #495057;">
                                    <?= esc($pengajuanPindah['keterangan']) ?>
                                </td>
                                <td style="padding: 1rem;">
                                    <?php if ($pengajuanPindah['status'] === 'Disetujui') : ?>
                                        <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                            ✓ Disetujui
                                        </span>
                                    <?php elseif ($pengajuanPindah['status'] === 'Ditolak') : ?>
                                        <span style="background: #f8d7da; color: #721c24; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                            ✕ Ditolak
                                        </span>
                                    <?php else : ?>
                                        <span style="background: #fff3cd; color: #856404; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                            ⏳ Pending
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            <?php else : ?>
                <!-- Jika belum pernah ajukan ATAU sudah Disetujui/Ditolak -->
                <?php if ($pengajuanPindah) : ?>
                    <!-- Tampilkan riwayat terakhir -->
                    <div class="card">
                        <h2 class="card-title">Riwayat Pengajuan Pindah</h2>
                        <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                            <thead>
                                <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Tanggal</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Kamar Tujuan</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Alasan</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Keterangan</th>
                                    <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($riwayatPindah)) : ?>
                                    <?php foreach ($riwayatPindah as $riwayat) : ?>
                                        <tr style="border-bottom: 1px solid #e9ecef;">
                                            <td style="padding: 1rem; color: #495057;">
                                                <?= date('d M Y', strtotime($riwayat['created_at'])) ?>
                                            </td>
                                            <td style="padding: 1rem; color: #495057;">
                                                <?= esc($riwayat['id_kamar_baru']) ?>
                                            </td>
                                            <td style="padding: 1rem; color: #495057;">
                                                <?= esc($riwayat['alasan']) ?>
                                            </td>
                                            <td style="padding: 1rem; color: #495057;">
                                                <?= esc($riwayat['keterangan']) ?>
                                            </td>
                                            <td style="padding: 1rem;">
                                                <?php if ($riwayat['status'] === 'Disetujui') : ?>
                                                    <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                                        ✓ Disetujui
                                                    </span>
                                                <?php elseif ($riwayat['status'] === 'Ditolak') : ?>
                                                    <span style="background: #f8d7da; color: #721c24; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                                        ✕ Ditolak
                                                    </span>
                                                <?php else : ?>
                                                    <span style="background: #fff3cd; color: #856404; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                                        ⏳ Pending
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="padding: 1rem; text-align: center; color: #999;">
                                            Belum ada pengajuan pindah kamar.
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>


                    <br>
                <?php endif; ?>

                <?= $this->include('user/form_pindah_kamar'); ?>
            <?php endif; ?>

        <?php else : ?>
            <div class="alert alert-info">
                <strong>Belum ada data kamar aktif saat ini.</strong><br>
                Silakan hubungi admin jika data kamar tidak muncul.
            </div>
        <?php endif; ?>

    </div>
</main>

<script>
    document.getElementById('alasan-select').addEventListener('change', function() {
        const detailGroup = document.getElementById('detail-group');
        if (this.value === 'other') {
            detailGroup.style.display = 'block';
        } else {
            detailGroup.style.display = 'none';
        }
    });
</script>
<?= $this->endSection() ?>