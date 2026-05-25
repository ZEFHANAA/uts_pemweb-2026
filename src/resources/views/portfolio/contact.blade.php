@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Hubungi Zefhana Ananda untuk kolaborasi, project freelance, atau sekadar menyapa.')

@section('content')

{{-- ===== HEADER ===== --}}
<section class="relative bg-slate-900 pt-32 pb-20 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-indigo-600/20 rounded-full blur-3xl"></div>
        <div class="absolute inset-0" style="background-image:radial-gradient(rgba(255,255,255,.04) 1px,transparent 1px);background-size:28px 28px;"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <span class="text-indigo-400 font-semibold text-sm uppercase tracking-widest">Get In Touch</span>
        <h1 class="text-5xl md:text-6xl font-black text-white mt-2 mb-4">Hubungi Zefhana</h1>
        <p class="text-slate-400 text-lg max-w-xl">Punya pertanyaan, ide project, atau ingin berkolaborasi? Saya senang mendengarnya!</p>
    </div>
</section>

{{-- ===== CONTACT SECTION ===== --}}
<section class="py-20 bg-slate-50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- ===== LEFT: Info ===== --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Info card --}}
                <div class="reveal bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Info Kontak</h2>

                    @php
                    $contacts = [];
                    if ($profile) {
                        if ($profile->email) $contacts[] = ['icon' => '📧', 'label' => 'Email', 'value' => $profile->email, 'href' => 'mailto:' . $profile->email, 'color' => 'indigo'];
                        if ($profile->phone) $contacts[] = ['icon' => '📱', 'label' => 'Phone', 'value' => $profile->phone, 'href' => 'tel:' . str_replace(' ', '', $profile->phone), 'color' => 'emerald'];
                        if ($profile->location) $contacts[] = ['icon' => '📍', 'label' => 'Location', 'value' => $profile->location, 'href' => null, 'color' => 'purple'];
                    }
                    @endphp

                    <div class="space-y-5">
                        @foreach($contacts as $contact)
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-{{ $contact['color'] }}-100 flex items-center justify-center text-lg flex-shrink-0">
                                {{ $contact['icon'] }}
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 font-medium uppercase tracking-wider mb-0.5">{{ $contact['label'] }}</p>
                                @if($contact['href'])
                                    <a href="{{ $contact['href'] }}" class="text-slate-900 font-semibold hover:text-indigo-600 transition-colors">{{ $contact['value'] }}</a>
                                @else
                                    <p class="text-slate-900 font-semibold">{{ $contact['value'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Social Media --}}
                @if(($profile->github_url ?? null) || ($profile->linkedin_url ?? null))
                <div class="reveal reveal-delay-1 bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <h2 class="text-xl font-bold text-slate-900 mb-6">Social Media</h2>
                    <div class="space-y-3">
                        @php
                        $socials = [];
                        if ($profile->github_url) {
                            $socials[] = [
                                'name' => 'GitHub', 
                                'handle' => str_replace(['https://github.com/', 'http://github.com/'], '@', $profile->github_url), 
                                'href' => $profile->github_url, 
                                'bg' => 'bg-slate-900 hover:bg-slate-700', 
                                'icon' => '<path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>'
                            ];
                        }
                        if ($profile->linkedin_url) {
                            $socials[] = [
                                'name' => 'LinkedIn', 
                                'handle' => str_replace(['https://linkedin.com/in/', 'http://linkedin.com/in/', 'https://www.linkedin.com/in/'], '', $profile->linkedin_url), 
                                'href' => $profile->linkedin_url, 
                                'bg' => 'bg-blue-600 hover:bg-blue-700', 
                                'icon' => '<path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>'
                            ];
                        }
                        @endphp
                        @foreach($socials as $social)
                        <a href="{{ $social['href'] }}" target="_blank" class="{{ $social['bg'] }} text-white rounded-xl p-3 flex items-center gap-3 transition-colors">
                            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">{!! $social['icon'] !!}</svg>
                            <div>
                                <p class="font-semibold text-sm">{{ $social['name'] }}</p>
                                <p class="text-xs opacity-70">{{ $social['handle'] }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Availability --}}
                <div class="reveal reveal-delay-2 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl p-8 text-white">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="text-emerald-300 font-semibold text-sm">Available Now</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2">Siap Berkolaborasi!</h3>
                    <p class="text-indigo-100 text-sm leading-relaxed">Saya terbuka untuk project freelance, full-time, maupun kolaborasi open-source.</p>
                </div>
            </div>

            {{-- ===== RIGHT: Form ===== --}}
            <div class="lg:col-span-3">
                <div class="reveal bg-white rounded-2xl p-8 md:p-10 border border-slate-100 shadow-sm">
                    <h2 class="text-2xl font-bold text-slate-900 mb-2">Kirim Pesan</h2>
                    <p class="text-slate-500 mb-8 text-sm">Isi form di bawah ini dan saya akan merespons dalam 24 jam.</p>

                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="John Doe"
                                       class="input-field @error('name') !border-red-400 @enderror"
                                       required>
                                @error('name')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="john@example.com"
                                       class="input-field @error('email') !border-red-400 @enderror"
                                       required>
                                @error('email')
                                <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-slate-700 mb-2">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="subject" name="subject"
                                   value="{{ old('subject') }}"
                                   placeholder="Tentang apa pesan ini?"
                                   class="input-field @error('subject') !border-red-400 @enderror"
                                   required>
                            @error('subject')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message" name="message" rows="6"
                                      placeholder="Ceritakan kebutuhan Anda..."
                                      class="input-field resize-none @error('message') !border-red-400 @enderror"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="submit-btn"
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-indigo-500/30 hover:-translate-y-0.5 flex items-center justify-center gap-3 text-base">
                            <svg id="btn-icon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span id="btn-text">Kirim Pesan</span>
                        </button>

                        <p class="text-center text-xs text-slate-400">
                            🔒 Data Anda aman dan tidak akan dibagikan kepada siapapun.
                        </p>
                    </form>
                </div>

                {{-- FAQ --}}
                @if($faqs->count() > 0)
                <div class="reveal mt-8 bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <h3 class="text-lg font-bold text-slate-900 mb-6">FAQ</h3>
                    <div class="space-y-4">
                        @foreach($faqs as $i => $faq)
                        <details class="group border border-slate-100 rounded-xl overflow-hidden">
                            <summary class="flex justify-between items-center p-4 cursor-pointer font-semibold text-slate-900 hover:bg-slate-50 transition list-none">
                                {{ $faq->question }}
                                <svg class="w-5 h-5 text-slate-400 group-open:rotate-180 transition-transform duration-200 flex-shrink-0 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>
                            <div class="px-4 pb-4 text-slate-500 text-sm leading-relaxed border-t border-slate-100 pt-3">
                                {{ $faq->answer }}
                            </div>
                        </details>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contact-form').addEventListener('submit', function() {
    const btn  = document.getElementById('submit-btn');
    const text = document.getElementById('btn-text');
    const icon = document.getElementById('btn-icon');
    btn.disabled = true;
    btn.classList.add('opacity-75', 'cursor-not-allowed');
    text.textContent = 'Mengirim...';
    icon.innerHTML = '<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" class="opacity-25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" class="opacity-75"/>';
});
</script>

@endsection
