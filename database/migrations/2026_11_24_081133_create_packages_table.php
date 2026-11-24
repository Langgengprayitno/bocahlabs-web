<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel packages untuk menyimpan daftar paket layanan.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('tier', 30)->index(); // beginner atau professional
            $table->boolean('is_popular')->default(false);
            $table->string('price_label', 100);
            $table->unsignedBigInteger('price_min')->nullable();
            $table->string('image_path', 255)->nullable();

            // Kolom konten dwibahasa (ID & EN)
            $table->string('name_id', 150);
            $table->string('name_en', 150);
            $table->string('tier_label_id', 100);
            $table->string('tier_label_en', 100);
            $table->text('tagline_id');
            $table->text('tagline_en');
            $table->json('features_id');
            $table->json('features_en');

            $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};