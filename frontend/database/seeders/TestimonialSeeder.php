<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('testimonials')->insert([
            [
                'name' => 'Mark Stevens',
                'image' => 'testimonials/mark.jpg',
                'testimonial' => 'Outstanding service! They helped me find the perfect home for my family. The team was professional, attentive, and went above and beyond.',
                'subtitle' => 'Happy Homeowner',
                'rating' => 5,
                'status' => 'active',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rachel Green',
                'image' => 'testimonials/rachel.jpg',
                'testimonial' => 'I had a wonderful experience working with this team. They made the entire process smooth and stress-free. Highly recommend!',
                'subtitle' => 'First-Time Buyer',
                'rating' => 5,
                'status' => 'active',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Thomas Anderson',
                'image' => 'testimonials/thomas.jpg',
                'testimonial' => 'Great property management services. They take care of everything and my tenants are always happy. Very professional team.',
                'subtitle' => 'Property Owner',
                'rating' => 5,
                'status' => 'active',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Amanda Collins',
                'image' => 'testimonials/amanda.jpg',
                'testimonial' => 'Found my dream apartment within my budget. The agent was very knowledgeable about the area and showed me exactly what I was looking for.',
                'subtitle' => 'Satisfied Tenant',
                'rating' => 4,
                'status' => 'active',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Steven Wright',
                'image' => null,
                'testimonial' => 'Excellent commercial real estate expertise. They helped us secure the perfect office space for our growing business.',
                'subtitle' => 'Business Owner',
                'rating' => 5,
                'status' => 'active',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}