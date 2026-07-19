<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('redirects an anonymous visitor from the admin panel to login', function () {
    $this->get('/admin')
        ->assertRedirect('/admin/login');
});

it('rejects invalid admin credentials', function () {
    User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('correct-password'),
    ]);

    $this->from('/admin/login')->post('/admin/login', [
        'email' => 'admin@example.com',
        'password' => 'wrong-password',
    ])->assertRedirect('/admin/login')
        ->assertSessionHasErrors('email');

    $this->assertGuest('web');
});

it('authenticates valid credentials and grants dashboard access', function () {
    $user = User::factory()->create([
        'email' => 'admin@example.com',
        'password' => Hash::make('correct-password'),
    ]);

    $this->post('/admin/login', [
        'email' => 'admin@example.com',
        'password' => 'correct-password',
    ])->assertRedirect('/admin');

    $this->assertAuthenticatedAs($user, 'web');
    $this->get('/admin')->assertOk();
});

it('logs out and protects the dashboard afterwards', function () {
    $user = User::factory()->create();

    $this->actingAs($user, 'web')
        ->post('/admin/logout')
        ->assertRedirect();

    $this->assertGuest('web');
    $this->get('/admin')->assertRedirect('/admin/login');
});
