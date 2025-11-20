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
                <form method="get" action="<?= current_url() ?>" class="d-flex align-items-center gap-2">
                    <input type="hidden" name="status" value="<?= esc($filters['status'] ?? '') ?>">
                    <input type="hidden" name="metode" value="<?= esc($filters['metode'] ?? '') ?>">
                    <input type="hidden" name="periode" value="<?= esc($filters['periode'] ?? '') ?>">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" name="search" value="<?= esc($filters['search'] ?? '') ?>" placeholder="Cari pembayaran...">
                    </div>
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                    <i class="fas fa-plus"></i> Tambah Pembayaran
                </button>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">

        <!-- Filter Section -->
        <div class="content-card">
            <div class="card-header">
                <h4>Filter Pembayaran</h4>
            </div>
            <div class="card-body">
                <form method="get" action="<?= current_url() ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Status Pembayaran</label>
                            <select name="status" class="form-select">
                                <option value="">Semua Status</option>
                                <option value="selesai" <?= (isset($filters['status']) && $filters['status'] === 'selesai') ? 'selected' : '' ?>>Selesai</option>
                                <option value="pending" <?= (isset($filters['status']) && $filters['status'] === 'pending') ? 'selected' : '' ?>>Pending</option>
                                <option value="gagal" <?= (isset($filters['status']) && $filters['status'] === 'gagal') ? 'selected' : '' ?>>Gagal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="metode" class="form-select">
                                <option value="">Semua Metode</option>
                                <option value="transfer" <?= (isset($filters['metode']) && $filters['metode'] === 'transfer') ? 'selected' : '' ?>>Transfer Bank</option>
                                <option value="cash" <?= (isset($filters['metode']) && $filters['metode'] === 'cash') ? 'selected' : '' ?>>Cash</option>
                                <option value="ewallet" <?= (isset($filters['metode']) && $filters['metode'] === 'ewallet') ? 'selected' : '' ?>>E-Wallet</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Periode</label>
                            <select name="periode" class="form-select">
                                <option value="">Semua Periode</option>
                                <?php if (!empty($periodeList)): ?>
                                    <?php foreach ($periodeList as $p): ?>
                                        <?php $val = $p['periode']; ?>
                                        <option value="<?= esc($val) ?>" <?= (isset($filters['periode']) && $filters['periode'] === $val) ? 'selected' : '' ?>>
                                            <?= esc($val) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="<?= base_url('admin/pembayaran') ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
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
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success" role="alert">
                        <?= esc(session()->getFlashdata('success')) ?>
                    </div>
                <?php elseif (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger" role="alert">
                        <?= esc(session()->getFlashdata('error')) ?>
                    </div>
                <?php endif; ?>
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
                            <?php if (!empty($pembayaran)): ?>
                                <?php
                                $currentPage = isset($pager) && method_exists($pager, 'getCurrentPage') ? (int)$pager->getCurrentPage('pembayaran') : (int)($_GET['page_pembayaran'] ?? 1);
                                $perPage = isset($pager) && method_exists($pager, 'getPerPage') ? (int)$pager->getPerPage('pembayaran') : 10;
                                $no = 1 + ($currentPage - 1) * $perPage;
                                ?>
                                <?php foreach ($pembayaran as $row): ?>
                                    <?php
                                    $nama = $row['nama_user'] ?? '-';
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

                                    $badgeClass = 'bg-warning';
                                    $status = strtolower($row['status'] ?? '');
                                    if ($status === 'selesai' || $status === 'success' || $status === 'paid') {
                                        $badgeClass = 'bg-success';
                                    } elseif ($status === 'gagal' || $status === 'failed' || $status === 'cancelled') {
                                        $badgeClass = 'bg-danger';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar-sm"><?= esc($initials) ?></div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0"><?= esc($row['nama_user'] ?? '-') ?></h6>
                                                    <small class="text-muted"><?= esc($row['email_user'] ?? '-') ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?= esc($row['no_kamar'] ?? '-') ?></span>
                                        </td>
                                        <td><?= esc($row['periode'] ?? '-') ?></td>
                                        <td><strong>Rp<?= number_format((float)($row['total_bayar'] ?? 0), 0, ',', '.') ?></strong></td>
                                        <td><?= !empty($row['tanggal_bayar']) ? date('d M Y', strtotime($row['tanggal_bayar'])) : '-' ?></td>
                                        <td>
                                            <span class="badge bg-info"><?= esc(ucwords($row['metode'] ?? '-')) ?></span>
                                        </td>
                                        <td>
                                            <span class="badge <?= $badgeClass ?>"><?= esc(ucwords($row['status'] ?? '-')) ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button
                                                    class="btn btn-sm btn-outline-primary btn-view-payment"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#viewPaymentModal"
                                                    data-id="<?= esc($row['id_pembayaran']) ?>"
                                                    data-nama="<?= esc($row['nama_user'] ?? '-') ?>"
                                                    data-email="<?= esc($row['email_user'] ?? '-') ?>"
                                                    data-kamar="<?= esc($row['no_kamar'] ?? '-') ?>"
                                                    data-periode="<?= esc($row['periode'] ?? '-') ?>"
                                                    data-jumlah="<?= number_format((float)($row['total_bayar'] ?? 0), 0, ',', '.') ?>"
                                                    data-tanggal="<?= !empty($row['tanggal_bayar']) ? date('d M Y', strtotime($row['tanggal_bayar'])) : '-' ?>"
                                                    data-metode="<?= esc(strtolower($row['metode'] ?? '-')) ?>"
                                                    data-status="<?= esc(ucwords($row['status'] ?? '-')) ?>"
                                                    data-bukti="<?= !empty($row['bukti']) ? base_url('uploads/bukti/' . $row['bukti']) : '' ?>"
                                                    title="Lihat Detail Pembayaran">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <?php if (strtolower($row['status'] ?? '') === 'pending'): ?>
                                                    <form class="form-update-status" action="<?= base_url('admin/pembayaran/update-status') ?>" method="post" style="display:inline-block;">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id_pembayaran" value="<?= esc($row['id_pembayaran']) ?>">
                                                        <input type="hidden" name="status" value="selesai">
                                                        <button type="button" class="btn btn-sm btn-outline-success btn-status-change" data-status="selesai" title="Konfirmasi Lunas">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form class="form-update-status" action="<?= base_url('admin/pembayaran/update-status') ?>" method="post" style="display:inline-block;">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id_pembayaran" value="<?= esc($row['id_pembayaran']) ?>">
                                                        <input type="hidden" name="status" value="gagal">
                                                        <button type="button" class="btn btn-sm btn-outline-danger btn-status-change" data-status="gagal" title="Tandai Gagal">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline-success" title="Cetak Kwitansi">
                                                        <i class="fas fa-receipt"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada data pembayaran.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted"></div>
                    <nav>
                        <?= isset($pager) ? $pager->links('pembayaran', 'default_full') : '' ?>
                    </nav>
                </div>
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

    .img-zoomable {
        cursor: zoom-in;
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
<!-- Modal Detail Pembayaran -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1" aria-labelledby="viewPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPaymentModalLabel">Detail Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <h6>Informasi Pembayaran</h6>
                        <table class="table table-sm">
                            <tr>
                                <th style="width: 40%">Nama Penyewa</th>
                                <td id="pm-nama">-</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td id="pm-email">-</td>
                            </tr>
                            <tr>
                                <th>Kamar</th>
                                <td id="pm-kamar">-</td>
                            </tr>
                            <tr>
                                <th>Periode</th>
                                <td id="pm-periode">-</td>
                            </tr>
                            <tr>
                                <th>Jumlah</th>
                                <td id="pm-jumlah">-</td>
                            </tr>
                            <tr>
                                <th>Tanggal Bayar</th>
                                <td id="pm-tanggal">-</td>
                            </tr>
                            <tr>
                                <th>Metode</th>
                                <td id="pm-metode">-</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-secondary" id="pm-status">-</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h6>Bukti Pembayaran</h6>
                        <div id="pm-bukti-wrapper" class="border rounded d-flex align-items-center justify-content-center" style="min-height: 250px; background:#f8f9fa;">
                            <span class="text-muted" id="pm-bukti-text">Tidak ada bukti pembayaran (metode cash)</span>
                            <img id="pm-bukti-img" src="" alt="Bukti Pembayaran" class="img-fluid d-none img-zoomable" style="max-height:240px; object-fit:contain;">
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

<!-- Modal Preview Gambar Bukti -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body position-relative p-0" style="background:#000;">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="d-flex align-items-center justify-content-center" style="min-height:70vh;">
                    <img id="imagePreviewModalImg" src="" alt="Bukti Pembayaran" style="max-width:100%; max-height:85vh; object-fit:contain;">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalEl = document.getElementById('viewPaymentModal');
        if (!modalEl) return;

        modalEl.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            if (!button) return;

            var nama = button.getAttribute('data-nama') || '-';
            var email = button.getAttribute('data-email') || '-';
            var kamar = button.getAttribute('data-kamar') || '-';
            var periode = button.getAttribute('data-periode') || '-';
            var jumlah = button.getAttribute('data-jumlah') || '-';
            var tanggal = button.getAttribute('data-tanggal') || '-';
            var metode = button.getAttribute('data-metode') || '-';
            var status = button.getAttribute('data-status') || '-';
            var bukti = button.getAttribute('data-bukti') || '';

            document.getElementById('pm-nama').textContent = nama;
            document.getElementById('pm-email').textContent = email;
            document.getElementById('pm-kamar').textContent = kamar;
            document.getElementById('pm-periode').textContent = periode;
            document.getElementById('pm-jumlah').textContent = 'Rp' + jumlah;
            document.getElementById('pm-tanggal').textContent = tanggal;
            document.getElementById('pm-metode').textContent = metode.toUpperCase();
            document.getElementById('pm-status').textContent = status;

            var buktiImg = document.getElementById('pm-bukti-img');
            var buktiText = document.getElementById('pm-bukti-text');

            if (metode.toLowerCase() === 'cash' || !bukti) {
                buktiImg.classList.add('d-none');
                buktiImg.removeAttribute('src');
                buktiText.textContent = 'Tidak ada bukti pembayaran (metode cash)';
                buktiText.classList.remove('d-none');
            } else {
                buktiImg.setAttribute('src', bukti);
                buktiImg.classList.remove('d-none');
                buktiText.classList.add('d-none');
            }
        });

        // Click to preview larger image
        var previewModalEl = document.getElementById('imagePreviewModal');
        var previewModalImg = document.getElementById('imagePreviewModalImg');
        var pmBuktiImg = document.getElementById('pm-bukti-img');

        if (previewModalEl && previewModalImg && pmBuktiImg) {
            pmBuktiImg.addEventListener('click', function() {
                var src = pmBuktiImg.getAttribute('src');
                if (!src) return;
                previewModalImg.setAttribute('src', src);
                var bsModal = new bootstrap.Modal(previewModalEl);
                bsModal.show();
            });
        }

        // SweetAlert confirmation for status update (pending -> selesai/gagal)
        var statusButtons = document.querySelectorAll('.btn-status-change');
        if (statusButtons.length) {
            statusButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetStatus = btn.getAttribute('data-status');
                    var form = btn.closest('form');
                    if (!form || !targetStatus) return;

                    var title = 'Konfirmasi perubahan status';
                    var text = '';
                    var icon = 'warning';
                    if (targetStatus === 'selesai') {
                        text = 'Tandai pembayaran ini sebagai SeLesai/Lunas?';
                    } else if (targetStatus === 'gagal') {
                        text = 'Yakin ingin menandai pembayaran ini sebagai GAGAL?';
                        icon = 'error';
                    } else {
                        text = 'Yakin ingin mengubah status?';
                    }

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, lanjutkan',
                        cancelButtonText: 'Batal'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }
    });
</script>
<?= $this->endSection() ?>