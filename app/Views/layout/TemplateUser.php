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
                    <a href="#" class="nav-link active">Dashboard</a>
                    <a href="pilih-kamar.html" class="nav-link">Pilih Kamar</a>
                    <a href="pembayaran.html" class="nav-link">Pembayaran</a>
                    <a href="pindah-kamar.html" class="nav-link">Pindah Kamar</a>
                    <a href="keluhan.html" class="nav-link">Keluhan</a>
                    <a href="profil.html" class="nav-link">Profil</a>
                </nav>
                <div class="user-info">
                    <div class="user-avatar">U</div>
                    <span><?= esc($nama) ?></span>
                    <a href="<?= base_url('/') ?>" id="logoutBtn"> <button class="logout-btn"> Logout</button></a>
                </div>
            </div>
        </div>
    </header>

    <?= $this->renderSection('content') ?>

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