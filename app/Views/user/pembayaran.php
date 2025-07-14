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
            <strong>Peringatan:</strong> Pembayaran sewa bulan ini jatuh tempo pada <strong>25 Januari 2025</strong>. Segera lakukan pembayaran untuk menghindari denda keterlambatan.
        </div>

        <div class="payment-grid">
            <!-- Payment Form -->
            <div class="card">
                <h2 class="card-title">Detail Pembayaran</h2>

                <form>
                    <div class="form-group">
                        <label class="form-label">Kamar</label>
                        <input type="text" class="form-input" value="A101" readonly>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Periode Pembayaran</label>
                        <select class="form-select">
                            <option value="januari-2025">Januari 2025</option>
                            <option value="februari-2025">Februari 2025</option>
                            <option value="maret-2025">Maret 2025</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Metode Pembayaran</label>

                        <div class="payment-method selected">
                            <input type="radio" name="payment" value="transfer" checked>
                            <div class="payment-icon" style="background: #e8f5e8; color: #27ae60;">🏦</div>
                            <div class="payment-info">
                                <div class="payment-name">Transfer Bank</div>
                                <div class="payment-desc">Transfer ke rekening kos</div>
                            </div>
                        </div>

                        <div class="payment-method">
                            <input type="radio" name="payment" value="ewallet">
                            <div class="payment-icon" style="background: #e8f4fd; color: #3498db;">📱</div>
                            <div class="payment-info">
                                <div class="payment-name">E-Wallet</div>
                                <div class="payment-desc">Bayar dengan OVO, GoPay, DANA</div>
                            </div>
                        </div>

                        <div class="payment-method">
                            <input type="radio" name="payment" value="cash">
                            <div class="payment-icon" style="background: #fff3cd; color: #f39c12;">💵</div>
                            <div class="payment-info">
                                <div class="payment-name">Tunai</div>
                                <div class="payment-desc">Bayar langsung ke pengelola</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea class="form-input" rows="3" placeholder="Tambahkan catatan pembayaran..."></textarea>
                    </div>
                </form>
            </div>

            <!-- Payment Summary -->
            <div class="card">
                <h2 class="card-title">Ringkasan Pembayaran</h2>

                <div class="summary-item">
                    <span class="summary-label">Sewa Bulanan</span>
                    <span class="summary-value">Rp 1.200.000</span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Biaya Admin</span>
                    <span class="summary-value">Rp 5.000</span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Diskon</span>
                    <span class="summary-value">- Rp 0</span>
                </div>

                <div class="summary-item">
                    <span class="summary-label">Total Pembayaran</span>
                    <span class="summary-value">Rp 1.205.000</span>
                </div>

                <div class="alert alert-info" style="margin-top: 1rem;">
                    <strong>Info:</strong> Pembayaran akan diproses dalam 1x24 jam setelah konfirmasi.
                </div>

                <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                <a href="dashboard.html" class="btn btn-outline" style="margin-top: 1rem;">Kembali</a>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>