<?php

use App\Models\Project;
use App\Models\ProfileSetting;

it('uses persisted profile settings when they are available', function () {
    ProfileSetting::create([
        'name' => 'Stored Profile Name',
        'title' => 'Stored Title',
        'sub_title' => 'Stored subtitle for the portfolio.',
        'about_me' => '<p>Stored about content.</p>',
        'email' => 'stored@example.com',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Stored Profile Name')
        ->assertSee('stored@example.com');
});

it('renders every public portfolio page with an empty database', function () {
    $this->get('/')->assertOk()->assertSee('Zefhana');
    $this->get('/projects')->assertOk();
    $this->get('/contact')->assertOk()->assertSee('azefhana@gmail.com');
});

it('renders a project detail using slug route model binding', function () {
    $project = Project::create([
        'title' => 'Petawisata',
        'slug' => 'petawisata',
        'description' => 'Aplikasi peta wisata Indonesia.',
        'long_description' => 'Aplikasi untuk mencari dan menyimpan lokasi wisata.',
        'technologies' => ['Laravel', 'Leaflet'],
        'status' => 'completed',
        'progress' => 100,
        'order' => 1,
        'is_featured' => true,
    ]);

    $this->get(route('portfolio.project', $project))
        ->assertOk()
        ->assertSee('Petawisata')
        ->assertSee('Laravel');
});

it('returns not found for an unknown project slug', function () {
    $this->get('/projects/not-a-real-project')->assertNotFound();
});

it('lists projects in configured order', function () {
    Project::create([
        'title' => 'Second Project',
        'slug' => 'second-project',
        'description' => 'Second description',
        'technologies' => [],
        'status' => 'completed',
        'progress' => 100,
        'order' => 2,
        'is_featured' => false,
    ]);

    Project::create([
        'title' => 'First Project',
        'slug' => 'first-project',
        'description' => 'First description',
        'technologies' => [],
        'status' => 'completed',
        'progress' => 100,
        'order' => 1,
        'is_featured' => false,
    ]);

    $this->get('/projects')
        ->assertOk()
        ->assertSeeInOrder(['First Project', 'Second Project']);
});
