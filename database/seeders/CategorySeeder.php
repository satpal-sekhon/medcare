<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PrimaryCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define primary categories and their sub-categories
        $categories = [
            'Prescription Medications' => [
                ['name' => 'Antibiotics', 'short_description' => 'Antibiotics to fight bacterial infections.'],
                ['name' => 'Antidepressants', 'short_description' => 'Medications for managing depression.'],
                ['name' => 'Pain Relievers', 'short_description' => 'Medicines for alleviating pain.'],
            ],
            'Over-the-Counter Medications' => [
                ['name' => 'Cold & Flu', 'short_description' => 'Medications to relieve cold and flu symptoms.'],
                ['name' => 'Allergy Relief', 'short_description' => 'Products to manage allergy symptoms.'],
                ['name' => 'Digestive Health', 'short_description' => 'Supplements and treatments for digestive issues.'],
            ],
            'Vitamins & Supplements' => [
                ['name' => 'Multivitamins', 'short_description' => 'Daily vitamins for overall health.'],
                ['name' => 'Minerals', 'short_description' => 'Essential minerals for body function.'],
                ['name' => 'Herbal Supplements', 'short_description' => 'Natural supplements derived from herbs.'],
            ],
            'Personal Care' => [
                ['name' => 'Skincare', 'short_description' => 'Products for maintaining skin health.'],
                ['name' => 'Hair Care', 'short_description' => 'Products for hair maintenance and health.'],
                ['name' => 'Body Care', 'short_description' => 'Products for overall body care and hygiene.'],
            ],
            'Health Devices' => [
                ['name' => 'Blood Pressure Monitors', 'short_description' => 'Devices for monitoring blood pressure.'],
                ['name' => 'Thermometers', 'short_description' => 'Tools for measuring body temperature.'],
                ['name' => 'Glucose Meters', 'short_description' => 'Devices for checking blood sugar levels.'],
            ],
            'First Aid' => [
                ['name' => 'Bandages', 'short_description' => 'Items for covering and protecting wounds.'],
                ['name' => 'Antiseptics', 'short_description' => 'Solutions for cleaning wounds and preventing infection.'],
                ['name' => 'First Aid Kits', 'short_description' => 'Kits containing essential first aid supplies.'],
            ],
            'Herbal Remedies' => [
                ['name' => 'Echinacea', 'short_description' => 'Herb used to boost the immune system.'],
                ['name' => 'Ginseng', 'short_description' => 'Herb known for its energy-boosting properties.'],
                ['name' => 'Lavender', 'short_description' => 'Herb used for relaxation and stress relief.'],
            ],
            'Dental Care' => [
                ['name' => 'Toothpaste', 'short_description' => 'Paste used for cleaning teeth.'],
                ['name' => 'Mouthwash', 'short_description' => 'Liquid used for oral hygiene and breath freshening.'],
                ['name' => 'Dental Floss', 'short_description' => 'Thread used for cleaning between teeth.'],
            ],
        ];

        // Iterate through the primary categories
        foreach ($categories as $primaryCategoryName => $subCategories) {
            // Create the primary category
            $primaryCategory = PrimaryCategory::create([
                'name' => $primaryCategoryName,
                'short_description' => 'Primary category for ' . $primaryCategoryName,
            ]);

            // Create the sub-categories
            foreach ($subCategories as $category) {
                Category::create([
                    'name' => $category['name'],
                    'short_description' => $category['short_description'],
                    'primary_category_id' => $primaryCategory->id,
                ]);
            }
        }
    }
}
