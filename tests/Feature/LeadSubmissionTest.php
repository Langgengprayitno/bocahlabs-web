<?php

namespace Tests\Feature;

use App\Models\Addon;
use App\Models\Package;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_pengunjung_dapat_menyimpan_lead_valid(): void
    {
        $package = Package::factory()->create();
        $addon = Addon::factory()->create();

        $response = $this->postJson(route('leads.store'), [
            'brand_name' => 'Kopi Nusantara',
            'package_id' => $package->id,
            'addon_ids' => [$addon->id],
            'lang' => 'id',
            'message' => 'Halo BocahLabs! Saya ingin konsultasi pembuatan website.',
            'website' => '',
        ]);

        $response->assertCreated()
            ->assertJson(['saved' => true]);

        $this->assertDatabaseHas('leads', [
            'brand_name' => 'Kopi Nusantara',
            'package_id' => $package->id,
            'lang' => 'id',
            'status' => 'baru',
        ]);
    }

    public function test_honeypot_terisi_tidak_disimpan_ke_database(): void
    {
        $response = $this->postJson(route('leads.store'), [
            'brand_name' => 'Bot Spam',
            'lang' => 'id',
            'message' => 'Pesan spam otomatis',
            'website' => 'https://spam.example.com',
        ]);

        $response->assertOk()
            ->assertJson(['saved' => false, 'ignored' => true]);

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_validasi_gagal_jika_pesan_kosong_atau_bahasa_tidak_valid(): void
    {
        $response = $this->postJson(route('leads.store'), [
            'lang' => 'fr',
            'message' => '',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['lang', 'message']);
    }

    public function test_rate_limit_membatasi_maksimal_5_permintaan_per_menit(): void
    {
        $payload = [
            'brand_name' => 'Uji Throttle',
            'lang' => 'en',
            'message' => 'Hi BocahLabs! Testing rate limit.',
        ];

        for ($i = 1; $i <= 5; $i++) {
            $this->postJson(route('leads.store'), $payload)->assertCreated();
        }

        // Permintaan ke-6 dalam 1 menit harus ditolak dengan 429 Too Many Requests
        $this->postJson(route('leads.store'), $payload)->assertStatus(429);
    }
}