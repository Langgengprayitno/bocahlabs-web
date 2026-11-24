<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Mengisi data pengaturan awal situs sesuai prototipe BocahLabs.
     */
    public function run(): void
    {
        $settings = [
            'wa_number' => '6285667667059',
            'brand_name' => 'BocahLabs',
            'logo_path' => 'images/logo.png',
            'stat_1_value_id' => '3–5 Hari',
            'stat_1_value_en' => '3–5 Days',
            'stat_1_label_id' => 'Estimasi Mulai',
            'stat_1_label_en' => 'Starting From',
            'stat_2_value_id' => '100%',
            'stat_2_value_en' => '100%',
            'stat_2_label_id' => 'Mobile Friendly',
            'stat_2_label_en' => 'Mobile Friendly',
            'stat_3_value_id' => '1 Bulan',
            'stat_3_value_en' => '1 Month',
            'stat_3_label_id' => 'Garansi Bug Pro',
            'stat_3_label_en' => 'Pro Bug Warranty',
            'footer_copy_id' => '© 2026 BocahLabs — Website Development Service. Semua hak dilindungi.',
            'footer_copy_id' => '© 2026 BocahLabs — Website Development Service. Semua hak dilindungi.',
        ];

        foreach ($settings as $key => $value) {
            Setting::query()->updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}