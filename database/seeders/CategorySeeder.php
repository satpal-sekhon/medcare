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
                ['name' => 'Antibiotics', 'description' => 'Antibiotics to fight bacterial infections.'],
                ['name' => 'Antidepressants', 'description' => 'Medications for managing depression.'],
                ['name' => 'Pain Relievers', 'description' => 'Medicines for alleviating pain.'],
            ],
            'Over-the-Counter Medications' => [
                ['name' => 'Cold & Flu', 'description' => 'Medications to relieve cold and flu symptoms.'],
                ['name' => 'Allergy Relief', 'description' => 'Products to manage allergy symptoms.'],
                ['name' => 'Digestive Health', 'description' => 'Supplements and treatments for digestive issues.'],
            ],
            'Vitamins & Supplements' => [
                ['name' => 'Multivitamins', 'description' => 'Daily vitamins for overall health.'],
                ['name' => 'Minerals', 'description' => 'Essential minerals for body function.'],
                ['name' => 'Herbal Supplements', 'description' => 'Natural supplements derived from herbs.'],
            ],
            'Personal Care' => [
                ['name' => 'Skincare', 'description' => 'Products for maintaining skin health.'],
                ['name' => 'Hair Care', 'description' => 'Products for hair maintenance and health.'],
                ['name' => 'Body Care', 'description' => 'Products for overall body care and hygiene.'],
            ],
            'Health Devices' => [
                ['name' => 'Blood Pressure Monitors', 'description' => 'Devices for monitoring blood pressure.'],
                ['name' => 'Thermometers', 'description' => 'Tools for measuring body temperature.'],
                ['name' => 'Glucose Meters', 'description' => 'Devices for checking blood sugar levels.'],
            ],
            'First Aid' => [
                ['name' => 'Bandages', 'description' => 'Items for covering and protecting wounds.'],
                ['name' => 'Antiseptics', 'description' => 'Solutions for cleaning wounds and preventing infection.'],
                ['name' => 'First Aid Kits', 'description' => 'Kits containing essential first aid supplies.'],
            ],
            'Herbal Remedies' => [
                ['name' => 'Echinacea', 'description' => 'Herb used to boost the immune system.'],
                ['name' => 'Ginseng', 'description' => 'Herb known for its energy-boosting properties.'],
                ['name' => 'Lavender', 'description' => 'Herb used for relaxation and stress relief.'],
            ],
            'Dental Care' => [
                ['name' => 'Toothpaste', 'description' => 'Paste used for cleaning teeth.'],
                ['name' => 'Mouthwash', 'description' => 'Liquid used for oral hygiene and breath freshening.'],
                ['name' => 'Dental Floss', 'description' => 'Thread used for cleaning between teeth.'],
            ],
        ];

        // Iterate through the primary categories
        foreach ($categories as $primaryCategoryName => $subCategories) {
            // Create the primary category
            $primaryCategory = PrimaryCategory::create([
                'name' => $primaryCategoryName,
                'description' => 'Primary category for ' . $primaryCategoryName,
            ]);

            // Create the sub-categories
            foreach ($subCategories as $category) {
                Category::create([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'primary_category_id' => $primaryCategory->id,
                ]);
            }
        }
    }
}
