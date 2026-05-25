<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Berapa lama respons?',
                'answer' => 'Saya biasanya merespons dalam 24 jam. Di akhir pekan mungkin sedikit lebih lama.',
                'order' => 1
            ],
            [
                'question' => 'Apakah tersedia untuk freelance?',
                'answer' => 'Ya! Saya terbuka untuk project freelance. Mari diskusikan kebutuhan Anda.',
                'order' => 2
            ],
            [
                'question' => 'Teknologi apa yang dikuasai?',
                'answer' => 'Laravel, Vue.js, React, Tailwind CSS, MySQL, Docker, dan banyak lagi.',
                'order' => 3
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                ['answer' => $faq['answer'], 'order' => $faq['order']]
            );
        }
    }
}
