<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Manajemen Penyewa</h1>
                <p>Kelola data penyewa dan informasi penghuni kos</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Cari penyewa...">
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTenantModal">
                    <i class="fas fa-plus"></i> Tambah Penyewa
                </button>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">

        <!-- Filter Section -->
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Penyewa</h4>
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url('admin/penyewa') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="">Semua Status</option>
                                <option value="aktif" <?= (isset($_GET['status']) && $_GET['status'] == 'aktif') ? 'selected' : '' ?>>Aktif
                                </option>
                                <option value="pending" <?= (isset($_GET['status']) && $_GET['status'] == 'pending') ? 'selected' : '' ?>>
                                    Pending
                                </option>
                                <option value="nonaktif" <?= (isset($_GET['status']) && $_GET['status'] == 'nonaktif') ? 'selected' : '' ?>>
                                    Non-Aktif
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Kamar</label>
                            <input type="text" class="form-control" name="kamar" value="<?= esc($_GET['kamar'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" value="<?= esc($_GET['tanggal_masuk'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="<?= base_url('admin/penyewa') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tenants Table -->
        <div class="content-card">
            <div class="card-header">
                <h4>Daftar Penyewa</h4>
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
                                <th>Nama Penyewa</th>
                                <th>Kamar</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($penyewa as $p) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div>
                                            <h6 class="mb-0"><?= esc($p['nama']) ?></h6>
                                            <small class="text-muted"><?= esc($p['email']) ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary"><?= esc($p['no_kamar']) ?></span>
                                    </td>
                                    <td>
                                        <div><i class="fas fa-phone text-muted me-2"></i><?= esc($p['no_hp']) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge <?= ($p['status_kamar'] == 'Terisi') ? 'bg-success' : 'bg-warning' ?>">
                                            <?= esc($p['status_kamar']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $status = strtolower($p['status_pembayaran']);
                                        $badge = ($status == 'lunas') ? 'bg-success' : (($status == 'pending') ? 'bg-warning' : 'bg-danger');
                                        ?>
                                        <span class="badge <?= $badge ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewTenantModal">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTenantModal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" onclick="deleteTenant(<?= $p['id_user'] ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan <?= count($penyewa) ?> dari <?= $pager->getTotal() ?> penyewa
                    </div>
                    <?= $pager->links('default', 'default_full') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Tenant Modal -->
<div class="modal fade" id="addTenantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penyewa Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kamar</label>
                                <select class="form-select" required>
                                    <option value="">Pilih Kamar</option>
                                    <option value="A101">A101</option>
                                    <option value="A102">A102</option>
                                    <option value="A103">A103</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Kontak Darurat</label>
                                <input type="tel" class="form-control">
                            </div>
                        </div>
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

<!-- View Tenant Modal -->
<div class="modal fade" id="viewTenantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="user-avatar-lg mb-3">JS</div>
                        <h5>John Smith</h5>
                        <span class="badge bg-success">Aktif</span>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Informasi Pribadi</h6>
                                <p><strong>Email:</strong> john.smith@email.com</p>
                                <p><strong>Telepon:</strong> 081234567890</p>
                                <p><strong>Tanggal Lahir:</strong> 15 Januari 1995</p>
                                <p><strong>Pekerjaan:</strong> Mahasiswa</p>
                            </div>
                            <div class="col-md-6">
                                <h6>Informasi Kos</h6>
                                <p><strong>Kamar:</strong> A101</p>
                                <p><strong>Tanggal Masuk:</strong> 15 Januari 2024</p>
                                <p><strong>Sewa Bulanan:</strong> Rp 1.200.000</p>
                                <p><strong>Status Pembayaran:</strong> <span class="badge bg-success">Lunas</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h6>Alamat</h6>
                                <p>Jl. Contoh No. 123, Jakarta Selatan, DKI Jakarta</p>
                                <h6>Kontak Darurat</h6>
                                <p>081234567891 (Orang Tua)</p>
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

<script>
    function deleteTenant(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data penyewa akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Di sini tambahkan logika untuk menghapus data
                Swal.fire(
                    'Terhapus!',
                    'Data penyewa telah dihapus.',
                    'success'
                );
            }
        });
    }
</script>


<?= $this->endSection() ?>