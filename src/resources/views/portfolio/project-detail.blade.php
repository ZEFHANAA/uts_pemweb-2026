@extends('layouts.app')

@section('title', $project->title)
@section('meta_description', $project->description)

@section('content')

{{-- ===== HERO HEADER ===== --}}
<section class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600/20 rounded-full blur-3xl"></div>
        <div class="absolute inset-0" style="background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <a href="{{ route('portfolio.home') }}" class="hover:text-white transition">Home</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('portfolio.projects') }}" class="hover:text-white transition">Projects</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-slate-300 font-medium truncate max-w-xs">{{ $project->title }}</span>
        </nav>

        <div class="flex flex-wrap items-start gap-4 mb-4">
            @php
            $statusConfig = [
                'completed'   => 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30',
                'in-progress' => 'bg-blue-500/20 text-blue-300 border-blue-500/30',
                'planning'    => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                'on-hold'     => 'bg-red-500/20 text-red-300 border-red-500/30',
            ];
            $cfg = $statusConfig[$project->status] ?? 'bg-slate-500/20 text-slate-300 border-slate-500/30';
            @endphp
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium border {{ $cfg }}">
                <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                {{ ucfirst(str_replace('-', ' ', $project->status)) }}
            </span>
            @if($project->is_featured)
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/20 text-yellow-300 border border-yellow-500/30">
                ⭐ Featured
            </span>
            @endif
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-4 leading-tight">{{ $project->title }}</h1>
        <p class="text-slate-300 text-lg max-w-2xl leading-relaxed">{{ $project->description }}</p>

        {{-- Quick action buttons --}}
        <div class="flex flex-wrap gap-4 mt-8">
            @if($project->demo_url)
            <a href="{{ $project->demo_url }}" target="_blank"
               class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-5 py-2.5 rounded-xl transition shadow-lg">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Live Demo
            </a>
            @endif
            @if($project->repository_url)
            <a href="{{ $project->repository_url }}" target="_blank"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-5 py-2.5 rounded-xl transition border border-white/20">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                Source Code
            </a>
            @endif
            <a href="{{ route('portfolio.projects') }}"
               class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 text-white font-semibold px-5 py-2.5 rounded-xl transition border border-white/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Semua Projects
            </a>
        </div>
    </div>
</section>

