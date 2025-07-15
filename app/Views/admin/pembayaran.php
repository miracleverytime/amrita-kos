<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Manajemen Pembayaran</h1>
                <p>Kelola pembayaran sewa dan transaksi keuangan</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari pembayaran...">
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                    <i class="fas fa-plus"></i> Tambah Pembayaran
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
                    <h3>Rp 54.000.000</h3>
                    <p>Total Pendapatan</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+8% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>42</h3>
                    <p>Pembayaran Lunas</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+5% dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <h3>8</h3>
                    <p>Pembayaran Pending</p>
                </div>
                <div class="stat-trend neutral">
                    <i class="fas fa-minus"></i>
                    <span>Tidak ada perubahan</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-content">
                    <h3>3</h3>
                    <p>Pembayaran Terlambat</p>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>-2 dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Status Pembayaran</label>
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="lunas">Lunas</option>
                            <option value="pending">Pending</option>
                            <option value="terlambat">Terlambat</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Metode Pembayaran</label>
                        <select class="form-select">
                            <option value="">Semua Metode</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="cash">Cash</option>
                            <option value="ewallet">E-Wallet</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Periode</label>
                        <select class="form-select">
                            <option value="">Semua Periode</option>
                            <option value="2024-01">Januari 2024</option>
                            <option value="2024-02">Februari 2024</option>
                            <option value="2024-03">Maret 2024</option>
                        </select>
                    </div>
                    <div class="col-md-3">
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

        <!-- Payment Table -->
        <div class="content-card">
            <div class="card-header">
                <h4>Daftar Pembayaran</h4>
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
                                <th>Penyewa</th>
                                <th>Kamar</th>
                                <th>Periode</th>
                                <th>Jumlah</th>
                                <th>Tanggal Bayar</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-sm">JS</div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">john.smith@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">A101</span>
                                </td>
                                <td>Januari 2024</td>
                                <td>
                                    <strong>Rp 1.200.000</strong>
                                </td>
                                <td>15 Jan 2024</td>
                                <td>
                                    <span class="badge bg-info">Transfer Bank</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lunas</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewPaymentModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-sm">AD</div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Alice Davis</h6>
                                            <small class="text-muted">alice.davis@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">A102</span>
                                </td>
                                <td>Februari 2024</td>
                                <td>
                                    <strong>Rp 1.500.000</strong>
                                </td>
                                <td>-</td>
                                <td>
                                    <span class="badge bg-secondary">-</span>
                                </td>
                                <td>
                                    <span class="badge bg-warning">Pending</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewPaymentModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-sm">MB</div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Michael Brown</h6>
                                            <small class="text-muted">michael.brown@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">A103</span>
                                </td>
                                <td>Januari 2024</td>
                                <td>
                                    <strong>Rp 1.200.000</strong>
                                </td>
                                <td>25 Jan 2024</td>
                                <td>
                                    <span class="badge bg-warning">E-Wallet</span>
                                </td>
                                <td>
                                    <span class="badge bg-danger">Terlambat</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewPaymentModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar-sm">SL</div>
                                        <div class="ms-3">
                                            <h6 class="mb-0">Sarah Lee</h6>
                                            <small class="text-muted">sarah.lee@email.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary">B201</span>
                                </td>
                                <td>Februari 2024</td>
                                <td>
                                    <strong>Rp 1.800.000</strong>
                                </td>
                                <td>10 Feb 2024</td>
                                <td>
                                    <span class="badge bg-success">Cash</span>
                                </td>
                                <td>
                                    <span class="badge bg-success">Lunas</span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewPaymentModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success">
                                            <i class="fas fa-receipt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPaymentModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan 1-4 dari 53 pembayaran
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

<!-- Add Payment Modal -->
<div class="modal fade" id="addPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Penyewa</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Penyewa</option>
                                    <option value="1">John Smith - A101</option>
                                    <option value="2">Alice Davis - A102</option>
                                    <option value="3">Michael Brown - A103</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Periode</label>
                                <input type="month" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembayaran</label>
                                <input type="number" class="form-control" placeholder="1200000" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pembayaran</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Metode</option>
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="cash">Cash</option>
                                    <option value="ewallet">E-Wallet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Status</option>
                                    <option value="lunas">Lunas</option>
                                    <option value="pending">Pending</option>
                                    <option value="terlambat">Terlambat</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Keterangan pembayaran..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- View Payment Modal -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Penyewa</h6>
                        <p><strong>Nama:</strong> John Smith</p>
                        <p><strong>Email:</strong> john.smith@email.com</p>
                        <p><strong>Kamar:</strong> A101</p>
                        <p><strong>Telepon:</strong> 081234567890</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Detail Pembayaran</h6>
                        <p><strong>Periode:</strong> Januari 2024</p>
                        <p><strong>Jumlah:</strong> Rp 1.200.000</p>
                        <p><strong>Tanggal Bayar:</strong> 15 Januari 2024</p>
                        <p><strong>Metode:</strong> Transfer Bank</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Lunas</span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Keterangan</h6>
                        <p>Pembayaran sewa kamar bulan Januari 2024 telah diterima melalui transfer bank.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success">
                    <i class="fas fa-receipt"></i> Cetak Kwitansi
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .user-avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .table th {
        background: #f8f9fa;
        font-weight: 600;
        border-bottom: 2px solid #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-group .btn {
        margin-right: 0.25rem;
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

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .table-responsive {
            font-size: 0.875rem;
        }
    }
</style>
<?= $this->endSection() ?>