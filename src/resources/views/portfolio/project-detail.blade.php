@extends('layouts.app')

@section('title', $project->title)
@section('meta_description', \Illuminate\Support\Str::limit($project->description, 155))

@section('content')

@php
$statusConfig = [
    'completed'   => ['label' => 'selesai', 'class' => 'text-emerald-400'],
    'in-progress' => ['label' => 'berjalan', 'class' => 'text-blue-400'],
    'planning'    => ['label' => 'rencana', 'class' => 'text-amber-400'],
    'on-hold'     => ['label' => 'ditunda', 'class' => 'text-red-400'],
];
$cfg = $statusConfig[$project->status] ?? ['label' => strtolower($project->status), 'class' => 'text-white/50'];
@endphp

<section class="pt-32 pb-8 border-b border-white/[0.08]">
    <div class="max-w-5xl mx-auto px-5">
        <nav class="flex items-center gap-2 font-mono text-xs text-white/30 mb-6">
            <a href="{{ route('portfolio.home') }}" class="hover:text-white transition-colors">beranda</a>
            <span>/</span>
            <a href="{{ route('portfolio.projects') }}" class="hover:text-white transition-colors">proyek</a>
            <span>/</span>
            <span class="text-white/60 truncate max-w-xs">{{ $project->title }}</span>
        </nav>

        <div class="flex flex-wrap items-center gap-3 mb-4 font-mono text-xs">
            <span class="{{ $cfg['class'] }}">{{ $cfg['label'] }}</span>
            @if($project->is_featured)
            <span class="text-amber-400">unggulan</span>
            @endif
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight">{{ $project->title }}</h1>
        <p class="mt-4 text-lg text-white/60 max-w-2xl">{{ $project->description }}</p>

        <div class="flex flex-wrap gap-3 mt-6">
            @if($project->demo_url)
            <a href="{{ $project->demo_url }}" target="_blank" class="btn-primary">Live Demo</a>
            @endif
            @if($project->repository_url)
            <a href="{{ $project->repository_url }}" target="_blank" class="btn-secondary">Repository</a>
            @endif
        </div>
    </div>
</section>

<section class="py-10 pb-24">
    <div class="max-w-5xl mx-auto px-5">
        <div class="grid grid-cols-1 lg:grid-cols-[1.3fr_.7fr] gap-8">

            <div class="space-y-6">
                <div class="card overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-auto object-cover max-h-[400px]">
                    @else
                        <div class="h-56 flex items-center justify-center bg-white/[0.02]">
                            <span class="font-mono text-5xl font-bold text-white/10">{{ strtoupper(substr($project->title, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>

                <div class="card p-6">
                    <h2 class="font-mono text-xs text-amber-500 mb-4">// tentang proyek</h2>
                    <div class="text-white/70 leading-relaxed space-y-3 text-sm">
                        @if($project->long_description)
                            {!! nl2br(e($project->long_description)) !!}
                        @else
                            <p>{{ $project->description }}</p>
                        @endif
                    </div>
                </div>

                @if($project->technologies && count($project->technologies) > 0)
                <div class="card p-6">
                    <h2 class="font-mono text-xs text-amber-500 mb-4">// teknologi</h2>
                    <div class="flex flex-wrap gap-x-4 gap-y-2 font-mono text-sm text-white/70">
                        @foreach($project->technologies as $tech)
                        <span>{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-5">
                <div class="card p-6 font-mono">
                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-white">{{ $project->progress }}<span class="text-lg text-white/30">%</span></div>
                        <p class="text-xs text-white/40 mt-1">progress</p>
                    </div>
                    <div class="h-1 bg-white/[0.08] overflow-hidden">
                        <div class="h-full bg-amber-500" style="width:{{ $project->progress }}%"></div>
                    </div>
                </div>

                @if($project->start_date || $project->end_date)
                <div class="card p-6">
                    <h3 class="font-mono text-xs text-amber-500 mb-4">// timeline</h3>
                    <div class="space-y-3 text-sm font-mono">
                        @if($project->start_date)
                        <div class="flex justify-between">
                            <span class="text-white/45">mulai</span>
                            <span class="text-white">{{ $project->start_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->end_date)
                        <div class="flex justify-between">
                            <span class="text-white/45">selesai</span>
                            <span class="text-white">{{ $project->end_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->start_date && $project->end_date)
                        <div class="flex justify-between pt-2 border-t border-white/[0.08]">
                            <span class="text-white/45">durasi</span>
                            <span class="text-amber-400">{{ $project->start_date->diffInDays($project->end_date) }} hari</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($project->demo_url || $project->repository_url)
                <div class="card p-6">
                    <h3 class="font-mono text-xs text-amber-500 mb-4">// link</h3>
                    <div class="grid grid-cols-1 gap-2">
                        @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" class="btn-primary justify-center">Live Demo</a>
                        @endif
                        @if($project->repository_url)
                        <a href="{{ $project->repository_url }}" target="_blank" class="btn-secondary justify-center">Repository</a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($relatedProjects->count() > 0)
        <div class="mt-20 pt-12 border-t border-white/[0.08]">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-mono text-xs text-amber-500">// proyek lainnya</h2>
                <a href="{{ route('portfolio.projects') }}" class="font-mono text-xs text-white/50 hover:text-amber-400 transition-colors">semua →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-white/[0.08]">
                @foreach($relatedProjects as $rel)
                <a href="{{ route('portfolio.project', $rel) }}" class="group bg-[#0a0a0a] hover:bg-white/[0.03] transition-colors p-5 block">
                    <h3 class="font-bold text-sm text-white group-hover:text-amber-400 transition-colors mb-1">{{ $rel->title }}</h3>
                    <p class="text-xs text-white/50 line-clamp-2">{{ $rel->description }}</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
