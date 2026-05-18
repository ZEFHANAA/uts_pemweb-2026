<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'A complete e-commerce solution with shopping cart, payment integration, and admin panel.',
                'long_description' => 'Built a full-featured e-commerce platform with Laravel 12 and Vue.js. Features include product catalog, shopping cart, secure payment gateway integration with Stripe, user authentication, order management, and a comprehensive admin dashboard for managing inventory and sales.',
                'technologies' => ['Laravel 12', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Stripe API'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => now()->subMonths(6),
                'end_date' => now()->subMonths(2),
                'repository_url' => 'https://github.com/user/ecommerce-platform',
                'demo_url' => 'https://ecommerce.example.com',
                'order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Task Management App',
                'slug' => 'task-management-app',
                'description' => 'A collaborative task management application with real-time updates and team features.',
                'long_description' => 'Created a modern task management application using Laravel with Filament admin panel. Features include task creation, assignment, priority levels, progress tracking, team collaboration, and real-time notifications using WebSockets.',
                'technologies' => ['Laravel 12', 'Filament', 'React', 'WebSockets', 'PostgreSQL'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => now()->subMonths(4),
                'end_date' => now()->subMonths(1),
                'repository_url' => 'https://github.com/user/task-manager',
                'demo_url' => 'https://tasks.example.com',
                'order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Analytics Dashboard',
                'slug' => 'analytics-dashboard',
                'description' => 'Real-time analytics dashboard for monitoring business metrics and KPIs.',
                'long_description' => 'Developed a comprehensive analytics dashboard that displays real-time data visualization of business metrics. Includes customizable widgets, multiple chart types, data export functionality, and role-based access control.',
                'technologies' => ['Laravel', 'Chart.js', 'TailwindCSS', 'MySQL'],
                'status' => 'in-progress',
                'progress' => 75,
                'start_date' => now()->subMonths(2),
                'end_date' => null,
                'repository_url' => 'https://github.com/user/analytics-dashboard',
                'demo_url' => null,
                'order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'Social Media API',
                'slug' => 'social-media-api',
                'description' => 'RESTful API for a social media platform with user management and feed generation.',
                'long_description' => 'Built a robust REST API for a social media application. Includes user authentication, post creation/deletion, following system, comment threads, and advanced filtering capabilities. Fully documented with API documentation and test coverage.',
                'technologies' => ['Laravel', 'MySQL', 'JWT Auth', 'Docker'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => now()->subMonths(5),
                'end_date' => now()->subMonths(2),
                'repository_url' => 'https://github.com/user/social-media-api',
                'demo_url' => 'https://api.social.example.com',
                'order' => 4,
                'is_featured' => false,
            ],
            [
                'title' => 'Blog Platform',
                'slug' => 'blog-platform',
                'description' => 'A modern blogging platform with markdown support and SEO optimization.',
                'long_description' => 'Designed and implemented a feature-rich blogging platform with markdown editor, categories, tags, search functionality, and SEO optimization. Includes social sharing, comments system, and automatic sitemap generation.',
                'technologies' => ['Laravel', 'Vue.js', 'Markdown.js', 'MySQL', 'Tailwind CSS'],
                'status' => 'completed',
                'progress' => 100,
                'start_date' => now()->subMonths(3),
                'end_date' => now()->subMonth(),
                'repository_url' => 'https://github.com/user/blog-platform',
                'demo_url' => 'https://blog.example.com',
                'order' => 5,
                'is_featured' => false,
            ],
            [
                'title' => 'Inventory Management System',
                'slug' => 'inventory-management',
                'description' => 'Enterprise inventory management system with barcode scanning and real-time tracking.',
                'long_description' => 'Developed a comprehensive inventory management system for warehouse operations. Features include barcode scanning, stock level tracking, automated reordering, supplier management, and detailed reporting with historical data analysis.',
                'technologies' => ['Laravel', 'Filament', 'MySQL', 'Barcode.js'],
                'status' => 'planning',
                'progress' => 20,
                'start_date' => now(),
                'end_date' => null,
                'repository_url' => null,
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

