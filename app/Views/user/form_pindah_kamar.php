            <div class="move-grid">
                <!-- Move Request Form -->
                <div class="card">
                    <h2 class="card-title">Form Pindah Kamar</h2>

                    <div class="current-room">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">Kamar Saat Ini</h3>
                        <div class="room-info">
                            <div class="room-number">Kamar <?= $kamar['no_kamar'] ?></div>
                            <div class="room-price">Rp <?= number_format($kamar['harga'], 0, ',', '.') ?>/bulan</div>
                        </div>
                        <div class="room-features">
                            <?php foreach (explode(',', $kamar['fasilitas']) as $fasilitas) : ?>
                                <span class="feature-tag"><?= trim($fasilitas) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <form action="<?= base_url('user/proses-pindah-kamar') ?>" method="post">
                        <div class="form-group">
                            <label class="form-label">Kamar Tujuan</label>
                            <select name="id_kamar_baru" class="form-select" required>
                                <option value="">Pilih kamar tujuan</option>
                                <?php foreach ($kamarTujuan as $k) : ?>
                                    <option value="<?= $k['id_kamar'] ?>">
                                        Kamar <?= $k['no_kamar'] ?> - Rp <?= number_format($k['harga'], 0, ',', '.') ?>/bulan
                                        (<?= implode(', ', array_map('trim', explode(',', $k['fasilitas']))) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Alasan Pindah</label>
                            <select class="form-input" id="alasan-select" name="alasan">
                                <option value="" disabled selected>Pilih alasan</option>
                                <option value="Kamar kurang nyaman">Kamar kurang nyaman</option>
                                <option value="Ingin dekat dengan teman">Ingin dekat dengan teman</option>
                                <option value="Masalah fasilitas">Masalah fasilitas</option>
                                <option value="other">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-group" id="detail-group" style="display: none;">
                            <label class="form-label">Keterangan Detail</label>
                            <textarea class="form-input form-textarea" name="keterangan" placeholder="Jelaskan secara detail alasan Anda ingin pindah kamar..."></textarea>
                        </div>

                        <div class="alert alert-warning">
                            <strong>Perhatian:</strong> Setelah pengajuan disetujui, Anda akan dikenakan biaya administrasi pindah kamar sebesar Rp 50.000.
                        </div>

                        <button type="submit" class="btn btn-warning">Ajukan Pindah Kamar</button>
                    </form>
                </div>

                <!-- Move Request Info -->
                <div class="card">
                    <h2 class="card-title">Informasi Pindah Kamar</h2>

                    <div class="info-item">
                        <span class="info-label">Biaya Admin</span>
                        <span class="info-value">Rp 50.000</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Waktu Proses</span>
                        <span class="info-value">2-3 hari kerja</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Status Pembayaran</span>
                        <span class="info-value">Lunas</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Masa Kontrak</span>
                        <span class="info-value"><?= $kamar['kontrak'] ?? '(Belum ada)' ?></span>
                    </div>

                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; color: #2c3e50;">Syarat & Ketentuan</h3>
                        <ul style="color: #6c757d; line-height: 1.6; padding-left: 1.5rem;">
                            <li>Pembayaran sewa bulan berjalan harus lunas</li>
                            <li>Tidak ada tunggakan pembayaran</li>
                            <li>Kamar tujuan harus tersedia</li>
                            <li>Pindah kamar hanya bisa dilakukan maksimal 2 kali dalam 1 tahun</li>
                            <li>Kerusakan di kamar lama akan dipotong dari deposit</li>
                        </ul>
                    </div>

                    <a href="<?= base_url('dashboard') ?>" class="btn btn-outline" style="margin-top: 2rem;">Kembali ke Dashboard</a>
                </div>
            </div>