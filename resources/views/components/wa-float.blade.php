@props(['waUrl' => '#'])

<a
    href="{{ $waUrl }}"
    target="_blank"
    rel="noopener noreferrer"
    @click.prevent="openBriefModal()"
    aria-label="{{ __('site.wa_float') }}"
    class="fixed bottom-5 right-5 z-40 inline-flex items-center gap-2 px-4 py-3 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-semibold shadow-lg shadow-emerald-600/30 transition-all hover:scale-105"
>
    <i data-lucide="message-circle" class="w-5 h-5"></i>
    <span class="hidden sm:inline">{{ __('site.wa_float') }}</span>
</a>