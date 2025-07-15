<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Manajemen Kamar</h1>
                <p>Kelola data kamar dan status ketersediaan</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari kamar...">
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                    <i class="fas fa-plus"></i> Tambah Kamar
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
                    <i class="fas fa-door-open"></i>
                </div>
                <div class="stat-content">
                    <h3>24</h3>
                    <p>Total Kamar</p>
                </div>
                <div class="stat-trend neutral">
                    <i class="fas fa-minus"></i>
                    <span>Tidak berubah</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <h3>18</h3>
                    <p>Kamar Terisi</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+3 dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-door-closed"></i>
                </div>
                <div class="stat-content">
                    <h3>6</h3>
                    <p>Kamar Kosong</p>
                </div>
                <div class="stat-trend negative">
                    <i class="fas fa-arrow-down"></i>
                    <span>-3 dari bulan lalu</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="stat-content">
                    <h3>75%</h3>
                    <p>Tingkat Okupansi</p>
                </div>
                <div class="stat-trend positive">
                    <i class="fas fa-arrow-up"></i>
                    <span>+12% dari bulan lalu</span>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Kamar</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-select">
                            <option value="">Semua Status</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Lantai</label>
                        <select class="form-select">
                            <option value="">Semua Lantai</option>
                            <option value="1">Lantai 1</option>
                            <option value="2">Lantai 2</option>
                            <option value="3">Lantai 3</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipe Kamar</label>
                        <select class="form-select">
                            <option value="">Semua Tipe</option>
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                            <option value="deluxe">Deluxe</option>
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

        <!-- Room Cards Grid -->
        <div class="content-card">
            <div class="card-header">
                <h4>Daftar Kamar</h4>
                <div class="card-actions">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-th"></i> Grid
                    </button>
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-list"></i> List
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="room-grid">
                    <!-- Room Card 1 -->
                    <div class="room-card">
                        <div class="room-header">
                            <h5>Kamar A101</h5>
                            <span class="badge bg-success">Terisi</span>
                        </div>
                        <div class="room-info">
                            <div class="room-detail">
                                <i class="fas fa-bed"></i>
                                <span>Standard</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-layer-group"></i>
                                <span>Lantai 1</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Rp 1.200.000</span>
                            </div>
                        </div>
                        <div class="room-tenant">
                            <div class="tenant-info">
                                <div class="user-avatar-sm">JS</div>
                                <div class="tenant-name">
                                    <span>John Smith</span>
                                    <small>Masuk: 15 Jan 2024</small>
                                </div>
                            </div>
                        </div>
                        <div class="room-actions">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewRoomModal">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                    </div>

                    <!-- Room Card 2 -->
                    <div class="room-card">
                        <div class="room-header">
                            <h5>Kamar A102</h5>
                            <span class="badge bg-primary">Tersedia</span>
                        </div>
                        <div class="room-info">
                            <div class="room-detail">
                                <i class="fas fa-bed"></i>
                                <span>Premium</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-layer-group"></i>
                                <span>Lantai 1</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Rp 1.500.000</span>
                            </div>
                        </div>
                        <div class="room-tenant">
                            <div class="vacant-info">
                                <i class="fas fa-home"></i>
                                <span>Kamar Kosong</span>
                            </div>
                        </div>
                        <div class="room-actions">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewRoomModal">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                    </div>

                    <!-- Room Card 3 -->
                    <div class="room-card">
                        <div class="room-header">
                            <h5>Kamar A103</h5>
                            <span class="badge bg-warning">Maintenance</span>
                        </div>
                        <div class="room-info">
                            <div class="room-detail">
                                <i class="fas fa-bed"></i>
                                <span>Standard</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-layer-group"></i>
                                <span>Lantai 1</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Rp 1.200.000</span>
                            </div>
                        </div>
                        <div class="room-tenant">
                            <div class="maintenance-info">
                                <i class="fas fa-tools"></i>
                                <span>Sedang Maintenance</span>
                            </div>
                        </div>
                        <div class="room-actions">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewRoomModal">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                    </div>

                    <!-- Room Card 4 -->
                    <div class="room-card">
                        <div class="room-header">
                            <h5>Kamar B201</h5>
                            <span class="badge bg-success">Terisi</span>
                        </div>
                        <div class="room-info">
                            <div class="room-detail">
                                <i class="fas fa-bed"></i>
                                <span>Deluxe</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-layer-group"></i>
                                <span>Lantai 2</span>
                            </div>
                            <div class="room-detail">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Rp 1.800.000</span>
                            </div>
                        </div>
                        <div class="room-tenant">
                            <div class="tenant-info">
                                <div class="user-avatar-sm">AD</div>
                                <div class="tenant-name">
                                    <span>Alice Davis</span>
                                    <small>Masuk: 20 Jan 2024</small>
                                </div>
                            </div>
                        </div>
                        <div class="room-actions">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewRoomModal">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Room Modal -->
<div class="modal fade" id="addRoomModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kamar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Kamar</label>
                                <input type="text" class="form-control" placeholder="Contoh: A101" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tipe Kamar</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Tipe</option>
                                    <option value="standard">Standard</option>
                                    <option value="premium">Premium</option>
                                    <option value="deluxe">Deluxe</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Lantai</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Lantai</option>
                                    <option value="1">Lantai 1</option>
                                    <option value="2">Lantai 2</option>
                                    <option value="3">Lantai 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Sewa (per bulan)</label>
                                <input type="number" class="form-control" placeholder="1200000" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fasilitas</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ac">
                                    <label class="form-check-label" for="ac">AC</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi">
                                    <label class="form-check-label" for="wifi">WiFi</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kamar_mandi">
                                    <label class="form-check-label" for="kamar_mandi">Kamar Mandi Dalam</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" placeholder="Deskripsi kamar..."></textarea>
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

<!-- View Room Modal -->
<div class="modal fade" id="viewRoomModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Informasi Kamar</h6>
                        <p><strong>Nomor Kamar:</strong> A101</p>
                        <p><strong>Tipe:</strong> Standard</p>
                        <p><strong>Lantai:</strong> 1</p>
                        <p><strong>Harga Sewa:</strong> Rp 1.200.000/bulan</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Terisi</span></p>
                    </div>
                    <div class="col-md-6">
                        <h6>Fasilitas</h6>
                        <ul>
                            <li>AC</li>
                            <li>WiFi</li>
                            <li>Kamar Mandi Dalam</li>
                            <li>Lemari</li>
                            <li>Kasur</li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Penghuni Saat Ini</h6>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar-sm">JS</div>
                            <div class="ms-3">
                                <h6 class="mb-0">John Smith</h6>
                                <small class="text-muted">Masuk: 15 Januari 2024</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>

<style>
    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .room-card {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .room-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .room-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .room-header h5 {
        margin: 0;
        color: #2c3e50;
    }

    .room-info {
        margin-bottom: 1rem;
    }

    .room-detail {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
        color: #6c757d;
    }

    .room-detail i {
        width: 16px;
        text-align: center;
    }

    .room-tenant {
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .tenant-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .tenant-name {
        display: flex;
        flex-direction: column;
    }

    .tenant-name span {
        font-weight: 600;
        color: #2c3e50;
    }

    .tenant-name small {
        color: #6c757d;
    }

    .vacant-info,
    .maintenance-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6c757d;
        justify-content: center;
    }

    .room-actions {
        display: flex;
        gap: 0.5rem;
    }

    .room-actions .btn {
        flex: 1;
    }

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
        .room-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .header-content {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
<?= $this->endSection() ?>