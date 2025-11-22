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
                <form method="get" action="<?= base_url('admin/kamar') ?>" class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" name="q" value="<?= esc($filters['q'] ?? '') ?>" placeholder="Cari kamar atau penghuni...">
                    <?php if (!empty($filters['status'])): ?>
                        <input type="hidden" name="status" value="<?= esc($filters['status']) ?>">
                    <?php endif; ?>
                </form>
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
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Kamar</h4>
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url('admin/kamar') ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <?php $statusVal = strtolower((string)($filters['status'] ?? '')); ?>
                                <option value="" <?= $statusVal === '' ? 'selected' : '' ?>>Semua Status</option>
                                <option value="tersedia" <?= $statusVal === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                <option value="terisi" <?= $statusVal === 'terisi' ? 'selected' : '' ?>>Terisi</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cari</label>
                            <input type="text" class="form-control" name="q" value="<?= esc($filters['q'] ?? '') ?>" placeholder="No kamar, penghuni, fasilitas">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Terapkan
                                </button>
                                <a href="<?= base_url('admin/kamar') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Room Cards Grid -->
        <div class="content-card">
            <div class="card-header">
                <h4>Daftar Kamar</h4>
                <div class="card-actions">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                        <i class="fas fa-plus"></i> Tambah Kamar
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="room-grid">
                    <?php if (empty($kamarList ?? [])) : ?>
                        <div class="alert alert-warning w-100">Belum ada data kamar.</div>
                    <?php else: ?>
                        <?php foreach ($kamarList as $k): ?>
                            <?php
                            $status = $k['status'] ?? '';
                            $statusLower = strtolower($status);
                            $badgeClass = 'bg-secondary';
                            if ($statusLower === 'tersedia') $badgeClass = 'bg-primary';
                            elseif ($statusLower === 'terisi') $badgeClass = 'bg-success';

                            $harga = isset($k['harga']) ? number_format((int)$k['harga'], 0, ',', '.') : '0';
                            $namaUser = $k['nama_user'] ?? null;
                            $tanggalMasuk = $k['tanggal_masuk'] ?? null;

                            $initials = '';
                            if (!empty($namaUser)) {
                                $parts = preg_split('/\s+/', trim($namaUser));
                                $initials = strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr($parts[1] ?? '', 0, 1));
                            }
                            ?>
                            <div class="room-card">
                                <div class="room-header">
                                    <h5>Kamar <?= esc($k['no_kamar']) ?></h5>
                                    <span class="badge <?= $badgeClass ?>"><?= esc(ucfirst($statusLower)) ?></span>
                                </div>
                                <div class="room-info">
                                    <div class="room-detail">
                                        <span>Rp <?= $harga ?> / bulan</span>
                                    </div>
                                    <?php if (!empty($k['fasilitas'])): ?>
                                        <div class="room-detail">
                                            <i class="fas fa-list"></i>
                                            <span><?= esc($k['fasilitas']) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="room-tenant">
                                    <?php if ($statusLower === 'terisi' && !empty($namaUser)): ?>
                                        <div class="tenant-info">
                                            <div class="user-avatar-sm"><?= esc($initials) ?></div>
                                            <div class="tenant-name">
                                                <span><?= esc($namaUser) ?></span>
                                                <?php if (!empty($tanggalMasuk)): ?>
                                                    <small>Masuk: <?= date('d M Y', strtotime($tanggalMasuk)) ?></small>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="vacant-info">
                                            <i class="fas fa-home"></i>
                                            <span>Kamar Kosong</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="room-actions">
                                    <button class="btn btn-sm btn-outline-primary btn-room-detail"
                                        data-bs-toggle="modal" data-bs-target="#viewRoomModal"
                                        data-id="<?= $k['id_kamar'] ?>"
                                        data-no="<?= esc($k['no_kamar']) ?>"
                                        data-status="<?= esc($statusLower) ?>"
                                        data-harga="<?= (int)$k['harga'] ?>"
                                        data-fasilitas="<?= esc($k['fasilitas']) ?>"
                                        data-nama="<?= esc($namaUser ?? '') ?>"
                                        data-tanggal_masuk="<?= !empty($tanggalMasuk) ? date('Y-m-d', strtotime($tanggalMasuk)) : '' ?>"
                                        data-gambar="<?= !empty($k['gambar']) ? base_url('uploads/kamar/' . $k['gambar']) : '' ?>">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editRoomModal-<?= $k['id_kamar'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="post" action="<?= base_url('admin/kamar/delete/' . $k['id_kamar']) ?>" class="form-delete-kamar">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- Edit Room Modal per Kamar -->
                            <div class="modal fade" id="editRoomModal-<?= $k['id_kamar'] ?>" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kamar <?= esc($k['no_kamar']) ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?= base_url('admin/kamar/update/' . $k['id_kamar']) ?>" enctype="multipart/form-data">
                                                <?= csrf_field() ?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nomor Kamar</label>
                                                            <input type="text" name="no_kamar" class="form-control" value="<?= esc($k['no_kamar']) ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Harga Sewa (per bulan)</label>
                                                            <input type="number" name="harga" class="form-control" value="<?= esc($k['harga']) ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <?php $st = strtolower($k['status'] ?? ''); ?>
                                                            <select class="form-select" name="status" required>
                                                                <option value="Tersedia" <?= $st === 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                                                <option value="Terisi" <?= $st === 'terisi' ? 'selected' : '' ?>>Terisi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Gambar (opsional, akan mengganti)</label>
                                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $fasil = array_map('trim', explode(',', $k['fasilitas'] ?? ''));
                                                $has = function ($val) use ($fasil) {
                                                    return in_array($val, $fasil);
                                                };
                                                ?>
                                                <div class="mb-3">
                                                    <label class="form-label">Fasilitas</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="ac-<?= $k['id_kamar'] ?>" name="fasilitas[]" value="AC" <?= $has('AC') ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="ac-<?= $k['id_kamar'] ?>">AC</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="wifi-<?= $k['id_kamar'] ?>" name="fasilitas[]" value="WiFi" <?= $has('WiFi') ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="wifi-<?= $k['id_kamar'] ?>">WiFi</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="km-<?= $k['id_kamar'] ?>" name="fasilitas[]" value="Kamar Mandi Dalam" <?= $has('Kamar Mandi Dalam') ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="km-<?= $k['id_kamar'] ?>">Kamar Mandi Dalam</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Pengajuan Pindah Kamar -->
        <div class="content-card">
            <div class="card-header">
                <h4>Pengajuan Pindah Kamar</h4>
            </div>
            <div class="card-body">
                <?php $pkList = $pindahKamar ?? ($pindah_kamar ?? []); ?>
                <?php if (empty($pkList)) : ?>
                    <div class="alert alert-info mb-0">Belum ada pengajuan pindah kamar.</div>
                <?php else: ?>
                    <div class="d-flex justify-content-end mb-2">
                        <form method="get" action="<?= base_url('admin/kamar') ?>" class="d-flex align-items-center gap-2">
                            <?php // pertahankan filter kamar atas jika ada 
                            ?>
                            <?php if (!empty($filters['status'])): ?>
                                <input type="hidden" name="status" value="<?= esc($filters['status']) ?>">
                            <?php endif; ?>
                            <?php if (!empty($filters['q'])): ?>
                                <input type="hidden" name="q" value="<?= esc($filters['q']) ?>">
                            <?php endif; ?>
                            <label class="me-2 small text-muted">Tampilan</label>
                            <select name="pk_per_page" class="form-select form-select-sm" onchange="this.form.submit()" style="width:auto;">
                                <?php $pp = (int)($pkPerPage ?? 10); ?>
                                <option value="10" <?= $pp === 10 ? 'selected' : '' ?>>10</option>
                                <option value="25" <?= $pp === 25 ? 'selected' : '' ?>>25</option>
                                <option value="50" <?= $pp === 50 ? 'selected' : '' ?>>50</option>
                            </select>
                            <noscript><button class="btn btn-sm btn-outline-secondary" type="submit">Terapkan</button></noscript>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">ID</th>
                                    <th>Penghuni</th>
                                    <th>Kamar Asal</th>
                                    <th>Kamar Tujuan</th>
                                    <th>Alasan</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th style="width: 180px;">Aksi</th>
                                    <th style="width: 160px;">Tanggal Pengajuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pkList as $row): ?>
                                    <?php
                                    $id = $row['id'] ?? ($row['id_pindah'] ?? ($row['id_pengajuan'] ?? ''));
                                    $nama = $row['nama_user'] ?? ($row['user_nama'] ?? ($row['nama'] ?? ''));
                                    $asal = $row['kamar_asal'] ?? ($row['asal'] ?? ($row['from_room'] ?? ''));
                                    $tujuan = $row['kamar_tujuan'] ?? ($row['tujuan'] ?? ($row['to_room'] ?? ''));
                                    $alasan = $row['alasan'] ?? '';
                                    $keterangan = $row['keterangan'] ?? '';
                                    $statusVal = strtolower((string)($row['status'] ?? ''));
                                    $tgl = $row['tanggal_pengajuan'] ?? ($row['created_at'] ?? ($row['tanggal'] ?? ''));
                                    $badge = 'bg-secondary';
                                    if ($statusVal === 'pending' || $statusVal === 'menunggu') $badge = 'bg-warning';
                                    elseif ($statusVal === 'disetujui' || $statusVal === 'approved') $badge = 'bg-success';
                                    elseif ($statusVal === 'ditolak' || $statusVal === 'rejected') $badge = 'bg-danger';
                                    ?>
                                    <tr>
                                        <td><?= esc($id) ?: '-' ?></td>
                                        <td><?= esc($nama) ?: '-' ?></td>
                                        <td><?= esc($asal) ?: '-' ?></td>
                                        <td><?= esc($tujuan) ?: '-' ?></td>
                                        <td><?= esc($alasan) ?: '-' ?></td>
                                        <td><?= esc($keterangan) ?: '-' ?></td>
                                        <td>
                                            <span class="badge <?= $badge ?>">
                                                <?= esc(ucfirst($statusVal ?: '-')) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if (in_array($statusVal, ['pending', 'menunggu'])): ?>
                                                <div class="d-flex gap-2">
                                                    <form method="post" action="<?= base_url('admin/pindah-kamar/approve/' . ($row['id_pindah'] ?? $row['id'] ?? 0)) ?>" class="form-approve-pindah">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm btn-success">
                                                            <i class="fas fa-check"></i> Setujui
                                                        </button>
                                                    </form>
                                                    <form method="post" action="<?= base_url('admin/pindah-kamar/reject/' . ($row['id_pindah'] ?? $row['id'] ?? 0)) ?>" class="form-reject-pindah">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= !empty($tgl) ? date('d M Y', strtotime($tgl)) : '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if (isset($pagerPk)) : ?>
                        <div class="mt-3">
                            <?= $pagerPk->links('pindah_kamar') ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
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
                <form method="post" action="<?= base_url('admin/kamar/store') ?>" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nomor Kamar</label>
                                <input type="text" name="no_kamar" class="form-control" placeholder="Contoh: A101" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Sewa (per bulan)</label>
                                <input type="number" name="harga" class="form-control" placeholder="1200000" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Terisi">Terisi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Gambar (opsional)</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fasilitas</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ac" name="fasilitas[]" value="AC">
                                    <label class="form-check-label" for="ac">AC</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="wifi" name="fasilitas[]" value="WiFi">
                                    <label class="form-check-label" for="wifi">WiFi</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="kamar_mandi" name="fasilitas[]" value="Kamar Mandi Dalam">
                                    <label class="form-check-label" for="kamar_mandi">Kamar Mandi Dalam</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Room Modal (Dynamic) -->
