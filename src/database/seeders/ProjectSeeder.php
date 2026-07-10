<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Seed proyek aktual portfolio.
     * Urutan = urutan tampil di halaman proyek.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Petawisata',
                'slug' => 'petawisata',
                'description' => 'Website pencarian lokasi wisata Indonesia dengan fitur pencarian dan penyimpanan lokasi.',
                'long_description' => "Aplikasi web untuk mencari dan menyimpan destinasi wisata di seluruh Indonesia. Fitur: pencarian lokasi berbasis nama, kategori wisata, dan fitur simpan ke akun pengguna. Dibangun dengan Laravel dan MariaDB.\n\nDiakses publik di petawisata.my.id.",
                'technologies' => ['Laravel', 'PHP', 'MariaDB', 'Tailwind CSS'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2026-06-01',
                'end_date' => '2026-07-06',
                'repository_url' => 'https://github.com/ZEFHANAA/project_pemweb-2026',
                'demo_url' => 'https://petawisata.my.id',
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Portofolio Pribadi',
                'slug' => 'portofolio-pribadi',
                'description' => 'Website portofolio dinamis dengan admin panel Filament.',
                'long_description' => "Website portofolio full-stack yang dibangun sebagai UTS Pemrograman Web. Seluruh konten (profil, proyek, pengalaman, skill, FAQ) dikelola melalui admin panel Filament v3. Frontend memakai Blade + Tailwind CSS, build aset via Vite, basis data MariaDB.\n\nDiakses publik di profile.petawisata.my.id.",
                'technologies' => ['Laravel 12', 'Filament v3', 'MariaDB', 'Tailwind CSS', 'Vite'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2026-05-18',
                'end_date' => '2026-06-01',
                'repository_url' => 'https://github.com/ZEFHANAA/uts_pemweb-2026',
                'demo_url' => 'https://profile.petawisata.my.id',
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Simanis',
                'slug' => 'simanis',
                'description' => 'Sistem informasi manajemen berbasis web.',
                'long_description' => "Aplikasi web untuk manajemen data dengan fitur CRUD, autentikasi pengguna, dan tampilan responsif. Dibangun dengan Laravel dan PHP.",
                'technologies' => ['Laravel', 'PHP', 'MariaDB'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2026-04-01',
                'end_date' => '2026-05-11',
                'repository_url' => 'https://github.com/ZEFHANAA/simanis',
                'demo_url' => null,
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'AUTO-PW',
                'slug' => 'auto-pw',
                'description' => 'Tool otomasi berbasis Python.',
                'long_description' => "Script Python untuk otomasi tugas-tugas spesifik. Dibangun dengan Python dan library pendukung untuk mempermudah alur kerja berulang.",
                'technologies' => ['Python'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2026-05-01',
                'end_date' => '2026-06-12',
                'repository_url' => 'https://github.com/ZEFHANAA/AUTO-PW',
                'demo_url' => null,
                'order' => 4,
                'is_featured' => false,
            ],
            [
                'title' => 'Sistem Manajemen Jadwal Kuliah',
                'slug' => 'sistem-manajemen-jadwal-kuliah',
                'description' => 'Aplikasi desktop manajemen jadwal kuliah berbasis OOP.',
                'long_description' => "Sistem manajemen jadwal kuliah yang dibangun dengan prinsip Object-Oriented Programming (OOP). Aplikasi desktop berbasis Java untuk membantu mahasiswa mengatur jadwal perkuliahan.",
                'technologies' => ['Java'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2025-12-01',
                'end_date' => '2026-01-19',
                'repository_url' => 'https://github.com/ZEFHANAA/Sistem-Manajemen-Jadwal-Kuliah-PBO',
                'demo_url' => null,
                'order' => 5,
                'is_featured' => false,
            ],
            [
                'title' => 'SKPL KEL-7',
                'slug' => 'skpl-kel-7',
                'description' => 'Proyek kelompok mata kuliah SKPL.',
                'long_description' => "Proyek pengembangan web kelompok 7 mata kuliah SKPL. Dibangun dengan JavaScript.",
                'technologies' => ['JavaScript'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => '2025-11-01',
                'end_date' => '2026-01-08',
                'repository_url' => 'https://github.com/ZEFHANAA/SKPL-KEL-7',
                'demo_url' => null,
                'order' => 6,
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
