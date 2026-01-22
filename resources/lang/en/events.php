<?php
return [
    'meta' => [
        'title' => 'FAAN Events - FAAN Foundation for Animal Welfare',
        'description' => 'FAAN Events,fundaci\u00f3n faan familia amor animale',
        'keywords' => 'Animal Rescue and Adoption',
        'ogTitle' => 'FAAN Events - Fundaci\u00f3n FAAN, Familia Amor y Animale-Animal Rescue and Adoption',
        'ogDescription' => 'FAAN Events,fundaci\u00f3n faan familia amor animale',
        'ogLocale' => 'en_US'
    ],
    'headers' => [
        'past' => 'Past Events',
        'upcoming' => 'Current / Upcoming Events'
    ],
    'amigo-secreto-2023' => file_get_contents(__DIR__ . '/events/amigo-secreto-2023.html'),
    'dogs-art-love-2024' => file_get_contents(__DIR__ . '/events/dogs-art-love-2024.html'),
    'dogs-in-art-2024' => file_get_contents(__DIR__ . '/events/dogs-in-art-2024.html'),
    'faan-expo-2024' => file_get_contents(__DIR__ . '/events/faan-expo-2024.html'),
    'gala-2025' => file_get_contents(__DIR__ . '/events/gala-2025.html'),
    'lucky-paws-2024' => file_get_contents(__DIR__ . '/events/lucky-paws-2024.html'),
    'lucky-paws-groundbreak-pub-2024' => file_get_contents(__DIR__ . '/events/lucky-paws-groundbreak-pub-2024.html'),
    'new-volunteers-orientation-2024-04' => file_get_contents(__DIR__ . '/events/new-volunteers-orientation-2024-04.html'),
    'perros-de-esperanza-2024-04' => file_get_contents(__DIR__ . '/events/perros-de-esperanza-2024-04.html'),
    'ungala-2023' => file_get_contents(__DIR__ . '/events/ungala-2023.html'),
    'wine-to-the-rescue-2023' => file_get_contents(__DIR__ . '/events/wine-to-the-rescue-2023.html'),
    'volunteer-and-adopter-field-trip' => file_get_contents(__DIR__ . '/events/volunteer-and-adopter-field-trip.html'),
];
