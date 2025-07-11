<?= $this->extend('layout/TemplateAuth.php') ?>

<?= $this->section('content') ?>
<!-- Register Form -->
<div id="registerForm" class="form-container">
    <div class="form-header">
        <h2>Buat Akun</h2>
        <p>Buat akun baru!</p>
    </div>

    <form action="<?= base_url('/proses-register') ?>" method="post">
        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text" class="form-control" placeholder="Nama Lengkap" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" class="form-control" placeholder="Email" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="registerPassword" placeholder="Password" required>
                <i class="fas fa-eye password-toggle" onclick="togglePassword('registerPassword')"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi Password" required>
                <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-user-plus me-2"></i>Daftar
        </button>
    </form>

    <div class="toggle-form">
        <p>Sudah punya akun? <a href="<?= base_url('/') ?>">Masuk sekarang</a></p>
    </div>
</div>
<?= $this->endSection() ?>