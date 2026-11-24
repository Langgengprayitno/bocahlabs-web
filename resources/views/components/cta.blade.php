@props(['waUrl' => '#'])

<section class="py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-3xl p-8 sm:p-12 text-center bg-gradient-to-br from-brand-600 via-brand-700 to-indigo-700 text-white shadow-2xl shadow-brand-700/25">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                {{ __('site.cta.title') }}
            </h2>
            <p class="mt-3 text-sm sm:text-base text-brand-100 max-w-2xl mx-auto">
                {{ __('site.cta.subtitle') }}
            </p>
            <div class="mt-7">
                <a
                    href="{{ $waUrl }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl text-sm font-bold bg-white text-brand-700 hover:bg-brand-50 shadow-lg transition-colors"
                >
                    <i data-lucide="message-circle" class="w-4 h-4 text-emerald-600"></i>
                    <span>{{ __('site.cta.button') }}</span>
                </a>
            </div>
        </div>
    </div>
</section>