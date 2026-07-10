@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Zefhana Ananda — mahasiswa Teknik Informatika, Full-Stack Developer. Proyek Laravel, PHP, Tailwind CSS, dan MariaDB.')

@section('content')
@php
    $name = $profile->name ?? 'Zefhana Ananda';
    $firstName = explode(' ', $name)[0];
    $title = $profile->title ?? 'Full-Stack Developer';
    $statusConfig = [
        'completed'   => ['label' => 'Selesai', 'class' => 'text-emerald-400'],
        'in-progress' => ['label' => 'Sedang dikerjakan', 'class' => 'text-blue-400'],
        'planning'    => ['label' => 'Perencanaan', 'class' => 'text-amber-400'],
        'on-hold'     => ['label' => 'Ditunda', 'class' => 'text-red-400'],
    ];
@endphp

{{-- HERO --}}
<section class="relative flex items-center pt-28 pb-16 overflow-hidden lg:min-h-screen">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(99,102,241,.15),transparent_42%),radial-gradient(circle_at_82%_18%,rgba(255,255,255,.04),transparent_32%)] pointer-events-none"></div>
    <div class="relative w-full max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.18fr)_360px] gap-10 lg:gap-14 items-center">

            <div class="flex flex-col items-start animate-fade-in-up">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3 py-1.5 text-xs font-medium text-white/55">
                    <span class="relative flex h-1.5 w-1.5">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400/70"></span>
                        <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    </span>
                    Tersedia untuk proyek baru
                </span>

                <h1 class="mt-6 text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight leading-[0.95] text-white animate-slide-in-left">
                    {{ $name }}
                </h1>

                <p class="mt-8 text-lg text-white/65 leading-relaxed max-w-xl animate-fade-in">
                    {{ $profile->sub_title ?? 'Membangun aplikasi web menggunakan Laravel dan Tailwind CSS. Berfokus pada pengembangan aplikasi yang terstruktur, cepat, dan mudah digunakan.' }}
                </p>

                <div class="mt-3 flex items-center gap-2.5 text-sm text-white/45 animate-fade-in">
                    <span class="text-white/25">▸</span>
                    Saat ini sedang eksplorasi Laravel 12, Filament v3, dan Docker
                </div>

                <div class="mt-9 flex flex-wrap gap-3 animate-fade-in">
                    <a href="{{ route('portfolio.projects') }}" class="btn-primary">
                        Lihat proyek
                    </a>
                    <a href="{{ route('portfolio.contact') }}" class="btn-secondary">
                        Hubungi saya
                    </a>
                </div>

                <div class="mt-12 grid grid-cols-3 gap-3 w-full max-w-xl animate-fade-in">
                    <div class="stats-card p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-white">{{ $projectCount }}</div>
                        <div class="mt-1 text-sm text-white/40">proyek</div>
                    </div>
                    <div class="stats-card p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-white">{{ $profile->years_of_experience_offset ?? 2 }}</div>
                        <div class="mt-1 text-sm text-white/40">tahun belajar</div>
                    </div>
                    <div class="stats-card p-4">
                        <div class="text-2xl sm:text-3xl font-bold text-white">{{ $techStackCount }}</div>
                        <div class="mt-1 text-sm text-white/40">teknologi</div>
                    </div>
                </div>
            </div>

            <div class="lg:justify-self-end w-full max-w-sm animate-slide-in-right">
                <div class="profile-card p-6 shadow-[0_20px_60px_rgba(0,0,0,.4)]">
                    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/30 to-transparent"></div>
                    <div class="flex items-center gap-4">
                        @if($profile && $profile->avatar_path)
                            <img src="{{ asset('storage/' . $profile->avatar_path) }}" alt="{{ $name }}" class="w-14 h-14 rounded-2xl object-cover border border-white/10">
                        @else
                            <div class="flex w-14 h-14 items-center justify-center rounded-2xl bg-indigo-600 text-base font-bold text-white shadow-lg shadow-indigo-950/50">
                                {{ $profile ? collect(explode(' ', $profile->name))->map(fn($n) => $n[0])->take(2)->implode('') : 'ZA' }}
                            </div>
                        @endif
                        <div>
                            <h2 class="text-base font-semibold text-white">{{ $name }}</h2>
                            <p class="text-sm text-white/45">{{ $title }}</p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-2.5">
                        <div class="rounded-xl border border-white/[0.06] bg-black/20 px-4 py-3">
                            <div class="text-[10px] uppercase tracking-[0.18em] text-white/30">Universitas</div>
                            <div class="mt-0.5 text-sm font-medium text-white">Esa Unggul</div>
                        </div>
                        <div class="rounded-xl border border-white/[0.06] bg-black/20 px-4 py-3">
                            <div class="text-[10px] uppercase tracking-[0.18em] text-white/30">Status</div>
                            <div class="mt-0.5 text-sm font-medium text-white">Mahasiswa TI, angkatan 2024</div>
                        </div>
                        <div class="rounded-xl border border-white/[0.06] bg-black/20 px-4 py-3">
                            <div class="text-[10px] uppercase tracking-[0.18em] text-white/30">Lokasi</div>
                            <div class="mt-0.5 text-sm font-medium text-white">{{ $profile->location ?? 'Indonesia' }}</div>
                        </div>
                        @if($profile->email)
                        <div class="rounded-xl border border-white/[0.06] bg-black/20 px-4 py-3">
                            <div class="text-[10px] uppercase tracking-[0.18em] text-white/30">Email</div>
                            <a href="mailto:{{ $profile->email }}" class="mt-0.5 inline-block text-sm font-medium text-indigo-300 hover:text-indigo-200">{{ $profile->email }}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ABOUT --}}
