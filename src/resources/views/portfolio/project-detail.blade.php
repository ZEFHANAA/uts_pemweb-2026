@extends('layouts.app')

@section('title', $project->title)
@section('meta_description', \Illuminate\Support\Str::limit($project->description, 155))

@section('content')

@php
$statusConfig = [
    'completed'   => ['label' => 'Selesai', 'class' => 'text-emerald-400'],
    'in-progress' => ['label' => 'Sedang dikerjakan', 'class' => 'text-blue-400'],
    'planning'    => ['label' => 'Perencanaan', 'class' => 'text-amber-400'],
    'on-hold'     => ['label' => 'Ditunda', 'class' => 'text-red-400'],
];
$cfg = $statusConfig[$project->status] ?? ['label' => ucfirst($project->status), 'class' => 'text-white/50'];
@endphp

<section class="pt-28 pb-8">
    <div class="max-w-6xl mx-auto px-4">
        <nav class="flex items-center gap-2 text-xs text-white/35 mb-6">
            <a href="{{ route('portfolio.home') }}" class="hover:text-white transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('portfolio.projects') }}" class="hover:text-white transition">Proyek</a>
            <span>/</span>
            <span class="text-white/60 truncate max-w-xs">{{ $project->title }}</span>
        </nav>

        <div class="flex flex-wrap items-center gap-3 mb-4">
            <span class="text-xs font-medium {{ $cfg['class'] }}">
                {{ $cfg['label'] }}
            </span>
            @if($project->is_featured)
            <span class="text-xs text-amber-400">Unggulan</span>
            @endif
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight">{{ $project->title }}</h1>
        <p class="mt-4 text-lg text-white/55 max-w-2xl">{{ $project->description }}</p>

        <div class="flex flex-wrap gap-3 mt-6">
            @if($project->demo_url)
            <a href="{{ $project->demo_url }}" target="_blank" class="inline-flex items-center gap-2 bg-white text-[#08090a] font-semibold px-5 py-2.5 rounded-xl hover:bg-white/90 transition text-sm">
                Live Demo
            </a>
            @endif
            @if($project->repository_url)
            <a href="{{ $project->repository_url }}" target="_blank" class="inline-flex items-center gap-2 bg-white/5 border border-white/10 text-white font-medium px-5 py-2.5 rounded-xl hover:bg-white/10 transition text-sm">
                Repository
            </a>
            @endif
        </div>
    </div>
</section>

<section class="py-8 pb-24">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-[1.3fr_.7fr] gap-8">

            <div class="space-y-6">
                <div class="card overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-auto object-cover max-h-[400px]">
                    @else
                        <div class="h-56 bg-gradient-to-br from-indigo-950/30 to-purple-950/20 flex items-center justify-center">
                            <span class="text-5xl font-bold text-white/10">{{ strtoupper(substr($project->title, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>

                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Tentang proyek ini</h2>
                    <div class="text-white/60 leading-relaxed space-y-3">
                        @if($project->long_description)
                            {!! nl2br(e($project->long_description)) !!}
                        @else
                            <p>{{ $project->description }}</p>
                        @endif
                    </div>
                </div>

                @if($project->technologies && count($project->technologies) > 0)
                <div class="card p-6">
                    <h2 class="text-lg font-semibold text-white mb-4">Teknologi yang dipakai</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                        <span class="text-sm text-white/70 bg-white/5 border border-white/[0.08] px-3 py-1.5 rounded-lg">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <div class="space-y-5">
                <div class="card p-6">
                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-white">{{ $project->progress }}<span class="text-lg text-white/30">%</span></div>
                        <p class="text-xs text-white/40 mt-1">progress</p>
                    </div>
                    <div class="h-1.5 bg-white/8 rounded-full overflow-hidden">
                        <div class="h-full rounded-full bg-indigo-500/70" style="width:{{ $project->progress }}%"></div>
                    </div>
                </div>

                @if($project->start_date || $project->end_date)
                <div class="card p-6">
                    <h3 class="font-semibold text-white mb-4">Timeline</h3>
                    <div class="space-y-3 text-sm">
                        @if($project->start_date)
                        <div class="flex justify-between">
                            <span class="text-white/45">Mulai</span>
                            <span class="text-white font-medium">{{ $project->start_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->end_date)
                        <div class="flex justify-between">
                            <span class="text-white/45">Selesai</span>
                            <span class="text-white font-medium">{{ $project->end_date->format('d M Y') }}</span>
                        </div>
                        @endif
                        @if($project->start_date && $project->end_date)
                        <div class="flex justify-between pt-2 border-t border-white/[0.08]">
                            <span class="text-white/45">Durasi</span>
                            <span class="text-indigo-400 font-medium">{{ $project->start_date->diffInDays($project->end_date) }} hari</span>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($project->demo_url || $project->repository_url)
                <div class="card p-6">
                    <h3 class="font-semibold text-white mb-4">Link</h3>
                    <div class="grid grid-cols-1 gap-2">
                        @if($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" class="flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2.5 rounded-xl font-medium transition text-sm">
                            Live Demo
                        </a>
                        @endif
                        @if($project->repository_url)
                        <a href="{{ $project->repository_url }}" target="_blank" class="flex justify-center items-center gap-2 bg-white/5 hover:bg-white/10 text-white px-4 py-2.5 rounded-xl border border-white/[0.08] font-medium transition text-sm">
                            Repository
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if($relatedProjects->count() > 0)
        <div class="mt-20 pt-12 border-t border-white/[0.08]">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white">Proyek lainnya</h2>
                <a href="{{ route('portfolio.projects') }}" class="text-sm text-indigo-400 hover:text-indigo-300">Lihat semua →</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($relatedProjects as $rel)
                <a href="{{ route('portfolio.project', $rel) }}" class="group card-hover overflow-hidden block">
                    <div class="h-36 bg-white/5 overflow-hidden">
                        @if($rel->image)
                            <img src="{{ asset('storage/'.$rel->image) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-950/20 to-purple-950/15">
                                <span class="text-2xl font-bold text-white/10">{{ strtoupper(substr($rel->title, 0, 1)) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-white group-hover:text-indigo-400 transition mb-1">{{ $rel->title }}</h3>
                        <p class="text-sm text-white/50 line-clamp-2">{{ $rel->description }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection
