<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Dashboard</h1>
                <p>Welcome back, Admin! Here's what's happening today.</p>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search anything...">
                </div>
                <div class="user-profile">
                    <div class="user-avatar">JD</div>
                    <div class="user-info">
                        <h6>John Doe</h6>
                        <p>Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">
        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <h1>Ini Laporan Keuangan</h1>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>