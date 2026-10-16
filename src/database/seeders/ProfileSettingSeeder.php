<?php

namespace Database\Seeders;

use App\Models\ProfileSetting;
use Illuminate\Database\Seeder;

class ProfileSettingSeeder extends Seeder
{
    /**
     * Seed profil awal.
     *
     * CATATAN:
     * - Data kontak & sosial (email, phone, github_url, linkedin_url) sengaja
     *   dikosongkan — isinya diatur lewat Admin Panel → Profil, supaya data
     *   pribadi tidak ter-hardcode di repo publik.
     * - firstOrCreate (bukan updateOrCreate) supaya re-seed TIDAK menimpa
     *   data yang sudah diisi lewat admin panel.
     * - Offset 0 → angka di halaman = jumlah data asli.
     */
    public function run(): void
    {
        ProfileSetting::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'Zefhana Ananda',
                'title' => 'Full-Stack Web Developer',
                'sub_title' => 'Mahasiswa Teknik Informatika yang membangun aplikasi web dari backend sampai deploy.',
                'about_me' => '<p>Saya <strong class="text-slate-900">Zefhana Ananda</strong>, mahasiswa Teknik Informatika yang senang membangun aplikasi web dari nol — mulai dari perancangan database, backend dengan Laravel, sampai antarmuka yang nyaman dipakai.</p><p>Saya mengerjakan semuanya sendiri, end to end: desain database, API, panel admin, sampai deploy dengan Docker dan Cloudflare. Beberapa aplikasi yang saya bangun sudah berjalan publik dan dipakai orang lain.</p>',
                'avatar_path' => null,

                // Kosong secara sengaja — diisi via Admin Panel, jangan hardcode.
                'email' => null,
                'phone' => null,
                'github_url' => null,
                'linkedin_url' => null,

                'location' => 'Indonesia',

                // 0 = tampilkan jumlah asli (lihat catatan di atas).
                'project_count_offset' => 0,
                'years_of_experience_offset' => 0,
                'tech_stack_count_offset' => 0,
            ]
        );
    }
}
