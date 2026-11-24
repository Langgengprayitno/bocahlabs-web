<div
    x-show="lightboxOpen"
    x-cloak
    x-transition.opacity.duration.200ms
    @click.self="closeLightbox()"
    role="dialog"
    aria-modal="true"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/85 backdrop-blur-sm"
>
    <div class="relative w-full max-w-4xl rounded-2xl overflow-hidden bg-slatebg-900 border border-slate-700/80 shadow-2xl">
        <button
            type="button"
            @click="closeLightbox()"
            aria-label="Close"
            class="absolute top-3 right-3 z-10 p-2 rounded-full bg-slate-900/80 hover:bg-brand-600 text-white border border-slate-700 transition-colors"
        >
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <div class="bg-slatebg-950 flex items-center justify-center p-2 sm:p-4">
            <img
                :src="lightboxImg"
                :alt="lightboxCaption"
                class="w-full h-auto max-h-[78vh] object-contain rounded-lg"
            />
        </div>

        <div class="px-5 py-3 bg-slatebg-900 border-t border-slate-800 text-center">
            <p class="text-xs sm:text-sm font-medium text-slate-200" x-text="lightboxCaption"></p>
        </div>
    </div>
</div>