<?php

namespace Database\Seeders;

use App\Models\Addon;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Mengisi tabel addons dengan 3 layanan tambahan persis dari prototipe.
     */
    public function run(): void
    {
        $addons = [
            [
                'slug' => 'copywriting',
                'icon' => 'pen-tool',
                'price_label_id' => 'Rp 150.000 / halaman',
                'price_label_en' => 'Rp 150,000 / page',
                'name_id' => 'Jasa Penulisan Teks (Copywriting)',
                'name_en' => 'Sales Copywriting',
                'desc_id' => 'Penyusunan kalimat penawaran produk yang menjual per halaman.',
                'desc_en' => 'Persuasive, conversion-focused product copy written per page.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'slug' => 'local-seo',
                'icon' => 'map-pin',
                'price_label_id' => 'Rp 300.000',
                'price_label_en' => 'Rp 300,000',
                'name_id' => 'Setup Google Business & Local SEO',
                'name_en' => 'Google Business & Local SEO',
                'desc_id' => 'Optimalisasi agar bisnis tampil optimal di peta pencarian lokal.',
                'desc_en' => 'Optimize your presence on Google Maps and local search results.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'slug' => 'maintenance',
                'icon' => 'shield-check',
                'price_label_id' => 'Mulai Rp 350.000 / tahun',
                'price_label_en' => 'From Rp 350,000 / year',
                'name_id' => 'Maintenance & Support Tahunan',
                'name_en' => 'Annual Maintenance & Support',
                'desc_id' => 'Pemeliharaan berkala, backup data, dan kuota update konten minor.',
                'desc_en' => 'Routine updates, scheduled backups, and minor content edits.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($addons as $addon) {
            Addon::updateOrCreate(
                ['slug' => $addon['slug']],
                $addon
            );
        }
    }
}