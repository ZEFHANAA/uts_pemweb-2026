@extends('layouts.app')

@section('title', 'Halaman tidak ditemukan')
@section('meta_description', 'Halaman yang Anda cari tidak tersedia.')

@section('content')
<section class="pt-32 pb-24 flex items-center">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="font-mono text-7xl sm:text-8xl font-bold tracking-tight text-white/10">404</div>
        <h1 class="mt-6 text-2xl sm:text-3xl font-semibold text-white tracking-tight">Halaman tidak ditemukan</h1>
        <p class="mt-4 text-white/50 leading-relaxed">
            Tautan mungkin sudah berubah atau halaman sudah tidak tersedia. Coba kembali ke beranda.
        </p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="{{ route('portfolio.home') }}" class="btn-primary">
                Kembali ke beranda
            </a>
            <a href="{{ route('portfolio.projects') }}" class="btn-secondary">
                Lihat proyek
            </a>
        </div>
    </div>
</section>
@endsection
