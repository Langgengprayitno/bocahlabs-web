<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel addons untuk menyimpan layanan tambahan.
     */
    public function up(): void
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 100)->unique();
            $table->string('icon', 50)->default('sparkles');

            // Kolom konten dwibahasa (ID & EN)
            $table->string('price_label_id', 100);
            $table->string('price_label_en', 100);
            $table->string('name_id', 150);
            $table->string('name_en', 150);
            $table->text('desc_id');
            $table->text('desc_en');

            $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addons');
    }
};