<section class="py-20 border-t border-white/[0.08]">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-12">

            <div>
                <h2 class="section-title mb-4">Tentang saya</h2>
                <div class="text-white/60 leading-relaxed space-y-4">
                    {!! $profile->about_me ?? '<p>Saya belajar membangun aplikasi web dari nol — mulai dari database, backend, sampai tampilan yang bisa dipakai user. Sekarang fokus di Laravel dan Tailwind CSS.</p>' !!}
                </div>
            </div>

            <div class="flex flex-col gap-6 mt-2 lg:mt-0 font-mono">
                @foreach($skillGroups as $group)
                    @if($group['skills']->count() > 0)
                        <div>
                            <h3 class="text-[11px] font-semibold text-indigo-400/70 uppercase tracking-[0.2em] mb-2.5">{{ $group['title'] }}</h3>
                            <div class="flex flex-wrap gap-1.5">
                                @foreach($group['skills'] as $skill)
                                    <span class="px-2.5 py-1 text-xs text-white/55 bg-white/[0.02] border border-white/[0.06] rounded-md hover:bg-indigo-500/10 hover:text-indigo-300 hover:border-indigo-500/20 transition cursor-default">
                                        {{ $skill->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>

    </div>
</section>

{{-- EXPERIENCES --}}
@if($experiences->count() > 0)
<section class="py-20 border-t border-white/[0.08]">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="section-title mb-8">Pengalaman belajar</h2>

        <div class="space-y-3">
            @foreach($experiences as $exp)
                <div class="card-hover flex gap-4 p-5">
                    <div class="text-sm font-semibold text-indigo-400 whitespace-nowrap">{{ $exp->year }}</div>
                    <div>
                        <h3 class="font-semibold text-white">{{ $exp->title }}</h3>
                        <p class="mt-1 text-sm text-white/55">{{ $exp->description }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- PROJECTS --}}
<section class="py-20 border-t border-white/[0.08]">
    <div class="max-w-6xl mx-auto px-4">

        <div class="flex justify-between items-end mb-8">
            <h2 class="section-title">Proyek pilihan</h2>
            <a href="{{ route('portfolio.projects') }}" class="text-sm text-indigo-400 hover:text-indigo-300 transition">
                Lihat semua →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @forelse($featuredProjects as $project)
                @php $status = $statusConfig[$project->status] ?? ['label' => ucfirst($project->status), 'class' => 'text-white/50']; @endphp
                <a href="{{ route('portfolio.project', $project) }}" class="group card-hover overflow-hidden block">
                    <div class="relative h-40 bg-white/5 overflow-hidden">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="project-card-image w-full h-full object-cover transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-950/25 to-purple-950/15">
                                <span class="text-3xl font-bold text-white/10">{{ strtoupper(substr($project->title, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h3 class="font-semibold text-white group-hover:text-indigo-400 transition leading-snug">{{ $project->title }}</h3>
                            <span class="text-xs {{ $status['class'] }} whitespace-nowrap">{{ $status['label'] }}</span>
                        </div>
                        <p class="text-sm text-white/55 leading-relaxed line-clamp-2">{{ $project->description }}</p>

                        <div class="mt-4 flex flex-wrap gap-1.5">
                            @foreach(array_slice($project->technologies ?? [], 0, 3) as $tech)
                                <span class="text-xs text-white/40 bg-white/5 px-2 py-0.5 rounded">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            @empty
                <div class="md:col-span-3 text-center py-12 card">
                    <p class="text-white/50">Belum ada proyek yang ditampilkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

{{-- CONTACT CTA --}}
<section class="py-20 border-t border-white/[0.08]">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <h2 class="section-title mb-3">Melihat kode sumber atau membahas proyek?</h2>
        <p class="text-white/50 mb-8">Saya lebih sering aktif di GitHub dan LinkedIn. Jika Anda memiliki pertanyaan atau masukan, silakan kirimkan pesan.</p>
        <a href="{{ route('portfolio.contact') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-xl transition">
            Kontak saya
        </a>
    </div>
</section>

@endsection
