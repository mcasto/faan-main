<?php
return [
    'meta' => [
        'title' => 'Eventos de FAAN - Fundación FAAN para el bienestar animal',
        'description' => 'Faan Events, Fundaci \ u00f3n Faan Familia Amor Animale',
        'keywords' => 'Rescate y adopción de animales',
        'ogTitle' => 'Eventos de FAAN - Fundaci \ u00f3n Faan, Familia Amor y Animale -Animal Rescue and Adoption',
        'ogDescription' => 'Faan Events, Fundaci \ u00f3n Faan Familia Amor Animale',
        'ogLocale' => 'EN_US'
    ],
    'headers' => [
        'past' => 'Eventos pasados',
        'upcoming' => 'Eventos actuales / próximos'
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
    'wine-to-the-rescue-2023' => file_get_contents(__DIR__ . '/events/wine-to-the-rescue-2023.html')
];
