<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProfileSetting;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    /**
     * Return the persisted profile or an in-memory fallback for fresh installs
     * and isolated test databases. The fallback is never written to storage.
     */
    private function profile(): ProfileSetting
    {
        return ProfileSetting::first() ?? new ProfileSetting([
            'name' => 'Zefhana',
            'title' => 'Beginner Developer',
            'sub_title' => 'Belajar dan membangun aplikasi web secara bertahap dengan fokus pada solusi yang terstruktur dan mudah digunakan.',
            'about_me' => '<p>Saya seorang developer pemula dari Indonesia yang sedang mendalami Python, C++, dan pengembangan web.</p>',
            'email' => 'azefhana@gmail.com',
            'location' => 'Indonesia',
            'github_url' => 'https://github.com/ZEFHANAA',
            'linkedin_url' => 'https://www.linkedin.com/in/zefhana-a-576275307/',
            'project_count_offset' => 0,
            'years_of_experience_offset' => 0,
            'tech_stack_count_offset' => 0,
        ]);
    }
    /**
     * Show home/about page
     */
    public function home(): View
    {
        $featuredProjects = Project::featured()->ordered()->published()->limit(3)->get();
        $profile = $this->profile();
        $skills = Skill::orderBy('order')->get();
        $experiences = Experience::orderBy('order')->get();

        // Group skills for the home page structure
        $skillGroups = [
            [
                'icon' => '⚙️',
                'title' => 'Backend',
                'color' => 'indigo',
                'skills' => $skills->where('group', 'backend'),
            ],
            [
                'icon' => '🎨',
                'title' => 'Frontend',
                'color' => 'purple',
                'skills' => $skills->where('group', 'frontend'),
            ],
            [
                'icon' => '🗄️',
                'title' => 'Database',
                'color' => 'emerald',
                'skills' => $skills->where('group', 'database'),
            ],
            [
                'icon' => '🔧',
                'title' => 'DevOps & Tools',
                'color' => 'orange',
                'skills' => $skills->where('group', 'devops'),
            ],
        ];

        return view('portfolio.home', [
            'featuredProjects' => $featuredProjects,
            'profile' => $profile,
            'skills' => $skills,
            'skillGroups' => $skillGroups,
            'experiences' => $experiences,
            'projectCount' => (($profile->project_count_offset ?? 0) + Project::count()),
            'techStackCount' => (($profile->tech_stack_count_offset ?? 0) + Skill::count()),
        ]);
    }

    /**
     * Show all projects
     */
    public function projects(): View
    {
        $projects = Project::ordered()->published()->paginate(12);

        return view('portfolio.projects', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show single project details
     */
    public function projectDetail(Project $project): View
    {
        abort_unless($project->is_published, 404);

        $relatedProjects = Project::where('id', '!=', $project->id)
            ->published()
            ->ordered()
            ->limit(3)
            ->get();

        return view('portfolio.project-detail', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
        ]);
    }

    /**
     * Show contact page
     */
    public function contact(): View
    {
        $profile = $this->profile();
        $faqs = Faq::orderBy('order')->get();

        return view('portfolio.contact', [
            'profile' => $profile,
            'faqs' => $faqs,
        ]);
    }
}

