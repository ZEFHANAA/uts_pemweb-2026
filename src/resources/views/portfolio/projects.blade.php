@extends('layouts.app')

@section('title', 'Proyek')
@section('meta_description', 'Daftar proyek web Zefhana Ananda: Petawisata, Simanis, portofolio, dan lainnya. Laravel, PHP, Filament, dan Tailwind CSS.')

@section('content')
@php
$statusConfig = [
    'completed'   => ['label' => 'Selesai', 'class' => 'text-emerald-400'],
    'in-progress' => ['label' => 'Sedang dikerjakan', 'class' => 'text-blue-400'],
    'planning'    => ['label' => 'Perencanaan', 'class' => 'text-amber-400'],
    'on-hold'     => ['label' => 'Ditunda', 'class' => 'text-red-400'],
];
@endphp

<section class="pt-28 pb-8">
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-3xl sm:text-4xl font-bold text-white tracking-tight">Proyek</h1>
        <p class="mt-3 text-white/55 max-w-lg">Proyek kuliah, latihan, dan eksperimen web yang saya kembangkan selama mempelajari pemrograman web.</p>
    </div>
</section>

<section class="py-8 pb-24">
    <div class="max-w-6xl mx-auto px-4">

        @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
            @foreach($projects as $project)
            @php $cfg = $statusConfig[$project->status] ?? ['label'=>ucfirst($project->status),'class'=>'text-white/50']; @endphp
            <a href="{{ route('portfolio.project', $project) }}" class="group card-hover overflow-hidden block">

                <div class="h-44 bg-white/5 relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                             class="project-card-image w-full h-full object-cover transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-950/30 to-purple-950/20">
                            <span class="text-3xl font-bold text-white/10">{{ strtoupper(substr($project->title, 0, 1)) }}</span>
                        </div>
                    @endif

                    <div class="absolute top-3 left-3">
                        <span class="text-xs font-medium {{ $cfg['class'] }} bg-black/50 backdrop-blur px-2 py-1 rounded-md">
                            {{ $cfg['label'] }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <h3 class="font-semibold text-white group-hover:text-indigo-400 transition leading-snug">{{ $project->title }}</h3>
                        @if($project->progress < 100)
                        <span class="text-xs text-white/35 whitespace-nowrap">{{ $project->progress }}%</span>
                        @endif
                    </div>

                    <p class="text-sm text-white/55 leading-relaxed line-clamp-2 mb-4">{{ $project->description }}</p>

                    @if($project->progress < 100)
                    <div class="h-1 bg-white/8 rounded-full overflow-hidden mb-4">
                        <div class="h-full rounded-full bg-indigo-500/70" style="width:{{ $project->progress }}%"></div>
                    </div>
                    @endif

                    @if($project->technologies)
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice($project->technologies, 0, 3) as $tech)
                        <span class="text-xs text-white/45 bg-white/5 px-2 py-0.5 rounded">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies) > 3)
                        <span class="text-xs text-white/30 px-1">+{{ count($project->technologies) - 3 }}</span>
                        @endif
                    </div>
                    @endif

                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-white/[0.06]">
                        <span class="text-xs text-white/35">
                            @if($project->start_date){{ $project->start_date->format('M Y') }}@endif
                        </span>
                        <div class="flex gap-2">
                            @if($project->repository_url)
                            <span class="w-7 h-7 rounded-md bg-white/5 flex items-center justify-center text-white/40 group-hover:text-white/70 transition" title="Repository">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            </span>
                            @endif
                            @if($project->demo_url)
                            <span class="w-7 h-7 rounded-md bg-indigo-500/15 flex items-center justify-center text-indigo-400 group-hover:bg-indigo-500/25 transition" title="Live Demo">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        @if($projects->hasPages())
        <div class="flex justify-center mt-8">
            {{ $projects->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-24 card">
            <p class="text-white/50 mb-6">Belum ada proyek.</p>
            <a href="{{ route('portfolio.home') }}" class="text-sm text-indigo-400 hover:text-indigo-300">← Kembali ke Beranda</a>
        </div>
        @endif
    </div>
</section>

@endsection
