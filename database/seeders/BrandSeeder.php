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
        // Define the array of medical brands with descriptions
        $brands = [
            ['name' => 'Pfizer', 'description' => 'Pfizer is a leading pharmaceutical company known for its innovations in vaccines and medicines.'],
            ['name' => 'Johnson & Johnson', 'description' => 'Johnson & Johnson is a multinational corporation specializing in medical devices, pharmaceuticals, and consumer health products.'],
            ['name' => 'Merck', 'description' => 'Merck & Co., Inc. is a global healthcare company providing innovative medicines, vaccines, and animal health products.'],
            ['name' => 'Novartis', 'description' => 'Novartis is a Swiss multinational pharmaceutical company focusing on innovative medicines and generics.'],
            ['name' => 'Abbott', 'description' => 'Abbott Laboratories offers a wide range of health care products including diagnostics, medical devices, and nutritional products.'],
            ['name' => 'Roche', 'description' => 'Roche is a Swiss multinational healthcare company that operates worldwide under two divisions: Pharmaceuticals and Diagnostics.'],
            ['name' => 'Bayer', 'description' => 'Bayer is a global enterprise with core competencies in the Life Science fields of health care and agriculture.'],
            ['name' => 'GSK', 'description' => 'GlaxoSmithKline (GSK) is a global healthcare company focused on pharmaceuticals, vaccines, and consumer healthcare products.'],
            ['name' => 'Sanofi', 'description' => 'Sanofi is a global biopharmaceutical company offering solutions in various therapeutic areas including diabetes, vaccines, and rare diseases.'],
            ['name' => 'AstraZeneca', 'description' => 'AstraZeneca is a global biopharmaceutical company engaged in the discovery, development, and commercialization of prescription medicines.'],
        ];

        // Insert the brands into the database
        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
