<?php

use GrahamCampbell\Markdown\Facades\Markdown;

return [
    'meta' => [
        'title' => 'Medios/Recursos -Rescate y adopción de animales',
        'description' => 'Medios/Recursos - fundación faan familia amor animale,Rescate y Adopción de Animales',
        'keywords' => 'Rescate y Adopción de Animales,Ecuador',
        'ogTitle' => 'Medios - Fundación FAAN, Familia Amor y Animale-Rescate y Adopción de Animales',
        'ogDescription' => 'Medios/Recursos - fundación faan familia amor animale,Rescate y Adopción de Animales',
        'ogLocale' => 'es_US'
    ],
    'linkHeader' => 'multimedia en línea',
    'top' => [
        'header' => 'Medios y recursos',
        'paragraphs' => [
            "FAAN is a grassroots community organization committed to animal welfare in Cuenca, Ecuador. We are supported by the local community and animal lovers around the world. We are currently working to build Ecuador's most modern and sustainable animal sanctuary.",
            "We've included resources for you to share with family and friends. Together we can achieve our goal of purchasing the land and moving our dogs in the first quarter of 2024."
        ]
    ],
    'images' => [
        '2023' => [
            '/images/bestof20231.jpg',
            '/images/bestof20232.jpg',
        ],
        '2024' => [
            '/images/2024-best-animal-shelter.jpg',
            '/images/2024-best-charity-event.jpg',
            '/images/2024-best-local-hero.jpg',
            '/images/2024-best-volunteer-opportunity.jpg'
        ]
    ],
    'benefits' => [
        'header' => 'FAAN beneficia a la comunidad',
        'items' => [
            '<em>Education</em>&mdash;Reducing abuse and raising awareness',
            '<em>Spay & Neuter</em>&mdash;Working with a network of community veterinarians',
            '<em>Adoption, sanctuary, Refuge</em>&mdash;Getting at risk, senior, and medically challenged dogs off the streets and into forever homes',
            '<em>Care</em>&mdash;Improving nutrition and providing medical care, training, and a large dose of love'
        ]
    ],
    'supporter' => [
        'header' => '¡Sea un partidario de perros FAAN-atic!',
        'subtitle' => '¡Únase a nosotros y sea un partidario de FAAN-atic hoy!',
        'bullet' => '/images/list-paw.png',
        'items' => [
            'Volunteer',
            'Adopt',
            'Foster',
            'Donate',
            'Share Our Mission'
        ]
    ],
    'media-release' => [
        'title' => 'Comunicado de prensa: 6 de octubre de 2025',
        'caption' => 'Haga clic en la imagen para leer el comunicado completo',
        'image' => '/images/12-mediodía-social-media.jpg',
        'body' => file_get_contents(__DIR__ . '/media-resources/release-2025-10-06.html')
    ],
    'link-sections' => [
        'social' => [
            'order' => 1,
            'header' => 'Redes Sociales',
            'links' => [
                [
                    'label' => 'Página de Facebook',
                    'url' => 'https://www.facebook.com/familiaamoranimal',
                ],
                [
                    'label' => 'grupo de facebook',
                    'url' => 'https://www.facebook.com/groups/736258083116570/',
                ],
                [
                    'label' => 'Instagram',
                    'url' => 'https://www.instagram.com/faancuenca/',
                    'hidden' => true,
                ]
            ]
        ],
        'magazines' => [
            'order' => 2,
            'header' => 'Revistas FAAN',
            'links' => [
                [
                    'label' => 'abril 2024',
                    'url' => "/descargable/revistas/2024-04.pdf",
                ],
                [
                    'label' => 'Enero de 2024: Informe anual y hoja de ruta',
                    'url' => "/descargable/magazines/2024-01-16-FAAN_annual_report_and_roadmap.pdf",
                ],
                [
                    'label' => 'diciembre 2023',
                    'url' => "/descargable/revistas/2023-12-newsletter.pdf",
                ],
                [
                    'label' => 'junio 2023',
                    'url' => "/descargable/revistas/especialedition23.pdf",
                ],
                [
                    'label' => 'mayo 2023',
                    'url' => "/descargable/revistas/FAANMay2023.pdf",
                ],
                [
                    'label' => 'marzo 2023',
                    'url' => "/descargable/revistas/FAANMar2023MagazineV1.pdf",
                ],
                [
                    'label' => 'febrero 2023',
                    'url' => "/descargable/revistas/feb2023.pdf",
                ],
                [
                    'label' => 'enero 2023',
                    'url' => "/descargable/magazines/jan2023.pdf",
                ],
                [
                    'label' => 'Actualización de progreso de la FAAN (enero de 2023)',
                    'url' => "/descargable/magazines/progressupdatej1823.pdf",
                ],
                [
                    'label' => 'diciembre 2022',
                    'url' => "/descargable/revistas/dec2022.pdf",
                ],
                [
                    'label' => 'noviembre 2022',
                    'url' => "/descargable/magazines/midnov2022.pdf",
                ]
            ]
        ],
        'specialDocuments' => [
            'order' => 3,
            'header' => 'Documentos informativos y recursos especiales',
            'links' => [
                [
                    'label' => 'Lista de deseos para perros',
                    'url' => "/descargable/lista-de-deseos-de-perritos.pdf",
                ],
                [
                    'label' => 'Libro para colorear y actividades (bilingüe)',
                    'url' => "/descargable/bekindbiling.pdf",
                ]
            ]
        ],
        'extractedArticles' => [
            'order' => 4,
            'header' => 'Artículos extraídos',
            'links' => [
                [
                    'label' => 'Un día: una historia de Sandra Beaumont, agosto de 2023',
                    'url' => "/descargable/artículos-extraídos/oneday2023.pdf",
                ],
                [
                    'label' => 'Dodi\'s Dogs - A ReHoming Love Story-June 2023',
                    'url' => "/descargable/artículos-extraídos/dodisdogs.pdf",
                ],
                [
                    'label' => 'Adopciones-junio 2023',
                    'url' => "/descargable/artículos-extraídos/adopcionesjunio2023.pdf",
                ],
                [
                    'label' => 'Datos FAAN-¿Sabías que?-Junio ​​2023',
                    'url' => "/descargable/artículos-extraídos/faanfactsjune2023.pdf",
                ],
                [
                    'label' => 'Adoptaste-¿Y ahora qué?-Junio ​​2023',
                    'url' => "/descargable/artículos-extraídos/ruleof3june2023.pdf",
                ],
                [
                    'label' => 'Heredero del Perro-Mayo 2023',
                    'url' => "/descargable/artículos-extraídos/heirofthedog/heirofthedog.pdf",
                ],
                [
                    'label' => '5 cosas que nos enseñan los perros: mayo de 2023',
                    'url' => "/descargable/artículos-extraídos/thingsdogsteachus/thingsdogsteachus.pdf",
                ],
                [
                    'label' => 'Celebrando la vida emocional de los perros: mayo de 2023',
                    'url' => "/descargable/artículos-extraídos/emotionallives/emotionallives.pdf",
                ],
                [
                    'label' => 'FAAN Conversa con Yapa Tree: Nov 2023',
                    'url' => 'https://yapatree.com/cuenca-dog-problem-what-you-can-do/',
                ]
            ]
        ],
        'worldAnimalDay' => [
            'order' => 5,
            'header' => 'FAAN celebra el Día Mundial de los Animales',
            'links' => [
                [
                    'label' => 'Características del árbol de Yapa FAAN',
                    'url' => 'https://yapatree.com/faan-celebrate-world-animal-day/',
                ],
                [
                    'label' => 'Visita nuestro Santuario Temporal',
                    'url' => 'https://www.youtube.com/watch?v=kAZDjqn3U5Y&t=168s&ab_channel=TravelWithUsbyWarren%26Julie',
                ]
            ]
        ],
        'featured' => [
            'order' => 6,
            'header' => 'Artículos que presentan FAAN',
            'links' => [
                [
                    'label' => 'Cuenca alta vida parte 1',
                    'url' => 'https://cuencahighlife.com/discovering-a-pawsome-volunteer-purpose-expat-couple-joins-effort-to-rescue-cuenca-street-dogs/',
                ],
                [
                    'label' => 'Cuenca alta vida parte 2',
                    'url' => 'https://cuencahighlife.com/faans-dream-of-providing-a-better-life-for-homeless-dogs-in-cuenca/',
                ],
                [
                    'label' => 'Cuenca alta vida pt.3',
                    'url' => 'https://cuencahighlife.com/cuenca-expats-raise-their-paws-to-build-a-new-animal-shelter-heres-how-you-can-help/',
                ]
            ]
        ],
        'multimedia' => [
            'order' => 7,
            'header' => 'Videos/Slideshows',
            'links' => [
                [
                    'label' => 'Ayúdanos a ayudar a los perros',
                    'url' => '/multimedia/videos/faan-video-reel-2024-03-21.mp4',
                ],
                [
                    'label' => 'Características del árbol de Yapa FAAN',
                    'url' => 'https://yapatree.com/faan-celebrate-world-animal-day/',
                ],
                [
                    'label' => 'Visita nuestro Santuario Temporal',
                    'url' => 'https://www.youtube.com/watch?v=kAZDjqn3U5Y&t=168s&ab_channel=TravelWithUsbyWarren%26Julie',
                ],
                [
                    'label' => '¡La historia de Willy!',
                    'url' => '/multimedia/videos/willy.mp4',
                ],
                [
                    'label' => 'Nuestros logros',
                    'url' => '/multimedia/videos/marzo25.mp4',
                ],
                [
                    'label' => 'Presentación de diapositivas voluntaria FAAN-atics',
                    'url' => '/presentación-de-diapositivas-voluntaria-de-faan-atics',
                ],
                [
                    'label' => 'Día Mundial de los Animales Sin Hogar: ¡Únase a Michael y sus invitados, Rosemary Rein y Sandra Beaumont mientras discutimos la importancia de apoyar a los animales callejeros!',
                    'url' => 'https://www.youtube.com/live/KSFuyyd4xCQ?feature',
                ],
                [
                    'label' => '¡Recordando la GalaFAAN-TASTICA 2023!',
                    'url' => '/multimedia/videos/gala-gracias-vid.mp4',
                ]
            ]
        ]
    ],
    'gallery' => [
        'header' => 'Galería de fotos',
        'items' => [
            "/media-images/mediagal0.jpg",
            "/media-images/mediagal1.jpg",
            "/media-images/mediagal2.jpg",
            "/media-images/mediagal3.jpg",
            "/media-images/mediagal4.jpg",
            "/media-images/mediagal5.jpg",
            "/media-images/mediagal6.jpg",
            "/media-images/mediagal7.jpg",
            "/media-images/mediagal8.jpg",
            "/media-images/mediagal9.jpg",
            "/media-images/mediagal10.jpg",
            "/media-images/mediagal11.jpg",
            "/media-images/mediagal12.jpg",
            "/media-images/mediagal13.jpg",
            "/media-images/mediagal14.jpg",
            "/media-images/mediagal15.jpg",
            "/media-images/mediagal16.jpg",
            "/media-images/mediagal17.jpg",
            "/media-images/mediagal18.jpg",
            "/media-images/mediagal19.jpg",
            "/media-images/mediagal20.jpg",
            "/media-images/mediagal21.jpg",
            "/media-images/mediagal22.jpg",
            "/media-images/mediagal23.jpg",
            "/media-images/mediagal24.jpg",
            "/media-images/mediagal25.jpg",
            "/media-images/mediagal26.jpg",
            "/media-images/mediagal27.jpg",
            "/media-images/mediagal28.jpg",
            "/media-images/mediagal29.jpg",
            "/media-images/mediagal30.jpg",
            "/media-images/mediagal31.jpg",
            "/media-images/mediagal32.jpg",
            "/media-images/mediagal33.jpg",
            "/media-images/mediagal34.jpeg",
            "/media-images/mediagal35.jpg",
            "/media-images/mediagal36.jpg",
            "/media-images/mediagal37.jpg",
            "/media-images/mediagal38.jpg",
            "/media-images/mediagal39.jpg",
            "/media-images/mediagal40.jpg",
            "/media-images/mediagal41.jpg",
            "/media-images/mediagal42.jpg"
        ]
    ]
];
