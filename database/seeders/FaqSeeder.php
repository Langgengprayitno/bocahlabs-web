<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Mengisi tabel faqs dengan 4 pertanyaan umum persis dari prototipe.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question_id' => 'Apakah saya bisa melihat contoh tampilan sebelum website jadi?',
                'question_en' => 'Can I review a design preview before the website is built?',
                'answer_id' => 'Tentu. Setiap proyek diawali dengan kesepakatan struktur & prototipe visual agar hasil akhirnya sesuai dengan karakter bisnis Anda.',
                'answer_en' => 'Yes. Every project begins with layout and visual prototype alignment so the final site matches your brand.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'question_id' => 'Bagaimana jika saya belum punya teks atau materi konten?',
                'question_en' => 'What if I do not have website copy or written content yet?',
                'answer_id' => 'Anda cukup kirim info singkat seputar usaha Anda, atau tambahkan layanan Copywriting (Rp 150.000/halaman) agar tim kami bantu susun kalimat yang menjual.',
                'answer_en' => 'Simply share basic notes about your business, or add our Copywriting add-on (Rp 150,000/page) and we will write conversion-ready text for you.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'question_id' => 'Bagaimana cakupan Garansi Bug 1 Bulan pada paket Professional?',
                'question_en' => 'What does the 1-Month Bug Warranty on Professional plans cover?',
                'answer_id' => 'Jika ditemukan kendala teknis atau bug pada fitur yang telah disepakati dalam 1 bulan sejak serah terima, tim BocahLabs akan memperbaikinya tanpa biaya tambahan.',
                'answer_en' => 'If any technical issue or bug appears within the agreed scope during the first month after handover, BocahLabs fixes it at no extra cost.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'question_id' => 'Apakah website bisa dibuka dengan nyaman di HP?',
                'question_en' => 'Will the website work smoothly on mobile phones?',
                'answer_id' => 'Ya, semua paket BocahLabs dirancang mobile-friendly sejak awal karena mayoritas calon pelanggan UMKM membuka website langsung dari smartphone.',
                'answer_en' => 'Yes, every BocahLabs package is designed mobile-first so visitors on smartphones get a fast, smooth experience.',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['sort_order' => $faq['sort_order']],
                $faq
            );
        }
    }
}