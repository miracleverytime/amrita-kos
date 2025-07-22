<?= $this->extend('layout/TemplateAuth.php') ?>

<?= $this->section('content') ?>
<style>
    body {
        padding-top: 18px;
    }
</style>
<!-- Register Form -->
<div id="registerForm" class="form-container">
    <div class="form-header">
        <h2>Buat Akun</h2>
        <p>Buat akun baru!</p>
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

    <form action="<?= base_url('/proses-register') ?>" method="post" id="form-auth">
        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-user input-icon"></i>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-envelope input-icon"></i>
                <input type="tel" oninput="this.value = this.value.replace(/[^0-9]/g, '')" id="no_hp" name="no_hp" class="form-control" placeholder="No. hp">
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" class="form-control" id="tpassword" placeholder="Konfirmasi Password">
                <i class="fas fa-eye password-toggle" onclick="togglePassword('tpassword')"></i>
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