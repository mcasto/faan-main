<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class AdditionalEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Volunteer Appreciation Day event
        Event::create([
            'title' => 'Volunteer Appreciation Day',
            'subtitle' => 'Celebrating Our Amazing Volunteers',
            'starts' => Carbon::now()->subDays(5),
            'expires' => Carbon::now()->addDays(10),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'volunteer-appreciation-2025'
        ]);

        // Create Monthly Adoption Fair event
        Event::create([
            'title' => 'Monthly Adoption Fair',
            'subtitle' => 'Find Your Perfect Companion',
            'starts' => Carbon::now()->addDays(2),
            'expires' => Carbon::now()->addDays(30),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'adoption-fair-august-2025'
        ]);
    }
}
