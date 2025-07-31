<?= $this->extend('layout/TemplateAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">
    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Pengaturan Akun</h1>
                <p>Kelola profil dan pengaturan akun administrator</p>
            </div>
            <div class="header-actions">
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
        <div class="row">
            <!-- Settings Section -->
            <div class="col-md-6">
                <!-- Personal Information -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Informasi Akun</h4>
                    </div>
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="error-message">
                            <?= session()->getFlashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="success-message">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <form action="<?= base_url('admin/profile-update'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" value="<?= esc($admin['nama']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-4">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?= esc($admin['email']) ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Personal Information -->
                <div class="content-card">
                    <div class="card-header">
                        <h4>Ganti Password</h4>
                    </div>
                    <?php if (session()->getFlashdata('errorp')): ?>
                        <div class="error-message">
                            <?= session()->getFlashdata('errorp'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('successp')): ?>
                        <div class="success-message">
                            <?= session()->getFlashdata('successp'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <form action="<?= base_url('admin/password-update'); ?>" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Password Sebelumnya</label>
                                        <input type="password" name="old_password" placeholder="Masukkan password lama" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Password Baru</label>
                                    <input type="password" name="new_password" placeholder="Masukkan password baru" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="confirm_password" placeholder="Konfirmasi password baru" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <button type="submit" class="btn btn-warning" style="flex: 1;">Ubah password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

    .card-body {
        padding: 1.5rem;
    }

    .form-check-input:checked {
        background-color: #667eea;
        border-color: #667eea;
    }

    .form-check-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
    }

    @media (max-width: 768px) {
        .header-content {
            flex-direction: column;
            gap: 1rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .security-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
    }
</style>
<?= $this->endSection() ?>