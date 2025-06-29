# SEA Catering - Healthy Meals, Anytime, Anywhere

[![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.0-red.svg)](https://codeigniter.com/)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

SEA Catering adalah platform web yang menyediakan layanan makanan sehat dengan kustomisasi menu dan pengiriman ke seluruh Indonesia. Dibangun menggunakan CodeIgniter 4 framework dengan fokus pada pengalaman pengguna yang optimal dan kemudahan dalam memesan makanan sehat berkualitas.

## 🌟 Fitur Utama

### 🍽️ Manajemen Menu
- **Diet Plan** - Paket hemat untuk program penurunan berat badan
- **Protein Plan** - Tingkatkan asupan protein untuk pembentukan otot
- **Royal Plan** - Hidangan premium dengan bahan-bahan organik pilihan

### 📱 Fitur Pengguna
- Kustomisasi menu makanan sesuai kebutuhan
- Informasi nutrisi lengkap untuk setiap menu
- Paket langganan fleksibel
- Sistem testimoni pelanggan
- Halaman kontak yang responsif

### 🚚 Layanan Pengiriman
- Pengiriman ke kota-kota besar di Indonesia
- Layanan pelanggan yang responsif
- Tracking pesanan real-time

## 🛠️ Teknologi yang Digunakan

- **Framework**: CodeIgniter 4
- **PHP**: 8.1+
- **Database**: SQLite3
- **Frontend**: HTML5, CSS3, JavaScript
- **UI Framework**: Bootstrap (responsive design)
- **Development Tools**: Composer, PHPUnit

## 📋 Prasyarat Sistem

Sebelum menjalankan aplikasi ini, pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP**: 8.1 atau lebih tinggi
- **Composer**: Versi terbaru
- **Web Server**: Apache/Nginx
- **SQLite3**: Extension PHP SQLite3 (biasanya sudah terinstall dengan PHP)
- **Extensions PHP**:
  - intl
  - mbstring
  - json
  - sqlite3
  - xml

## 🚀 Instalasi

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
```bash
# Copy file environment template
cp env .env

# Edit file .env sesuai konfigurasi Anda
nano .env
```

### 4. Konfigurasi Environment Variables

Edit file `.env` dan sesuaikan konfigurasi berikut:

#### Environment Setting
```env
#--------------------------------------------------------------------
# ENVIRONMENT
#--------------------------------------------------------------------
CI_ENVIRONMENT = development
```

#### App Configuration
```env
#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'http://localhost:8081/'
app.forceGlobalSecureRequests = false
app.CSPEnabled = false
```

#### Database Configuration (SQLite)
```env
#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
# Konfigurasi database utama menggunakan SQLite
database.default.database = writable/sea_catering.db
database.default.DBDriver = SQLite3
database.default.DBPrefix =
database.default.foreignKeys = true
database.default.busyTimeout = 1000

# Database untuk testing (SQLite in-memory)
database.tests.database = :memory:
database.tests.DBDriver = SQLite3
database.tests.DBPrefix = db_
database.tests.foreignKeys = true
database.tests.busyTimeout = 1000
```

#### Security Configuration
```env
#--------------------------------------------------------------------
# ENCRYPTION
#--------------------------------------------------------------------
encryption.key = your_32_character_encryption_key_here

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------
session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
session.savePath = null
```

#### Logging Configuration
```env
#--------------------------------------------------------------------
# LOGGER
#--------------------------------------------------------------------
logger.threshold = 4
```

### 5. Setup Database
```bash
# Jalankan migrasi database
php spark migrate

# Jalankan seeder (jika ada)
php spark db:seed
```

### 6. Konfigurasi Web Server

#### Apache
Pastikan mod_rewrite diaktifkan dan tambahkan konfigurasi berikut di `.htaccess`:

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

#### Nginx
```nginx
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

### 7. Set Permissions
```bash
# Set permission untuk folder writable
chmod -R 755 writable/
chmod -R 755 public/

# Pastikan folder writable dapat ditulis untuk database SQLite
chmod 755 writable/
```

### 8. Jalankan Aplikasi
```bash
# Development server dengan port 8081
php spark serve --host=localhost --port=8081

# Atau untuk production
php spark serve --host=0.0.0.0 --port=8081
```

Aplikasi akan berjalan di [http://localhost:8081/](http://localhost:8081/)

## 📁 Struktur Proyek

```
Compfest-17-SEA/
├── app/                          # Kode aplikasi utama
│   ├── Config/                   # File konfigurasi
│   ├── Controllers/              # Controller aplikasi
│   │   ├── BaseController.php    # Controller dasar
│   │   ├── Home.php             # Controller halaman utama
│   │   └── Pages.php            # Controller halaman statis
│   ├── Models/                   # Model database
│   ├── Views/                    # Template view
│   │   ├── pages/               # Halaman utama
│   │   │   ├── home.php         # Halaman beranda
│   │   │   ├── menu.php         # Halaman menu
│   │   │   ├── contact.php      # Halaman kontak
│   │   │   └── subscription.php # Halaman langganan
│   │   └── templates/           # Template layout
│   └── Helpers/                 # Helper functions
├── public/                      # File publik (CSS, JS, Images)
├── writable/                    # File yang dapat ditulis (logs, cache)
│   ├── sea_catering.db         # Database SQLite
│   ├── logs/                   # Log files
│   └── cache/                  # Cache files
├── tests/                       # Unit tests
├── vendor/                      # Dependencies Composer
├── .env                        # Environment configuration
├── env                         # Environment template
├── composer.json               # Dependencies PHP
└── README.md                   # Dokumentasi proyek
```

## 🎯 Penggunaan

### Halaman Utama
- **URL**: [http://localhost:8081/](http://localhost:8081/)
- **Deskripsi**: Menampilkan informasi utama SEA Catering dengan testimoni pelanggan

### Menu & Meal Plans
- **URL**: [http://localhost:8081/menu](http://localhost:8081/menu)
- **Deskripsi**: Menampilkan berbagai paket makanan yang tersedia

### Kontak
- **URL**: [http://localhost:8081/contact](http://localhost:8081/contact)
- **Deskripsi**: Halaman kontak dengan informasi lengkap perusahaan

### Langganan
- **URL**: [http://localhost:8081/subscription](http://localhost:8081/subscription)
- **Deskripsi**: Halaman untuk mengelola paket langganan

## 🧪 Testing

Jalankan unit tests dengan perintah:

```bash
# Jalankan semua tests
composer test

# Atau menggunakan PHPUnit langsung
./vendor/bin/phpunit

# Jalankan tests dengan coverage
./vendor/bin/phpunit --coverage-html coverage/
```

## 🔧 Konfigurasi Tambahan

### Environment Modes
- **Development**: `CI_ENVIRONMENT = development` (menampilkan error detail)
- **Production**: `CI_ENVIRONMENT = production` (menyembunyikan error detail)
- **Testing**: `CI_ENVIRONMENT = testing` (untuk unit testing)

### Security Best Practices
- Aktifkan HTTPS di production dengan `app.forceGlobalSecureRequests = true`
- Set encryption key yang unik dan aman (32 karakter)
- Konfigurasi Content Security Policy (CSP) dengan `app.CSPEnabled = true`
- Gunakan session driver yang aman

### Performance Optimization
- Aktifkan caching untuk production
- Optimasi database queries
- Minify CSS dan JavaScript
- Gunakan CDN untuk assets statis

### SQLite Configuration Tips
- Database file akan otomatis dibuat di `writable/sea_catering.db`
- SQLite mendukung foreign keys (diaktifkan dengan `foreignKeys = true`)
- Gunakan `busyTimeout` untuk menangani concurrent access
- Backup database dengan menyalin file `.db`
- Testing menggunakan in-memory database (`:memory:`)

## 📝 API Documentation

### Endpoints yang Tersedia

#### GET `/`
- **Deskripsi**: Halaman utama aplikasi
- **URL**: [http://localhost:8081/](http://localhost:8081/)
- **Response**: HTML page dengan data testimoni

#### GET `/menu`
- **Deskripsi**: Halaman menu dan meal plans
- **URL**: [http://localhost:8081/menu](http://localhost:8081/menu)
- **Response**: HTML page dengan data paket makanan

#### GET `/contact`
- **Deskripsi**: Halaman kontak
- **URL**: [http://localhost:8081/contact](http://localhost:8081/contact)
- **Response**: HTML page dengan informasi kontak

#### POST `/add-testimonial`
- **Deskripsi**: Menambah testimoni baru
- **URL**: [http://localhost:8081/add-testimonial](http://localhost:8081/add-testimonial)
- **Parameters**:
  - `customer_name` (string): Nama pelanggan
  - `review` (string): Isi testimoni
  - `rating` (integer): Rating 1-5
- **Response**: Redirect dengan flash message

## 🤝 Kontribusi

Kami menyambut kontribusi dari komunitas! Berikut adalah langkah-langkah untuk berkontribusi:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Guidelines untuk Kontribusi
- Ikuti standar coding PSR-12
- Tambahkan unit tests untuk fitur baru
- Update dokumentasi sesuai perubahan
- Pastikan semua tests berjalan dengan baik
- Update file `.env` jika ada perubahan konfigurasi

## 🐛 Bug Reports

Jika Anda menemukan bug, silakan buat issue di GitHub dengan informasi berikut:
- Deskripsi bug yang jelas
- Langkah-langkah untuk mereproduksi bug
- Screenshot (jika relevan)
- Informasi sistem (OS, PHP version, dll)
- Log error dari `writable/logs/`

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## 👥 Tim Pengembang

- **Alif Nurhidayat** - Lead Developer & Project Manager
- **Tim SEA Compfest** - Development Team

## 📞 Kontak

### Informasi Perusahaan
- **Email**: contact@seacatering.com
- **Phone**: 08123456789
- **Address**: Jl. Digital Raya No. 17, Jakarta, Indonesia

### Informasi Developer
- **Nama**: Alif Nurhidayat
- **Email**: alifnurhidayatwork@gmail.com
- **Phone**: 081368898090
- **GitHub**: [@KillerKing93](https://github.com/KillerKing93)
- **Repository**: [Compfest-17-SEA](https://github.com/KillerKing93/Compfest-17-SEA)

## 🌐 Demo Aplikasi

Aplikasi dapat diakses melalui:
- **Production**: [https://compfest-17-sea.craftthingy.com](https://compfest-17-sea.craftthingy.com)
- **Development**: [http://localhost:8081/](http://localhost:8081/)
- **Repository**: [https://github.com/KillerKing93/Compfest-17-SEA](https://github.com/KillerKing93/Compfest-17-SEA)
- **Compfest Hub**: [https://compfest.craftthingy.com](https://compfest.craftthingy.com) - Showcase semua proyek Compfest

## 🚀 Deployment

### Production Environment
Aplikasi telah di-deploy di:
- **URL**: [https://compfest-17-sea.craftthingy.com](https://compfest-17-sea.craftthingy.com)
- **Platform**: CraftThingy
- **Status**: Live & Ready

### Compfest Project Hub
Semua proyek Compfest dapat dilihat di:
- **Hub URL**: [https://compfest.craftthingy.com](https://compfest.craftthingy.com)
- **Deskripsi**: Showcase dan gallery semua proyek yang berpartisipasi dalam Compfest 17

### Deployment Checklist
- ✅ Environment set ke production
- ✅ Database SQLite terkonfigurasi
- ✅ Permissions folder writable
- ✅ Cache dioptimasi
- ✅ Security headers aktif
- ✅ SSL/HTTPS aktif

## 🔧 Troubleshooting

### Masalah Umum

#### 1. Permission Denied
```bash
# Set permission yang benar
chmod -R 755 writable/
chmod -R 755 public/
```

#### 2. SQLite Database Error
- Pastikan extension SQLite3 terinstall: `php -m | grep sqlite`
- Periksa permission folder `writable/`
- Database akan otomatis dibuat saat migrasi pertama

#### 3. Composer Dependencies
```bash
# Clear cache composer
composer clear-cache
composer install --no-cache
```

#### 4. CodeIgniter Cache
```bash
# Clear cache aplikasi
php spark cache:clear
```

#### 5. SQLite Database Backup
```bash
# Backup database
cp writable/sea_catering.db backup/sea_catering_$(date +%Y%m%d_%H%M%S).db

# Restore database
cp backup/sea_catering_backup.db writable/sea_catering.db
```

## 🙏 Ucapan Terima Kasih

Terima kasih kepada:
- [CodeIgniter Team](https://codeigniter.com/) untuk framework yang luar biasa
- [Bootstrap](https://getbootstrap.com/) untuk UI framework
- [Unsplash](https://unsplash.com/) untuk gambar-gambar berkualitas
- [Compfest](https://compfest.id/) untuk kesempatan berpartisipasi dalam kompetisi
- [CraftThingy](https://craftthingy.com/) untuk platform hosting dan showcase proyek
- Semua kontributor dan pengguna yang telah mendukung proyek ini

---

**SEA Catering** - Healthy Meals, Anytime, Anywhere 🍽️✨

*Dibuat dengan ❤️ oleh Alif Nurhidayat untuk Compfest 17*

**🌐 Akses Aplikasi**: 
- **Production**: [https://compfest-17-sea.craftthingy.com](https://compfest-17-sea.craftthingy.com)
- **Development**: [http://localhost:8081/](http://localhost:8081/)
- **Compfest Hub**: [https://compfest.craftthingy.com](https://compfest.craftthingy.com)
