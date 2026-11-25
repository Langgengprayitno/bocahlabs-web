import './bootstrap';
import Alpine from 'alpinejs';
import { initScrollCraft } from './scrollcraft';
import {
    createIcons,
    ArrowDown,
    ArrowRight,
    Check,
    CheckCircle2,
    ChevronDown,
    Code2,
    Copy,
    Globe,
    LayoutTemplate,
    MapPin,
    Menu,
    MessageCircle,
    MessagesSquare,
    Moon,
    PenTool,
    PlusCircle,
    Rocket,
    Send,
    ShieldCheck,
    Sparkles,
    Sun,
    X,
    ZoomIn,
} from 'lucide';

const appIcons = {
    ArrowDown,
    ArrowRight,
    Check,
    CheckCircle2,
    ChevronDown,
    Code2,
    Copy,
    Globe,
    LayoutTemplate,
    MapPin,
    Menu,
    MessageCircle,
    MessagesSquare,
    Moon,
    PenTool,
    PlusCircle,
    Rocket,
    Send,
    ShieldCheck,
    Sparkles,
    Sun,
    X,
    ZoomIn,
};

window.refreshIcons = () => {
    createIcons({ icons: appIcons });
};

Alpine.data('bocahLabsApp', (config = {}) => ({
    theme: 'dark',
    lang: config.lang ?? 'id',
    waNumber: config.waNumber ?? '6285667667059',
    leadsUrl: config.leadsUrl ?? '/leads',
    copySuccessText: config.copySuccessText ?? 'Teks pesan berhasil disalin!',
    packages: config.packages ?? [],
    addons: config.addons ?? [],
    marketingCodes: config.marketingCodes ?? [],

    // State navigasi & tampilan
    heroPreviewIdx: 0,
    activeTier: 'all',
    openFaq: 0,
    mobileMenuOpen: false,

    // State Lightbox
    lightboxOpen: false,
    lightboxImg: '',
    lightboxCaption: '',

    // State Modal Brief & Leads
    briefModalOpen: false,
    briefBrandName: '',
    briefPromoCode: '',
    briefHoneypot: '',
    selectedPackageSlug: 'compro-mini',
    selectedAddonSlugs: [],
    isSubmittingLead: false,

    // State Toast (2400ms sesuai prototipe)
    toastVisible: false,
    toastMessage: '',
    toastTimer: null,

    init() {
        try {
            const savedTheme = localStorage.getItem('bocahlabs_theme');
            this.theme = savedTheme === 'light' ? 'light' : 'dark';
        } catch (_) {
            this.theme = 'dark';
        }

        if (!this.packages.some((p) => p.slug === this.selectedPackageSlug) && this.packages.length > 0) {
            this.selectedPackageSlug = this.packages[0].slug;
        }

        this.applyTheme();
        this.$nextTick(() => window.refreshIcons());
    },

    applyTheme() {
        document.documentElement.classList.toggle('dark', this.theme === 'dark');
    },

    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        this.applyTheme();
        try {
            localStorage.setItem('bocahlabs_theme', this.theme);
        } catch (_) {}
    },

    get currentHeroPackage() {
        return this.packages[this.heroPreviewIdx] ?? this.packages[0] ?? null;
    },

    get filteredPackageCount() {
        if (this.activeTier === 'all') {
            return this.packages.length;
        }
        return this.packages.filter((pkg) => pkg.tier === this.activeTier).length;
    },

    get selectedPackage() {
        return this.packages.find((p) => p.slug === this.selectedPackageSlug) ?? this.packages[0] ?? null;
    },

    get chosenAddons() {
        return this.addons.filter((a) => this.selectedAddonSlugs.includes(a.slug));
    },

    get matchedMarketingCode() {
        const code = this.briefPromoCode.trim().toUpperCase();
        if (!code) return null;
        return this.marketingCodes.find((m) => m.code === code) ?? null;
    },

    // Format pesan WhatsApp ID & EN persis prototipe + baris Kode Promo opsional
    get waMessage() {
        const pkg = this.selectedPackage;
        if (!pkg) return '';

        const brandName = this.briefBrandName.trim();
        const promoCode = this.briefPromoCode.trim().toUpperCase();
        const chosenAddons = this.chosenAddons;

        if (this.lang === 'en') {
            const lines = ['Hi BocahLabs! I would like to discuss a website project.'];
            if (brandName) {
                lines.push(` Business/Brand: ${brandName}`);
            }
            lines.push(` Package: ${pkg.name} (${pkg.price_label})`);
            if (chosenAddons.length > 0) {
                lines.push(` Add-ons: ${chosenAddons.map((a) => a.name).join(', ')}`);
            }
            if (promoCode) {
                lines.push(` Promo Code: ${promoCode}`);
            }
            lines.push('Could you share the next steps and available consultation slots? Thank you!');
            return lines.join('\n');
        }

        const lines = ['Halo BocahLabs! Saya ingin konsultasi pembuatan website.'];
        if (brandName) {
            lines.push(` Usaha/Brand: ${brandName}`);
        }
        lines.push(` Paket: ${pkg.name} (${pkg.price_label})`);
        if (chosenAddons.length > 0) {
            lines.push(` Add-ons: ${chosenAddons.map((a) => a.name).join(', ')}`);
        }
        if (promoCode) {
            lines.push(` Kode Promo: ${promoCode}`);
        }
        lines.push('Mohon info alur pengerjaan & jadwal konsultasinya ya. Terima kasih!');
        return lines.join('\n');
    },

    openBriefModal(packageSlug = null, addonSlug = null) {
        if (packageSlug && this.packages.some((p) => p.slug === packageSlug)) {
            this.selectedPackageSlug = packageSlug;
        }
        if (addonSlug && !this.selectedAddonSlugs.includes(addonSlug)) {
            this.selectedAddonSlugs.push(addonSlug);
        }
        this.mobileMenuOpen = false;
        this.briefModalOpen = true;
    },

    closeBriefModal() {
        this.briefModalOpen = false;
    },

    toggleAddon(slug) {
        if (this.selectedAddonSlugs.includes(slug)) {
            this.selectedAddonSlugs = this.selectedAddonSlugs.filter((s) => s !== slug);
        } else {
            this.selectedAddonSlugs.push(slug);
        }
    },

    async copyWaMessage() {
        const text = this.waMessage;
        try {
            await navigator.clipboard.writeText(text);
        } catch (_) {
            const ta = document.createElement('textarea');
            ta.value = text;
            document.body.appendChild(ta);
            ta.select();
            document.execCommand('copy');
            document.body.removeChild(ta);
        }
        this.showToast(this.copySuccessText);
    },

    async submitBriefToWhatsApp() {
        if (this.isSubmittingLead) return;
        this.isSubmittingLead = true;

        const message = this.waMessage;
        const cleanNumber = String(this.waNumber).replace(/\D+/g, '');
        const waTargetUrl = `https://wa.me/${cleanNumber}?text=${encodeURIComponent(message)}`;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';

        const payload = {
            brand_name: this.briefBrandName.trim() || null,
            package_id: this.selectedPackage ? this.selectedPackage.id : null,
            promo_code: this.briefPromoCode.trim().toUpperCase() || null,
            addon_ids: this.chosenAddons.map((a) => a.id),
            lang: this.lang,
            message,
            website: this.briefHoneypot,
        };

        const controller = new AbortController();
        const timeoutId = setTimeout(() => controller.abort(), 2500);

        try {
            await fetch(this.leadsUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify(payload),
                signal: controller.signal,
            });
        } catch (_) {
            // Gagal menyimpan ke server tidak boleh menghalangi pembukaan WhatsApp
        } finally {
            clearTimeout(timeoutId);
            this.isSubmittingLead = false;
            const popup = window.open(waTargetUrl, '_blank', 'noopener,noreferrer');
            if (!popup) {
                window.location.href = waTargetUrl;
            }
        }
    },

    openLightbox(img, caption) {
        this.lightboxImg = img;
        this.lightboxCaption = caption;
        this.lightboxOpen = true;
    },

    openPackageLightbox(index) {
        const pkg = this.packages[index];
        if (!pkg) return;
        this.openLightbox(pkg.image_url, `${pkg.name} — ${pkg.price_label}`);
    },

    closeLightbox() {
        this.lightboxOpen = false;
    },

    toggleFaq(index) {
        this.openFaq = this.openFaq === index ? null : index;
    },

    closeAllModals() {
        this.lightboxOpen = false;
        this.mobileMenuOpen = false;
        this.briefModalOpen = false;
    },

    showToast(message) {
        this.toastMessage = message;
        this.toastVisible = true;
        if (this.toastTimer) {
            clearTimeout(this.toastTimer);
        }
        this.toastTimer = setTimeout(() => {
            this.toastVisible = false;
        }, 2400);
    },
}));

window.Alpine = Alpine;

document.addEventListener('DOMContentLoaded', () => {
    window.refreshIcons();
    initScrollCraft();
});

Alpine.start();