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
                <form method="get" action="<?= base_url('admin/penyewa') ?>" class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="<?= esc($_GET['q'] ?? '') ?>" placeholder="Cari penyewa...">
                </form>
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <a href="<?= base_url('admin/pengaturan-akun') ?>" class="a-info">
                        <div class="user-info">
                            <h6><?= esc($admin['nama'] ?? 'Admin') ?></h6>
                            <p>Administrator</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= esc(session()->getFlashdata('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= esc(session()->getFlashdata('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="content-card mb-3">
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
                            <select class="form-control" name="kamar">
                                <option value="">-- Pilih Kamar --</option>
                                <?php foreach ($kamarList as $k): ?>
                                    <option value="<?= $k['id_kamar']; ?>"
                                        <?= (isset($_GET['kamar']) && $_GET['kamar'] == $k['id_kamar']) ? 'selected' : '' ?>>
                                        <?= esc($k['no_kamar']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTenantModal">
                        <i class="fas fa-plus"></i> Tambah Penyewa
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
                                <th>Status Sewa</th>
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
                                        <span><?= esc($p['no_kamar']) ?></span>
                                    </td>
                                    <td>
                                        <div><i class="text-muted me-2"></i><?= esc($p['no_hp']) ?></div>
                                    </td>
                                    <td>
                                        <span class="badge <?= ($p['status'] == 'aktif') ? 'bg-success' : 'bg-danger' ?>">
                                            <?= esc($p['status']) ?>
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
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewTenantModal" data-id_user="<?= $p['id_user'] ?>">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editTenantModal"
                                                data-id_user="<?= $p['id_user'] ?>"
                                                data-nama="<?= esc($p['nama']) ?>"
                                                data-email="<?= esc($p['email']) ?>"
                                                data-no_hp="<?= esc($p['no_hp']) ?>"
                                                data-tanggal_masuk="<?= esc($p['tanggal_masuk'] ?? '') ?>">
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
                <form method="post" action="<?= base_url('admin/penyewa/tambah') ?>" id="formAddTenant">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" name="no_hp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" required>
                            </div>
                        </div>
                    </div>
                    <!-- Hanya menggunakan field yang ada di UserModel: nama, email, no_hp, tanggal_masuk -->
                    <div class="mb-3 mt-2">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="formAddTenant" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Tenant Modal (kerangka, dapat diisi dinamis via JS) -->
<div class="modal fade" id="editTenantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="formEditTenant">
                    <input type="hidden" name="id_user" id="edit_id_user">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="edit_nama" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="edit_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" class="form-control" name="no_hp" id="edit_no_hp" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="edit_tanggal_masuk">
                            </div>
                        </div>
                    </div>
                    <!-- Tidak ada pengaturan password di form edit, mengikuti field UserModel -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" form="formEditTenant" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- View Tenant Modal (bisa diisi dinamis jika diperlukan) -->
<div class="modal fade" id="viewTenantModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penyewa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="detailLoading" class="text-center py-3" style="display:none;">
                    <div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>
                </div>
                <div id="detailError" class="alert alert-danger d-none"></div>
                <div id="detailContent" style="display:none;">
                    <h6 class="mb-3">Data Penyewa</h6>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <strong>Nama:</strong> <span id="d_nama">-</span><br>
                            <strong>Email:</strong> <span id="d_email">-</span><br>
                            <strong>No HP:</strong> <span id="d_no_hp">-</span><br>
                        </div>
                        <div class="col-md-6">
                            <strong>Tanggal Masuk:</strong> <span id="d_tanggal_masuk">-</span><br>
                            <strong>Status:</strong> <span id="d_status" class="badge bg-secondary">-</span><br>
                        </div>
                    </div>
                    <hr>
                    <h6 class="mb-3">Informasi Kamar</h6>
                    <div id="kamarSection" class="mb-2">
                        <strong>No Kamar:</strong> <span id="d_no_kamar">-</span><br>
                        <strong>Status Kamar:</strong> <span id="d_status_kamar" class="badge bg-secondary">-</span><br>
                        <strong>Fasilitas:</strong> <span id="d_fasilitas">-</span><br>
                        <strong>Harga:</strong> <span id="d_harga">-</span>
                    </div>
                    <hr>
                    <h6 class="mb-3">Pembayaran Terakhir</h6>
                    <div id="pembayaranSection">
                        <strong>Status:</strong> <span id="d_status_pembayaran" class="badge bg-secondary">-</span><br>
                        <strong>Metode:</strong> <span id="d_metode">-</span><br>
                        <strong>Periode:</strong> <span id="d_periode">-</span><br>
                        <strong>Nominal:</strong> <span id="d_nominal">-</span><br>
                        <strong>Tanggal Bayar:</strong> <span id="d_tanggal_bayar">-</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Isi otomatis modal edit saat dibuka
    const editModal = document.getElementById('editTenantModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (!button) return;

            const idUser = button.getAttribute('data-id_user');
            const nama = button.getAttribute('data-nama');
            const email = button.getAttribute('data-email');
            const noHp = button.getAttribute('data-no_hp');
            const tanggalMasuk = button.getAttribute('data-tanggal_masuk');

            const form = document.getElementById('formEditTenant');
            if (!form) return;

            document.getElementById('edit_id_user').value = idUser || '';
            document.getElementById('edit_nama').value = nama || '';
            document.getElementById('edit_email').value = email || '';
            document.getElementById('edit_no_hp').value = noHp || '';
            document.getElementById('edit_tanggal_masuk').value = tanggalMasuk || '';

            // Set action form ke endpoint edit sesuai id_user
            form.action = `<?= base_url('admin/penyewa/edit') ?>/${idUser}`;
        });
    }

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
                fetch(`<?= base_url('admin/penyewa/hapus') ?>/${id}`, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        Swal.fire(
                            data.success ? 'Terhapus!' : 'Gagal',
                            data.message,
                            data.success ? 'success' : 'error'
                        ).then(() => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                    })
                    .catch(() => {
                        Swal.fire('Gagal', 'Terjadi kesalahan saat menghapus.', 'error');
                    });
            }
        });
    }

    // Detail modal fetch
    const viewModal = document.getElementById('viewTenantModal');
    if (viewModal) {
        viewModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            if (!button) return;
            const idUser = button.getAttribute('data-id_user');
            if (!idUser) return;

            // Reset state
            document.getElementById('detailContent').style.display = 'none';
            document.getElementById('detailLoading').style.display = 'block';
            document.getElementById('detailError').classList.add('d-none');
            document.getElementById('detailError').innerHTML = '';

            fetch(`<?= base_url('admin/penyewa/detail') ?>/${idUser}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(r => r.json())
                .then(res => {
                    document.getElementById('detailLoading').style.display = 'none';
                    if (!res.success) {
                        document.getElementById('detailError').classList.remove('d-none');
                        document.getElementById('detailError').innerHTML = res.message || 'Gagal memuat data.';
                        return;
                    }
                    const d = res.data;
                    const u = d.user || {};
                    const k = d.kamar || null;
                    const lp = d.last_payment || null;

                    document.getElementById('d_nama').textContent = u.nama || '-';
                    document.getElementById('d_email').textContent = u.email || '-';
                    document.getElementById('d_no_hp').textContent = u.no_hp || '-';
                    document.getElementById('d_tanggal_masuk').textContent = u.tanggal_masuk || '-';
                    const statusSpan = document.getElementById('d_status');
                    statusSpan.textContent = u.status || '-';
                    statusSpan.className = 'badge ' + ((u.status || '').toLowerCase() === 'aktif' ? 'bg-success' : 'bg-secondary');

                    if (k) {
                        document.getElementById('d_no_kamar').textContent = k.no_kamar || '-';
                        const stK = document.getElementById('d_status_kamar');
                        stK.textContent = k.status || '-';
                        stK.className = 'badge ' + ((k.status || '').toLowerCase() === 'terisi' ? 'bg-success' : 'bg-info');
                        document.getElementById('d_fasilitas').textContent = k.fasilitas || '-';
                        document.getElementById('d_harga').textContent = k.harga ? 'Rp ' + new Intl.NumberFormat('id-ID').format(k.harga) : '-';
                    } else {
                        document.getElementById('d_no_kamar').textContent = '-';
                        document.getElementById('d_status_kamar').textContent = '-';
                        document.getElementById('d_status_kamar').className = 'badge bg-secondary';
                        document.getElementById('d_fasilitas').textContent = '-';
                        document.getElementById('d_harga').textContent = '-';
                    }

                    if (lp) {
                        const stP = document.getElementById('d_status_pembayaran');
                        stP.textContent = lp.status || '-';
                        const stLower = (lp.status || '').toLowerCase();
                        let cls = 'bg-secondary';
                        if (stLower === 'lunas' || stLower === 'selesai') cls = 'bg-success';
                        else if (stLower === 'pending') cls = 'bg-warning';
                        else if (stLower === 'gagal') cls = 'bg-danger';
                        stP.className = 'badge ' + cls;
                        document.getElementById('d_metode').textContent = lp.metode || '-';
                        document.getElementById('d_periode').textContent = lp.periode || '-';
                        document.getElementById('d_nominal').textContent = lp.nominal ? 'Rp ' + new Intl.NumberFormat('id-ID').format(lp.nominal) : '-';
                        document.getElementById('d_tanggal_bayar').textContent = lp.tanggal_bayar || '-';
                    } else {
                        document.getElementById('d_status_pembayaran').textContent = '-';
                        document.getElementById('d_status_pembayaran').className = 'badge bg-secondary';
                        document.getElementById('d_metode').textContent = '-';
                        document.getElementById('d_periode').textContent = '-';
                        document.getElementById('d_nominal').textContent = '-';
                        document.getElementById('d_tanggal_bayar').textContent = '-';
                    }

                    document.getElementById('detailContent').style.display = 'block';
                })
                .catch(() => {
                    document.getElementById('detailLoading').style.display = 'none';
                    document.getElementById('detailError').classList.remove('d-none');
                    document.getElementById('detailError').innerHTML = 'Terjadi kesalahan jaringan.';
                });
        });
    }
</script>


<?= $this->endSection() ?>