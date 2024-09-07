<?php

namespace Database\Seeders;

use App\Models\LabTest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labTests = [
            ['name' => 'Blood Test', 'description' => 'A test to check various blood parameters.'],
            ['name' => 'Urine Test', 'description' => 'A test to analyze urine samples.'],
            ['name' => 'X-Ray', 'description' => 'An imaging test to view internal structures.'],
            ['name' => 'CT Scan', 'description' => 'A more detailed imaging test.'],
            ['name' => 'MRI Scan', 'description' => 'Advanced imaging for detailed views.'],
            ['name' => 'Ultrasound', 'description' => 'A non-invasive imaging technique using sound waves.'],
            ['name' => 'Hematology Test', 'description' => 'A test to analyze blood components.'],
            ['name' => 'Biopsy', 'description' => 'A test to examine tissue samples for abnormalities.'],
            ['name' => 'Genetic Test', 'description' => 'A test to identify genetic disorders.'],
            ['name' => 'Allergy Test', 'description' => 'A test to identify allergens causing allergic reactions.'],
            ['name' => 'Liver Function Test', 'description' => 'A test to assess liver health.'],
            ['name' => 'Kidney Function Test', 'description' => 'A test to evaluate kidney function.'],
            ['name' => 'Thyroid Function Test', 'description' => 'A test to check thyroid gland activity.'],
            ['name' => 'Pregnancy Test', 'description' => 'A test to confirm pregnancy.'],
            ['name' => 'Cholesterol Test', 'description' => 'A test to measure cholesterol levels in the blood.'],
            ['name' => 'Blood Sugar Test', 'description' => 'A test to measure blood glucose levels.'],
        ];


        foreach ($labTests as $test) {
            LabTest::create($test);
        }
    }
}
