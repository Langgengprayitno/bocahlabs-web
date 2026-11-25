@props(['waUrl' => '#'])

<section class="py-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div
            data-sc-reveal="resolve"
            data-sc-glow
            style="background: linear-gradient(135deg, #6d28d9 0%, #4338ca 55%, #0f172a 100%);"
            class="sc-cta-glow relative overflow-hidden rounded-3xl p-8 sm:p-14 text-center text-white border border-brand-500/30 shadow-2xl shadow-brand-900/30"
        >
            <div class="relative z-10 max-w-2xl mx-auto">
                <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-[-0.025em] leading-tight text-white">
                    {{ __('site.cta.title') }}
                </h2>
                <p class="mt-3.5 text-sm sm:text-base text-brand-100 leading-relaxed">
                    {{ __('site.cta.subtitle') }}
                </p>
                <div class="mt-8">
                    <a
                        href="{{ $waUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        @click.prevent="openBriefModal()"
                        class="inline-flex items-center gap-2.5 px-7 py-4 rounded-xl text-sm font-bold bg-white text-slate-900 hover:bg-brand-50 shadow-xl shadow-slate-950/30 transition-all hover:-translate-y-0.5"
                    >
                        <i data-lucide="message-circle" class="w-4 h-4 text-emerald-600"></i>
                        <span>{{ __('site.cta.button') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>