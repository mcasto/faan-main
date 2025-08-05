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
        // Clear existing events
        Event::truncate();

        // Real production events data
        $events = [
            [
                'id' => 1,
                'title' => 'Gala FAAN-tastica 2025',
                'subtitle' => 'The wait is over!',
                'slug' => 'gala-faantastica-2025',
                'starts' => Carbon::create(2025, 7, 30),
                'expires' => Carbon::create(2025, 11, 22),
                'hide_dates' => true,
                'is_active' => true,
            ],
            [
                'id' => 2,
                'title' => 'FAAN Expo at Feria de La Construcción, Vivienda, y Decoracíon',
                'subtitle' => 'Visit our exhibit at Ecuador\'s largest construction and home design show.',
                'slug' => 'faan-expo-2024',
                'starts' => Carbon::create(2024, 4, 5),
                'expires' => Carbon::create(2024, 4, 7),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 3,
                'title' => 'FAAN\'s March Pot of Gold!',
                'subtitle' => 'One of our generous leprechauns will match donations made through May 2024',
                'slug' => 'lucky-paws-2024',
                'starts' => Carbon::create(2024, 3, 1),
                'expires' => Carbon::create(2024, 5, 14),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 4,
                'title' => 'Lucky Paws Groundbreak Pub',
                'subtitle' => 'Celebrate the groundbreaking of our new shelter',
                'slug' => 'lucky-paws-groundbreak-pub-2024',
                'starts' => Carbon::create(2024, 6, 15),
                'expires' => Carbon::create(2024, 6, 15),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 5,
                'title' => 'Dogs, Art, Love',
                'subtitle' => 'February 15 - March 1',
                'slug' => 'dogs-art-love-2024',
                'starts' => Carbon::create(2024, 2, 5),
                'expires' => Carbon::create(2024, 3, 1),
                'hide_dates' => true,
                'is_active' => true,
            ],
            [
                'id' => 6,
                'title' => 'Dogs in Art',
                'subtitle' => 'Art exhibition featuring canine subjects',
                'slug' => 'dogs-in-art-2024',
                'starts' => Carbon::create(2024, 1, 15),
                'expires' => Carbon::create(2024, 2, 15),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 7,
                'title' => 'FAAN Wine to the Rescue!',
                'subtitle' => 'December 14, 7 PM',
                'slug' => 'wine-to-the-rescue-2023',
                'starts' => Carbon::create(2023, 12, 14),
                'expires' => Carbon::create(2023, 12, 14),
                'hide_dates' => true,
                'is_active' => true,
            ],
            [
                'id' => 8,
                'title' => 'New Volunteers Orientation',
                'subtitle' => 'Learn how you can help FAAN',
                'slug' => 'new-volunteers-orientation-2024-04',
                'starts' => Carbon::create(2024, 4, 20),
                'expires' => Carbon::create(2024, 4, 20),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 9,
                'title' => 'Perros de Esperanza',
                'subtitle' => 'Dogs of Hope fundraising event',
                'slug' => 'perros-de-esperanza-2024-04',
                'starts' => Carbon::create(2024, 4, 15),
                'expires' => Carbon::create(2024, 4, 15),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 10,
                'title' => 'Amigo Secreto',
                'subtitle' => 'Secret friend gift exchange for the animals',
                'slug' => 'amigo-secreto-2023',
                'starts' => Carbon::create(2023, 12, 1),
                'expires' => Carbon::create(2023, 12, 25),
                'hide_dates' => false,
                'is_active' => true,
            ],
            [
                'id' => 11,
                'title' => 'Un Gala',
                'subtitle' => 'FAAN fundraising gala event',
                'slug' => 'ungala-2023',
                'starts' => Carbon::create(2023, 11, 15),
                'expires' => Carbon::create(2023, 11, 15),
                'hide_dates' => false,
                'is_active' => true,
            ],
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
