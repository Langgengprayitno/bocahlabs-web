import './bootstrap';
import Alpine from 'alpinejs';

// Ekspos Alpine ke window agar bisa dipakai di komponen Blade
window.Alpine = Alpine;
Alpine.start();