@extends('layouts.app')

@section('title', 'Beranda')
@section('meta_description', 'Zefhana Ananda — Full-Stack Web Developer. Spesialis Laravel, PHP, Tailwind CSS, MariaDB, dan Docker.')

@section('content')
@php
    $name = $profile->name ?? 'Zefhana Ananda';
    $title = $profile->title ?? 'Full-Stack Web Developer';
    $statusConfig = [
        'completed'   => ['label' => 'selesai', 'class' => 'text-emerald-400'],
        'in-progress' => ['label' => 'berjalan', 'class' => 'text-blue-400'],
        'planning'    => ['label' => 'rencana', 'class' => 'text-amber-400'],
        'on-hold'     => ['label' => 'ditunda', 'class' => 'text-red-400'],
    ];
@endphp

{{-- HERO --}}
<section class="pt-32 pb-16 border-b border-white/[0.08]">
    <div class="max-w-5xl mx-auto px-5">
        <div class="flex flex-col lg:flex-row items-start justify-between gap-12">

            <div class="w-full lg:w-[60%]">
                <div class="font-mono text-xs text-amber-500 mb-4">$ whoami</div>

                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-[1.1] text-white">
                    {{ $name }}
                </h1>
                <p class="mt-2 font-mono text-sm text-white/50">{{ $title }}</p>

                <p class="mt-6 text-base leading-relaxed max-w-xl text-white/70">
                    {{ $profile->sub_title ?? 'Suka membangun aplikasi web dari nol menggunakan Laravel & Tailwind CSS. Berfokus pada struktur kode yang bersih, performa cepat, dan antarmuka yang nyaman digunakan.' }}
                </p>

                <div class="mt-6 font-mono text-xs text-white/40">
                    Laravel · PHP · Tailwind CSS · Docker · MariaDB
                </div>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('portfolio.projects') }}" class="btn-primary">Lihat proyek</a>
                    <a href="{{ route('portfolio.contact') }}" class="btn-secondary">Hubungi saya</a>
                </div>
            </div>

            {{-- INFO CARD --}}
            <div class="w-full lg:w-[36%] shrink-0 lg:mt-2">
                <div class="card p-5 font-mono text-xs">
                    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-white/[0.08]">
                        @if($profile && $profile->avatar)
                            <img src="{{ asset('storage/' . $profile->avatar) }}" alt="{{ $name }}" class="h-11 w-11 rounded-sm object-cover border border-white/10">
                        @else
                            <div class="flex h-11 w-11 items-center justify-center rounded-sm bg-amber-500 text-sm font-bold text-black">
                                {{ $profile ? collect(explode(' ', $profile->name))->map(fn($n) => $n[0])->take(2)->implode('') : 'ZA' }}
                            </div>
                        @endif
                        <div>
                            <div class="text-white font-semibold">{{ $name }}</div>
                            <div class="text-white/40">{{ $title }}</div>
                        </div>
                    </div>

                    <div class="space-y-2.5 text-white/50">
                        <div class="flex justify-between"><span>fokus</span><span class="text-white/80">web app &amp; api</span></div>
                        <div class="flex justify-between"><span>lokasi</span><span class="text-white/80">{{ $profile->location ?? 'Indonesia' }}</span></div>
                        @if($profile && $profile->email)
                        <div class="flex justify-between"><span>email</span><a href="mailto:{{ $profile->email }}" class="text-amber-400 hover:underline">{{ $profile->email }}</a></div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ABOUT --}}
<section class="py-16 border-b border-white/[0.08]">
    <div class="max-w-5xl mx-auto px-5">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-12">
            <div>
                <h2 class="section-title mb-5">Tentang</h2>
                <div class="leading-relaxed text-sm sm:text-base text-white/70">
                    {!! $profile->about_me ?? '<p>Saya senang belajar membangun aplikasi web dari nol — mulai dari perancangan database, pembuatan backend dengan Laravel, sampai memoles antarmuka pengguna agar nyaman dan cepat diakses.</p>' !!}
                </div>
            </div>

            <div class="flex flex-col gap-5 font-mono text-xs">
                @foreach($skillGroups as $group)
                    @if($group['skills']->count() > 0)
                        <div>
                            <div class="text-white/40 mb-2">// {{ strtolower($group['title']) }}</div>
                            <div class="flex flex-wrap gap-x-3 gap-y-1.5 text-white/70">
                                @foreach($group['skills'] as $skill)
                                    <span>{{ $skill->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- PROJECTS --}}
<section class="py-16 border-b border-white/[0.08]">
    <div class="max-w-5xl mx-auto px-5">

        <div class="flex justify-between items-end mb-8">
            <h2 class="section-title">Proyek</h2>
            <a href="{{ route('portfolio.projects') }}" class="font-mono text-xs text-white/50 hover:text-amber-400 transition-colors">semua →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-white/[0.08]">
            @forelse($featuredProjects as $project)
                @php $status = $statusConfig[$project->status] ?? ['label' => strtolower($project->status), 'class' => 'text-white/50']; @endphp
                <a href="{{ route('portfolio.project', $project) }}" class="group bg-[#0a0a0a] hover:bg-white/[0.03] transition-colors flex flex-col justify-between p-5">
                    <div>
                        <div class="flex items-start justify-between gap-2 mb-3">
                            <h3 class="font-bold text-sm text-white group-hover:text-amber-400 transition-colors leading-snug">{{ $project->title }}</h3>
                            <span class="font-mono text-[10px] {{ $status['class'] }} whitespace-nowrap">{{ $status['label'] }}</span>
                        </div>
                        <p class="text-xs leading-relaxed text-white/50 line-clamp-3">{{ $project->description }}</p>
                    </div>

                    @if($project->technologies)
                    <div class="mt-4 font-mono text-[10px] text-white/35">
                        {{ implode(' · ', array_slice($project->technologies ?? [], 0, 3)) }}
                    </div>
                    @endif
                </a>
            @empty
            @endforelse
        </div>
        @if($featuredProjects->isEmpty())
        <div class="text-center py-12 border border-white/[0.08]">
            <p class="text-sm text-white/50">Belum ada proyek yang ditampilkan.</p>
        </div>
        @endif

    </div>
</section>

{{-- CONTACT CTA --}}
<section class="py-16">
    <div class="max-w-2xl mx-auto px-5 text-center">
        <h2 class="section-title mb-3">Tertarik membahas proyek atau diskusi?</h2>
        <p class="mb-6 text-sm sm:text-base leading-relaxed text-white/60">Saya terbuka untuk diskusi seputar proyek web, pertukaran ide, maupun masukan kodingan.</p>
        <a href="{{ route('portfolio.contact') }}" class="btn-primary">Hubungi Saya</a>
    </div>
</section>

@endsection
