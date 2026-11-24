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

window.Alpine = Alpine;

// Helper agar ikon Lucide mudah dirender ulang saat DOM berubah
window.refreshIcons = () => {
    createIcons({ icons: appIcons });
};

document.addEventListener('DOMContentLoaded', () => {
    window.refreshIcons();
});

Alpine.start();