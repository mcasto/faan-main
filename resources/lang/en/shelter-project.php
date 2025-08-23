<?php

return [
    'meta' => [
        'title' => 'FAAN Shelter Project-Ecuador',
        'description' => 'FAAN Shelter Project-Ecuador',
        'keywords' => 'animal shelter project,Proyecto de refugio de animale,Ecuador,Animal Rescue and Adoption',
        'ogTitle' => 'FAAN Shelter Project-Ecuador',
        'ogDescription' => 'FAAN Shelter Project-Ecuador',
        'ogLocale' => 'en_US'
    ],
    'header' => "FAAN's Current Shelter Project & Goals",
    'subtitle' => 'Keeping Animals Safe in Cuenca, Ecuador',
    'overview' => "We did it! We raised funds to purchase permanent land for the dogs of FAAN who were facing eviction. We are now entering building construction so that our dogs will have a safe and modern sanctuary that, hand in hand with education, prevention, and adoption, will make a real difference in Cuenca's care and kindness for abandoned, rescued, and vulnerable dogs.",
    'project_header' => "Project Goals",
    'phases' => [
        [
            'title' => 'Phase 1',
            'items' => [
                [
                    'title' => 'Purchase the land',
                    'completed' => true,
                    'children' => [
                        ['title' => 'Secure permits and create road access', 'completed' => true],
                        ['title' => 'Complete soil test to determine building location', 'completed' => true],
                        ['title' => 'Identify architect for detailed plan and specifications', 'completed' => true],
                        ['title' => 'Launch Capital Campaign to build the shelter', 'completed' => true],
                    ]
                ],
                [
                    'title' => 'Create the needed infrastructure for building the new dog shelter (where we are now)',
                    'completed' => false
                ]
            ]
        ],
        [
            'title' => 'Phase 2',
            'items' => [
                ['title' => 'Construction of the basic shelter structure', 'completed' => false],
                [
                    'title' => 'Moving our loving animals, particularly those at our upper shelter, who are now at imminent risk due to recent landslides at their temporary location',
                    'completed' => false
                ]
            ]
        ],
        [
            'title' => 'Phase 3',
            'items' => [
                ['title' => 'Construction of the outer buildings', 'completed' => false],
                [
                    'title' => 'Completion of the shelter, including our adoption center, special areas for visiting vets/spay and neutering, grooming area for the dogs, and a community education room',
                    'completed' => false
                ]
            ]
        ]
    ],
    'community' => file_get_contents(__DIR__ . '/shelter-project/community.html'),
    'preview' => file_get_contents(__DIR__ . '/shelter-project/preview.html')
];
