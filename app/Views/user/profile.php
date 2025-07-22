<?= $this->extend('layout/TemplateUser') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <h1 class="page-title">Profil Saya</h1>

        <!-- Profile Header -->
        <div class="status-grid" style="grid-template-columns: 1fr;">
            <div class="status-card" style="text-align: center; padding: 2rem;">
                <div class="profile-avatar" style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 2rem; color: white;">
                    👤
                </div>
                <div class="status-value" style="font-size: 1.5rem; margin-bottom: 0.5rem;">
                    <?= esc($user['nama']) ?>
                </div>
                <div class="status-label">Penghuni Kos</div>
            </div>
        </div>

        <!-- Profile Form -->
        <div class="dashboard-grid" style="grid-template-columns: 1fr;">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #e3f2fd; color: #2196f3;">✏️</div>
                    <div>
                        <div class="card-title">Informasi Pribadi</div>
                        <div class="card-subtitle">Kelola data pribadi Anda</div>
                    </div>
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

                <form action="<?= base_url('/user/profile-update') ?>" method="post" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Nama Lengkap</label>
                            <input type="text" value="<?= esc($user['nama']) ?>" name="nama" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Email</label>
                            <input type="email" value="<?= esc($user['email']) ?>" name="email" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Nomor Telepon</label>
                            <input type="tel" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="<?= esc($user['no_hp']) ?>" name="no_hp" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Asal Daerah</label>
                            <input type="text" value="" placeholder="Asal daerah..." name="asal_daerah" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                        <button type="submit" class="btn btn-primary" style="flex: 1;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="dashboard-grid" style="grid-template-columns: 1fr;">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #fce4ec; color: #e91e63;">🔒</div>
                    <div>
                        <div class="card-title">Ubah Kata Sandi</div>
                        <div class="card-subtitle">Perbarui keamanan akun Anda</div>
                    </div>
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

                <form action="<?= base_url('/user/password-update') ?>" method="post" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Kata Sandi Lama</label>
                        <input type="password" name="old_password" placeholder="Masukkan kata sandi lama" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Kata Sandi Baru</label>
                            <input type="password" name="new_password" placeholder="Masukkan kata sandi baru" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: #2c3e50;">Konfirmasi Kata Sandi</label>
                            <input type="password" name="confirm_password" placeholder="Konfirmasi kata sandi baru" style="width: 100%; padding: 0.75rem; border: 2px solid #e9ecef; border-radius: 8px; font-size: 1rem; transition: border-color 0.3s;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning" style="width: fit-content;">Ubah Kata Sandi</button>
                </form>
            </div>
        </div>
    </div>
</main>

<style>
    input:focus,
    textarea:focus {
        outline: none;
        border-color: #3498db !important;
    }

    .profile-avatar {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }

        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>