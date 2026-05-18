# Portofolio Zefhana Ananda

| | |
|---|---|
| **Nama** | Zefhana Ananda |
| **NIM** | 20240801047 |
| **Mata Kuliah** | Pemrograman Web (CR002) |
| **Dosen Pengampu** | Jefry Sunupurwa Asri, S.Kom., M.Kom. |
| **Program Studi** | Teknik Informatika |
| **Fakultas** | Ilmu Komputer |
| **Universitas** | Universitas Esa Unggul |

<a href="docs/Laporan Awal Project Akhir.pdf">
  <img src="https://img.shields.io/badge/Buka_PDF-dc2626?style=for-the-badge&logo=adobeacrobatreader&logoColor=white" alt="Buka PDF"/>
</a>
&nbsp;
<a href="docs/Laporan Awal Project Akhir.pdf">
  <img src="https://img.shields.io/badge/Laporan_Awal_Project_Akhir-4f46e5?style=for-the-badge&logo=googledocs&logoColor=white" alt="Laporan Awal Project Akhir"/>
</a>

---

## 🎯 Deskripsi Project

Website portofolio full-stack yang dibangun sebagai project UTS Pemrograman Web. Menampilkan:
- ✅ **Halaman Home/About** — Profil, bio, dan skill stack
- ✅ **Halaman Projects** — Daftar project dengan progress tracking
- ✅ **Halaman Contact** — Form kontak dinamis yang tersimpan ke database
- ✅ **Admin Panel** — CRUD project, kelola pesan, upload gambar
- ✅ **Arsitektur MVC** — Menggunakan Laravel 12 sebagai framework utama

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 12, PHP 8.2 |
| Frontend | Blade, Tailwind CSS, Vite |
| Admin | Filament v3 |
| Database | MariaDB 10.11 |
| Server | Nginx, Docker |

---

## 🚀 Cara Menjalankan

### Prasyarat
- Docker & Docker Compose
- Git

### Langkah

```bash
# Masuk ke folder project
cd /root/perkuliahan/uts_pemweb

# Jalankan semua container
docker compose up -d

# Cek status container
docker compose ps
```

### Akses

| Halaman | URL |
|---------|-----|
| Website | https://uts_pemweb.test |
| Admin Panel | https://uts_pemweb.test/admin |
| Database | localhost:13306 |

---

## 🔐 Kredensial Admin

| | |
|--|--|
| Email | `admin@admin.com` |
| Password | `password` |

---

## 📁 Struktur Project

```
uts_pemweb/
├── docker-compose.yml        # Konfigurasi Docker
├── .env                      # Environment Docker
├── docs/                     # Dokumentasi & Laporan
├── nginx/                    # Konfigurasi Nginx & SSL
├── php/                      # Dockerfile PHP
├── db/                       # Konfigurasi & data MariaDB
└── src/                      # Source code Laravel
    ├── app/
    │   ├── Http/Controllers/
    │   │   ├── PortfolioController.php
    │   │   └── ContactController.php
    │   ├── Models/
    │   │   ├── Project.php
    │   │   └── ContactMessage.php
    │   └── Filament/Admin/
    │       ├── Resources/
    │       │   ├── ProjectResource.php
    │       │   └── ContactMessageResource.php
    │       └── Widgets/
    │           ├── StatsOverviewWidget.php
    │           ├── ProjectsTableWidget.php
    │           └── RecentMessagesWidget.php
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    │       ├── ProjectSeeder.php
    │       └── UserSeeder.php
    ├── resources/views/
    │   ├── layouts/app.blade.php
    │   └── portfolio/
    │       ├── home.blade.php
    │       ├── projects.blade.php
    │       ├── project-detail.blade.php
    │       └── contact.blade.php
    └── routes/web.php
```

---

## 📊 Arsitektur MVC

```
Model      → Project, ContactMessage, User
View       → Blade templates (layouts + portfolio)
Controller → PortfolioController, ContactController
Admin      → Filament Resources (ProjectResource, ContactMessageResource)
```

---

## 🔧 Konfigurasi Penting (.env)

```env
APP_NAME="Portofolio Zefhana Ananda"
APP_URL="https://uts_pemweb.test"
DB_HOST=db
DB_DATABASE=uts_pemweb
FILESYSTEM_DISK=public
```

---

## 🐛 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| Container tidak jalan | `docker compose up -d` |
| Error database | `docker compose restart db` |
| Asset tidak loading | `npm run build` di dalam container php |
| Upload foto gagal | `php artisan storage:link` |
| Error 500 | `docker exec uts_pemweb_php tail -50 storage/logs/laravel.log` |

---

**Status**: ✅ Selesai & Tested  
**Last Updated**: Mei 2026
