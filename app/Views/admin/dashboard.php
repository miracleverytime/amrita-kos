<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Dashboard</h1>
                <p>Welcome back, <?= esc($admin['nama']) ?>! Here's what's happening today.</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search anything...">
                </div>
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <a href="<?= base_url('admin/pengaturan-akun') ?>" class="a-info">
                        <div class="user-info">
                            <h6> <?= esc($admin['nama']) ?></h6>
                            <p>Administrator</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Total Penghuni</p>
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?= esc($totalPenghuni) ?></h2>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Pendapatan Bulan Ini</p>
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <h2 class="stat-value">$45,210</h2>
                <p class="stat-change positive">
                    <i class="fas fa-arrow-up"></i> +8.2% from last month
                </p>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Kamar Tersedia</p>
                    <div class="stat-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?= esc($kamarTersedia) ?></h2>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <p class="stat-title">Pengajuan Pindah</p>
                    <div class="stat-icon">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                </div>
                <h2 class="stat-value"><?= esc($pengajuanPindah) ?></h2>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="content-grid">
            <!-- Recent Orders -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran Terbaru</h3>
                    <a href="<?= base_url('admin/pembayaran') ?>" class="card-action">View All</a>
                </div>
                <div class="table-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($pembayaranTerbaru)): ?>
                                <?php foreach ($pembayaranTerbaru as $pb): ?>
                                    <tr>
                                        <td>#<?= esc($pb['id_pembayaran']) ?></td>
                                        <td><?= esc($pb['nama_user'] ?? '-') ?></td>
                                        <td><?= esc($pb['no_kamar'] ?? '-') ?></td>
                                        <td>Rp<?= number_format((float)($pb['total_bayar'] ?? 0), 0, ',', '.') ?></td>
                                        <td>
                                            <?php
                                            $status = strtolower($pb['status'] ?? '');
                                            $badgeClass = 'status-pending';
                                            if ($status === 'selesai' || $status === 'paid' || $status === 'success') {
                                                $badgeClass = 'status-active';
                                            } elseif ($status === 'gagal' || $status === 'cancelled' || $status === 'failed') {
                                                $badgeClass = 'status-inactive';
                                            }
                                            ?>
                                            <span class="status-badge <?= $badgeClass ?>"><?= esc(ucwords($pb['status'] ?? '-')) ?></span>
                                        </td>
                                        <td><?= !empty($pb['tanggal_bayar']) ? date('d M Y H:i', strtotime($pb['tanggal_bayar'])) : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" style="text-align:center;">Belum ada pembayaran.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="content-card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Pindah Kamar</h3>
                    <a href="<?= base_url('admin/penyewa') ?>" class="card-action">View All</a>
                </div>
                <ul class="activity-list">
                    <?php if (!empty($riwayatPindah)): ?>
                        <?php foreach ($riwayatPindah as $rk): ?>
                            <?php
                            $nama = $rk['nama_user'] ?? '-';
                            $parts = preg_split('/\s+/', trim($nama));
                            $initials = '';
                            if (!empty($parts[0])) {
                                $initials .= strtoupper(substr($parts[0], 0, 1));
                            }
                            if (!empty($parts[1])) {
                                $initials .= strtoupper(substr($parts[1], 0, 1));
                            }
                            if ($initials === '' && $nama !== '-') {
                                $initials = strtoupper(substr($nama, 0, 1));
                            }
                            $from = $rk['no_kamar_lama'] ?? '-';
                            $to = $rk['no_kamar_baru'] ?? '-';
                            $waktu = !empty($rk['created_at']) ? date('d M Y H:i', strtotime($rk['created_at'])) : '-';
                            ?>
                            <li class="activity-item">
                                <div class="activity-avatar"><?= esc($initials) ?></div>
                                <div class="activity-content">
                                    <h6><?= esc($nama) ?> pindah kamar</h6>
                                    <p><?= esc($from) ?> ➝ <?= esc($to) ?><?= !empty($rk['alasan']) ? ' • Alasan: ' . esc($rk['alasan']) : '' ?></p>
                                </div>
                                <div class="activity-time"><?= esc($waktu) ?></div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="activity-item">
                            <div class="activity-content">
                                <p>Belum ada riwayat pindah kamar.</p>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>