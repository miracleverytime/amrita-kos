# 🌿 Kos Amrita – Aplikasi Pengelolaan Keuangan Kos Berbasis Web

**Kos Amrita** adalah aplikasi berbasis web yang dikembangkan menggunakan **CodeIgniter 4** untuk membantu pengelolaan keuangan kos secara digital. Aplikasi ini dirancang untuk mencatat penyewaan kamar, mengelola pembayaran, serta menyusun laporan pemasukan dan pengeluaran dengan lebih efisien dan transparan.

## 📌 Latar Belakang

Selama ini, Kos Amrita masih menggunakan metode pencatatan manual dalam mengelola keuangan dan penyewaan kamar. Hal ini rawan menyebabkan:

- Kesalahan pencatatan transaksi
- Kehilangan data
- Kesulitan pemilik kos dalam memantau kondisi keuangan secara real-time
- Kurangnya kejelasan dalam penyusunan laporan keuangan

Oleh karena itu, aplikasi ini dibangun untuk mendigitalisasi proses pengelolaan keuangan kos dan memberikan kontrol yang lebih baik kepada pemilik.

## 🎯 Tujuan

- Menyediakan sistem yang **otomatis dan akurat** dalam mencatat transaksi keuangan kos
- Mempermudah pencatatan **pemasukan, pengeluaran, dan penyewaan kamar**
- Menyajikan **laporan keuangan** yang transparan dan mudah diakses
- Meminimalisir risiko kehilangan data

## ⚙️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 4
- **Bahasa Pemrograman**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS (custom theme), JavaScript
- **Arsitektur**: MVC (Model-View-Controller)

## 🧩 Fitur Utama

- [x] Manajemen data penyewa
- [x] Pencatatan penyewaan kamar
- [x] Pemasukan & pengeluaran bulanan
- [ ] Laporan keuangan per bulan/periode
- [ ] Dashboard ringkasan keuangan
- [ ] Export laporan (PDF/Excel)
- [ ] Notifikasi jatuh tempo pembayaran

## 🏗️ Struktur Proyek

\`\`\`
app/
├── Controllers/
├── Models/
├── Views/
├── Config/
public/
├── assets/ (CSS, JS, images)
writable/
.env
\`\`\`

## 🚀 Cara Menjalankan Aplikasi

1. Clone repository:

\`\`\`bash
git clone https://github.com/username/kos-amrita.git
cd kos-amrita
\`\`\`

2. Jalankan server lokal:

\`\`\`bash
php spark serve
\`\`\`

3. Akses aplikasi di browser:

\`\`\`
http://localhost:8080
\`\`\`

4. Pastikan sudah mengatur file \`.env\` dan koneksi database MySQL.
