@props(['addons', 'waUrl' => '#'])

<section id="addons" class="py-20 border-t border-slate-200/70 dark:border-slate-800/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200">
                {{ __('site.addons.badge') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('site.addons.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.addons.subtitle') }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($addons as $index => $addon)
                <div
                    data-sc-reveal="wipe"
                    style="--sc-delay: {{ $index * 110 }}ms;"
                    class="card-hover flex flex-col justify-between rounded-2xl p-6 bg-white dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800 shadow-sm"
                >
                    <div>
                        <div class="w-11 h-11 rounded-xl bg-brand-100 dark:bg-brand-900/40 text-brand-600 dark:text-brand-400 flex items-center justify-center mb-4">
                            <i data-lucide="{{ $addon->icon }}" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-base font-bold text-slate-900 dark:text-white">{{ $addon->name }}</h3>
                        <p class="mt-1 text-sm font-bold text-brand-600 dark:text-brand-400">{{ $addon->price_label }}</p>
                        <p class="mt-2.5 text-sm text-slate-600 dark:text-slate-400 leading-relaxed">{{ $addon->desc }}</p>
                    </div>

                    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-800">
                        <a
                            href="{{ $waUrl }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            @click.prevent="openBriefModal(null, '{{ $addon->slug }}')"
                            data-select-addon="{{ $addon->slug }}"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-brand-600 dark:text-brand-400 hover:underline"
                        >
                            <i data-lucide="plus-circle" class="w-4 h-4"></i>
                            <span>{{ __('site.addons.add_btn') }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>