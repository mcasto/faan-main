<?php

use GrahamCampbell\Markdown\Facades\Markdown;

return [
    'meta' => [
        'title' => 'Media/Resources -Animal Rescue and Adoption',
        'description' => 'Media/Resources - fundación faan familia amor animale,Animal Rescue and Adoption',
        'keywords' => 'Animal Rescue and Adoption,Ecuador',
        'ogTitle' => 'Media - Fundación FAAN, Familia Amor y Animale-Animal Rescue and Adoption',
        'ogDescription' => 'Media/Resources - fundación faan familia amor animale,Animal Rescue and Adoption',
        'ogLocale' => 'en_US'
    ],
    'linkHeader' => 'Online Multimedia',
    'top' => [
        'header' => 'Media & Resources',
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
        'header' => 'FAAN Benefits the Community',
        'items' => [
            '<em>Education</em>&mdash;Reducing abuse and raising awareness',
            '<em>Spay & Neuter</em>&mdash;Working with a network of community veterinarians',
            '<em>Adoption, sanctuary, Refuge</em>&mdash;Getting at risk, senior, and medically challenged dogs off the streets and into forever homes',
            '<em>Care</em>&mdash;Improving nutrition and providing medical care, training, and a large dose of love'
        ]
    ],
    'supporter' => [
        'header' => 'Be a FAAN-atic Dog Supporter!',
        'subtitle' => 'Join Us and Be a FAAN-atic Supporter Today!',
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
        'title' => 'Media Release: Oct 6, 2025',
        'caption' => 'Click image to read full release',
        'image' => '/images/12-noon-social-media.jpg',
        'body' => file_get_contents(__DIR__ . '/media-resources/release-2025-10-06.html')
    ],
    'link-sections' => [
        'social' => [
            'order' => 1,
            'header' => 'Social Media',
            'links' => [
                [
                    'label' => 'Facebook Page',
                    'url' => 'https://www.facebook.com/familiaamoranimal',
                ],
                [
                    'label' => 'Facebook Group',
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
            'header' => 'FAAN Magazines',
            'links' => [
                [
                    'label' => 'April 2024',
                    'url' => "/downloadable/magazines/2024-04.pdf",
                ],
                [
                    'label' => 'January 2024: Annual Report and Roadmap',
                    'url' => "/downloadable/magazines/2024-01-16-annual_report_and_roadmap.pdf",
                ],
                [
                    'label' => 'December 2023',
                    'url' => "/downloadable/magazines/2023-12-newsletter.pdf",
                ],
                [
                    'label' => 'June 2023',
                    'url' => "/downloadable/magazines/specialedition23.pdf",
                ],
                [
                    'label' => 'May 2023',
                    'url' => "/downloadable/magazines/FAANMay2023.pdf",
                ],
                [
                    'label' => 'March 2023',
                    'url' => "/downloadable/magazines/FAANMar2023MagazineV1.pdf",
                ],
                [
                    'label' => 'February 2023',
                    'url' => "/downloadable/magazines/feb2023.pdf",
                ],
                [
                    'label' => 'January 2023',
                    'url' => "/downloadable/magazines/jan2023.pdf",
                ],
                [
                    'label' => 'FAAN Progress Update (January 2023)',
                    'url' => "/downloadable/magazines/progressupdatej1823.pdf",
                ],
                [
                    'label' => 'December 2022',
                    'url' => "/downloadable/magazines/dec2022.pdf",
                ],
                [
                    'label' => 'November 2022',
                    'url' => "/downloadable/magazines/midnov2022.pdf",
                ]
            ]
        ],
        'specialDocuments' => [
            'order' => 3,
            'header' => 'Information Documents & Special Resources',
            'links' => [
                [
                    'label' => 'Doggie Wish List',
                    'url' => "/downloadable/doggie-wish-list.pdf",
                ],
                [
                    'label' => 'Coloring & Activity Book (bilingual)',
                    'url' => "/downloadable/bekindbiling.pdf",
                ]
            ]
        ],
        'extractedArticles' => [
            'order' => 4,
            'header' => 'Extracted Articles',
            'links' => [
                [
                    'label' => 'One Day - A Story by Sandra Beaumont-Aug 2023',
                    'url' => "/downloadable/extracted-articles/oneday2023.pdf",
                ],
                [
                    'label' => 'Dodi\'s Dogs - A ReHoming Love Story-June 2023',
                    'url' => "/downloadable/extracted-articles/dodisdogs.pdf",
                ],
                [
                    'label' => 'Adoptions-June 2023',
                    'url' => "/downloadable/extracted-articles/adoptionsjune2023.pdf",
                ],
                [
                    'label' => 'FAAN Facts-Did you Know?-June 2023',
                    'url' => "/downloadable/extracted-articles/faanfactsjune2023.pdf",
                ],
                [
                    'label' => 'You Adopted-Now What?-June 2023',
                    'url' => "/downloadable/extracted-articles/ruleof3june2023.pdf",
                ],
                [
                    'label' => 'Heir of the Dog-May 2023',
                    'url' => "/downloadable/extracted-articles/heirofthedog/heirofthedog.pdf",
                ],
                [
                    'label' => '5 Things Dogs Teach Us-May 2023',
                    'url' => "/downloadable/extracted-articles/thingsdogsteachus/thingsdogsteachus.pdf",
                ],
                [
                    'label' => 'Celebrating the Emotional Lives of Dogs-May 2023',
                    'url' => "/downloadable/extracted-articles/emotionallives/emotionallives.pdf",
                ],
                [
                    'label' => 'FAAN Talks with Yapa Tree: Nov 2023',
                    'url' => 'https://yapatree.com/cuenca-dog-problem-what-you-can-do/',
                ]
            ]
        ],
        'worldAnimalDay' => [
            'order' => 5,
            'header' => 'FAAN Celebrates World Animal Day',
            'links' => [
                [
                    'label' => 'Yapa Tree Features FAAN',
                    'url' => 'https://yapatree.com/faan-celebrate-world-animal-day/',
                ],
                [
                    'label' => 'Visit our Temporary Sanctuary',
                    'url' => 'https://www.youtube.com/watch?v=kAZDjqn3U5Y&t=168s&ab_channel=TravelWithUsbyWarren%26Julie',
                ]
            ]
        ],
        'featured' => [
            'order' => 6,
            'header' => 'Articles Featuring FAAN',
            'links' => [
                [
                    'label' => 'Cuenca High Life Pt.1',
                    'url' => 'https://cuencahighlife.com/discovering-a-pawsome-volunteer-purpose-expat-couple-joins-effort-to-rescue-cuenca-street-dogs/',
                ],
                [
                    'label' => 'Cuenca High Life Pt.2',
                    'url' => 'https://cuencahighlife.com/faans-dream-of-providing-a-better-life-for-homeless-dogs-in-cuenca/',
                ],
                [
                    'label' => 'Cuenca High Life Pt.3',
                    'url' => 'https://cuencahighlife.com/cuenca-expats-raise-their-paws-to-build-a-new-animal-shelter-heres-how-you-can-help/',
                ]
            ]
        ],
        'multimedia' => [
            'order' => 7,
            'header' => 'Videos/Slideshows',
            'links' => [
                [
                    'label' => 'Help Us Help The Dogs',
                    'url' => '/multimedia/videos/faan-video-reel-2024-03-21.mp4',
                ],
                [
                    'label' => 'Yapa Tree Features FAAN',
                    'url' => 'https://yapatree.com/faan-celebrate-world-animal-day/',
                ],
                [
                    'label' => 'Visit our Temporary Sanctuary',
                    'url' => 'https://www.youtube.com/watch?v=kAZDjqn3U5Y&t=168s&ab_channel=TravelWithUsbyWarren%26Julie',
                ],
                [
                    'label' => 'The Story of Willy!',
                    'url' => '/multimedia/videos/willy.mp4',
                ],
                [
                    'label' => 'Our Accomplishments',
                    'url' => '/multimedia/videos/march25.mp4',
                ],
                [
                    'label' => 'FAAN-atics Volunteer slide show',
                    'url' => '/faan-atics-volunteer-slide-show',
                ],
                [
                    'label' => 'World Homeless Animal Day: Join Michael and his guests, Rosemary Rein and Sandra Beaumont as we discuss the importance of supporting stray animals!',
                    'url' => 'https://www.youtube.com/live/KSFuyyd4xCQ?feature',
                ],
                [
                    'label' => 'Remembering the 2023 GalaFAAN-TASTICA!',
                    'url' => '/multimedia/videos/gala-thanks-vid.mp4',
                ]
            ]
        ]
    ],
    'gallery' => [
        'header' => 'Photo Gallery',
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
