<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kredensial admin bisa di-override lewat .env, supaya tidak ada
        // password default yang ikut ter-deploy. Fallback = nilai development.
        $adminEmail = env('ADMIN_EMAIL', 'admin@admin.com');
        $adminPassword = env('ADMIN_PASSWORD', 'password');

        $user = User::firstOrCreate(
            ['email' => $adminEmail],
            ['name' => 'Super Admin', 'password' => Hash::make($adminPassword)]
        );
        $user->assignRole('super_admin');

        $user = User::firstOrCreate(
            ['email' => 'user@admin.com'],
            ['name' => 'User Account', 'password' => Hash::make('password')]
        );
        $user->assignRole('user');
    }
}
