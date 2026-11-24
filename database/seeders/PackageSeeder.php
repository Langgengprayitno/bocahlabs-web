<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Mengisi tabel packages dengan 4 paket persis dari prototipe.
     */
    public function run(): void
    {
        $packages = [
            [
                'slug' => 'landing-basic',
                'tier' => 'beginner',
                'is_popular' => false,
                'price_label' => 'Rp 1.500.000',
                'price_min' => 1500000,
                'image_path' => 'images/packages/landing-basic.webp',
                'name_id' => 'Paket Landing Page Basic',
                'name_en' => 'Basic Landing Page',
                'tier_label_id' => 'Kelas Beginner',
                'tier_label_en' => 'Beginner Tier',
                'tagline_id' => 'Cocok untuk UMKM & personal brand yang butuh cepat tampil online.',
                'tagline_en' => 'Ideal for SMEs & personal brands needing a fast, high-converting single page.',
                'features_id' => [
                    'Landing page 1 halaman (single-page scroll)',
                    'Desain modern, cepat, & ramah perangkat mobile',
                    'Tombol interaktif WhatsApp, Telepon, & Peta Lokasi',
                    'Estimasi pengerjaan: 3–5 hari kerja',
                    'Maksimal 2 kali revisi mayor',
                ],
                'features_en' => [
                    '1-page single-scroll landing page',
                    'Modern, fast, & mobile-friendly design',
                    'Interactive WhatsApp, Phone, & Google Maps buttons',
                    'Estimated delivery: 3–5 business days',
                    'Up to 2 major revisions',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'compro-mini',
                'tier' => 'beginner',
                'is_popular' => true,
                'price_label' => 'Rp 2.500.000',
                'price_min' => 2500000,
                'image_path' => 'images/packages/compro-mini.webp',
                'name_id' => 'Paket Company Profile Mini',
                'name_en' => 'Mini Company Profile',
                'tier_label_id' => 'Kelas Beginner',
                'tier_label_en' => 'Beginner Tier',
                'tagline_id' => 'Tampilan profil usaha elegan multi-halaman untuk meningkatkan kredibilitas.',
                'tagline_en' => 'Elegant multi-page company presence built for local credibility and SEO.',
                'features_id' => [
                    'Website 3–5 halaman (Beranda, Tentang, Layanan, Kontak)',
                    'Desain kustom elegan & ramah mesin pencari lokal',
                    'Integrasi media sosial & tombol melayang WhatsApp',
                    'Panduan penggunaan singkat bagi pengelola',
                    'Estimasi pengerjaan: 5–7 hari kerja',
                ],
                'features_en' => [
                    '3–5 pages (Home, About, Services, Contact)',
                    'Custom elegant design & local SEO ready',
                    'Social media integration & floating WhatsApp button',
                    'Short handover guide for site managers',
                    'Estimated delivery: 5–7 business days',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'pro-business',
                'tier' => 'professional',
                'is_popular' => false,
                'price_label' => 'Rp 3.000.000 – Rp 4.500.000',
                'price_min' => 3000000,
                'image_path' => 'images/packages/pro-business.webp',
                'name_id' => 'Paket Pro Business',
                'name_en' => 'Pro Business Website',
                'tier_label_id' => 'Kelas Professional',
                'tier_label_en' => 'Professional Tier',
                'tagline_id' => 'Website dinamis dengan panel admin mandiri dan keamanan tingkat lanjut.',
                'tagline_en' => 'Dynamic multi-page site with custom CMS admin panel & advanced security.',
                'features_id' => [
                    'Website dinamis multi-halaman & blog/artikel',
                    'Panel admin khusus untuk kelola konten mandiri',
                    'Keamanan tingkat lanjut & optimasi struktur data',
                    'Sesi pelatihan admin langsung via video call',
                    'Garansi perbaikan bug 1 bulan',
                ],
                'features_en' => [
                    'Dynamic multi-page website & blog/articles',
                    'Dedicated admin panel for independent content updates',
                    'Advanced security & structured data optimization',
                    'Live admin onboarding session via video call',
                    '1-month bug-fix warranty',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'slug' => 'pro-custom',
                'tier' => 'professional',
                'is_popular' => false,
                'price_label' => 'Rp 5.000.000 – Rp 7.000.000+',
                'price_min' => 5000000,
                'image_path' => 'images/packages/pro-custom.webp',
                'name_id' => 'Paket Pro Custom System',
                'name_en' => 'Pro Custom Web System',
                'tier_label_id' => 'Kelas Professional',
                'tier_label_en' => 'Professional Tier',
                'tagline_id' => 'Sistem web fungsional khusus seperti booking, reservasi, & portal bisnis.',
                'tagline_en' => 'Tailored web application for booking, reservations, portals & API integrations.',
                'features_id' => [
                    'Sistem fungsional khusus (booking, reservasi, portal)',
                    'Panel admin lanjutan dengan fitur export data (Excel/PDF)',
                    'Integrasi layanan pihak ketiga / API pendukung',
                    'Garansi perbaikan bug 1 bulan',
                    'Estimasi pengerjaan: 3–5 minggu',
                ],
                'features_en' => [
                    'Custom functional system (booking, reservation, portal)',
                    'Advanced admin panel with Excel/PDF data export',
                    'Third-party service & API integrations',
                    '1-month bug-fix warranty',
                    'Estimated delivery: 3–5 weeks',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            Package::updateOrCreate(
                ['slug' => $package['slug']],
                $package
            );
        }
    }
}