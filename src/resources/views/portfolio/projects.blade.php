@extends('layouts.app')

@section('title', 'Projects')
@section('meta_description', 'Daftar project yang pernah dan sedang dikerjakan — web app, API, dashboard, dan lebih banyak lagi.')

@section('content')

{{-- ===== HEADER ===== --}}
<section class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-600/20 rounded-full blur-3xl"></div>
        <div class="absolute inset-0" style="background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-indigo-400 font-semibold text-sm uppercase tracking-widest">My Work</span>
        <h1 class="text-5xl md:text-6xl font-black text-white mt-2 mb-4">Projects</h1>
        <p class="text-slate-400 text-lg max-w-xl">Showcase of my professional work, side projects, dan technical experiments.</p>
    </div>
</section>

{{-- ===== PROJECTS GRID ===== --}}
<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @php
        $statusConfig = [
            'completed'   => ['label' => 'Completed',   'class' => 'bg-emerald-100 text-emerald-700', 'dot' => 'bg-emerald-500'],
            'in-progress' => ['label' => 'In Progress',  'class' => 'bg-blue-100 text-blue-700',       'dot' => 'bg-blue-500'],
            'planning'    => ['label' => 'Planning',     'class' => 'bg-amber-100 text-amber-700',     'dot' => 'bg-amber-500'],
            'on-hold'     => ['label' => 'On Hold',      'class' => 'bg-red-100 text-red-700',         'dot' => 'bg-red-500'],
        ];
        $gradients = [
            'from-indigo-500 to-purple-600',
            'from-purple-500 to-pink-600',
            'from-blue-500 to-indigo-600',
            'from-emerald-500 to-teal-600',
            'from-orange-500 to-red-600',
            'from-pink-500 to-rose-600',
        ];
        $emojis = ['💻','🚀','📊','🔗','📝','📦','⚡','🌐'];
        @endphp

        @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($projects as $i => $project)
            @php $cfg = $statusConfig[$project->status] ?? ['label'=>ucfirst($project->status),'class'=>'bg-slate-100 text-slate-700','dot'=>'bg-slate-500']; @endphp
            <div class="reveal reveal-delay-{{ ($i % 3) + 1 }} card group hover:-translate-y-2 cursor-pointer"
                 onclick="window.location='{{ route('portfolio.project', $project) }}'">

                {{-- Thumbnail --}}
                <div class="h-52 bg-gradient-to-br {{ $gradients[$i % count($gradients)] }} relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500 opacity-80">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <span class="text-6xl opacity-50">{{ $emojis[$i % count($emojis)] }}</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                    {{-- Status --}}
                    <div class="absolute top-4 left-4">
                        <span class="badge {{ $cfg['class'] }} flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                            {{ $cfg['label'] }}
                        </span>
                    </div>

                    @if($project->is_featured)
                    <div class="absolute top-4 right-4 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-lg">
                        ⭐ Featured
                    </div>
                    @endif

                    {{-- Progress overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/20">
                        <div class="h-full bg-white/80 rounded-r-full transition-all duration-1000"
                             style="width:{{ $project->progress }}%"></div>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight">
                            {{ $project->title }}
                        </h3>
                        <span class="text-indigo-600 font-bold text-sm whitespace-nowrap">{{ $project->progress }}%</span>
                    </div>

                    <p class="text-slate-500 text-sm leading-relaxed mb-4">{{ Str::limit($project->description, 100) }}</p>

                    {{-- Progress bar --}}
                    <div class="h-1.5 bg-slate-100 rounded-full overflow-hidden mb-4">
                        <div class="h-full rounded-full transition-all duration-1000"
                             style="width:{{ $project->progress }}%; background:linear-gradient(90deg,#4f46e5,#7c3aed)"></div>
                    </div>

                    {{-- Technologies --}}
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-1.5 mb-5">
                        @foreach(array_slice($project->technologies, 0, 4) as $tech)
                        <span class="badge bg-indigo-50 text-indigo-600">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies) > 4)
                        <span class="badge bg-slate-100 text-slate-400">+{{ count($project->technologies) - 4 }}</span>
                        @endif
                    </div>
                    @endif

                    {{-- Meta --}}
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div class="text-xs text-slate-400">
                            @if($project->start_date)
                                📅 {{ $project->start_date->format('M Y') }}
                            @endif
                        </div>
                        <div class="flex gap-2">
                            @if($project->repository_url)
                            <a href="{{ $project->repository_url }}" target="_blank" onclick="event.stopPropagation()"
                               class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-900 hover:text-white flex items-center justify-center transition-colors text-slate-600" title="Repository">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                            </a>
                            @endif
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" onclick="event.stopPropagation()"
                               class="w-8 h-8 rounded-lg bg-indigo-100 hover:bg-indigo-600 hover:text-white flex items-center justify-center transition-colors text-indigo-600" title="Live Demo">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                            @endif
                            <a href="{{ route('portfolio.project', $project) }}"
                               class="w-8 h-8 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white flex items-center justify-center transition-colors" title="Detail">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($projects->hasPages())
        <div class="flex justify-center mt-8">
            {{ $projects->links() }}
        </div>
        @endif

        @else
        <div class="text-center py-24">
            <div class="text-7xl mb-6">🚀</div>
            <h3 class="text-2xl font-bold text-slate-900 mb-3">Belum Ada Project</h3>
            <p class="text-slate-500 mb-8">Projects akan segera ditambahkan. Stay tuned!</p>
            <a href="{{ route('portfolio.home') }}" class="btn-primary inline-flex">
                Kembali ke Home
            </a>
        </div>
        @endif
    </div>
</section>

@endsection
