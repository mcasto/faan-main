<?php

return [
    'meta' => [
        'title' => 'Legacy Giving - Donations - FAAN Foundation',
        'description' => 'Legacy Giving for Dogs in Equador',
        'keywords' => 'Legacy Giving,heir program,volunteer,Animal Rescue and Adoption,FAAN',
        'ogTitle' => 'Volunteering to save animals - FAAN Foundation',
        'ogDescription' => 'Legacy Giving for Dogs in Equador',
        'ogLocale' => 'en_US'
    ],
    'header-area' => [
        'header' => 'Legacy Giving',
        'subtitle' => 'Consider leaving to animal welfare by including FAAN (<strong>Fundacion Familia Amor Animal</strong>) in your final estate plans.',
        'image' => '/images/legacy-giving-01.jpeg'
    ],
    'left-column' => [
        'why' => [
            'header' => 'Why planned giving matters',
            'text' => "The great news about planned giving is that you don't need to be wealthy to plant a seed for FAAN's future sustainability.",
            'image' => '/images/legacy-giving-02.jpeg'
        ],
        'society' => "Join <strong>FAAN's Legacy Society</strong> and be recognized today for a cause you believe in. (See contact information below.)",
        'guide' => [
            'header' => "FAAN's Guide to Planned Giving",
            'image' => '/images/planning.png',
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
            'header' => 'The Heir Program&mdash;Article from our magazine',
            'text' => 'Read a firsthand testimonial about Legacy Giving.',
            'buttonLabel' => 'Read / Download PDF',
            'pdf' => '/downloadable/extracted-articles/heirofthedog/heirofthedog.pdf'
        ],
        'pledge' => [
            'header' => "FAAN's Pledge to Donors",
            'items' => [
                " Bequests to FAAN are used for organizational sustainability of the sanctuary unless designated for a specific FAAN program or service by the Donor. These funds are closely invested and allocated by agreement of both the combined FAAN Board &amp; US Advisory Board.",
                "Upon receipt of a Legacy Intention, Donors will be recognized as members of FAAN's Legacy Society unless an anonymous donation is requested."
            ]
        ]
    ],
    'form-config' => [
        'title' => 'Legacy Donation and Planned Giving Intention',
        'buttonLabel' => 'Submit',
        'legal_name_of_donor' => [
            'label' => 'Legal Name of Donor',
            'type' => 'text'
        ],
        'phone' => [
            'label' => 'Phone Number',
            'type' => 'tel',
            'mask' => '(###) ### - ####'
        ],
        'cedula_passport' => [
            'label' => 'Cédula or Passport Number',
            'label' => 'Cédula or Passport Number',
            'type' => 'number'
        ],
        'email' => [
            'label' => 'Email Address',
            'label' => 'Email Address',
            'type' => 'email'
        ],
        'address' => [
            'label' => 'Address',
            'type' => 'textarea'
        ],
        'special_instructions' => [
            'label' => 'Special Instructions',
            'label' => 'Special Instructions',
            'type' => 'textarea'
        ],
        'recognized' => [
            'label' => "I would like to be recognized as a member of FAAN's Legal Society",
            'type' => 'checkbox'
        ],
        'donation_type' => [
            'label' => 'Donation Type',
            'type' => 'select',
            'options' => [
                ['label' => 'Outright Bequest (Fixed $ Amount)', 'value' => 'fixed'],
                ['label' => 'Outright Bequest (% of Estate)', 'value' => 'percentage'],
                ['label' => 'Donation of Specific Assets', 'value' => 'donation']
            ],
            'followups' => [
                'fixed' => [
                    'label' => '$ Amount',
                    'type' => 'number'
                ],
                'percentage' => [
                    'label' => '% of Estate',
                    'type' => 'number'
                ],
                'donation' => [
                    'label' => 'Specific Assets',
                    'type' => 'textarea'
                ],
            ]
        ],
        'consent' => [
            'label' => 'I consent to have this website hold my personal data solely for communication purposes and understand that it will not be shared with any third parties.',
            'type' => 'checkbox'
        ]
    ],
    'recaptcha' => "This site is protected by reCAPTCHA and the Google <a href='https://policies.google.com/privacy' target='_blank'>Privacy Policy</a> and <a href='https://policies.google.com/terms' target='_blank'>Terms of Service</a> apply."
];
