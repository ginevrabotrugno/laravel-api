<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\TypeTableSeeder;
use Database\Seeders\ProjectTechnologyTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TechnologiesTableSeeder::class,
            TypeTableSeeder::class,
            ProjectSeeder::class,
            ProjectTechnologyTableSeeder::class
        ]);
    }
}
