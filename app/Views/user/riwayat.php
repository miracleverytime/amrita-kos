<?= $this->extend('layout/TemplateUser') ?>

<?= $this->section('content') ?>
<main>
    <div class="container">
        <h1 class="page-title">Riwayat Pembayaran</h1>

        <!-- Summary Cards -->
        <div class="status-grid">
            <div class="status-card">
                <div class="status-value" style="color: #27ae60;">Rp 14.400.000</div>
                <div class="status-label">Total Pembayaran</div>
            </div>
            <div class="status-card">
                <div class="status-value">12</div>
                <div class="status-label">Pembayaran Sukses</div>
            </div>
            <div class="status-card">
                <div class="status-value">0</div>
                <div class="status-label">Pembayaran Gagal</div>
            </div>
            <div class="status-card">
                <div class="status-value">Jan 2024</div>
                <div class="status-label">Mulai Menghuni</div>
            </div>
        </div>

        <!-- Payment History -->
        <div class="dashboard-grid" style="grid-template-columns: 1fr;">
            <div class="card">
                <div class="card-header">
                    <div class="card-icon" style="background: #e8f5e8; color: #27ae60;">💳</div>
                    <div>
                        <div class="card-title">Riwayat Transaksi</div>
                        <div class="card-subtitle">Daftar semua pembayaran sewa kos</div>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
                        <thead>
                            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Tanggal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Periode</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Kamar</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Jumlah</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Status</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #2c3e50;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">25 Jan 2025</td>
                                <td style="padding: 1rem; color: #495057;">Januari 2025</td>
                                <td style="padding: 1rem; color: #495057;">A101</td>
                                <td style="padding: 1rem; color: #495057; font-weight: 600;">Rp 1.200.000</td>
                                <td style="padding: 1rem;">
                                    <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                        ✓ Berhasil
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <button style="background: #e3f2fd; color: #1976d2; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">25 Des 2024</td>
                                <td style="padding: 1rem; color: #495057;">Desember 2024</td>
                                <td style="padding: 1rem; color: #495057;">A101</td>
                                <td style="padding: 1rem; color: #495057; font-weight: 600;">Rp 1.200.000</td>
                                <td style="padding: 1rem;">
                                    <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                        ✓ Berhasil
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <button style="background: #e3f2fd; color: #1976d2; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">25 Nov 2024</td>
                                <td style="padding: 1rem; color: #495057;">November 2024</td>
                                <td style="padding: 1rem; color: #495057;">A101</td>
                                <td style="padding: 1rem; color: #495057; font-weight: 600;">Rp 1.200.000</td>
                                <td style="padding: 1rem;">
                                    <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                        ✓ Berhasil
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <button style="background: #e3f2fd; color: #1976d2; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">25 Okt 2024</td>
                                <td style="padding: 1rem; color: #495057;">Oktober 2024</td>
                                <td style="padding: 1rem; color: #495057;">A101</td>
                                <td style="padding: 1rem; color: #495057; font-weight: 600;">Rp 1.200.000</td>
                                <td style="padding: 1rem;">
                                    <span style="background: #fff3cd; color: #856404; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                        ⏳ Pending
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <button style="background: #e3f2fd; color: #1976d2; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid #e9ecef;">
                                <td style="padding: 1rem; color: #495057;">25 Sep 2024</td>
                                <td style="padding: 1rem; color: #495057;">September 2024</td>
                                <td style="padding: 1rem; color: #495057;">A101</td>
                                <td style="padding: 1rem; color: #495057; font-weight: 600;">Rp 1.200.000</td>
                                <td style="padding: 1rem;">
                                    <span style="background: #d4edda; color: #155724; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">
                                        ✓ Berhasil
                                    </span>
                                </td>
                                <td style="padding: 1rem;">
                                    <button style="background: #e3f2fd; color: #1976d2; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem;">
                                        Lihat Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div style="display: flex; justify-content: between; align-items: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e9ecef;">
                    <div style="color: #6c757d; font-size: 0.875rem;">
                        Menampilkan 1-5 dari 12 transaksi
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <button style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">
                            ← Sebelumnya
                        </button>
                        <button style="background: #3498db; color: white; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">
                            1
                        </button>
                        <button style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">
                            2
                        </button>
                        <button style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">
                            3
                        </button>
                        <button style="background: #f8f9fa; border: 1px solid #dee2e6; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer;">
                            Selanjutnya →
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    input:focus,
    select:focus {
        outline: none;
        border-color: #3498db !important;
    }

    table tr:hover {
        background: #f8f9fa;
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }

        div[style*="grid-template-columns: 1fr 1fr 1fr auto"] {
            grid-template-columns: 1fr !important;
        }

        table {
            font-size: 0.875rem;
        }

        th,
        td {
            padding: 0.75rem !important;
        }

        .status-grid {
            grid-template-columns: 1fr 1fr !important;
        }
    }
</style>
<?= $this->endSection() ?>