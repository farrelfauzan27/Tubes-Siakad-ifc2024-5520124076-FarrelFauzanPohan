# SIAKAD — Tugas Besar Web II (IF53413)

Aplikasi web Sistem Informasi Akademik (SIAKAD) sederhana berbasis **Laravel 11**.

## 1. Deskripsi Singkat Aplikasi

Aplikasi ini mensimulasikan SIAKAD sederhana dengan fitur pengelolaan data Dosen, Mahasiswa, Mata Kuliah, Jadwal Perkuliahan, dan Kartu Rencana Studi (KRS). Terdapat dua role:

- **Admin**: mengelola seluruh data master (dosen, mahasiswa, mata kuliah, jadwal) dan melihat seluruh data KRS mahasiswa.
- **Mahasiswa**: hanya dapat mengambil/drop mata kuliah (KRS) dan melihat jadwal kuliahnya sendiri.

## 2. Fungsi Tiap Halaman

| Halaman | Fungsi |
|---|---|
| `/login` | Login menggunakan Laravel Auth (session-based) |
| `/dashboard` | Dashboard ringkasan statistik (admin) atau info akademik pribadi (mahasiswa) |
| `/dosen` | CRUD data dosen (admin) |
| `/mahasiswa` | CRUD data mahasiswa + otomatis membuat akun login mahasiswa (admin) |
| `/matakuliah` | CRUD data mata kuliah (admin) |
| `/jadwal` | CRUD jadwal perkuliahan, terhubung ke dosen & mata kuliah (admin) |
| `/krs` | Admin melihat seluruh data KRS semua mahasiswa, dapat menghapus data KRS |
| `/krs-saya` | Mahasiswa mengambil (tambah) atau drop (hapus) mata kuliah sendiri |

## 3. Fitur Utama

- Authentication & Authorization dengan Laravel Auth + Middleware role (`admin`, `mahasiswa`)
- CRUD lengkap untuk Dosen, Mahasiswa, Mata Kuliah, Jadwal, dan KRS
- Validasi input pada setiap form (Laravel Validation)
- Eloquent ORM + Eloquent Relationship (hasMany, belongsTo, belongsToMany via tabel pivot `krs`)
- Migration & Seeder untuk inisialisasi database beserta data dummy
- Pencarian/filter data pada setiap halaman index (bonus)
- UI responsif menggunakan Bootstrap 5

## 4. Cara Menjalankan Aplikasi (Lokal)

```bash
# 1. Install dependency PHP
composer install

# 2. Copy environment file
cp .env.example .env
php artisan key:generate

# 3. Buat database SQLite (default)
touch database/database.sqlite

# 4. Jalankan migration & seeder
php artisan migrate --seed

# 5. Jalankan server
php artisan serve
```

Akses di `http://127.0.0.1:8000`

### Akun Demo (hasil seeder)

| Role | Email | Password |
|---|---|---|
| Admin | admin@kampus.ac.id | password |
| Mahasiswa | rian@siakad.test | password |
| Mahasiswa | dewi@siakad.test | password |
| Mahasiswa | putu@siakad.test | password |

## 5. Struktur Database (ERD)

- **dosens** (nidn PK, nama)
- **mahasiswas** (npm PK, nidn FK → dosens, nama)
- **matakuliahs** (kode_matakuliah PK, nama_matakuliah, sks)
- **jadwals** (id, kode_matakuliah FK, nidn FK, kelas, hari, jam)
- **krs** (id, npm FK, kode_matakuliah FK)

## 6. Screenshot Aplikasi

Lihat folder [`screenshots/`](./screenshots) untuk tangkapan layar setiap halaman.

## 7. Link Hosting

> _(isi link deploy/hosting di sini jika sudah dideploy)_

## 8. Tech Stack

- Laravel 11, PHP 8.2+, Bootstrap 5, SQLite/MySQL
