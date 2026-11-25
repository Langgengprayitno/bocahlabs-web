<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->foreignId('marketing_code_id')
                ->nullable()
                ->after('package_id')
                ->constrained('marketing_codes')
                ->nullOnDelete();
            $table->string('promo_code', 50)->nullable()->after('marketing_code_id');
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropConstrainedForeignId('marketing_code_id');
            $table->dropColumn('promo_code');
        });
    }
};