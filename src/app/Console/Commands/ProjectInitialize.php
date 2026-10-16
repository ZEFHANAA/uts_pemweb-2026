<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectInitialize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Project Initialization';

    /**
     * Execute the console command.
     *
     * ⚠️ PERINGATAN: perintah ini memanggil `migrate:fresh`, artinya SEMUA tabel
     * di-drop dan seluruh data hilang — termasuk konten yang diisi lewat admin
     * panel dan pesan dari form kontak. Jangan dipanggil otomatis saat boot
     * container (lihat php/docker-entrypoint.sh). Pakai `project:update` untuk
     * migrasi biasa.
     */
    public function handle()
    {
        $this->call('migrate:fresh', [
            '--force' => true,
        ]);
        $this->call('shield:generate', [
            '--all' => true,
            '--panel' => 'admin',
        ]);
        $this->call('db:seed', [
            '--force' => true,
        ]);

        $this->call('filament:optimize-clear');
        $this->call('optimize:clear');
    }
}
