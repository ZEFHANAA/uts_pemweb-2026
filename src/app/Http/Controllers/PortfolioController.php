<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Show home/about page
     */
    public function home()
    {
        $featuredProjects = Project::featured()->ordered()->limit(3)->get();
        
        return view('portfolio.home', [
            'featuredProjects' => $featuredProjects,
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
        return view('portfolio.project-detail', [
            'project' => $project,
        ]);
    }

    /**
     * Show contact page
     */
    public function contact()
    {
        return view('portfolio.contact');
    }
}

