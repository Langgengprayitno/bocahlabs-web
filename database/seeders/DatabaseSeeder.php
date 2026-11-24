<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Menjalankan seluruh seeder data awal BocahLabs.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            PackageSeeder::class,
            AddonSeeder::class,
            ProcessStepSeeder::class,
            FaqSeeder::class,
        ]);
    }
}