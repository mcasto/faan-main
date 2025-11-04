<?php

return [
    'meta' => [
        'title' => 'Donaciones de legado - Donaciones - Fundación FAAN',
        'description' => 'Donaciones heredadas para perros en Ecuador',
        'keywords' => 'Legacy Giving, programa de herederos, voluntario, Rescate y Adopción de Animales, FAAN',
        'ogTitle' => 'Voluntariado para salvar animales - Fundación FAAN',
        'ogDescription' => 'Donaciones heredadas para perros en Ecuador',
        'ogLocale' => 'es_US'
    ],
    'header-area' => [
        'header' => 'Donación de legado',
        'subtitle' => 'Considere dejarlo en manos del bienestar animal incluyendo a FAAN (<strong>Fundación Familia Amor Animal</strong>) en sus planes patrimoniales finales.',
        'image' => '/images/legacy-giving-01.jpeg'
    ],
    'left-column' => [
        'why' => [
            'header' => 'Por qué son importantes las donaciones planificadas',
            'text' => "La buena noticia sobre las donaciones planificadas es que no es necesario ser rico para plantar una semilla para la sostenibilidad futura de FAAN.",
            'image' => '/images/legacy-giving-02.jpeg'
        ],
        'society' => "Únase a la <strong>FAAN's Legacy Society</strong> y sea reconocido hoy por una causa en la que cree. (Consulte la información de contacto a continuación).",
        'guide' => [
            'header' => "Guía de FAAN para donaciones planificadas",
            'image' => '/images/planificación.png',
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
            'header' => 'El Programa Heredero—Artículo de nuestra revista',
            'text' => 'Lea un testimonio de primera mano sobre Legacy Giving.',
            'buttonLabel' => 'Leer / Descargar PDF',
            'pdf' => '/descargable/artículos-extraídos/heirofthedog/heirofthedog.pdf'
        ],
        'pledge' => [
            'header' => "El compromiso de la FAAN con los donantes",
            'items' => [
                " Bequests to FAAN are used for organizational sustainability of the sanctuary unless designated for a specific FAAN program or service by the Donor. These funds are closely invested and allocated by agreement of both the combined FAAN Board &amp; US Advisory Board.",
                "Upon receipt of a Legacy Intention, Donors will be recognized as members of FAAN's Legacy Society unless an anonymous donation is requested."
            ]
        ]
    ],
    'form-config' => [
        'title' => 'Donación heredada e intención de donación planificada',
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
            'label' => 'Cédula o Número de Pasaporte',
            'label' => 'Cédula o Número de Pasaporte',
            'type' => 'número'
        ],
        'email' => [
            'label' => 'Dirección de correo electrónico',
            'label' => 'Dirección de correo electrónico',
            'type' => 'correo electrónico'
        ],
        'address' => [
            'label' => 'DirecciÓn',
            'type' => 'área de texto'
        ],
        'special_instructions' => [
            'label' => 'Instrucciones especiales',
            'label' => 'Instrucciones especiales',
            'type' => 'área de texto'
        ],
        'recognized' => [
            'label' => "Me gustaría ser reconocido como miembro de la Sociedad Jurídica de la FAAN",
            'type' => 'caja'
        ],
        'donation_type' => [
            'label' => 'Tipo de donación',
            'type' => 'seleccionar',
            'options' => [
                ['label' => 'Legado absoluto (cantidad fija en dólares)', 'value' => 'fijado'],
                ['label' => 'Legado absoluto (% del patrimonio)', 'value' => 'porcentaje'],
                ['label' => 'Donación de Activos Específicos', 'value' => 'donación']
            ],
            'followups' => [
                'fixed' => [
                    'label' => '$ Monto',
                    'type' => 'número'
                ],
                'percentage' => [
                    'label' => '% de patrimonio',
                    'type' => 'número'
                ],
                'donation' => [
                    'label' => 'Activos específicos',
                    'type' => 'área de texto'
                ],
            ]
        ],
        'consent' => [
            'label' => 'Doy mi consentimiento para que este sitio web conserve mis datos personales únicamente con fines de comunicación y entiendo que no se compartirán con terceros.',
            'type' => 'caja'
        ]
    ],
    'recaptcha' => "Este sitio está protegido por reCAPTCHA y se aplican las <a href='https://policies.google.com/privacy' target='_blank'>Política de Privacidad</a> y los <a href='https://policies.google.com/terms' target='_blank'>Términos de Servicio</a> de Google."
];
