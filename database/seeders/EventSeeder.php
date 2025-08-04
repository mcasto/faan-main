<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Gala FAAN-tastica 2025 event
        $galaEvent = Event::create([
            'title' => 'Gala FAAN-tastica 2025',
            'subtitle' => 'Annual Fundraising Gala',
            'starts' => Carbon::create(2025, 1, 1),
            'expires' => Carbon::create(2025, 12, 31),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'gala-faantastica-2025'
        ]);

        // Create sample HTML content for the event
        $galaContent = '<div class="event-content">
            <h3>Gala FAAN-tastica 2025</h3>
            <p>Join us for our annual fundraising gala supporting animal rescue efforts in Ecuador.</p>
            <p>This year\'s event promises to be our most spectacular yet, featuring:</p>
            <ul>
                <li>Live entertainment and music</li>
                <li>Gourmet dinner and open bar</li>
                <li>Silent and live auctions</li>
                <li>Awards ceremony recognizing outstanding volunteers</li>
                <li>Stories from successful adoptions</li>
            </ul>
            <p>All proceeds benefit the animals at our shelter and support our rescue operations.</p>
            <p><strong>Date:</strong> To be announced</p>
            <p><strong>Location:</strong> Cuenca, Ecuador</p>
            <p><strong>Tickets:</strong> Available soon</p>
        </div>';

        // Save the HTML content using the event's ID
        \Illuminate\Support\Facades\Storage::disk('public')->put("events/{$galaEvent->id}.html", $galaContent);
    }
}
