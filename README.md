# Sistem Pakar Kosmetik (Forward-Chaining)

## Deskripsi
Sistem Pakar Pemilihan Produk Kosmetik berbasis web menggunakan metode forward-chaining. Aplikasi ini dibuat dengan PHP (native), MySQL (mysqli), dan Bootstrap 4 untuk antarmuka admin/pakar.

Fitur utama:

- Manajemen produk (CRUD)
- Manajemen fakta (pertanyaan) dan aturan (rules)
- Simulasi/forward chaining untuk merekomendasikan produk
- Halaman admin terpisah dengan autentikasi sederhana

## Catatan singkat tentang struktur

- Aset statis (CSS & gambar) berada di `assets/css/` dan `assets/image/`.
- Koneksi database tersentral di `config/koneksi.php`.
- Proses admin di `admin/` dan handler aksi di `admin/actions.php`.
- Autentikasi ada di `auth/` (root) — halaman login: `auth/login.php`.

## Spesifikasi yang direkomendasikan

- PHP: 7.4 atau 8.0+
- MySQL / MariaDB: MySQL 5.7+ / MariaDB 10+
- Webserver: Apache (XAMPP) atau Laragon (Windows)
- Ekstensi PHP: `mysqli`, `session`, `mbstring`

## Persiapan lingkungan (XAMPP / Laragon)

1. Install XAMPP (atau Laragon). Jika menggunakan XAMPP, gunakan versi yang menyertakan PHP 7.4/8.0.
2. Nyalakan Apache & MySQL melalui kontrol panel XAMPP (atau start services di Laragon).

## Install & konfigurasi dari GitHub (atau ZIP)

1. Clone repository ke folder web server Anda (htdocs atau Laragon `www`):

```powershell
cd C:\laragon\www\
git clone https://github.com/<your-user>/<repo>.git
# atau untuk XAMPP
cd C:\xampp\htdocs\
git clone https://github.com/<your-user>/<repo>.git
```

2. Jika Anda menerima ZIP, ekstrak ke `C:\xampp\htdocs\your-folder` atau `C:\laragon\www\your-folder`.

## Database

1. Buat database kosong (nama default yang dipakai proyek adalah `sispak_kosmetik_fc`). Anda bisa memilih nama lain, tapi ingat untuk mengubah `config/koneksi.php`.

2. Import struktur & data sample dari file SQL yang ada (`sispak.sql`). Cara singkat lewat phpMyAdmin:

- Buka `http://localhost/phpmyadmin`
- Pilih database yang Anda buat, tab Import → pilih `sispak.sql` → Go

Atau via command line (PowerShell):

```powershell
# contoh: import file SQL ke database yang sudah dibuat
# mysql -u root -p
# CREATE DATABASE sispak_kosmetik_fc;
# USE sispak_kosmetik_fc;
# SOURCE C:/path/to/sispak.sql;
```

## Konfigurasi aplikasi

1. Edit koneksi database di `config/koneksi.php` jika diperlukan:

```php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'sispak_kosmetik_fc';
$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname) or die('koneksi gagal');
```

2. Pastikan folder `uploads/` (jika ada) dapat ditulisi oleh webserver jika Anda memakai upload gambar produk.

## Default akun admin

Setelah import `sispak.sql`, ada akun admin bawaan:

- Username: `admin`
- Password: `admin` (disimpan sebagai MD5 dalam sample SQL)

## URL Akses

- Frontend: `http://localhost/your-folder/` (sesuaikan nama folder)
- Admin (setelah login): `http://localhost/your-folder/admin/pakar-home.php`
- Login: `http://localhost/your-folder/auth/login.php`

## Perubahan penting di repo ini

- `assets/` berisi `css/` dan `image/`.
- Admin actions (edit/delete) terpusat pada `admin/actions.php`.
- Semua halaman admin membutuhkan autentikasi via `auth/check.php`.

## Troubleshooting (masalah umum)

- Error koneksi DB: periksa `config/koneksi.php` dan pastikan MySQL berjalan.
- Halaman kosong / error PHP: aktifkan `display_errors` sementara di `php.ini` atau lihat `Apache`/`PHP` error log.
- Tidak bisa login: pastikan `tb_admin` terisi (cek dengan phpMyAdmin) dan password MD5 cocok.

## Keamanan & perbaikan yang disarankan

- Gantilah hashing password MD5 ke `password_hash()` / `password_verify()` untuk produksi.
- Tambahkan token CSRF pada form admin untuk mencegah CSRF.
- Batasi akses upload file dan validasi tipe file jika menambahkan fitur upload gambar.

## Kontak & kontribusi

Jika ingin kontribusi atau minta fitur/bugfix, buat issue di GitHub repo Anda atau kirim patch.

## LICENSE

Silakan tambahkan file lisensi di repo jika ingin membagikan ulang. Saat ini tidak ada lisensi eksplisit.

---
README dibuat untuk membantu instalasi lokal dan pengembangan.
# Sistem-Pakar
Web Sistem Pakar Pemilihan Prodi : web pengambilan keputusan menggunakan metode forward-chaining, Bootstrap 4.1, php native

# Instalasi Lokal
1. Ekstrak semua file ke dalam htdocs
2. Nyalakan service mysql dan apache
3. Import file database "sispak.sql" ke dalam phpmyadmin
4. Atur database di file koneksi.php
5. Buka browser dan akses halaman web

## 🔍 Keywords SEO

```
SPK Siswa Berprestasi, PROMETHEE Laravel, Sistem Pendukung Keputusan Sekolah, Penilaian Prestasi Siswa, Rekomendasi Siswa Terbaik, Net Flow Siswa
```

---

## 📌 Credits

This project is developed and maintained by [Masmut Dev](https://masmut.dev), a Fullstack Developer from Indonesia. Dedicated to building efficient educational decision systems with clean logic and practical UI/UX.

© 2025 [Masmut Dev](https://masmut.dev) – All Rights Reserved.
Lisensi: MIT