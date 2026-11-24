@props(['packages', 'settings', 'waUrl' => '#'])

@php
    $firstPackage = $packages->first();
@endphp

<section id="top" class="relative overflow-hidden hero-glow grid-pattern pt-12 pb-20 lg:pt-20 lg:pb-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-10 lg:gap-12 items-center">
            {{-- Kolom Kiri: Copywriting & Statistik --}}
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200 border border-brand-200/80 dark:border-brand-700/60">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    <span>{{ __('site.hero.badge') }}</span>
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-slate-900 dark:text-white">
                    {{ __('site.hero.title_prefix') }}
                    <span class="bg-gradient-to-r from-brand-500 via-brand-400 to-indigo-400 bg-clip-text text-transparent">
                        {{ __('site.hero.title_highlight') }}
                    </span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-xl">
                    {{ __('site.hero.subtitle') }}
                </p>

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <a
                        href="#paket"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold bg-brand-600 hover:bg-brand-700 text-white shadow-lg shadow-brand-600/25 transition-all"
                    >
                        <span>{{ __('site.hero.cta_packages') }}</span>
                        <i data-lucide="arrow-down" class="w-4 h-4"></i>
                    </a>
                    <a
                        href="{{ $waUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-xl text-sm font-semibold bg-white dark:bg-slatebg-900 text-slate-800 dark:text-slate-100 border border-slate-200 dark:border-slate-700 hover:border-brand-500 transition-colors"
                    >
                        <i data-lucide="message-circle" class="w-4 h-4 text-emerald-500"></i>
                        <span>{{ __('site.hero.cta_consult') }}</span>
                    </a>
                </div>

                {{-- 3 Statistik Hero --}}
                <div class="grid grid-cols-3 gap-4 pt-4 border-t border-slate-200/80 dark:border-slate-800/80 max-w-md">
                    <div>
                        <p class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white">{{ __('site.hero.stat_1_value') }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_1_label') }}</p>
                    </div>
                    <div>
                        <p class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white">{{ __('site.hero.stat_2_value') }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_2_label') }}</p>
                    </div>
                    <div>
                        <p class="text-lg sm:text-xl font-extrabold text-slate-900 dark:text-white">{{ __('site.hero.stat_3_value') }}</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('site.hero.stat_3_label') }}</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Preview Paket Interaktif --}}
            <div class="lg:col-span-6">
                <div class="rounded-2xl p-4 sm:p-5 bg-white/90 dark:bg-slatebg-900/90 border border-slate-200 dark:border-slate-800 shadow-2xl shadow-brand-900/10">
                    {{-- Tab Preview 4 Paket --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach ($packages as $index => $pkg)
                            <button
                                type="button"
                                data-preview="{{ $index }}"
                                class="hero-tab-btn px-3 py-1.5 rounded-lg text-xs font-semibold transition-colors cursor-pointer {{ $index === 0 ? 'bg-brand-600 text-white shadow-sm' : 'bg-white dark:bg-slate-800 text-slate-600 dark:text-slate-300 border border-slate-200 dark:border-slate-700 hover:border-brand-500' }}"
                            >
                                {{ $pkg->name }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Gambar Preview --}}
                    @if ($firstPackage)
                        <div class="relative rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800 bg-slate-100 dark:bg-slatebg-950 aspect-[16/10]">
                            <img
                                id="hero-preview-img"
                                src="{{ asset($firstPackage->image_path) }}"
                                alt="{{ $firstPackage->name }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="flex items-center justify-between gap-2 mt-3 text-xs text-slate-500 dark:text-slate-400">
                            <span id="hero-preview-caption" class="font-medium text-slate-700 dark:text-slate-200">
                                {{ $firstPackage->name }} - {{ $firstPackage->tier_label }}
                            </span>
                            <span>{{ __('site.hero.preview_hint') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>