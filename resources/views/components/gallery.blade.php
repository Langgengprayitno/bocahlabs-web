@props(['packages'])

<section id="galeri" class="py-20 bg-white/60 dark:bg-slatebg-950 border-t border-slate-200/70 dark:border-slate-800/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12 space-y-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-100 text-brand-700 dark:bg-brand-900/50 dark:text-brand-200">
                {{ __('site.gallery.badge') }}
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                {{ __('site.gallery.title') }}
            </h2>
            <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400">
                {{ __('site.gallery.subtitle') }}
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($packages as $pkg)
                <figure class="card-hover group rounded-2xl overflow-hidden bg-white dark:bg-slatebg-900 border border-slate-200 dark:border-slate-800 shadow-sm cursor-pointer">
                    <div class="relative aspect-[16/10] overflow-hidden bg-slate-100 dark:bg-slatebg-800">
                        <img
                            src="{{ asset($pkg->image_path) }}"
                            alt="{{ $pkg->name }}"
                            loading="lazy"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        <span class="absolute bottom-2.5 right-2.5 inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-slate-900/75 text-white backdrop-blur-sm">
                            <i data-lucide="zoom-in" class="w-3.5 h-3.5"></i>
                            <span>{{ __('site.gallery.zoom_hint') }}</span>
                        </span>
                    </div>
                    <figcaption class="p-4">
                        <span class="text-[11px] font-bold uppercase tracking-wide text-brand-600 dark:text-brand-400">
                            {{ $pkg->tier_label }}
                        </span>
                        <h3 class="mt-1 text-sm font-bold text-slate-900 dark:text-white">{{ $pkg->name }}</h3>
                        <p class="mt-0.5 text-xs text-slate-500 dark:text-slate-400">{{ $pkg->price_label }}</p>
                    </figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>