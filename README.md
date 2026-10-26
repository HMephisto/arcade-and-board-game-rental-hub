# Arcade & Board Game Rental Hub

Sistem Informasi Manajemen Data Sederhana untuk inventarisasi dan rental board game serta unit arcade cabinet berbasis Native PHP dan MySQL.

Proyek ini disusun untuk memenuhi **Tugas 2: Sistem Informasi Manajemen Data Sederhana** pada mata kuliah **Penerapan Teknologi Internet (01170)**.

---

## Informasi Mahasiswa & Akademik

* **Nama Mahasiswa:** Muhamad Hakim Nur Majid
* **NIM:** 10124015
* **Mata Kuliah:** Penerapan Teknologi Internet (01170)
* **Dosen Pengampu:** Donny Reza, M.Kom.
* **Topik Tugas:** Tugas 2 - Sistem Informasi Manajemen Data Sederhana (Session Auth, CRUD, Input Validation, Dual Language)

---

## Fitur Utama

Sistem ini dibangun murni menggunakan **Native PHP** tanpa framework pihak ketiga, dengan rincian fitur sebagai berikut:

1. **Autentikasi Berbasis Sesi (Session-based Auth):**
   - Halaman `login.php` dengan verifikasi hash password menggunakan `password_verify()`.
   - Pencegahan Session Fixation menggunakan `session_regenerate_id(true)`.
   - Guard script `Includes/Auth_check.php` yang mengamankan seluruh route internal (`index.php`, `create.php`, `edit.php`, `delete.php`).
   - `logout.php` yang membersihkan session cookie dan session storage secara menyeluruh dengan tetap mempertahankan preferensi bahasa pengguna.

2. **Pengelolaan Data Lengkap (Full CRUD):**
   - **Create (`create.php`):** Formulir penambahan data unit game baru.
   - **Read (`index.php`):** Dashboard katalog tabular dengan badge visual kategori (Board Game, Arcade Cabinet, Console) dan status ketersediaan (Available, Rented, Maintenance).
   - **Update (`edit.php`):** Pembaruan data unit yang terisi otomatis (*pre-filled*).
   - **Delete (`delete.php`):** Penghapusan record aman berbasis ID dengan dialog konfirmasi JavaScript.

3. **Sanitasi & Validasi Percabangan Input Form:**
   - Seluruh mutasi data menggunakan metode `POST`.
   - Sanitasi string menggunakan `htmlspecialchars(trim(...), ENT_QUOTES, 'UTF-8')`.
   - Validasi numerik menggunakan `filter_var(..., FILTER_VALIDATE_INT)` dan `filter_var(..., FILTER_VALIDATE_FLOAT)`.
   - Validasi percabangan logika bisnis:
     - Judul game wajib diisi.
     - Jumlah pemain minimum harus $\ge 1$.
     - Jumlah pemain maksimum tidak boleh lebih kecil dari pemain minimum.
     - Tarif per jam harus berupa angka non-negatif.
     - Kategori, kondisi fisik, dan status divalidasi ketat terhadap whitelist ENUM.
   - *Sticky Form:* Nilai input form dipertahankan apabila terjadi kesalahan validasi sehingga pengguna tidak perlu mengetik ulang.

4. **Antarmuka Dua Bahasa (Dual Language ID / EN):**
   - Preferensi bahasa disimpan secara persisten di dalam `$_SESSION['lang']` (default: `'id'`).
   - Toggle instan `[ID | EN]` pada header navigasi dan halaman login.
   - Seluruh teks, label tabel, placeholder, dan notifikasi error/sukses dimuat dari kamus asosiatif (`Lang/id.php` dan `Lang/en.php`).

5. **Pemberitahuan Flash & Sanitasi URL:**
   - Feedback notifikasi aksi (`msg=created`, `msg=updated`, `msg=deleted`, `msg=logged_out`).
   - Tombol *dismiss* interaktif (`✕`).
   - Pembersihan otomatis parameter URL melalui `window.history.replaceState` agar pesan notifikasi tidak berulang saat halaman di-*refresh*.

---

## Struktur Direktori Proyek

```text
Arcade and Board Game Rental Hub/
├── Assets/
│   ├── css/
│   │   └── style.css          # Desain antarmuka bertema game cafe & arcade lounge
│   └── images/
│       └── login-bg.jpg       # Aset grafis latar belakang halaman login
├── Config/
│   └── Koneksi.php            # Konfigurasi koneksi PDO ke MySQL dengan Exception handling
├── Includes/
│   ├── Auth_check.php         # Gate guard session autentikasi
│   ├── Footer.php             # Komponen penutup halaman & script URL clean-up
│   ├── Header.php             # Komponen navigasi, user badge & language switcher
│   └── Lang_init.php          # Inisialisasi dan sinkronisasi sesi bahasa ($_SESSION['lang'])
├── Lang/
│   ├── en.php                 # Kamus bahasa Inggris
│   └── id.php                 # Kamus bahasa Indonesia
├── arcade_rental.sql          # Skrip skema database, tabel, dan seed data awal
├── create.php                 # Halaman tambah data game baru (Form & Validasi POST)
├── delete.php                 # Handler penghapusan data game
├── edit.php                   # Halaman ubah data game (Pre-filled form & Update)
├── index.php                  # Halaman utama inventaris / katalog game (Read)
├── login.php                  # Halaman login sistem
├── logout.php                 # Handler penghentian sesi login
└── README.md                  # Dokumentasi proyek
```

---

## Panduan Instalasi & Menjalankan Proyek

### 1. Kebutuhan Lingkungan (Prerequisites)
* Web Server: Apache (melalui XAMPP)
* Database: MySQL / MariaDB (melalui XAMPP)
* PHP Versi: PHP 8.0 ke atas

### 2. Langkah Instalasi
1. *Clone* repositori ini ke dalam direktori `htdocs` web server lokal Anda:
   ```bash
   cd C:/xampp/htdocs
   git clone https://github.com/<username>/arcade-and-board-game-rental-hub.git
   ```

2. Buka **XAMPP Control Panel** dan jalankan modul **Apache** serta **MySQL**.

3. Buka browser dan akses **phpMyAdmin** (`http://localhost/phpmyadmin`).

4. Buat database baru bernama `arcade_rental` atau langsung impor file `arcade_rental.sql` yang berada di direktori *root* proyek.

5. Pastikan pengaturan koneksi database pada `Config/Koneksi.php` sesuai dengan konfigurasi web server lokal Anda:
   ```php
   $host     = "localhost";
   $nama_db  = "arcade_rental";
   $username = "root";
   $password = "";
   ```

### 3. Akses Aplikasi & Akun Default
Buka URL berikut pada web browser sesuai dengan nama repositori hasil *clone*:
```text
http://localhost/arcade-and-board-game-rental-hub/login.php
```

**Kredensial Akun Administrator:**
* **Username:** `admin`
* **Password:** `password123`

---

## Lisensi & Penggunaan
Proyek ini dibuat untuk keperluan akademik mata kuliah Penerapan Teknologi Internet, Universitas Komputer Indonesia (UNIKOM).
