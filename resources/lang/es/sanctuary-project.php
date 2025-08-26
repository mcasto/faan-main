<?php

return [
    'meta' => [
        'title' => 'Proyecto de santuario de faan-ECUADOR',
        'description' => 'Proyecto de santuario de faan-ECUADOR',
        'keywords' => 'Proyecto de santuario de animales, Proyecto de Santuario de Animale, Ecuador, Rescate y Adopción de Animales',
        'ogTitle' => 'Proyecto de santuario de faan-ECUADOR',
        'ogDescription' => 'Proyecto de santuario de faan-ECUADOR',
        'ogLocale' => 'EN_US'
    ],
    'header' => "Proyecto santuario actual de FAAN y objetivos",
    'subtitle' => 'Mantener a los animales seguros en cuenca, Ecuador',
    'overview' => "¡Lo hicimos! Recaudamos fondos para comprar tierras permanentes para los perros de Faan que enfrentaban desalojo. Ahora estamos entrando en la construcción de edificios para que nuestros perros tengan un santuario seguro y moderno que, de la mano con la educación, la prevención y la adopción, marcará una verdadera diferencia en el cuidado y amabilidad de Cuenca para los perros abandonados, rescatados y vulnerables.",
    'project_header' => "Proyecto de objetivos",
    'phases' => [
        [
            'title' => 'Fase 1',
            'items' => [
                [
                    'title' => 'Compra el terreno',
                    'completed' => true,
                    'children' => [
                        ['title' => 'Asegure permisos y crear acceso a la carretera', 'completed' => true],
                        ['title' => 'Completa prueba de suelo para determinar la ubicación del edificio', 'completed' => true],
                        ['title' => 'Identificar el arquitecto para un plan y especificaciones detallados', 'completed' => true],
                        ['title' => 'Campaña Capital de lanzamiento para construir el santuario', 'completed' => true],
                    ]
                ],
                [
                    'title' => 'Cree la infraestructura necesaria para construir el nuevo santuario de perros (donde estamos ahora)',
                    'completed' => false
                ]
            ]
        ],
        [
            'title' => 'Fase 2',
            'items' => [
                ['title' => 'Construcción de la estructura del santuario básico', 'completed' => false],
                [
                    'title' => 'Mover nuestros animales amorosos, particularmente aquellos en nuestro santuario superior, que ahora tienen un riesgo inminente debido a los recientes deslizamientos de tierra en su ubicación temporal',
                    'completed' => false
                ]
            ]
        ],
        [
            'title' => 'Fase 3',
            'items' => [
                ['title' => 'Construcción de los edificios exteriores', 'completed' => false],
                [
                    'title' => 'Finalización del santuario, incluido nuestro centro de adopción, áreas especiales para visitar veterinarios/esterilización y castración, área de aseo para los perros y una sala de educación comunitaria',
                    'completed' => false
                ]
            ]
        ]
    ],
    'community' => file_get_contents(__DIR__ . '/sanctuary-project/community.html'),
    'preview' => file_get_contents(__DIR__ . '/sanctuary-project/preview.html')
];
