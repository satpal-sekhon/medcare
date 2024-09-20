<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::truncate();

        $menuItems = [
            [
                'label' => 'Wellness',
                'parent_id' => null,
                'menu_type' => 'primary'
            ],
            [
                'label' => 'Search Medicine',
                'parent_id' => null,
                'is_dropdown' => true,
            ],
            [
                'label' => 'Generic Medicine',
                'route_name' => 'search-medicines',
                'parent_id' => 2,
                'meta_tags' => json_encode([
                    'meta_name' => 'Generic Medicine',
                    'meta_description' => 'Search for generic medicines.',
                    'meta_keywords' => 'generic, medicines',
                ]),
            ],
            [
                'label' => 'All Products',
                'route_name' => 'products.index',
                'parent_id' => 2,
                'meta_tags' => json_encode([
                    'meta_name' => 'All Products',
                    'meta_description' => 'Browse all available products.',
                    'meta_keywords' => 'products, medicines',
                ]),
            ],
            [
                'label' => 'Brands',
                'route_name' => 'brands.index',
                'parent_id' => null,
                'meta_tags' => json_encode([
                    'meta_name' => 'Brands',
                    'meta_description' => 'Explore our brands.',
                    'meta_keywords' => 'brands, products',
                ]),
            ],
            [
                'label' => 'Lab Test',
                'route_name' => 'lab-test.index',
                'parent_id' => null,
                'meta_tags' => json_encode([
                    'meta_name' => 'Lab Test',
                    'meta_description' => 'Information on lab tests.',
                    'meta_keywords' => 'lab, tests',
                ]),
            ],
            [
                'label' => 'Pharmacy',
                'route_name' => 'pharmacy.index',
                'parent_id' => null,
                'meta_tags' => json_encode([
                    'meta_name' => 'Pharmacy',
                    'meta_description' => 'Find a pharmacy near you.',
                    'meta_keywords' => 'pharmacy, medicines',
                ]),
            ],
            [
                'label' => 'Doctors',
                'route_name' => 'doctors.index',
                'parent_id' => null,
                'meta_tags' => json_encode([
                    'meta_name' => 'Doctors',
                    'meta_description' => 'Find a doctor.',
                    'meta_keywords' => 'doctors, health',
                ]),
            ],
            [
                'label' => 'Company +',
                'parent_id' => null,
                'is_dropdown' => true,
            ],
            [
                'label' => 'About Us',
                'route_name' => 'about-us',
                'parent_id' => 9,
                'meta_tags' => json_encode([
                    'meta_name' => 'About Us',
                    'meta_description' => 'Learn more about us.',
                    'meta_keywords' => 'about, us',
                ]),
            ],
            [
                'label' => 'FAQs',
                'route_name' => 'faq',
                'parent_id' => 9,
                'meta_tags' => json_encode([
                    'meta_name' => 'FAQs',
                    'meta_description' => 'Frequently asked questions.',
                    'meta_keywords' => 'faq, questions',
                ]),
            ],
            [
                'label' => 'Contact Us',
                'route_name' => 'contact-us',
                'parent_id' => 9,
                'meta_tags' => json_encode([
                    'meta_name' => 'Contact Us',
                    'meta_description' => 'Get in touch with us.',
                    'meta_keywords' => 'contact, support',
                ]),
            ],
            [
                'label' => 'Quick Order',
                'route_name' => 'quick-order',
                'menu_type' => 'secondary',
                'meta_tags' => json_encode([
                    'meta_name' => 'Quick Order',
                    'meta_description' => 'Quickly order your products.',
                    'meta_keywords' => 'quick order, products',
                ]),
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::create($item);
        }
    }
}
