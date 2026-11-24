import './bootstrap';
import Alpine from 'alpinejs';
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

// Komponen state utama halaman publik BocahLabs
Alpine.data('bocahLabsApp', (config = {}) => ({
    theme: 'dark',
    packages: config.packages ?? [],
    heroPreviewIdx: 0,
    activeTier: 'all',
    openFaq: 0,
    mobileMenuOpen: false,

    // State Lightbox
    lightboxOpen: false,
    lightboxImg: '',
    lightboxCaption: '',

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
});

Alpine.start();