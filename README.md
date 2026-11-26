# BocahLabs — Website Development Service

Platform web resmi untuk layanan jasa pembuatan website **BocahLabs** yang dibangun menggunakan **Laravel 11**, **MySQL**, **Filament v3**, **Tailwind CSS**, dan **Alpine.js**.

## Fitur Utama

- **Bilingua Penuh (ID / EN)** — Terjemahan antarmuka statis (`lang/id`, `lang/en`) dan konten dinamis database lewat Eloquent accessor, lengkap dengan tag `hreflang`.
- **Dark & Light Mode (Zero-Flash)** — Preferensi tema tersimpan di `localStorage` dengan skrip anti-flash di `<head>`.
- **Interaktivitas Alpine.js & Scroll-Craft** — Tab preview paket di Hero, Lightbox galeri, filter tier tanpa reload, akordeon FAQ, koreografi scroll berbasis GPU (`transform`, `opacity`, `clip-path`), serta dukungan `prefers-reduced-motion`.
- **Modal Brief, Tracking Kode Marketing, & Integrasi WhatsApp** — Pratinjau pesan WhatsApp real-time (ID/EN), pencocokan kode referral/diskon tim marketing, penyimpanan lead via `POST /leads` (CSRF, `FormRequest`, `throttle:5,1`, honeypot), dan tombol Salin Teks + Toast.
- **Panel Admin Filament (`/admin`)** — CRUD konten dwibahasa (Tab ID/EN) untuk Paket, Add-ons, Alur Kerja, FAQ, Pengaturan, **Kode Marketing** (otomatis menghitung jumlah klien per marketer), dan **Manajemen Leads** (filter status & tim marketing, ekspor CSV, tombol Hubungi WA, serta widget statistik).
- **SEO, Performa, & Keamanan** — Meta/Open Graph, JSON-LD `ProfessionalService`, `/sitemap.xml`, `robots.txt`, caching query halaman utama dengan auto-invalidation saat admin mengedit data, `SecurityHeaders` middleware, serta PHPUnit Feature Tests.

## Tech Stack

- **Backend:** PHP 8.2+, Laravel 11, MySQL / MariaDB
- **Admin Panel:** Filament v3
- **Frontend:** Blade Components, Tailwind CSS 3.4, Vite, Alpine.js, Lucide Icons (tree-shaken)
- **Testing:** PHPUnit (`LeadSubmissionTest`, `PublicSiteTest`)

## Cara Menjalankan Secara Lokal

```bash
git clone [https://github.com/USERNAME_ANDA/bocahlabs-web.git](https://github.com/USERNAME_ANDA/bocahlabs-web.git)
cd bocahlabs-web
composer install
npm install
cp .env.example .env
php artisan key:generate
# Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD di .env
php artisan migrate --seed
php artisan make:filament-user
npm run build
php artisan serve