<div class="modal fade" id="viewRoomModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roomModalTitle">Detail Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Informasi Kamar</h6>
                        <table class="table table-sm">
                            <tr>
                                <th style="width:40%">Nomor Kamar</th>
                                <td id="modalNoKamar">-</td>
                            </tr>
                            <tr>
                                <th>Harga Sewa</th>
                                <td id="modalHarga">-</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-secondary" id="modalStatus">-</span></td>
                            </tr>
                        </table>
                        <h6 class="mt-4">Fasilitas</h6>
                        <ul id="modalFasilitas" class="mb-0 small"></ul>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Gambar Kamar</h6>
                        <div id="modalImageWrapper" class="border rounded d-flex align-items-center justify-content-center bg-light" style="min-height:240px;">
                            <span class="text-muted" id="modalImageText">Tidak ada gambar</span>
                            <img id="modalGambar" src="" alt="Gambar Kamar" class="img-fluid d-none" style="max-height:230px; object-fit:cover;">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h6>Penghuni Saat Ini</h6>
                        <div id="modalPenghuniWrapper" class="d-flex align-items-center p-3 bg-light rounded">
                            <div class="user-avatar-sm me-3" id="modalPenghuniInitials">-</div>
                            <div>
                                <h6 class="mb-0" id="modalPenghuniNama">Tidak ada penghuni</h6>
                                <small class="text-muted" id="modalPenghuniTanggal"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    .vacant-info {
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // SweetAlert konfirmasi hapus kamar
        document.querySelectorAll('.form-delete-kamar').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Hapus kamar ini?',
                    text: 'Data kamar akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Konfirmasi setujui/ tolak pindah kamar
        document.querySelectorAll('.form-approve-pindah').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Setujui pengajuan?',
                    text: 'Kamar akan dipindahkan sesuai pengajuan.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Setujui',
                    cancelButtonText: 'Batal'
                }).then((res) => {
                    if (res.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        document.querySelectorAll('.form-reject-pindah').forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Tolak pengajuan?',
                    text: 'Pengajuan akan ditandai ditolak.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Tolak',
                    cancelButtonText: 'Batal'
                }).then((res) => {
                    if (res.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Populate dynamic room modal
        var roomModalEl = document.getElementById('viewRoomModal');
        if (roomModalEl) {
            roomModalEl.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                if (!button) return;
                var no = button.getAttribute('data-no') || '-';
                var status = (button.getAttribute('data-status') || '-').toLowerCase();
                var harga = parseInt(button.getAttribute('data-harga') || '0', 10);
                var fasilitas = button.getAttribute('data-fasilitas') || '';
                var nama = button.getAttribute('data-nama') || '';
                var tglMasuk = button.getAttribute('data-tanggal_masuk') || '';
                var gambar = button.getAttribute('data-gambar') || '';

                // Set basic info
                document.getElementById('modalNoKamar').textContent = no;
                document.getElementById('modalHarga').textContent = 'Rp ' + harga.toLocaleString('id-ID') + ' / bulan';
                var statusBadge = document.getElementById('modalStatus');
                statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                statusBadge.className = 'badge ' + (status === 'tersedia' ? 'bg-primary' : (status === 'terisi' ? 'bg-success' : 'bg-secondary'));

                // Fasilitas list
                var fasilitasUl = document.getElementById('modalFasilitas');
                fasilitasUl.innerHTML = '';
                if (fasilitas.trim() !== '') {
                    fasilitas.split(',').map(function(f) {
                        return f.trim();
                    }).filter(Boolean).forEach(function(f) {
                        var li = document.createElement('li');
                        li.textContent = f;
                        fasilitasUl.appendChild(li);
                    });
                } else {
                    var li = document.createElement('li');
                    li.textContent = 'Tidak ada data fasilitas';
                    fasilitasUl.appendChild(li);
                }

                // Gambar
                var imgEl = document.getElementById('modalGambar');
                var imgText = document.getElementById('modalImageText');
                if (gambar) {
                    imgEl.src = gambar;
                    imgEl.classList.remove('d-none');
                    imgText.classList.add('d-none');
                } else {
                    imgEl.src = '';
                    imgEl.classList.add('d-none');
                    imgText.classList.remove('d-none');
                }

                // Penghuni
                var initialsEl = document.getElementById('modalPenghuniInitials');
                var namaEl = document.getElementById('modalPenghuniNama');
                var tanggalEl = document.getElementById('modalPenghuniTanggal');
                if (status === 'terisi' && nama) {
                    var parts = nama.trim().split(/\s+/);
                    var initials = parts[0] ? parts[0].charAt(0).toUpperCase() : '';
                    if (parts[1]) initials += parts[1].charAt(0).toUpperCase();
                    initialsEl.textContent = initials || nama.charAt(0).toUpperCase();
                    namaEl.textContent = nama;
                    tanggalEl.textContent = tglMasuk ? ('Masuk: ' + new Date(tglMasuk).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    })) : '';
                } else {
                    initialsEl.textContent = '-';
                    namaEl.textContent = 'Tidak ada penghuni';
                    tanggalEl.textContent = '';
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>