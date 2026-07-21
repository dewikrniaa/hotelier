# Sistem Pengelolaan Hotel Berbasis Website

Sistem Pengelolaan Hotel adalah aplikasi berbasis web untuk membantu pengelolaan operasional hotel. Aplikasi ini digunakan untuk mengelola data kamar, pelanggan, proses check-in, pembayaran, checkout, dan laporan pendapatan.

Project ini dikembangkan secara kolaboratif menggunakan Laravel dan MySQL dengan struktur MVC. Repository digunakan sebagai dokumentasi pengembangan dan versioning source code.

## Fitur Utama

- Login dan registrasi pengguna/admin.
- Pengelolaan data kamar dan tipe kamar.
- Pengelolaan data pelanggan.
- Proses check-in pelanggan.
- Proses pembayaran.
- Proses checkout dan perubahan status kamar.
- Laporan pendapatan.
- Export laporan ke PDF dan Excel.
- Audit log untuk mencatat aktivitas penting pengguna.

## Teknologi yang Digunakan

| Komponen | Fungsi |
| --- | --- |
| Laravel 9 | Framework utama aplikasi berbasis MVC |
| PHP 8 | Bahasa pemrograman backend |
| MySQL | Database relasional |
| phpMyAdmin | Pengelolaan database secara visual |
| Blade Template | Tampilan halaman aplikasi |
| Bootstrap / Tailwind CSS | Desain antarmuka |
| Vite | Build asset frontend |
| DomPDF | Export laporan ke PDF |
| Laravel Excel | Export laporan ke Excel |
| Git dan GitHub | Versioning source code |

## Struktur Project

| Folder / File | Fungsi |
| --- | --- |
| `app/Http/Controllers` | Berisi controller untuk proses bisnis aplikasi |
| `app/Models` | Berisi model data aplikasi |
| `app/Helpers/AuditLog.php` | Helper pencatatan aktivitas pengguna |
| `app/Exports` | Export laporan ke Excel |
| `database/migrations` | Struktur tabel dan relasi database |
| `resources/views` | Tampilan halaman aplikasi |
| `routes/web.php` | Pengaturan route aplikasi |
| `public` | Asset publik aplikasi |
| `.env` | Konfigurasi environment dan koneksi database |

## Struktur Database

Database yang digunakan: `edotel`

Tabel utama:

- `users`
- `tipe_kamar`
- `kamar`
- `pelanggan`
- `checkin`
- `audit_logs`

Relasi foreign key:

- `kamar.tipe_kamar_id` mengacu ke `tipe_kamar.id`
- `checkin.id_pelanggan` mengacu ke `pelanggan.id_pelanggan`
- `checkin.id_kamar` mengacu ke `kamar.id_kamar`
- `audit_logs.user_id` mengacu ke `users.id`

## Instalasi Project

1. Clone repository:

```bash
git clone https://github.com/dewikrniaa/hotelier.git
cd hotelier
```

2. Install dependency PHP:

```bash
composer install
```

3. Install dependency frontend:

```bash
npm install
```

4. Salin file environment:

```bash
cp .env.example .env
```

Jika menggunakan Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Atur konfigurasi database pada file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=edotel
DB_USERNAME=root
DB_PASSWORD=
```

7. Buat database `edotel` melalui phpMyAdmin atau MySQL.

8. Jalankan migration:

```bash
php artisan migrate
```

9. Jalankan build asset:

```bash
npm run build
```

10. Jalankan aplikasi:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
http://127.0.0.1:8000
```

## Alur Penggunaan Aplikasi

1. Pengguna/admin login ke sistem.
2. Admin mengelola data kamar dan tipe kamar.
3. Admin mencatat data pelanggan.
4. Admin melakukan proses check-in dengan memilih pelanggan dan kamar tersedia.
5. Sistem menghitung lama menginap dan total harga.
6. Admin memproses pembayaran pelanggan.
7. Admin melakukan checkout.
8. Sistem mengubah status kamar dan menyimpan riwayat transaksi.
9. Admin melihat laporan pendapatan dan melakukan export laporan jika diperlukan.

## Modul Utama

| Modul | Fungsi |
| --- | --- |
| Dashboard | Menampilkan ringkasan data hotel |
| Kamar | Mengelola data kamar dan status kamar |
| Pelanggan | Mengelola data pelanggan hotel |
| Check-in | Mencatat transaksi menginap |
| Pembayaran | Mengubah status pembayaran pelanggan |
| Checkout | Mengakhiri proses menginap dan mengubah status kamar |
| Laporan | Menampilkan dan export laporan pendapatan |
| Audit Log | Mencatat aktivitas penting pengguna |

## Best Practices yang Diterapkan

- Struktur MVC Laravel untuk memisahkan controller, model, view, dan route.
- Validasi input menggunakan `$request->validate()`.
- Query database menggunakan Laravel Query Builder.
- Foreign key untuk menjaga relasi antar tabel.
- `DB::transaction()` pada proses yang melibatkan lebih dari satu tabel.
- Audit log untuk mencatat aktivitas penting.
- Versioning source code menggunakan Git dan GitHub.

## Pengujian

Perintah yang dapat digunakan untuk pengujian dan validasi:

```bash
php artisan migrate:status
php artisan test
npm run build
```

Catatan: route `/` pada aplikasi diarahkan ke halaman login, sehingga test bawaan Laravel yang mengharapkan status `200` pada `/` perlu disesuaikan dengan alur aplikasi.

## Repository

Repository GitHub:

```text
https://github.com/dewikrniaa/hotelier
```

## Kontributor

- Dewi Kurnia Sari
- Lutfi Ainnun Fruityantri
- Shasy Wiade Putri
- Denisa Ruthdiani Siagian

## Catatan Pengembangan

Project ini dapat dikembangkan lebih lanjut dengan:

- Menambahkan role pengguna.
- Menambahkan stored procedure atau trigger database untuk audit log otomatis.
- Menambahkan dokumentasi ERD.
- Menambahkan pengujian fitur untuk modul kamar, pelanggan, check-in, dan laporan.
- Menyempurnakan README dengan screenshot aplikasi.

