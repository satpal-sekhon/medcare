<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $diseases = [
            ['name' => 'Diabetes', 'description' => 'A chronic condition that affects the way the body processes blood sugar (glucose).'],
            ['name' => 'Hypertension', 'description' => 'A condition in which the blood pressure in the arteries is persistently elevated.'],
            ['name' => 'Asthma', 'description' => 'A condition in which a person\'s airways become inflamed, narrow, and swell, and produce extra mucus.'],
            ['name' => 'Influenza', 'description' => 'A viral infection that attacks your respiratory system – your nose, throat, and lungs.'],
            ['name' => 'Cancer', 'description' => 'A group of diseases involving abnormal cell growth with the potential to invade or spread to other parts of the body.'],
            ['name' => 'Chronic Obstructive Pulmonary Disease (COPD)', 'description' => 'A group of progressive lung diseases that obstruct airflow from the lungs.'],
            ['name' => 'Arthritis', 'description' => 'Inflammation of one or more of your joints, causing pain and stiffness that can worsen with age.'],
            ['name' => 'Alzheimer\'s Disease', 'description' => 'A progressive disease that destroys memory and other important mental functions.'],
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
