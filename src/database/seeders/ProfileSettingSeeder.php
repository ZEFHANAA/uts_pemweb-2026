<?php

namespace Database\Seeders;

use App\Models\ProfileSetting;
use Illuminate\Database\Seeder;

class ProfileSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileSetting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Zefhana Ananda',
                'title' => 'Full-Stack Developer',
                'sub_title' => 'Saya membangun aplikasi web yang skalabel, modern, dan berkesan — dari backend yang robust hingga UI yang elegan.',
                'about_me' => '<p>Saya <strong class="text-slate-900">Zefhana Ananda</strong>, seorang mahasiswa yang sedang menempuh pendidikan dan passionate dalam dunia <strong class="text-slate-900">Full-Stack Web Development</strong>. Saya memiliki keahlian dalam membangun aplikasi web yang skalabel, modern, dan berdampak.</p><p>Dengan menguasai berbagai teknologi mulai dari backend (Laravel/PHP) hingga frontend (Vue.js, Tailwind CSS), saya menghadirkan solusi digital yang tidak hanya fungsional, tetapi juga indah secara visual.</p>',
                'avatar_path' => null,
                'email' => 'zefhana@example.com',
                'phone' => '+62 812 345 678',
                'location' => 'Indonesia',
                'github_url' => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'project_count_offset' => 6,
                'years_of_experience_offset' => 2,
                'tech_stack_count_offset' => 10,
            ]
        );
    }
}