{{-- ===== MAIN CONTENT ===== --}}
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ===== LEFT: Main content ===== --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Project image --}}
                <div class="reveal card overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-72 md:h-96 object-cover">
                    @else
                        <div class="h-72 md:h-96 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 flex items-center justify-center">
                            <div class="text-center text-white">
                                <div class="text-8xl mb-4">💻</div>
                                <p class="text-xl font-bold opacity-80">{{ $project->title }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Project Overview --}}
                <div class="reveal card p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center text-sm">📋</span>
                        Project Overview
                    </h2>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        @if($project->long_description)
                            {!! nl2br(e($project->long_description)) !!}
                        @else
                            <p>{{ $project->description }}</p>
                        @endif
                    </div>
                </div>

                {{-- Technologies --}}
                @if($project->technologies && count($project->technologies) > 0)
                <div class="reveal card p-8">
                    <h2 class="text-2xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center text-sm">⚡</span>
                        Teknologi yang Digunakan
                    </h2>
                    <div class="flex flex-wrap gap-3">
                        @foreach($project->technologies as $tech)
                        <span class="inline-flex items-center gap-2 bg-slate-100 hover:bg-indigo-100 hover:text-indigo-700 text-slate-700 px-4 py-2 rounded-xl font-medium transition-colors cursor-default">
                            <span class="w-2 h-2 rounded-full bg-indigo-400"></span>
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- ===== RIGHT: Sidebar ===== --}}
            <div class="space-y-6">

                {{-- Progress card --}}
                <div class="reveal card p-6">
                    <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span>📊</span> Progress
                    </h3>
                    <div class="text-center mb-4">
                        <div class="text-5xl font-black text-indigo-600">{{ $project->progress }}<span class="text-2xl text-slate-400">%</span></div>
                        <p class="text-slate-500 text-sm mt-1">Completion</p>
                    </div>
                    <div class="h-3 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000"
                             style="width:{{ $project->progress }}%; background:linear-gradient(90deg,#4f46e5,#7c3aed)"></div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-slate-100">
                        <p class="text-xs text-slate-400 mb-2 uppercase tracking-wider font-medium">Status</p>
                        @php
                        $statusBadge = [
                            'completed'   => 'bg-emerald-100 text-emerald-700',
                            'in-progress' => 'bg-blue-100 text-blue-700',
                            'planning'    => 'bg-amber-100 text-amber-700',
                            'on-hold'     => 'bg-red-100 text-red-700',
                        ][$project->status] ?? 'bg-slate-100 text-slate-700';
                        @endphp
                        <span class="badge {{ $statusBadge }} text-sm font-semibold px-3 py-1.5">
                            {{ ucfirst(str_replace('-', ' ', $project->status)) }}
                        </span>
                    </div>
                </div>

                {{-- Timeline --}}
                @if($project->start_date || $project->end_date)
                <div class="reveal reveal-delay-1 card p-6">
                    <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span>📅</span> Timeline
                    </h3>
                    <div class="space-y-4">
                        @if($project->start_date)
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">Mulai</span>
                            <span class="text-sm font-semibold text-slate-900">{{ $project->start_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->end_date)
                        <div class="flex justify-between items-center py-2 border-b border-slate-100">
                            <span class="text-sm text-slate-500">Selesai</span>
                            <span class="text-sm font-semibold text-slate-900">{{ $project->end_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->start_date && $project->end_date)
                        <div class="flex justify-between items-center py-2">
                            <span class="text-sm text-slate-500">Durasi</span>
                            <span class="text-sm font-semibold text-indigo-600">
                                {{ $project->start_date->diffInDays($project->end_date) }} hari
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Quick Links --}}
                @if($project->demo_url || $project->repository_url)
                <div class="reveal reveal-delay-2 card p-6">
                    <h3 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <span>🔗</span> Links
                    </h3>
                    <div class="space-y-3">
                        @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank"
                           class="flex items-center gap-3 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-3 rounded-xl font-semibold transition text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Live Demo
                        </a>
                        @endif
                        @if($project->repository_url)
                        <a href="{{ $project->repository_url }}" target="_blank"
                           class="flex items-center gap-3 bg-slate-900 hover:bg-slate-700 text-white px-4 py-3 rounded-xl font-semibold transition text-sm">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            Source Code
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                {{-- CTA --}}
                <div class="reveal reveal-delay-3 rounded-2xl p-6 bg-gradient-to-br from-indigo-600 to-purple-600 text-white">
                    <h3 class="font-bold text-lg mb-2">Tertarik?</h3>
                    <p class="text-indigo-100 text-sm mb-4 leading-relaxed">Ingin project serupa? Mari diskusikan kebutuhan Anda bersama saya.</p>
                    <a href="{{ route('portfolio.contact') }}"
                       class="block text-center bg-white text-indigo-600 font-bold px-4 py-3 rounded-xl hover:bg-indigo-50 transition text-sm">
                        Hubungi Saya →
                    </a>
                </div>
            </div>
        </div>

        {{-- ===== RELATED PROJECTS ===== --}}
        @php
        $relatedProjects = \App\Models\Project::where('id', '!=', $project->id)
            ->ordered()->limit(3)->get();
        @endphp

        @if($relatedProjects->count() > 0)
        <div class="mt-20">
            <div class="flex items-end justify-between mb-8">
                <h2 class="text-2xl font-bold text-slate-900">Project Lainnya</h2>
                <a href="{{ route('portfolio.projects') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm flex items-center gap-1">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                $gradients = ['from-indigo-500 to-purple-600','from-purple-500 to-pink-600','from-blue-500 to-indigo-600'];
                @endphp
                @foreach($relatedProjects as $i => $rel)
                <div class="reveal reveal-delay-{{ $i + 1 }} card group hover:-translate-y-1">
                    <div class="h-40 bg-gradient-to-br {{ $gradients[$i % 3] }} flex items-center justify-center overflow-hidden">
                        @if($rel->image)
                            <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover opacity-80 group-hover:scale-110 transition duration-500">
                        @else
                            <span class="text-white text-4xl">💻</span>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $rel->title }}</h3>
                        <p class="text-slate-500 text-sm mb-4 leading-relaxed">{{ Str::limit($rel->description, 80) }}</p>
                        <a href="{{ route('portfolio.project', $rel) }}"
                           class="inline-flex items-center gap-1 text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">
                            Lihat Detail
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
