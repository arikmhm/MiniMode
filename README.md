# MiniMode - Kids Fashion Store Management System

## Overview

MiniMode adalah sistem manajemen untuk toko fashion anak yang memungkinkan pengelolaan data produk secara efisien. Aplikasi ini dibuat menggunakan PHP, MySQL, dan Bootstrap dengan fitur dasar untuk manajemen data produk fashion anak.

## Fitur Utama

- Dashboard dengan visualisasi data
- Manajemen data produk (CRUD)
- Authentication system
- Statistik produk
- Monitoring stok
- Responsive design

## Teknologi yang Digunakan

- PHP 7.4+
- MySQL 5.7+
- Bootstrap 4
- Chart.js untuk visualisasi data
- FontAwesome 5 untuk icons
- jQuery 3.3.1

## Cara Install

1. **Download File Zip**

   - Unduh file zip dari repositori atau sumber yang telah disediakan.

2. **Ekstrak File**

   - Ekstrak file zip yang telah diunduh ke lokasi yang diinginkan.

3. **Simpan ke Folder htdocs XAMPP**

   - Pindahkan folder hasil ekstraksi ke dalam direktori `htdocs` pada XAMPP.

4. **Buat Database**

   - Buka phpMyAdmin melalui XAMPP.
   - Buat database baru dengan nama `minimode`.

5. **Import File SQL**

   - Masuk ke database yang telah dibuat.
   - Pilih menu "Import" dan unggah file `minimode.sql`.

6. **Start XAMPP**

   - Jalankan Apache dan MySQL di panel kontrol XAMPP.

7. **Jalankan di Browser**
   - Buka browser dan akses URL: `http://localhost/minimode`

## Struktur Database

1. **Tabel users**

   - id (Primary Key)
   - username
   - password
   - created_at

2. **Tabel produk**
   - id (Primary Key)
   - kode_produk (Unique)
   - nama_produk
   - kategori (Enum)
   - ukuran (Enum)
   - stok
   - harga
   - keterangan
   - created_at
   - updated_at

## Struktur Folder

```
minimode/
├── bootstrap4/          # File-file Bootstrap
├── css/                # File CSS custom
├── database/           # File SQL
├── fungsi.php          # File koneksi database
├── index.php           # Halaman login
├── dashboard.php       # Halaman dashboard
├── produk.php          # Halaman manajemen produk
├── tambah_produk.php   # Form tambah produk
├── edit_produk.php     # Form edit produk
├── hapus_produk.php    # Proses hapus produk
└── README.md
```

## Login Default

- Username: admin
- Password: admin123

## Panduan Penggunaan

1. **Login**

   - Gunakan akun default untuk masuk ke sistem

2. **Dashboard**

   - Menampilkan statistik produk
   - Visualisasi data dalam bentuk chart
   - Monitoring stok menipis
   - Daftar produk terbaru

3. **Manajemen Produk**
   - Lihat daftar semua produk
   - Tambah produk baru
   - Edit data produk
   - Hapus produk
   - Filter dan pencarian produk

## Fitur Detail

1. **Dashboard**

   - Total produk
   - Total kategori
   - Total stok
   - Produk dengan stok menipis
   - Grafik distribusi produk per kategori
   - Grafik stok per kategori

2. **Manajemen Produk**
   - Kode produk otomatis
   - Validasi input
   - Preview data
   - Pagination
   - Search realtime
   - Alert system

## Catatan Penting

- Pastikan XAMPP versi terbaru sudah terinstal
- PHP minimum versi 7.4
- MySQL minimum versi 5.7
- Browser modern yang mendukung JavaScript ES6
- Pastikan folder memiliki permission yang tepat
- Sesuaikan konfigurasi database di file `fungsi.php` jika diperlukan

## Pengembangan Ke Depan

- Fitur manajemen gambar produk
- Fitur laporan penjualan
- Fitur stok masuk/keluar
- Fitur manajemen kategori
- Fitur ekspor data

## Kontribusi

## Lisensi

MIT License

## Support

Jika mengalami masalah atau butuh bantuan, silakan hubungi:

- Email: support@minimode.com
- WhatsApp: 081234567890

## Versi

1.0.0 (Januari 2024)
