<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamMember::create([
            'name' => 'Muhammad Qasim',
            'role' => 'Founder & Creative Director',
            'bio' => 'Visionary leader with 10+ years of experience in digital design and branding.',
            'image' => 'team/qasim.jpg',
            'email' => 'qasim@webagency.com',
        ]);

        TeamMember::create([
            'name' => 'Ayesha Khan',
            'role' => 'UI/UX Designer',
            'bio' => 'Award-winning designer specializing in user-centered design solutions.',
            'image' => 'team/ayesha.jpg',
            'email' => 'ayesha@webagency.com',
        ]);

        TeamMember::create([
            'name' => 'Bilal Ahmed',
            'role' => 'Lead Developer',
            'bio' => 'Full-stack developer with expertise in Laravel and Vue.js technologies.',
            'image' => 'team/bilal.jpg',
            'email' => 'bilal@webagency.com',
        ]);

        TeamMember::create([
            'name' => 'Sara Malik',
            'role' => 'Digital Strategist',
            'bio' => 'Strategic thinker focused on data-driven marketing and business growth.',
            'image' => 'team/sara.jpg',
            'email' => 'sara@webagency.com',
        ]);
    }
}
