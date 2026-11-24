<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel process_steps untuk menyimpan alur pengerjaan proyek.
     */
    public function up(): void
    {
        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('number', 10); // Contoh: 01, 02, 03, 04
            $table->string('icon', 50)->default('message-square');

            // Kolom konten dwibahasa (ID & EN)
            $table->string('title_id', 150);
            $table->string('title_en', 150);
            $table->text('desc_id');
            $table->text('desc_en');

            $table->unsignedSmallInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('process_steps');
    }
};