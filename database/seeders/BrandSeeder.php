<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'HealthPro',
            'description' => 'Leading brand in healthcare products.',
        ]);

        Brand::create([
            'name' => 'MediCare',
            'description' => 'Innovative solutions for better health.',
        ]);

        Brand::create([
            'name' => 'WellnessPlus',
            'description' => 'Your partner in wellness and vitality.',
        ]);
    }
}
