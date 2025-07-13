<?= $this->extend('layout/TemplateAuth.php') ?>

<?= $this->section('content') ?>
<!-- Login Form -->
<div id="loginForm" class="form-container">
    <div class="form-header">
        <h2>Selamat Datang</h2>
        <p>Masuk ke akun Anda</p>
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
    </div>

    <form action="<?= base_url('/proses-login') ?>" method="post" id="form-auth">
        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-sign-in-alt me-2"></i>Masuk
        </button>
    </form>

    <div class="toggle-form">
        <p>Belum punya akun? <a href="<?= base_url('/register') ?>">Daftar sekarang</a></p>
    </div>
</div>
<?= $this->endSection() ?>