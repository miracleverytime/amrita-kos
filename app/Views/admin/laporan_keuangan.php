<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Laporan Keuangan</h1>
                <p>Kelola dan pantau keuangan kos secara detail</p>
            </div>
            <div class="header-actions">
                <form method="get" class="search-box" style="display:flex;align-items:center;gap:.5rem;">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="<?= esc($filters['q'] ?? '') ?>" placeholder="Cari transaksi..." />
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                    <i class="fas fa-file-download"></i> Generate Laporan
                </button>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">

        <!-- Filter Section -->
        <form method="get" class="content-card">
            <div class="card-header">
                <h4>Filter Laporan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Periode</label>
                        <select class="form-select" name="periode">
                            <option value="">Pilih Periode</option>
                            <?php foreach (['harian' => 'Harian', 'mingguan' => 'Mingguan', 'bulanan' => 'Bulanan', 'tahunan' => 'Tahunan'] as $k => $v): ?>
                                <option value="<?= $k ?>" <?= ($filters['periode'] ?? '') === $k ? 'selected' : ''; ?>><?= $v ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Transaksi</label>
                        <select class="form-select" name="jenis">
                            <option value="">Semua Transaksi</option>
                            <option value="pendapatan" <?= ($filters['jenis'] ?? '') === 'pendapatan' ? 'selected' : ''; ?>>Pendapatan</option>
                            <option value="pengeluaran" <?= ($filters['jenis'] ?? '') === 'pengeluaran' ? 'selected' : ''; ?>>Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="from" value="<?= esc($filters['from'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="to" value="<?= esc($filters['to'] ?? '') ?>" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Per Halaman</label>
                        <select class="form-select" name="per_page">
                            <?php foreach (($allowedPerPage ?? [10, 25, 50]) as $pp): ?>
                                <option value="<?= $pp ?>" <?= (int)($filters['per_page'] ?? $perPage ?? 10) === $pp ? 'selected' : ''; ?>><?= $pp ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <a class="btn btn-outline-secondary" href="<?= current_url() ?>">
                                <i class="fas fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-8">
                <div class="content-card">
                    <div class="card-header">
                        <h4>Grafik Pendapatan vs Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="chart-placeholder">
                            <div class="chart-info">
                                <i class="fas fa-chart-area fa-3x text-muted"></i>
                                <p class="text-muted mt-2">Grafik akan ditampilkan di sini</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="content-card">
                    <div class="card-header">
                        <h4>Ringkasan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <span>Total Pendapatan:</span>
                            <strong class="text-success">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></strong>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <span>Total Pengeluaran:</span>
                            <strong class="text-danger">Rp <?= number_format($totalPengeluaran, 0, ',', '.') ?></strong>
                        </div>
                        <div class="border-top pt-3 d-flex justify-content-between">
                            <span>Saldo / Laba Bersih:</span>
                            <strong class="<?= $netto >= 0 ? 'text-success' : 'text-danger' ?>">Rp <?= number_format($netto, 0, ',', '.') ?></strong>
                        </div>
                        <p class="text-muted mt-3 mb-0" style="font-size:.8rem;">Pengeluaran belum tersedia (tabel belum dibuat).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="content-card">
            <div class="card-header">
                <h4>Transaksi Terbaru</h4>
                <div class="card-actions">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-print"></i> Print
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Keterangan</th>
                                <th>Kategori</th>
                                <th>Jenis</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($transaksi)): ?>
                                <?php $no = 1;
                                foreach ($transaksi as $t): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $t['tanggal'] ? date('d M Y', strtotime($t['tanggal'])) : '-' ?></td>
                                        <td><?= esc($t['keterangan']) ?></td>
                                        <td><?= esc($t['kategori']) ?></td>
                                        <td>
                                            <span class="badge <?= $t['jenis'] === 'Pendapatan' ? 'bg-success' : 'bg-danger' ?>"><?= esc($t['jenis']) ?></span>
                                        </td>
                                        <td class="<?= $t['jenis'] === 'Pendapatan' ? 'text-success' : 'text-danger' ?>">
                                            <?= $t['jenis'] === 'Pendapatan' ? '+' : '-' ?>Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <span class="badge <?= strtolower($t['status']) === 'selesai' || strtolower($t['status']) === 'confirmed' ? 'bg-success' : (strtolower($t['status']) === 'pending' ? 'bg-warning' : 'bg-secondary') ?>"><?= esc($t['status']) ?></span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" title="Detail" data-id="<?= esc($t['detail']['id_pembayaran'] ?? '') ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">Tidak ada data transaksi untuk filter yang dipilih.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if (isset($pager) && $pager !== null): ?>
                    <?php
                    $group = 'laporan';
                    $currentPage = $pager->getCurrentPage($group);
                    $total = $pager->getTotal($group);
                    $perPageLocal = $pager->getPerPage($group);
                    $start = $total ? (($currentPage - 1) * $perPageLocal) + 1 : 0;
                    $end = $total ? min($start + count($transaksi) - 1, $total) : 0;
                    ?>
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mt-3 gap-2">
                        <div class="text-muted small">
                            Menampilkan <?= $start ?> - <?= $end ?> dari <?= $total ?> transaksi (Halaman <?= $currentPage ?>)
                        </div>
                        <div>
                            <?= $pager->links($group) ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Generate Report Modal -->
<div class="modal fade" id="generateReportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generate Laporan Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Jenis Laporan</label>
                        <select class="form-select" required>
                            <option value="">Pilih Jenis Laporan</option>
                            <option value="pendapatan">Laporan Pendapatan</option>
                            <option value="pengeluaran">Laporan Pengeluaran</option>
                            <option value="laba_rugi">Laporan Laba Rugi</option>
                            <option value="arus_kas">Laporan Arus Kas</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode</label>
                        <select class="form-select" required>
                            <option value="">Pilih Periode</option>
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Format Output</label>
                        <select class="form-select" required>
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                            <option value="csv">CSV</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Generate</button>
            </div>
        </div>
    </div>
</div>

<style>
    .chart-placeholder {
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px dashed #dee2e6;
    }

    .chart-info {
        text-align: center;
    }

    .expense-category {
        padding: 1rem 0;
    }

    .category-item {
        margin-bottom: 1.5rem;
    }

    .category-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .category-name {
        font-weight: 500;
        color: #2c3e50;
    }

    .category-amount {
        font-weight: 600;
        color: #7f8c8d;
    }

    .category-bar {
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        transition: width 0.3s ease;
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

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .table th {
        background: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .stat-trend {
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-trend.positive {
        color: #27ae60;
    }

    .stat-trend.negative {
        color: #e74c3c;
    }

    .stat-trend.neutral {
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>
<?= $this->endSection() ?>