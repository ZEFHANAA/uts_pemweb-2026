<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProfileSetting;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Faq;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Show home/about page
     */
    public function home()
    {
        $featuredProjects = Project::featured()->ordered()->limit(3)->get();
        $profile = ProfileSetting::first();
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
    public function projects()
    {
        $projects = Project::ordered()->paginate(12);
        
        return view('portfolio.projects', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show single project details
     */
    public function projectDetail(Project $project)
    {
        $relatedProjects = Project::where('id', '!=', $project->id)
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
    public function contact()
    {
        $profile = ProfileSetting::first();
        $faqs = Faq::orderBy('order')->get();

        return view('portfolio.contact', [
            'profile' => $profile,
            'faqs' => $faqs,
        ]);
    }
}

