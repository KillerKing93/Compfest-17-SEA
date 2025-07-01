# SEA Catering - Healthy Meals, Anytime, Anywhere

[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.0-red.svg)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

SEA Catering adalah aplikasi web untuk layanan katering sehat dengan fitur langganan, menu dinamis, testimoni, dan dashboard admin. Proyek ini dibangun dengan CodeIgniter 4, database SQLite (default, cross-platform), dan UI responsif yang modern.

---

## 🚀 Demo & Deployment
- **Production**: [https://compfest-17-sea.craftthingy.com](https://compfest-17-sea.craftthingy.com)
- **Development (local)**: [http://localhost:8081/](http://localhost:8081/)
- **Compfest Hub**: [https://compfest.craftthingy.com](https://compfest.craftthingy.com)
- **Repository**: [https://github.com/KillerKing93/Compfest-17-SEA](https://github.com/KillerKing93/Compfest-17-SEA)

---

## 📋 Fitur Utama
- **Manajemen Menu & Langganan**: CRUD menu, langganan, testimoni
- **Dashboard Admin**: Statistik, manajemen user, dan data
- **UI/UX Modern**: Responsive, mobile-friendly, dan intuitif
- **Database SQLite**: Tidak perlu setup MySQL, langsung jalan di semua OS
- **Seeder & Migrasi**: Data awal otomatis, mudah di-reset
- **Clean Code & Architecture**: PSR-12, separation of concerns, commit history jelas

---

## 🛠️ Teknologi
- **Backend**: CodeIgniter 4 (PHP 8.1+)
- **Database**: SQLite3 (default, cross-platform)
- **Frontend**: HTML5, CSS3, Bootstrap, JavaScript
- **Testing**: PHPUnit
- **Deployment**: CraftThingy (public), bisa deploy di mana saja

---

## ⚡️ Instalasi & Setup

### 1. Clone Repository
```bash
git clone https://github.com/KillerKing93/Compfest-17-SEA.git
cd Compfest-17-SEA
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file `env` menjadi `.env`:
```bash
cp env .env
```

Edit `.env` jika perlu, default sudah siap pakai untuk SQLite. **Tidak perlu mengatur database.default.DBDriver atau database.default.database di .env, kecuali Anda ingin override konfigurasi bawaan.**

```env
app.baseURL = 'http://localhost:8081/'
# database.default.DBDriver = SQLite3   # (JANGAN di-uncomment, sudah diatur di app/Config/Database.php)
# database.default.database = writable/sea_catering.db   # (JANGAN di-uncomment, sudah diatur di app/Config/Database.php)
```
> **Catatan:**
> Secara default, konfigurasi database sudah diatur di `app/Config/Database.php` untuk SQLite. Jika Anda mengatur variabel database di `.env`, pastikan nilainya benar dan sesuai path, atau biarkan saja agar tidak terjadi error.

### 4. (Opsional, Direkomendasikan) Jalankan setup.php untuk Membuat Database Otomatis
Sebelum menjalankan migrasi, Anda dapat mengakses script setup otomatis untuk membuat file database SQLite jika belum ada:

- **Local:** Buka di browser: [http://localhost:8081/setup.php](http://localhost:8081/setup.php)
- **Production:** Buka: [https://compfest-17-sea.craftthingy.com/setup.php](https://compfest-17-sea.craftthingy.com/setup.php)

Script ini akan membuat file `writable/sea_catering.db` jika belum ada, dan memberi tahu jika perlu menjalankan migrasi secara manual.

### 5. Jalankan Migrasi & Seeder
```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

### 6. Jalankan Server Lokal
```bash
php spark serve --host=localhost --port=8081
```
Akses di [http://localhost:8081/](http://localhost:8081/)

---

## 👤 Admin Account (Jika Ada Fitur Admin)
Jika Anda ingin membuat akun admin:
1. Jalankan seeder khusus admin (jika ada):
   ```bash
   php spark db:seed AdminSeeder
   ```
   atau
2. Register user baru, lalu ubah role-nya menjadi `admin` lewat database browser (misal: DB Browser for SQLite) pada tabel `users`.

---

## 📁 Struktur Proyek
```
Compfest-17-SEA/
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   ├── Models/
│   ├── Views/
│   └── ...
├── public/
├── writable/
├── tests/
├── vendor/
├── .env
├── composer.json
└── README.md
```

---

## 🌱 Seeder & Migrasi
- **Migrasi**: Semua struktur tabel otomatis dengan `php spark migrate`
- **Seeder**: Data awal (menu, testimoni, dsb) otomatis dengan `php spark db:seed DatabaseSeeder`
- **Reset Data**: Jalankan `php spark migrate:refresh --seed` untuk reset database

---

## 🌐 Environment Variables Penting
| Variable | Contoh Value |
|----------|--------------|
| app.baseURL | http://localhost:8081/ |
| # database.default.DBDriver | SQLite3 |
| # database.default.database | writable/sea_catering.db |

> **Catatan:**
> Variabel database di atas **tidak perlu diisi** kecuali Anda ingin override konfigurasi bawaan di `app/Config/Database.php`.

---

## 💡 Troubleshooting
- **Database Error**: Pastikan folder `writable/` bisa ditulis (chmod 777 di Linux, Full Control di Windows)
- **Migration Error**: Pastikan sudah jalankan semua migrasi (`php spark migrate --all`)
- **Seeder Error**: Pastikan sudah jalankan seeder (`php spark db:seed DatabaseSeeder`)
- **SQLite Error**: Pastikan extension SQLite3 aktif di PHP (`php -m | grep sqlite3`)
- **Port Conflict**: Jika port 8081 dipakai, ganti port di perintah serve

---

## 🏆 Penilaian & Bonus
- **Clean Code**: PSR-12, arsitektur rapi, separation of concerns
- **Responsive Layout**: Bootstrap, mobile-friendly
- **Readme Lengkap**: Semua instruksi, env, dan troubleshooting jelas
- **Commit History**: Step by step, tidak di-squash
- **UI/UX**: Modern, intuitif, dan kreatif (lihat demo!)
- **Deployment**: [compfest-17-sea.craftthingy.com](https://compfest-17-sea.craftthingy.com) (bisa diakses siapa saja)

---

## 📜 Lisensi
MIT License

---

## 🙏 Terima Kasih
Terima kasih kepada semua reviewer, tim Compfest, dan semua yang telah mendukung proyek ini. Semoga aplikasi ini bermanfaat dan menginspirasi!

---

**SEA Catering** - Healthy Meals, Anytime, Anywhere 🍽️✨

*Dibuat dengan ❤️ oleh Alif Nurhidayat untuk Compfest 17*
