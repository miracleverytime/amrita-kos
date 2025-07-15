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
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari transaksi...">
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#generateReportModal">
                    <i class="fas fa-file-download"></i> Generate Laporan
                </button>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <h3>Rp 52.500.000</h3>
                    <p>Total Pendapatan</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <div class="stat-content">
                    <h3>Rp 8.200.000</h3>
                    <p>Total Pengeluaran</p>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-up"></i>
                    <span>+3% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>Rp 44.300.000</h3>
                    <p>Laba Bersih</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+15% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>Rp 3.600.000</h3>
                    <p>Tunggakan</p>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>-5% dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Laporan</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Periode</label>
                        <select class="form-select">
                            <option value="">Pilih Periode</option>
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Transaksi</label>
                        <select class="form-select">
                            <option value="">Semua Transaksi</option>
                            <option value="pendapatan">Pendapatan</option>
                            <option value="pengeluaran">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-refresh"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        <h4>Kategori Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="expense-category">
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">Listrik & Air</span>
                                    <span class="category-amount">Rp 2.500.000</span>
                                </div>
                                <div class="category-bar">
                                    <div class="bar-fill" style="width: 60%"></div>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">Maintenance</span>
                                    <span class="category-amount">Rp 1.800.000</span>
                                </div>
                                <div class="category-bar">
                                    <div class="bar-fill" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">Kebersihan</span>
                                    <span class="category-amount">Rp 1.200.000</span>
                                </div>
                                <div class="category-bar">
                                    <div class="bar-fill" style="width: 30%"></div>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">Keamanan</span>
                                    <span class="category-amount">Rp 900.000</span>
                                </div>
                                <div class="category-bar">
                                    <div class="bar-fill" style="width: 25%"></div>
                                </div>
                            </div>
                            <div class="category-item">
                                <div class="category-info">
                                    <span class="category-name">Lainnya</span>
                                    <span class="category-amount">Rp 800.000</span>
                                </div>
                                <div class="category-bar">
                                    <div class="bar-fill" style="width: 20%"></div>
                                </div>
                            </div>
                        </div>
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
                            <tr>
                                <td>1</td>
                                <td>15 Jul 2025</td>
                                <td>Pembayaran Sewa Kamar A101</td>
                                <td>Sewa Kamar</td>
                                <td>
                                    <span class="badge bg-success">Pendapatan</span>
                                </td>
                                <td class="text-success">+Rp 1.200.000</td>
                                <td>
                                    <span class="badge bg-success">Confirmed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>14 Jul 2025</td>
                                <td>Bayar Tagihan Listrik</td>
                                <td>Listrik & Air</td>
                                <td>
                                    <span class="badge bg-danger">Pengeluaran</span>
                                </td>
                                <td class="text-danger">-Rp 850.000</td>
                                <td>
                                    <span class="badge bg-success">Confirmed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>13 Jul 2025</td>
                                <td>Pembayaran Sewa Kamar A102</td>
                                <td>Sewa Kamar</td>
                                <td>
                                    <span class="badge bg-success">Pendapatan</span>
                                </td>
                                <td class="text-success">+Rp 1.200.000</td>
                                <td>
                                    <span class="badge bg-warning">Pending</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>12 Jul 2025</td>
                                <td>Service AC Kamar A103</td>
                                <td>Maintenance</td>
                                <td>
                                    <span class="badge bg-danger">Pengeluaran</span>
                                </td>
                                <td class="text-danger">-Rp 350.000</td>
                                <td>
                                    <span class="badge bg-success">Confirmed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>11 Jul 2025</td>
                                <td>Gaji Cleaning Service</td>
                                <td>Kebersihan</td>
                                <td>
                                    <span class="badge bg-danger">Pengeluaran</span>
                                </td>
                                <td class="text-danger">-Rp 600.000</td>
                                <td>
                                    <span class="badge bg-success">Confirmed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan 1-5 dari 125 transaksi
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
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