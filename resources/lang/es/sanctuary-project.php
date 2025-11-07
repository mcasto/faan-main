<?php

return [
    'meta' => [
        'title' => 'Proyecto Santuario FAAN-Ecuador',
        'description' => 'Proyecto Santuario FAAN-Ecuador',
        'keywords' => 'proyecto de santuario de animales,Proyecto de santuario de animale,Ecuador,Rescate y Adopción de Animales',
        'ogTitle' => 'Proyecto Santuario FAAN-Ecuador',
        'ogDescription' => 'Proyecto Santuario FAAN-Ecuador',
        'ogLocale' => 'es_US'
    ],
    'header' => "Proyecto y objetivos del Santuario actual de FAAN",
    'subtitle' => 'Manteniendo a los animales seguros en Cuenca, Ecuador',
    'overview' => file_get_contents(__DIR__ . '/sanctuary-project/overview.html'),
    'community' => file_get_contents(__DIR__ . '/sanctuary-project/community.html'),
    'budget' => [
        'header' => file_get_contents(__DIR__ . '/sanctuary-project/budget.html'),
        'items' => json_decode(file_get_contents(__DIR__ . '/sanctuary-project/budget.json')),

    ],
    'total' => file_get_contents(__DIR__ . '/sanctuary-project/total.html'),
    'video' => '/storage/videos/superdogs.mp4'
];
