<?php

return [
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
                " Bequests to FAAN are used for organizational sustainability of the shelter unless designated for a specific FAAN program or service by the Donor. These funds are closely invested and allocated by agreement of both the combined FAAN Board &amp; US Advisory Board.",
                "Upon receipt of a Legacy Intention, Donors will be recognized as members of FAAN's Legacy Society unless an anonymous donation is requested."
            ]
        ]
    ],
    'form-config' => [
        [
            'field' => 'legal_name_of_donor',
            'label' => 'Legal Name of Donor',
        ],
        [
            'field' => 'phone',
            'label' => 'Phone Number',
        ],
        [
            'field' => 'cedula_passport',
            'label' => 'Cédula or Passport Number'
        ],
        [
            'field' => 'email',
            'label' => 'Email Address'
        ],
        [
            'field' => 'address',
            'label' => 'Address'
        ],
        [
            'field' => 'special_instructions',
            'label' => 'Special Instructions'
        ],
        [
            'field' => 'recognized',
            'label' => "I would like to be recognized as a member of FAAN's Legal Society"
        ],
        [
            'field' => 'donation_type',
            'label' => 'Donation Type'
        ],
        [
            'field' => 'consent',
            'label' => 'I consent to have this website hold my personal data solely for communication purposes and understand that it will not be shared with any third parties.'
        ]
    ],
    'recaptcha' => "This site is protected by reCAPTCHA and the Google <a href='https://policies.google.com/privacy' target='_blank'>Privacy Policy</a> and <a href='https://policies.google.com/terms' target='_blank'>Terms of Service</a> apply."
];
