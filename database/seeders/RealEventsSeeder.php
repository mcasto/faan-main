<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RealEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gala FAAN-tastica 2025 (current major event)
        $gala = Event::create([
            'title' => 'Gala FAAN-tastica 2025',
            'subtitle' => 'The wait is over!',
            'starts' => Carbon::parse('2025-07-30'),
            'expires' => Carbon::parse('2025-11-22'),
            'hide_dates' => true,
            'is_active' => true,
            'slug' => 'gala-faantastica-2025'
        ]);

        // Create HTML content for Gala
        $galaContent = '<div class="event-content">
            <p>Cuenca\'s Charity Event of the Year. FAAN is building Ecuador\'s first North American Standard Animal Shelter and helping Cuenca become known as <em>The City That Cares</em>.</p>

            <div class="event-details mt-4">
                <h3 class="font-bold text-lg mb-2">Event Information</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="mb-2"><strong>Date:</strong> Saturday, November 22, 2025</div>
                    <div class="mb-2"><strong>Time:</strong> 6:00 - 7:00 VIP Champagne Hour</div>
                    <div class="mb-2"><strong>Venue:</strong> Estancia Rosario</div>
                    <div class="mb-2"><strong>Location:</strong> Located next to Hospital Del Rio</div>
                    <div class="mb-2"><strong>Dress Code:</strong> Elegant Evening or Cocktail Attire</div>
                    <div class="mb-2"><strong>Tickets:</strong> $85 with VIP Champagne Hour</div>
                    <div class="mb-2"><strong>Features:</strong> Table Ambassadorships Available, Movie-Themed Tables</div>
                </div>

                <div class="mt-4">
                    <a href="https://gala.faanecuador.org" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                        Learn More & Get Tickets
                    </a>
                </div>
            </div>
        </div>';

        Storage::disk('public')->put('events/' . $gala->id . '.html', $galaContent);
        echo 'Created: ' . $gala->title . ' (ID: ' . $gala->id . ')' . PHP_EOL;

        // Add a current volunteer/donation drive (inspired by old "Amigo Secreto" concept)
        $drive = Event::create([
            'title' => 'Emergency Shelter Fund Drive',
            'subtitle' => 'Help us complete the new shelter construction',
            'starts' => Carbon::parse('2025-08-01'),
            'expires' => Carbon::parse('2025-12-31'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'emergency-shelter-fund-2025'
        ]);

        $driveContent = '<div class="event-content">
            <p>FAAN needs your help to complete the construction of Ecuador\'s first North American Standard Animal Shelter. Recent weather challenges have made this project even more urgent.</p>

            <h3 class="font-bold text-lg mt-4 mb-2">How You Can Help:</h3>
            <ul class="list-disc ml-6 mb-4">
                <li>Make a financial contribution to the shelter construction fund</li>
                <li>Sponsor a dog kennel or cat enclosure</li>
                <li>Donate construction materials or services</li>
                <li>Volunteer your time for fundraising events</li>
            </ul>

            <p class="bg-blue-50 p-4 rounded-lg">
                <strong>Goal:</strong> Raise $50,000 by December 2025 to complete Phase 1 of the new shelter construction.
            </p>

            <div class="mt-4">
                <a href="/donations" class="text-blue-600 hover:text-blue-800 underline font-semibold">
                    Donate Now to Help Build the Shelter
                </a>
            </div>
        </div>';

        Storage::disk('public')->put('events/' . $drive->id . '.html', $driveContent);
        echo 'Created: ' . $drive->title . ' (ID: ' . $drive->id . ')' . PHP_EOL;
    }
}
