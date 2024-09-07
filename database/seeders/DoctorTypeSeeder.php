<?php

namespace Database\Seeders;

use App\Models\DoctorType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorTypes = [
            ['name' => 'General Practitioner'],
            ['name' => 'Cardiologist'],
            ['name' => 'Dermatologist'],
            ['name' => 'Neurologist'],
            ['name' => 'Pediatrician'],
            ['name' => 'Oncologist'],
            ['name' => 'Gynecologist'],
            ['name' => 'Orthopedic Surgeon'],
            ['name' => 'Ophthalmologist'],
            ['name' => 'Otolaryngologist'],
            ['name' => 'Pulmonologist'],
            ['name' => 'Rheumatologist'],
            ['name' => 'Urologist'],
            ['name' => 'Endocrinologist'],
            ['name' => 'Gastroenterologist'],
            ['name' => 'Hematologist'],
            ['name' => 'Infectious Disease Specialist'],
            ['name' => 'Nephrologist'],
            ['name' => 'Plastic Surgeon'],
            ['name' => 'Anesthesiologist'],
            ['name' => 'Radiologist'],
            ['name' => 'Emergency Medicine Specialist'],
            ['name' => 'Sports Medicine Specialist'],
            ['name' => 'Vascular Surgeon'],
            ['name' => 'Pathologist'],
            ['name' => 'Internal Medicine Specialist'],
            ['name' => 'Allergist'],
            ['name' => 'Addiction Medicine Specialist'],
            ['name' => 'Family Medicine Specialist'],
            ['name' => 'Palliative Care Specialist'],
            ['name' => 'Pain Management Specialist'],
            ['name' => 'Geriatrician'],
            ['name' => 'Medical Geneticist'],
            ['name' => 'Sleep Medicine Specialist'],
            ['name' => 'Clinical Immunologist'],
            ['name' => 'Bariatric Surgeon'],
            ['name' => 'Clinical Pharmacologist'],
        ];

        foreach ($doctorTypes as $doctorType) {
            DoctorType::create($doctorType);
        }
    }
}
