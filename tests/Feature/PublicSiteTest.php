<?php

namespace Tests\Feature;

use App\Models\MarketingCode;
use App\Models\Package;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_utama_memuat_data_seo_dan_security_headers(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Paket Landing Page Basic')
            ->assertSee('Paket Company Profile Mini')
            ->assertSee('ProfessionalService')
            ->assertSee('og:title', false)
            ->assertSee('hreflang="en"', false)
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_ganti_bahasa_ke_inggris_menampilkan_konten_en(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->get('/lang/en')->assertRedirect();

        $this->withSession(['locale' => 'en'])
            ->get('/')
            ->assertOk()
            ->assertSee('Mini Company Profile')
            ->assertSee('Annual Maintenance &amp; Support', false);
    }

    public function test_sitemap_xml_valid(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<urlset', false)
            ->assertSee('hreflang="id"', false);
    }

    public function test_panel_admin_memerlukan_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_lead_dengan_kode_marketing_aktif_otomatis_terhubung(): void
    {
        $package = Package::factory()->create();
        $code = MarketingCode::create([
            'code' => 'BOCAH-RINA',
            'marketer_name' => 'Rina Wijaya',
            'discount_label' => 'Diskon Rp 150.000',
            'is_active' => true,
        ]);

        $this->postJson(route('leads.store'), [
            'brand_name' => 'Kopi Nusantara',
            'package_id' => $package->id,
            'promo_code' => 'bocah-rina',
            'lang' => 'id',
            'message' => 'Halo BocahLabs! Test kode marketing.',
        ])->assertCreated();

        $this->assertDatabaseHas('leads', [
            'brand_name' => 'Kopi Nusantara',
            'marketing_code_id' => $code->id,
            'promo_code' => 'BOCAH-RINA',
        ]);
    }
}