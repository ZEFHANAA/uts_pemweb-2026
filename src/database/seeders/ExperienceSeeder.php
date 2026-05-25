<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'year' => '2026',
                'title' => 'Final Project / Tugas Akhir',
                'description' => 'Membangun aplikasi web portofolio dengan Laravel & Filament',
                'color' => 'indigo',
                'order' => 1
            ],
            [
                'year' => '2025',
                'title' => 'Web Development Projects',
                'description' => 'Pengembangan berbagai proyek web menggunakan Laravel',
                'color' => 'purple',
                'order' => 2
            ],
            [
                'year' => '2024',
                'title' => 'Belajar Programming',
                'description' => 'Mulai belajar PHP, Laravel, dan teknologi web modern',
                'color' => 'pink',
                'order' => 3
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['year' => $exp['year'], 'title' => $exp['title']],
                ['description' => $exp['description'], 'color' => $exp['color'], 'order' => $exp['order']]
            );
        }
    }
}
