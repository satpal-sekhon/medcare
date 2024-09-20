<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'terms-and-conditions',
                'name' => 'Terms and Conditions',
                'content' => '<h1>Terms and Conditions</h1><p>Your terms and conditions content goes here.</p>',
                'meta_title' => 'Terms and Conditions',
                'meta_description' => 'Read our terms and conditions for using our services.',
                'meta_tags' => 'terms, conditions, agreement'
            ],
            [
                'slug' => 'privacy-policy',
                'name' => 'Privacy Policy',
                'content' => '<h1>Privacy Policy</h1><p>Your privacy policy content goes here.</p>',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Learn about how we handle your personal information.',
                'meta_tags' => 'privacy, policy, data'
            ],
            [
                'slug' => 'return-and-refund-policy',
                'name' => 'Return & Refund Policy',
                'content' => '<h1>Return & Refund Policy</h1><p>Your return and refund policy content goes here.</p>',
                'meta_title' => 'Return & Refund Policy',
                'meta_description' => 'Find out about our return and refund processes.',
                'meta_tags' => 'return, refund, policy'
            ],
            [
                'slug' => 'shipping-and-delivery',
                'name' => 'Shipping & Delivery',
                'content' => '<h1>Shipping & Delivery</h1><p>Your shipping and delivery content goes here.</p>',
                'meta_title' => 'Shipping & Delivery',
                'meta_description' => 'Information about our shipping and delivery services.',
                'meta_tags' => 'shipping, delivery, service'
            ],
            [
                'slug' => 'about-us',
                'name' => 'About Us',
                'content' => '<h1>About Us</h1><p>Your about us content goes here.</p>',
                'meta_title' => 'About Us',
                'meta_description' => 'Learn more about our company and mission.',
                'meta_tags' => 'about, us, company'
            ],
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
