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

Website portofolio **full-stack dinamis** yang dibangun sebagai project UTS Pemrograman Web. Seluruh konten dikelola melalui database dan dapat diubah melalui Admin Panel tanpa menyentuh kode. Menampilkan:
- ✅ **Halaman Home/About** — Profil, bio, skill, dan timeline pengalaman (dinamis dari database)
- ✅ **Halaman Projects** — Daftar project dengan detail dan progress tracking (dinamis dari database)
- ✅ **Halaman Contact** — Form kontak yang tersimpan ke database + FAQ dinamis
- ✅ **Admin Panel** — CRUD lengkap untuk semua konten (profil, skill, pengalaman, project, FAQ, pesan)
- ✅ **Arsitektur MVC** — Menggunakan Laravel 12 sebagai framework utama
- ✅ **Sepenuhnya Dinamis** — Tidak ada konten hardcoded, semua data dari database

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 12, PHP 8.3 |
| Frontend | Blade, Tailwind CSS, Vite |
| Admin & Interactivity | Filament v3, **Livewire**, **Alpine.js** |
| Database | MariaDB 10.11 |
| Server | Nginx, Docker |

> **Note:** Penggunaan **Livewire** dan **Alpine.js** terintegrasi secara mendalam (*under the hood*) melalui penggunaan Filament v3 untuk memberikan reaktivitas tinggi pada admin panel tanpa harus menulis banyak kode JavaScript manual.

---

## 🚀 Cara Menjalankan

### Prasyarat
- Docker & Docker Compose
- Git

### Langkah

```bash
# 1. Clone & masuk ke folder project
git clone https://github.com/ZEFHANAA/uts_pemweb-2026.git
cd uts_pemweb-2026

# 2. Siapkan environment Docker (file .env di root, di-gitignore)
cat > .env <<'EOF'
COMPOSE_PROJECT_NAME=uts_pemweb
PROJECT_NAME=uts_pemweb
DB_ROOT_PASSWORD=secret
EOF

# 3. Nginx butuh SSL cert (folder nginx/ssl/ di-gitignore)
mkdir -p nginx/ssl
openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
  -keyout nginx/ssl/petawisata.my.id.key \
  -out nginx/ssl/petawisata.my.id.crt \
  -subj "/CN=petawisata.my.id"

# 4. Network yang dipakai docker-compose (external)
docker network create pemweb_net

# 5. Jalankan semua container
docker compose up -d --build

# 6. Cek status
docker compose ps
```

> Pada boot pertama, container otomatis menyiapkan semuanya: generate `src/.env`
> + `APP_KEY`, `composer install`, `migrate`, `storage:link`, lalu seed data awal
> **sekali saja** (ditandai oleh file `src/storage/.seeded`). Boot berikutnya tidak
> akan menimpa data yang sudah kamu isi lewat admin panel.

### Akses

| Halaman | URL |
|---------|-----|
| Website | http://localhost:8080 |
| Admin Panel | http://localhost:8080/admin |
| Database | localhost:13307 |

---

## 🔐 Kredensial Admin

| | |
|--|--|
| Email | `admin@admin.com` |
| Password | `password` |

> ⚠️ **Ganti password ini sebelum deploy.** Kredensial di atas hanya untuk development lokal.

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
    │   │   ├── ContactMessage.php
    │   │   ├── ProfileSetting.php
    │   │   ├── Skill.php
    │   │   ├── Experience.php
    │   │   └── Faq.php
    │   └── Filament/Admin/
    │       ├── Resources/
    │       │   ├── ProjectResource.php
    │       │   ├── ContactMessageResource.php
    │       │   ├── ProfileSettingResource.php
    │       │   ├── SkillResource.php
    │       │   ├── ExperienceResource.php
    │       │   └── FaqResource.php
    │       └── Widgets/
    │           ├── StatsOverviewWidget.php
    │           ├── ProjectsTableWidget.php
    │           └── RecentMessagesWidget.php
    ├── database/
    │   ├── migrations/
    │   └── seeders/
    │       ├── RoleSeeder.php
    │       ├── UserSeeder.php
    │       ├── ProjectSeeder.php
    │       ├── ProfileSettingSeeder.php
    │       ├── SkillSeeder.php
    │       ├── ExperienceSeeder.php
    │       └── FaqSeeder.php
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
Model      → Project, ContactMessage, ProfileSetting, Skill, Experience, Faq, User
View       → Blade templates (layouts + portfolio)
Controller → PortfolioController, ContactController
Admin      → Filament Resources (ProjectResource, ContactMessageResource,
             ProfileSettingResource, SkillResource, ExperienceResource, FaqResource)
```

---

## 🔧 Konfigurasi Penting (.env)

```env
APP_NAME="Portofolio Zefhana Ananda"
APP_URL=http://localhost:8080
DB_HOST=db
DB_DATABASE=uts_pemweb
DB_PASSWORD=secret
FILESYSTEM_DISK=public
```

---

## 🗄️ Data & Reset Database

Semua konten (profil, project, skill, pengalaman, FAQ) dikelola lewat Admin Panel
dan tersimpan di MariaDB.

- Migrasi biasa — **aman, tidak menghapus data**:
  ```bash
  docker exec uts_pemweb_php php artisan migrate
  ```
- **Reset total — ⚠️ menghapus SEMUA data** (termasuk pesan dari form kontak):
  ```bash
  docker exec uts_pemweb_php php artisan project:init
  ```
  Perintah ini menjalankan `migrate:fresh` lalu seed ulang dari kondisi nol.
  Hanya pakai kalau memang ingin kembali ke kondisi awal.

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

## 🤝 Panduan Kontribusi (Contributing)

Meskipun ini adalah project UTS individu, kontribusi atau saran perbaikan (berupa Issue atau Pull Request) sangat dipersilakan:
1. Fork repository ini.
2. Buat branch fitur Anda (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -m 'Menambahkan fitur baru'`).
4. Push ke branch (`git push origin fitur-baru`).
5. Buka Pull Request.

---

## 📄 Lisensi

Project ini dilisensikan di bawah **MIT License**. Anda bebas menggunakan, memodifikasi, dan mendistribusikan kode ini untuk keperluan edukasi maupun komersial.

---

**Status**: ✅ Selesai & Tested  
**Last Updated**: Juni 2026
