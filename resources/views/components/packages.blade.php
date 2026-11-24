@props(['packages', 'waUrl' => '#'])

<section id="paket" class="py-20 bg-white/60 dark:bg-slatebg-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header Section --}}
        <div class="text-center max-w-2xl mx-auto mb-10 space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200">
                {{ __('site.packages.badge') }}
            </span>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('site.packages.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.packages.subtitle') }}
            </p>
        </div>

        {{-- Filter Tier --}}
        <div class="flex justify-center mb-10">
            <div class="inline-flex items-center gap-1 p-1 rounded-xl bg-slate-100 dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800">
                <button type="button" data-tier="all" class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer bg-brand-600 text-white shadow-sm">
                    {{ __('site.packages.filter_all') }}
                </button>
                <button type="button" data-tier="beginner" class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                    {{ __('site.packages.filter_beginner') }}
                </button>
                <button type="button" data-tier="professional" class="tier-filter-btn px-3.5 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-colors cursor-pointer text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                    {{ __('site.packages.filter_professional') }}
                </button>
            </div>
        </div>

        {{-- Grid Kartu Paket --}}
        <div id="packages-grid" class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($packages as $pkg)
                @php
                    $borderCls = $pkg->is_popular
                        ? 'border-2 border-brand-500 shadow-xl shadow-brand-600/15'
                        : 'border border-slate-200 dark:border-slate-800 shadow-sm';
                    $tierCls = $pkg->tier === 'professional'
                        ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300'
                        : 'bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-300';
                @endphp

                <div
                    data-package-tier="{{ $pkg->tier }}"
                    class="card-hover relative flex flex-col justify-between rounded-2xl p-6 bg-white dark:bg-slatebg-900 {{ $borderCls }}"
                >
                    <div>
                        <div class="flex items-center justify-between gap-2 mb-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold uppercase tracking-wide {{ $tierCls }}">
                                {{ $pkg->tier_label }}
                            </span>
                            @if ($pkg->is_popular)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-bold bg-brand-600 text-white">
                                    {{ __('site.packages.popular_badge') }}
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $pkg->name }}</h3>
                        <p class="mt-2 text-xl font-extrabold text-brand-600 dark:text-brand-400">{{ $pkg->price_label }}</p>
                        <p class="mt-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $pkg->tagline }}</p>

                        <ul class="mt-5 space-y-2.5 text-xs sm:text-sm text-slate-700 dark:text-slate-300">
                            @foreach ($pkg->features as $feature)
                                <li class="flex items-start gap-2">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-brand-500 shrink-0 mt-0.5"></i>
                                    <span>{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <a
                            href="{{ $waUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            data-select-package="{{ $pkg->slug }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors {{ $pkg->is_popular ? 'bg-brand-600 hover:bg-brand-700 text-white shadow-md shadow-brand-600/20' : 'bg-slate-100 hover:bg-brand-600 text-slate-800 hover:text-white dark:bg-slate-800 dark:hover:bg-brand-600 dark:text-slate-100' }}"
                        >
                            <span>{{ __('site.packages.select_btn') }}</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>