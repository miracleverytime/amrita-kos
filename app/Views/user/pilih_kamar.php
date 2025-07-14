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

    .btn-primary {
        background: #3498db;
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
    }

    .btn-outline {
        background: transparent;
        border: 2px solid #3498db;
        color: #3498db;
    }

    .btn-outline:hover {
        background: #3498db;
        color: white;
    }

    /* Room Selection */
    .room-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
    }

    .room-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .room-card:hover {
        transform: translateY(-2px);
    }

    .room-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6c757d;
        font-size: 3rem;
    }

    .room-info {
        padding: 1.5rem;
    }

    .room-number {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .room-price {
        font-size: 1.5rem;
        color: #27ae60;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .room-features {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .feature-tag {
        background: #e9ecef;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .room-status {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .status-available {
        background: #d4edda;
        color: #155724;
    }

    .status-occupied {
        background: #f8d7da;
        color: #721c24;
    }

    .filter-section {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        margin-bottom: 2rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .filter-label {
        font-weight: 500;
        color: #2c3e50;
    }

    .filter-input {
        padding: 0.5rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    .filter-input:focus {
        outline: none;
        border-color: #3498db;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .nav-menu {
            display: none;
        }

        .room-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
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
        <h1 class="page-title">Pilih Kamar</h1>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Harga Minimum</label>
                    <input type="number" class="filter-input" placeholder="Rp 0">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Harga Maksimum</label>
                    <input type="number" class="filter-input" placeholder="Rp 2.000.000">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Fasilitas</label>
                    <select class="filter-input">
                        <option value="">Semua Fasilitas</option>
                        <option value="ac">AC</option>
                        <option value="kamar-mandi-dalam">Kamar Mandi Dalam</option>
                        <option value="wifi">WiFi</option>
                        <option value="balkon">Balkon</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-input">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Room Selection -->
        <div class="room-grid">
            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar A101</div>
                    <div class="room-price">Rp 1.200.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">AC</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Dalam</span>
                        <span class="feature-tag">Lemari</span>
                    </div>
                    <div class="room-status status-available">Tersedia</div>
                    <a href="#" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>

            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar A102</div>
                    <div class="room-price">Rp 1.000.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">Kipas Angin</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Luar</span>
                        <span class="feature-tag">Lemari</span>
                    </div>
                    <div class="room-status status-available">Tersedia</div>
                    <a href="#" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>

            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar A103</div>
                    <div class="room-price">Rp 1.100.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">AC</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Luar</span>
                        <span class="feature-tag">Lemari</span>
                    </div>
                    <div class="room-status status-available">Tersedia</div>
                    <a href="#" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>

            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar B201</div>
                    <div class="room-price">Rp 1.500.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">AC</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Dalam</span>
                        <span class="feature-tag">Balkon</span>
                    </div>
                    <div class="room-status status-occupied">Terisi</div>
                    <button class="btn btn-outline" disabled>Tidak Tersedia</button>
                </div>
            </div>

            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar B202</div>
                    <div class="room-price">Rp 1.400.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">AC</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Dalam</span>
                        <span class="feature-tag">Lemari</span>
                    </div>
                    <div class="room-status status-available">Tersedia</div>
                    <a href="#" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>

            <div class="room-card">
                <div class="room-image">🏠</div>
                <div class="room-info">
                    <div class="room-number">Kamar C301</div>
                    <div class="room-price">Rp 900.000/bulan</div>
                    <div class="room-features">
                        <span class="feature-tag">Kipas Angin</span>
                        <span class="feature-tag">WiFi</span>
                        <span class="feature-tag">Kamar Mandi Luar</span>
                        <span class="feature-tag">Lemari</span>
                    </div>
                    <div class="room-status status-available">Tersedia</div>
                    <a href="#" class="btn btn-primary">Pilih Kamar</a>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>