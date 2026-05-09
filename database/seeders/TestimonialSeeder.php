<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::create([
            'name' => 'Ahmed Khan',
            'position' => 'CEO, TechVista Solutions',
            'quote' => 'They transformed our online presence completely. The new website increased our conversions by 180%.',
            'image' => 'testimonials/ahmed-khan.jpg',
            'rating' => 5,
        ]);

        Testimonial::create([
            'name' => 'Sana Malik',
            'position' => 'Marketing Director, Lumina Brands',
            'quote' => 'Best agency we\'ve worked with. Professional, creative, and delivered exactly what we needed.',
            'image' => 'testimonials/sana-malik.jpg',
            'rating' => 5,
        ]);

        Testimonial::create([
            'name' => 'Bilal Rehman',
            'position' => 'Founder, GrowthHub',
            'quote' => 'Their attention to detail and modern approach helped us stand out in a competitive market.',
            'image' => 'testimonials/bilal-rehman.jpg',
            'rating' => 5,
        ]);
    }
}
