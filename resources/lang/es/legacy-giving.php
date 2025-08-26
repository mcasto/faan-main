<?php

return [
    'meta' => [
        'title' => 'Donaciones de Legado - Donaciones - Fundación FAAN',
        'description' => 'Donaciones de Legado para perros en Ecuador',
        'keywords' => 'Donaciones de Legado, heredero, voluntario, rescate y adopción de animales, FAAN',
        'ogTitle' => 'Voluntario para salvar animales - Fundación FAAN',
        'ogDescription' => 'Donaciones de Legado para perros en Ecuador',
        'ogLocale' => 'EN_US'
    ],
    'header-area' => [
        'header' => 'Donaciones de Legado',
        'subtitle' => 'Considere irse al bienestar animal al incluir FAAN (<strong> Fundación Familia Amor Animal </strong>) en sus planes finales de patrimonio.',
        'image' => '/images/legacy-giving-01.jpeg'
    ],
    'left-column' => [
        'why' => [
            'header' => 'Por qué las cosas planificadas para dar asuntos',
            'text' => "La gran noticia sobre las donaciones planificadas es que no necesita ser rico para plantar una semilla para la futura sostenibilidad de FAAN.",
            'image' => '/images/legacy-giving-02.jpeg'
        ],
        'society' => "Únase a la Sociedad Legacy de Faan </strong> y sea reconocido hoy por una causa en la que cree. (Vea la información de contacto a continuación).",
        'guide' => [
            'header' => "Guía de faan para donaciones planificadas",
            'image' => '/Images/planning.png',
            'plan' => [
                "Complete FAAN's <strong>Legacy Donation</strong> and <strong>Planned Giving Intention</strong> forms.",
                "Determine the type of gift you wish to make to FAAN (outright bequest of a specific dollar amount, specific assets, or percentage of estate).",
                "Check with both your Ecuadorian and US attorney (if applicable) depending on asset location for correct legal language.",
                "Include <strong>FAAN (Fundación Familia Amor Animal)</strong> in your final will and testament."
            ]
        ]
    ],
    'right-column' => [
        'heir' => [
            'header' => 'El programa heredero: Artículo de nuestra revista',
            'text' => 'Lea un testimonio de primera mano sobre el legado.',
            'buttonLabel' => 'Leer / descargar pdf',
            'pdf' => '/downloadable/extracted-articles/heirofthedog/heirofthedog.pdf'
        ],
        'pledge' => [
            'header' => "Promesa de Faan a los donantes",
            'items' => [
                " Bequests to FAAN are used for organizational sustainability of the sanctuary unless designated for a specific FAAN program or service by the Donor. These funds are closely invested and allocated by agreement of both the combined FAAN Board &amp; US Advisory Board.",
                "Upon receipt of a Legacy Intention, Donors will be recognized as members of FAAN's Legacy Society unless an anonymous donation is requested."
            ]
        ]
    ],
    'form-config' => [
        'title' => 'Donación heredada e intención de donaciones planificadas',
        'buttonLabel' => 'Entregar',
        'legal_name_of_donor' => [
            'label' => 'Nombre legal del donante',
            'type' => 'texto'
        ],
        'phone' => [
            'label' => 'Número de teléfono',
            'type' => 'tel',
            'mask' => '(###) ### - ####'
        ],
        'cedula_passport' => [
            'label' => 'Cédula o número de pasaporte',
            'label' => 'Cédula o número de pasaporte',
            'type' => 'número'
        ],
        'email' => [
            'label' => 'Dirección de correo electrónico',
            'label' => 'Dirección de correo electrónico',
            'type' => 'correo electrónico'
        ],
        'address' => [
            'label' => 'DirecciÓn',
            'type' => 'textea'
        ],
        'special_instructions' => [
            'label' => 'Instrucciones especiales',
            'label' => 'Instrucciones especiales',
            'type' => 'textea'
        ],
        'recognized' => [
            'label' => "Me gustaría ser reconocido como miembro de la Sociedad Legal de FAAN",
            'type' => 'caja'
        ],
        'donation_type' => [
            'label' => 'Tipo de donación',
            'type' => 'seleccionar',
            'options' => [
                ['label' => 'Legado directo (cantidad fija de $)', 'value' => 'fijado'],
                ['label' => 'Legado absoluto (% del patrimonio)', 'value' => 'porcentaje'],
                ['label' => 'Donación de activos específicos', 'value' => 'donación']
            ],
            'followups' => [
                'fixed' => [
                    'label' => '$ Cantidad',
                    'type' => 'número'
                ],
                'percentage' => [
                    'label' => '% de patrimonio',
                    'type' => 'número'
                ],
                'donation' => [
                    'label' => 'Activos específicos',
                    'type' => 'textea'
                ],
            ]
        ],
        'consent' => [
            'label' => 'Tengo su consentimiento para que este sitio web mantenga mis datos personales únicamente para fines de comunicación y comprendo que no se compartirá con terceros.',
            'type' => 'caja'
        ]
    ],
    'recaptcha' => "Este sitio está protegido por Recaptcha y Google <a href = 'https: //policies.google.com/privacy' target = '_ en blanco'> Política de privacidad </a> y <a href = 'https: //policies.google.com/terms' Target = '_ en blanco'> Términos de servicio </a> Aplicar."
];
