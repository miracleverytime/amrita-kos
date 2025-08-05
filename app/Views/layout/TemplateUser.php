<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('/assets/css/user.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title> <?= esc($title) ?> </title>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Amrita Kos</div>
                <nav class="nav-menu">
                    <a href="<?= base_url('user/dashboard') ?>" class="nav-link <?= ($currentPage === 'dashboard') ? 'active' : '' ?>">Dashboard</a>
                    <a href="<?= base_url('user/pilih-kamar') ?>" class="nav-link <?= ($currentPage === 'pilihkamar') ? 'active' : '' ?>">Pilih Kamar</a>
                    <?php if (!empty($kamar)) : ?>
                        <a href="<?= base_url('user/pembayaran') ?>" class="nav-link <?= ($currentPage === 'pembayaran') ? 'active' : '' ?>">Pembayaran</a>
                    <?php endif; ?>
                    <a href="<?= base_url('user/pindah-kamar') ?>" class="nav-link <?= ($currentPage === 'pindah-kamar') ? 'active' : '' ?>">Pindah Kamar</a>
                    <a href="<?= base_url('user/history') ?>" class="nav-link <?= ($currentPage === 'history') ? 'active' : '' ?>">Riwayat</a>
                    <a href="<?= base_url('user/profile') ?>" class="nav-link <?= ($currentPage === 'profile') ? 'active' : '' ?>">Profil</a>
                </nav>
                <div class="user-info">
                    <a href="<?= base_url('user/profile') ?>" class="u-avatar">
                        <div class="user-avatar">B</div>
                    </a>
                    <span><?= esc($user['nama']) ?></span>
                    <a href="<?= base_url('/') ?>" id="logoutBtn"> <button class="logout-btn"> Logout</button></a>
                </div>
            </div>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('/assets/js/user.js') ?>"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('logoutBtn');

            if (logoutBtn) {
                logoutBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Cegah logout langsung

                    Swal.fire({
                        title: 'Yakin ingin logout?',
                        text: 'Kamu akan keluar dari sesi sekarang.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = logoutBtn.href; // Arahkan ke URL logout
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>