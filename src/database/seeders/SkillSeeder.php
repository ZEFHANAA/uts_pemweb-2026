<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Backend
            ['name' => 'Laravel / PHP', 'level' => 90, 'group' => 'backend', 'order' => 1],
            ['name' => 'Node.js', 'level' => 70, 'group' => 'backend', 'order' => 2],
            ['name' => 'RESTful API', 'level' => 85, 'group' => 'backend', 'order' => 3],

            // Frontend
            ['name' => 'Vue.js / React', 'level' => 75, 'group' => 'frontend', 'order' => 1],
            ['name' => 'Tailwind CSS', 'level' => 90, 'group' => 'frontend', 'order' => 2],
            ['name' => 'JavaScript', 'level' => 80, 'group' => 'frontend', 'order' => 3],

            // Database
            ['name' => 'MySQL / MariaDB', 'level' => 85, 'group' => 'database', 'order' => 1],
            ['name' => 'PostgreSQL', 'level' => 65, 'group' => 'database', 'order' => 2],

            // DevOps & Tools
            ['name' => 'Docker', 'level' => 75, 'group' => 'devops', 'order' => 1],
            ['name' => 'Git / GitHub', 'level' => 88, 'group' => 'devops', 'order' => 2],
            ['name' => 'Linux', 'level' => 70, 'group' => 'devops', 'order' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name'], 'group' => $skill['group']],
                ['level' => $skill['level'], 'order' => $skill['order']]
            );
        }
    }
}
