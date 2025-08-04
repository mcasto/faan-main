<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class OriginalEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create events directory
        Storage::disk('public')->makeDirectory('events');

        // Gala FAAN-tastica 2025 (current/upcoming)
        $gala = Event::create([
            'title' => 'Gala FAAN-tastica 2025',
            'subtitle' => 'The wait is over!',
            'starts' => Carbon::parse('2025-07-30'),
            'expires' => Carbon::parse('2025-11-22'),
            'hide_dates' => true,
            'is_active' => true,
            'slug' => 'gala-faantastica-2025'
        ]);

        $galaContent = file_get_contents(resource_path('content/en/faan-events/sections/gala-2025.html'));
        Storage::disk('public')->put('events/' . $gala->id . '.html', $galaContent);

        // FAAN Expo 2024 (past)
        $expo = Event::create([
            'title' => 'FAAN Expo at Feria de La Construcción, Vivienda, y Decoracíon',
            'subtitle' => 'Visit our exhibit at Ecuador\'s largest construction and home design show.',
            'starts' => Carbon::parse('2024-04-05'),
            'expires' => Carbon::parse('2024-04-07'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'faan-expo-2024'
        ]);

        $expoContent = file_get_contents(resource_path('content/en/faan-events/sections/faan-expo-2024.html'));
        Storage::disk('public')->put('events/' . $expo->id . '.html', $expoContent);

        // FAAN's March Pot of Gold 2024 (past)
        $potOfGold = Event::create([
            'title' => 'FAAN\'s March Pot of Gold!',
            'subtitle' => 'One of our generous leprechauns will match donations made through May 2024',
            'starts' => Carbon::parse('2024-03-01'),
            'expires' => Carbon::parse('2024-05-14'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'lucky-paws-2024'
        ]);

        $potOfGoldContent = file_get_contents(resource_path('content/en/faan-events/sections/lucky-paws-2024.html'));
        Storage::disk('public')->put('events/' . $potOfGold->id . '.html', $potOfGoldContent);

        // Lucky Paws Groundbreak Pub 2024 (past)
        $groundbreak = Event::create([
            'title' => 'Lucky Paws Groundbreak Pub',
            'subtitle' => 'Celebrate the groundbreaking of our new shelter',
            'starts' => Carbon::parse('2024-06-15'),
            'expires' => Carbon::parse('2024-06-15'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'lucky-paws-groundbreak-pub-2024'
        ]);

        $groundbreakContent = file_get_contents(resource_path('content/en/faan-events/sections/lucky-paws-groundbreak-pub-2024.html'));
        Storage::disk('public')->put('events/' . $groundbreak->id . '.html', $groundbreakContent);

        // Dogs, Art, Love 2024 (past)
        $dogsArt = Event::create([
            'title' => 'Dogs, Art, Love',
            'subtitle' => 'February 15 - March 1',
            'starts' => Carbon::parse('2024-02-05'),
            'expires' => Carbon::parse('2024-03-01'),
            'hide_dates' => true,
            'is_active' => true,
            'slug' => 'dogs-art-love-2024'
        ]);

        $dogsArtContent = file_get_contents(resource_path('content/en/faan-events/sections/dogs-art-love.html'));
        Storage::disk('public')->put('events/' . $dogsArt->id . '.html', $dogsArtContent);

        // Dogs in Art (past)
        $dogsInArt = Event::create([
            'title' => 'Dogs in Art',
            'subtitle' => 'Art exhibition featuring canine subjects',
            'starts' => Carbon::parse('2024-01-15'),
            'expires' => Carbon::parse('2024-02-15'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'dogs-in-art-2024'
        ]);

        $dogsInArtContent = file_get_contents(resource_path('content/en/faan-events/sections/dogs-in-art.html'));
        Storage::disk('public')->put('events/' . $dogsInArt->id . '.html', $dogsInArtContent);

        // Wine to the Rescue 2023 (past)
        $wine = Event::create([
            'title' => 'FAAN Wine to the Rescue!',
            'subtitle' => 'December 14, 7 PM',
            'starts' => Carbon::parse('2023-12-14'),
            'expires' => Carbon::parse('2023-12-14'),
            'hide_dates' => true,
            'is_active' => true,
            'slug' => 'wine-to-the-rescue-2023'
        ]);

        $wineContent = file_get_contents(resource_path('content/en/faan-events/sections/wine-to-the-rescue.html'));
        Storage::disk('public')->put('events/' . $wine->id . '.html', $wineContent);

        // New Volunteers Orientation April 2024 (past)
        $orientation = Event::create([
            'title' => 'New Volunteers Orientation',
            'subtitle' => 'Learn how you can help FAAN',
            'starts' => Carbon::parse('2024-04-20'),
            'expires' => Carbon::parse('2024-04-20'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'new-volunteers-orientation-2024-04'
        ]);

        $orientationContent = file_get_contents(resource_path('content/en/faan-events/sections/new-volunteers-orientation-2024-04.html'));
        Storage::disk('public')->put('events/' . $orientation->id . '.html', $orientationContent);

        // Perros de Esperanza April 2024 (past)
        $perros = Event::create([
            'title' => 'Perros de Esperanza',
            'subtitle' => 'Dogs of Hope fundraising event',
            'starts' => Carbon::parse('2024-04-15'),
            'expires' => Carbon::parse('2024-04-15'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'perros-de-esperanza-2024-04'
        ]);

        $perrosContent = file_get_contents(resource_path('content/en/faan-events/sections/perros-de-esperanza-2024-04.html'));
        Storage::disk('public')->put('events/' . $perros->id . '.html', $perrosContent);

        // Amigo Secreto (past)
        $amigo = Event::create([
            'title' => 'Amigo Secreto',
            'subtitle' => 'Secret friend gift exchange for the animals',
            'starts' => Carbon::parse('2023-12-01'),
            'expires' => Carbon::parse('2023-12-25'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'amigo-secreto-2023'
        ]);

        $amigoContent = file_get_contents(resource_path('content/en/faan-events/sections/amigo-secreto.html'));
        Storage::disk('public')->put('events/' . $amigo->id . '.html', $amigoContent);

        // Un Gala (past)
        $ungala = Event::create([
            'title' => 'Un Gala',
            'subtitle' => 'FAAN fundraising gala event',
            'starts' => Carbon::parse('2023-11-15'),
            'expires' => Carbon::parse('2023-11-15'),
            'hide_dates' => false,
            'is_active' => true,
            'slug' => 'ungala-2023'
        ]);

        $ungalaContent = file_get_contents(resource_path('content/en/faan-events/sections/ungala.html'));
        Storage::disk('public')->put('events/' . $ungala->id . '.html', $ungalaContent);

        $this->command->info('Created ' . Event::count() . ' events from original site data');
    }
}
