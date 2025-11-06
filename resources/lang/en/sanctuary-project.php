<?php

return [
    'meta' => [
        'title' => 'FAAN Sanctuary Project-Ecuador',
        'description' => 'FAAN Sanctuary Project-Ecuador',
        'keywords' => 'animal sanctuary project,Proyecto de santuario de animale,Ecuador,Animal Rescue and Adoption',
        'ogTitle' => 'FAAN Sanctuary Project-Ecuador',
        'ogDescription' => 'FAAN Sanctuary Project-Ecuador',
        'ogLocale' => 'en_US'
    ],
    'header' => "FAAN's Current Sanctuary Project & Goals",
    'subtitle' => 'Keeping Animals Safe in Cuenca, Ecuador',
    'overview' => file_get_contents(__DIR__ . '/sanctuary-project/overview.html'),
    'community' => file_get_contents(__DIR__ . '/sanctuary-project/community.html'),
    'budget' => [
        'header' => file_get_contents(__DIR__ . '/sanctuary-project/budget.html'),
        'items' => json_decode(file_get_contents(__DIR__ . '/sanctuary-project/budget.json'))
    ],
    'video' => '/storage/videos/superdogs.mp4'
];
