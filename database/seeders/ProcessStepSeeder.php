<?php

namespace Database\Seeders;

use App\Models\ProcessStep;
use Illuminate\Database\Seeder;

class ProcessStepSeeder extends Seeder
{
    /**
     * Mengisi tabel process_steps dengan 4 langkah pengerjaan persis dari prototipe.
     */
    public function run(): void
    {
        $steps = [
            [
                'number' => '01',
                'icon' => 'messages-square',
                'title_id' => 'Konsultasi & Brief',
                'title_en' => 'Discovery & Brief',
                'desc_id' => 'Diskusikan target usaha, fitur yang dibutuhkan, dan pilih paket paling sesuai via WhatsApp.',
                'desc_en' => 'Share your business goals, required features, and choose the best tier via WhatsApp.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'number' => '02',
                'icon' => 'layout-template',
                'title_id' => 'Desain & Prototipe',
                'title_en' => 'UI Design & Prototype',
                'desc_id' => 'Kami susun tampilan visual selaras dengan branding Anda agar bisa dicek sebelum coding.',
                'desc_en' => 'We craft a brand-aligned visual preview for your approval before full development.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'number' => '03',
                'icon' => 'code-2',
                'title_id' => 'Pengembangan & Uji',
                'title_en' => 'Build & QA Testing',
                'desc_id' => 'Website dibangun responsif, cepat diakses di HP maupun laptop, serta diuji menyeluruh.',
                'desc_en' => 'Built responsive and fast across mobile and desktop, followed by thorough testing.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'number' => '04',
                'icon' => 'rocket',
                'title_id' => 'Launch & Garansi',
                'title_en' => 'Launch & Warranty',
                'desc_id' => 'Serah terima, panduan admin, dan dukungan garansi perbaikan bug 1 bulan untuk paket Pro.',
                'desc_en' => 'Live deployment, admin handover, plus 1-month bug-fix warranty on Pro tiers.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($steps as $step) {
            ProcessStep::updateOrCreate(
                ['number' => $step['number']],
                $step
            );
        }
    }
}