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

    .payment-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
        margin-bottom: 2rem;
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

    .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        font-size: 1rem;
        background: white;
        cursor: pointer;
    }

    .payment-method {
        display: flex;
        align-items: center;
        padding: 1rem;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        margin-bottom: 1rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .payment-method:hover {
        border-color: #3498db;
    }

    .payment-method.selected {
        border-color: #3498db;
        background: #f8f9fa;
    }

    .payment-method input[type="radio"] {
        margin-right: 1rem;
    }

    .payment-icon {
        width: 40px;
        height: 40px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.2rem;
    }

    .payment-info {
        flex: 1;
    }

    .payment-name {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .payment-desc {
        color: #6c757d;
        font-size: 0.9rem;
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

    .btn-success {
        background: #27ae60;
        color: white;
        width: 100%;
    }

    .btn-success:hover {
        background: #219a52;
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

    /* Summary Card */
    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .summary-item:last-child {
        border-bottom: none;
        font-weight: bold;
        font-size: 1.1rem;
    }

    .summary-label {
        color: #6c757d;
    }

    .summary-value {
        font-weight: 500;
        color: #2c3e50;
    }

    .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
    }

    .alert-warning {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        color: #856404;
    }

    .alert-info {
        background: #d1ecf1;
        border: 1px solid #bee5eb;
        color: #0c5460;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-menu {
            display: none;
        }

        .payment-grid {
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
        <h1 class="page-title">Pembayaran Sewa Kos</h1>

        <div class="alert alert-warning">
            <strong>Peringatan:</strong> Pembayaran sewa bulan ini jatuh tempo pada <strong>25 Januari 2025</strong>. Segera lakukan pembayaran ya!
        </div>

        <div class="payment-grid">
            <!-- Payment Form -->
            <div class="card">
                <h2 class="card-title">Detail Pembayaran</h2>

                <form action="<?= base_url('user/proses-pembayaran') ?>" method="post" enctype="multipart/form-data" id="formPembayaran">
                    <div class="form-group">
                        <label class="form-label">Kamar</label>
                        <input type="text" class="form-input" value="<?= esc($kamar['no_kamar'] ?? '-') ?>" readonly>
                        <input type="hidden" name="id_kamar" value="<?= esc($kamar['id_kamar'] ?? '') ?>">
                    </div>

                    <select class="form-select" name="periode">
                        <?php foreach ($periode as $p): ?>
                            <option value="<?= $p ?>"><?= $p ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>

                        <div class="payment-method-wrapper">
                            <label class="payment-method selected">
                                <input type="radio" name="metode" value="transfer" checked hidden>
                                <div class="payment-icon" style="background: #e8f5e8; color: #27ae60;">🏦</div>
                                <div class="payment-info">
                                    <div class="payment-name">Transfer Bank</div>
                                    <div class="payment-desc">Transfer ke rekening kos</div>
                                </div>
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="metode" value="ewallet" hidden>
                                <div class="payment-icon" style="background: #e8f4fd; color: #3498db;">📱</div>
                                <div class="payment-info">
                                    <div class="payment-name">E-Wallet</div>
                                    <div class="payment-desc">Bayar dengan OVO, GoPay, DANA</div>
                                </div>
                            </label>

                            <label class="payment-method">
                                <input type="radio" name="metode" value="cash" hidden>
                                <div class="payment-icon" style="background: #fff3cd; color: #f39c12;">💵</div>
                                <div class="payment-info">
                                    <div class="payment-name">Tunai</div>
                                    <div class="payment-desc">Bayar langsung ke pengelola</div>
                                </div>
                            </label>
                            <input type="hidden" name="total" value="<?= $total ?>">
                            <input type="file" name="bukti" id="inputBuktiHidden" style="display: none;" />
                        </div>
                    </div>

                </form>
            </div>

            <!-- Payment Summary -->
            <div class="card">
                <h2 class="card-title">Ringkasan Pembayaran</h2>

                <div class="summary-item">
                    <span class="summary-label">Sewa Bulanan</span>
                    <span class="summary-value">
                        <p>Rp <?= (!empty($kamar['harga'])) ? number_format($kamar['harga'], 0, ',', '.') : '0' ?></p>
                    </span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Biaya Admin</span>
                    <span class="summary-value">
                        <p>Rp <?= (!empty($biaya_admin)) ? number_format($biaya_admin, 0, ',', '.') : '0' ?></p>
                    </span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Total Pembayaran</span>
                    <span class="summary-value">
                        <p name="total" id="totalBayar">Rp <?= (!empty($total)) ? number_format($total, 0, ',', '.') : '0' ?></p>
                    </span>
                </div>

                <div class="alert alert-info" style="margin-top: 1rem;">
                    <strong>Info:</strong> Pembayaran akan diproses dalam 1x24 jam setelah konfirmasi.
                </div>

                <button type="button" id="payBtn" class="btn btn-success">Bayar Sekarang</button>
                <a href="<?= base_url('user/dashboard') ?>" class="btn btn-outline" style="margin-top: 1rem;">Kembali</a>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('payBtn').addEventListener('click', function() {
        const kamar = document.querySelector('input[name="id_kamar"]').value;
        const periode = document.querySelector('select[name="periode"]').value;
        const metode = document.querySelector('input[name="metode"]:checked').value;

        const harga = <?= (int) ($kamar['harga'] ?? 0) ?>;
        const admin = <?= (int) ($biaya_admin ?? 0) ?>;
        const total = harga + admin;

        Swal.fire({
            title: 'Konfirmasi Pembayaran',
            html: `
                <p><strong>Kamar:</strong> <?= esc($kamar['no_kamar'] ?? '-') ?></p>
                <p><strong>Periode:</strong> ${periode}</p>
                <p><strong>Metode:</strong> ${metode}</p>
                <p><strong>Total:</strong> Rp ${total.toLocaleString('id-ID')}</p>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Konfirmasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                let metodeText = '';
                if (metode === 'transfer') {
                    metodeText = `<p>Silakan transfer ke rekening BCA <strong>123456789</strong> a.n. Kos Amrita</p>`;
                } else if (metode === 'ewallet') {
                    metodeText = `<p>Silakan kirim ke salah satu e-wallet berikut:
                        <br><br>DANA: 08881669524 
                        <br>GoPay: 08881669524
                        <br>OVO: 08881669524</p>`;
                } else {
                    // Cash - langsung submit
                    Swal.fire({
                        title: 'Pembayaran Tunai',
                        html: `<p>Silakan bayar langsung ke pengelola sebelum tanggal jatuh tempo.</p>`,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        document.getElementById('formPembayaran').submit();
                    });
                    return; // hentikan proses di sini
                }

                // Transfer atau E-Wallet
                Swal.fire({
                    title: 'Upload Bukti Pembayaran',
                    html: `
                        ${metodeText}
                        <br><br>
                        <input type="file" name="bukti" id="bukti" class="swal2-file" accept="image/*" style="width: 100%;">
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Kirim Bukti',
                    cancelButtonText: 'Batal',
                    preConfirm: () => {
                        const file = document.getElementById('bukti').files[0];
                        if (!file) {
                            Swal.showValidationMessage('Mohon unggah bukti pembayaran terlebih dahulu');
                            return false;
                        }
                        return file;
                    }
                }).then((uploadResult) => {
                    if (uploadResult.isConfirmed) {
                        const file = document.getElementById('bukti').files[0];
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        document.getElementById('inputBuktiHidden').files = dataTransfer.files;

                        Swal.fire({
                            title: 'Pembayaran Diproses',
                            text: 'Terima kasih, bukti pembayaran Anda berhasil dikirim!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            document.getElementById('formPembayaran').submit();
                        });
                    }
                });
            }
        });
    });

    // Efek visual pilihan metode pembayaran
    document.querySelectorAll('.payment-method input[type="radio"]').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('.payment-method').forEach(pm => pm.classList.remove('selected'));
            this.closest('.payment-method').classList.add('selected');
        });
    });
</script>



<?= $this->endSection() ?>